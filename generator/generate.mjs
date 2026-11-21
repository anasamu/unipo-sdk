#!/usr/bin/env node
/*
 * Generator SDK SIAKAD UNIPO.
 *
 * Membaca spesifikasi OpenAPI (openapi.json) lalu menulis kode modul API untuk kedua paket:
 *   - node/src/generated/{schemas,resources,siakad}.ts
 *   - php/src/Resources/*.php dan php/src/Concerns/GeneratedResources.php
 *
 * Jalankan setelah endpoint SIAKAD bertambah:
 *   curl -s https://api.unipo.ac.id/v1/openapi.json > openapi.json   # atau spec-dari-siakad.php
 *   node generator/generate.mjs
 *
 * Kode inti (HTTP, token, galat) ditulis tangan dan tidak disentuh generator.
 */
import { mkdirSync, readFileSync, readdirSync, rmSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const ROOT = join(dirname(fileURLToPath(import.meta.url)), '..');
const specPath = process.argv[2] ?? join(ROOT, 'openapi.json');
const spec = JSON.parse(readFileSync(specPath, 'utf8'));
const schemas = spec.components?.schemas ?? {};
/** $ref yang menunjuk skema yang tidak ada di components.schemas. */
const refHilang = new Set();

const VERBS = ['get', 'post', 'put', 'patch', 'delete'];
const SKIP = (path) => path === '/' || path === '/docs' || path.startsWith('/v1/auth/');

// ---------------------------------------------------------------------------- model

const pascal = (s) =>
  s
    .split(/[^A-Za-z0-9]+/)
    .filter(Boolean)
    .map((p) => p[0].toUpperCase() + p.slice(1))
    .join('');
const camel = (s) => {
  const p = pascal(s);
  return p[0].toLowerCase() + p.slice(1);
};

function moduleOf(path) {
  if (path === '/v1') return 'system';
  const seg = path.split('/')[2];
  if (seg === 'health' || seg === 'openapi.json') return 'system';
  return seg;
}

function methodName(mod, op, method, path) {
  if (mod === 'system') {
    if (path === '/v1') return 'info';
    if (path === '/v1/health') return 'health';
    if (path === '/v1/openapi.json') return 'openapi';
  }
  let rest = op.operationId.slice(method.length);
  const modPascal = pascal(mod);
  if (rest.startsWith(modPascal)) rest = rest.slice(modPascal.length);
  if (rest === '') {
    return { get: 'list', post: 'create', put: 'replace', patch: 'update', delete: 'delete' }[method];
  }
  return method + rest;
}

const modules = new Map();
let total = 0;
for (const [path, ops] of Object.entries(spec.paths)) {
  if (SKIP(path)) continue;
  for (const method of VERBS) {
    const op = ops[method];
    if (!op) continue;
    const mod = moduleOf(path);
    if (!modules.has(mod)) modules.set(mod, { key: mod, ops: [], tags: new Set() });
    const m = modules.get(mod);
    m.tags.add(op.tags?.[0] ?? '');

    const params = op.parameters ?? [];
    const pathParams = [...path.matchAll(/\{([A-Za-z0-9_]+)\}/g)].map(([, name]) => {
      const p = params.find((x) => x.in === 'path' && x.name === name) ?? { name, schema: { type: 'string' } };
      return { name, schema: p.schema ?? { type: 'string' }, description: p.description ?? '' };
    });
    const queryParams = params
      .filter((p) => p.in === 'query')
      .map((p) => ({ name: p.name, schema: p.schema ?? {}, required: !!p.required, description: p.description ?? '' }));

    let body = null;
    if (op.requestBody) {
      const content = op.requestBody.content ?? {};
      const multipart = !!content['multipart/form-data'] && !content['application/json'];
      const media = content['application/json'] ?? content['multipart/form-data'] ?? Object.values(content)[0];
      body = { schema: media?.schema ?? { type: 'object' }, multipart, required: op.requestBody.required !== false };
    }

    const okCode = Object.keys(op.responses ?? {}).find((c) => c.startsWith('2'));
    const okSchema = okCode ? op.responses[okCode].content?.['application/json']?.schema : undefined;
    let data = { type: 'object', additionalProperties: true };
    let paginated = false;
    if (okSchema?.properties?.data) {
      data = okSchema.properties.data;
      paginated = !!okSchema.properties.meta;
    } else if (okSchema?.$ref) {
      data = okSchema;
    }

    const name = methodName(mod, op, method, path);
    if (m.ops.some((o) => o.name === name)) throw new Error(`Nama metode ganda ${mod}.${name}`);
    m.ops.push({
      name,
      method: method.toUpperCase(),
      path,
      summary: op.summary ?? '',
      description: op.description ?? '',
      scopes: op['x-scopes'] ?? [],
      token: op['x-token'] ?? (op.security?.length === 0 ? 'publik' : 'semua'),
      isPublic: Array.isArray(op.security) && op.security.length === 0,
      operationId: op.operationId,
      pathParams,
      queryParams,
      body,
      data,
      paginated,
    });
    total++;
  }
}
const mods = [...modules.values()].sort((a, b) => (a.key === 'system' ? -1 : b.key === 'system' ? 1 : a.key.localeCompare(b.key)));

// ---------------------------------------------------------------------------- TypeScript

const IDENT = /^[A-Za-z_$][A-Za-z0-9_$]*$/;
const tsKey = (k) => (IDENT.test(k) ? k : JSON.stringify(k));

function tsType(s, ref = 'S.', indent = '') {
  if (!s || typeof s !== 'object') return 'any';
  if (s.$ref) {
    const nama = s.$ref.split('/').pop();
    if (schemas[nama]) return ref + nama;
    // Skema dirujuk tetapi tidak didefinisikan di components (bug spesifikasi SIAKAD): pakai objek bebas supaya
    // typecheck tidak gagal dan endpoint lain tetap terbit; nama skemanya dilaporkan di akhir.
    refHilang.add(nama);
    return ref + 'JsonObject';
  }
  if (s.oneOf || s.anyOf) return [...new Set((s.oneOf ?? s.anyOf).map((x) => tsType(x, ref, indent)))].join(' | ');
  if (s.allOf) return s.allOf.map((x) => wrap(tsType(x, ref, indent))).join(' & ');
  const types = Array.isArray(s.type) ? s.type : s.type ? [s.type] : [];
  if (s.enum) {
    const lits = s.enum.map((v) => JSON.stringify(v));
    if (types.includes('null') && !s.enum.includes(null)) lits.push('null');
    return [...new Set(lits)].join(' | ');
  }
  if (types.length === 0) return s.properties ? tsObject(s, ref, indent) : 'any';
  const out = types.map((t) => {
    switch (t) {
      case 'string':
        return s.format === 'binary' ? 'Uploadable' : 'string';
      case 'integer':
      case 'number':
        return 'number';
      case 'boolean':
        return 'boolean';
      case 'null':
        return 'null';
      case 'array':
        return `Array<${tsType(s.items, ref, indent)}>`;
      case 'object':
        return tsObject(s, ref, indent);
      default:
        return 'any';
    }
  });
  return [...new Set(out)].join(' | ');
}
const wrap = (t) => (/[|&]/.test(t) && !t.startsWith('{') ? `(${t})` : t);

function tsObject(s, ref, indent) {
  const props = s.properties ?? {};
  const keys = Object.keys(props);
  const ap = s.additionalProperties;
  if (keys.length === 0) {
    if (ap && typeof ap === 'object') return `Record<string, ${tsType(ap, ref, indent)}>`;
    return ref + 'JsonObject';
  }
  const req = new Set(s.required ?? []);
  const inner = indent + '  ';
  const lines = keys.map((k) => {
    const p = props[k];
    const doc = jsdoc(p.description, inner, p);
    return `${doc}${inner}${tsKey(k)}${req.has(k) ? '' : '?'}: ${tsType(p, ref, inner)};`;
  });
  if (ap !== false) lines.push(`${inner}[key: string]: any;`);
  return `{\n${lines.join('\n')}\n${indent}}`;
}

function jsdoc(text, indent, s = {}) {
  const parts = [];
  if (text) parts.push(String(text).trim());
  if (s.example !== undefined && typeof s.example !== 'object') parts.push(`Contoh: \`${s.example}\``);
  if (s.readOnly) parts.push('Hanya dibaca.');
  if (parts.length === 0) return '';
  const body = parts.join(' ').replace(/\*\//g, '*\\/');
  const lines = body.split('\n');
  if (lines.length === 1) return `${indent}/** ${lines[0]} */\n`;
  return `${indent}/**\n${lines.map((l) => `${indent} * ${l}`.trimEnd()).join('\n')}\n${indent} */\n`;
}

function tsParamType(schema) {
  const t = tsType(schema, 'S.');
  if (t === 'number' || t === 'string') return 'string | number';
  return t;
}

function opDoc(o, indent, params) {
  const lines = [];
  if (o.summary) lines.push(o.summary.trim());
  if (o.description) {
    // Bagian "Scope:" sudah ditulis terpisah di bawah.
    const d = o.description.replace(/\n*\*\*Scope:\*\*[^\n]*/g, '').replace(/\n*\*\*Token:\*\*[^\n]*/g, '').trim();
    if (d) lines.push('', ...d.split('\n'));
  }
  lines.push('', `\`${o.method} ${o.path}\``);
  const meta = [];
  if (o.isPublic) meta.push('publik (tanpa token)');
  if (o.scopes.length) meta.push('scope: ' + o.scopes.map((x) => `\`${x}\``).join(', '));
  if (o.token === 'pengguna') meta.push('hanya token pengguna');
  if (o.paginated) meta.push('berhalaman');
  if (meta.length) lines.push('', meta.join(' · '));
  if (params.length) lines.push('');
  for (const p of params) lines.push(`@param ${p.name} ${p.description ?? ''}`.trimEnd());
  const body = lines.join('\n').replace(/\*\//g, '*\\/');
  return `${indent}/**\n${body.split('\n').map((l) => `${indent} * ${l}`.trimEnd()).join('\n')}\n${indent} */\n`;
}

function tsQueryType(o) {
  if (o.queryParams.length === 0) return 'Query';
  const lines = o.queryParams.map((p) => {
    let t = tsType(p.schema, 'S.', '    ');
    if (t === 'any' || t.includes('{')) t = 'QueryValue';
    if (t === 'Array<any>') t = 'Array<string | number | boolean>';
    return `${jsdoc(p.description, '    ', p.schema)}    ${tsKey(p.name)}${p.required ? '' : '?'}: ${t};`;
  });
  return `{\n${lines.join('\n')}\n  } & Query`;
}

function genTs() {
  const dir = join(ROOT, 'node/src/generated');
  rmSync(dir, { recursive: true, force: true });
  mkdirSync(dir, { recursive: true });
  const head = `// Dibuat otomatis oleh generator/generate.mjs dari ${spec.info?.title ?? 'OpenAPI'} ${spec.info?.version ?? ''}. Jangan diubah manual.\n`;

  // schemas.ts
  let out = head + `/* eslint-disable */\nimport type { Uploadable } from '../types.js';\n\n/** Objek JSON bebas. */\nexport type JsonObject = { [key: string]: any };\n\n`;
  for (const [name, s] of Object.entries(schemas)) {
    out += jsdoc(s.description, '') + `export type ${name} = ${tsType(s, '')};\n\n`;
  }
  writeFileSync(join(dir, 'schemas.ts'), out);

  // resources.ts
  out = head + `/* eslint-disable */\nimport type { SiakadCore } from '../core.js';\nimport type { ApiResult, Query, QueryValue, RequestOptions, Uploadable } from '../types.js';\nimport type * as S from './schemas.js';\n\nvoid (0 as unknown as Uploadable | QueryValue);\n\n`;
  for (const m of mods) {
    const cls = pascal(m.key) + 'Resource';
    const tags = [...m.tags].filter(Boolean).join(', ');
    out += `/** ${tags || m.key} */\nexport class ${cls} {\n  constructor(private readonly client: SiakadCore) {}\n\n`;
    for (const o of m.ops) {
      const args = o.pathParams.map((p) => `${p.name}: ${tsParamType(p.schema)}`);
      const docParams = o.pathParams.map((p) => ({ name: p.name, description: p.description }));
      let call = `{ method: '${o.method}', path: '${o.path}'`;
      const pathQuery = o.pathParams.length ? `{ ${o.pathParams.map((p) => p.name).join(', ')} }` : null;
      const dataType = tsType(o.data, 'S.', '  ');
      const qType = tsQueryType(o);
      const qRequired = o.queryParams.some((p) => p.required);
      if (o.body) {
        let bType = tsType(o.body.schema, 'S.', '  ');
        args.push(`body${o.body.required ? '' : '?'}: ${bType}`);
        args.push(`options?: RequestOptions & { query?: ${qType.replace(/\n {2}/g, '\n    ')} }`);
        docParams.push({ name: 'body', description: o.body.multipart ? 'Isian formulir; field berkas boleh Blob/File/Uint8Array.' : '' });
        call += pathQuery ? `, query: ${pathQuery}` : '';
        call += `, body${o.body.multipart ? ', multipart: true' : ''}`;
      } else {
        args.push(`query${qRequired ? '' : '?'}: ${qType}`);
        args.push('options?: RequestOptions');
        call += pathQuery ? `, query: { ...query, ${o.pathParams.map((p) => p.name).join(', ')} }` : ', query';
      }
      if (o.isPublic) call += ', public: true';
      call += ' }';
      out += opDoc(o, '  ', docParams);
      out += `  ${o.name}(${args.join(', ')}): Promise<ApiResult<${dataType}>> {\n    return this.client.request(${call}, options);\n  }\n\n`;
    }
    out = out.trimEnd() + '\n}\n\n';
  }
  writeFileSync(join(dir, 'resources.ts'), out);

  // siakad.ts
  out = head + `import { SiakadCore } from '../core.js';\nimport * as R from './resources.js';\n\n`;
  out += `/**\n * Klien API SIAKAD UNIPO.\n *\n * \`\`\`ts\n * const siakad = new Siakad({ clientId: process.env.SIAKAD_CLIENT_ID, clientSecret: process.env.SIAKAD_CLIENT_SECRET });\n * const { data } = await siakad.mahasiswa.getByNim('2025001');\n * \`\`\`\n */\nexport class Siakad extends SiakadCore {\n`;
  out += `  private readonly resources = new Map<string, unknown>();\n\n  private resource<T>(key: string, make: () => T): T {\n    let r = this.resources.get(key) as T | undefined;\n    if (!r) {\n      r = make();\n      this.resources.set(key, r);\n    }\n    return r;\n  }\n\n`;
  for (const m of mods) {
    const prop = m.key === 'system' ? 'system' : camel(m.key);
    const cls = pascal(m.key) + 'Resource';
    const tags = [...m.tags].filter(Boolean).join(', ');
    out += `  /** ${tags || m.key} (${m.ops.length} endpoint) */\n  get ${prop}(): R.${cls} {\n    return this.resource('${prop}', () => new R.${cls}(this));\n  }\n\n`;
  }
  out = out.trimEnd() + '\n}\n';
  writeFileSync(join(dir, 'siakad.ts'), out);
}

// ---------------------------------------------------------------------------- PHP

function phpType(s, depth = 0) {
  if (!s || typeof s !== 'object') return 'mixed';
  if (s.$ref) {
    const target = schemas[s.$ref.split('/').pop()];
    return depth > 2 || !target ? 'array<string, mixed>' : phpType(target, depth + 1);
  }
  if (s.oneOf || s.anyOf) return [...new Set((s.oneOf ?? s.anyOf).map((x) => phpType(x, depth + 1)))].join('|');
  if (s.allOf) return 'array<string, mixed>';
  const types = Array.isArray(s.type) ? s.type : s.type ? [s.type] : [];
  if (types.length === 0) return 'mixed';
  const out = types.map((t) => {
    switch (t) {
      case 'string':
        return s.format === 'binary' ? '\\Unipo\\Siakad\\Http\\Upload|\\SplFileInfo|string' : 'string';
      case 'integer':
        return 'int';
      case 'number':
        return 'float|int';
      case 'boolean':
        return 'bool';
      case 'null':
        return 'null';
      case 'array':
        return 'list<mixed>';
      case 'object':
        return 'array<string, mixed>';
      default:
        return 'mixed';
    }
  });
  return [...new Set(out.join('|').split('|'))].join('|');
}

/** Bentuk array PHPDoc satu tingkat, mis. array{nama: string, aktif?: bool}. */
function phpShape(s, extra = true) {
  if (s?.$ref) s = schemas[s.$ref.split('/').pop()];
  const props = s?.properties ?? {};
  const keys = Object.keys(props);
  if (keys.length === 0 || keys.length > 40 || keys.some((k) => !/^[A-Za-z_][A-Za-z0-9_]*$/.test(k))) {
    return 'array<string, mixed>';
  }
  const req = new Set(s.required ?? []);
  const parts = keys.map((k) => `${k}${req.has(k) ? '' : '?'}: ${phpType(props[k])}`);
  if (extra) parts.push('...');
  return `array{${parts.join(', ')}}`;
}

function phpQueryShape(o) {
  if (o.queryParams.length === 0) return 'array<string, mixed>';
  return `array{${o.queryParams.map((p) => `${p.name}${p.required ? '' : '?'}: ${phpType(p.schema)}`).join(', ')}, ...}`;
}

function phpDoc(o, indent, params, ret) {
  const lines = [];
  if (o.summary) lines.push(o.summary.trim());
  if (o.description) {
    const d = o.description.replace(/\n*\*\*Scope:\*\*[^\n]*/g, '').replace(/\n*\*\*Token:\*\*[^\n]*/g, '').trim();
    if (d) lines.push('', ...d.split('\n'));
  }
  lines.push('', `\`${o.method} ${o.path}\``);
  const meta = [];
  if (o.isPublic) meta.push('publik (tanpa token)');
  if (o.scopes.length) meta.push('scope: ' + o.scopes.map((x) => `\`${x}\``).join(', '));
  if (o.token === 'pengguna') meta.push('hanya token pengguna');
  if (o.paginated) meta.push('berhalaman');
  if (meta.length) lines.push('', meta.join(' · '));
  lines.push('');
  for (const p of params) lines.push(`@param ${p.type} $${p.name}${p.description ? ' ' + p.description.replace(/\n/g, ' ') : ''}`);
  lines.push(`@return ${ret}`);
  lines.push('@throws \\Unipo\\Siakad\\Exceptions\\SiakadException');
  const body = lines.join('\n').replace(/\*\//g, '*\\/');
  return `${indent}/**\n${body.split('\n').map((l) => `${indent} * ${l}`.trimEnd()).join('\n')}\n${indent} */\n`;
}

const phpVar = (n) => (/^[A-Za-z_][A-Za-z0-9_]*$/.test(n) ? n : n.replace(/[^A-Za-z0-9_]/g, '_'));

function genPhp() {
  const dir = join(ROOT, 'php/src/Resources');
  mkdirSync(dir, { recursive: true });
  for (const f of readdirSync(dir)) if (f !== 'Resource.php') rmSync(join(dir, f));
  const head = `<?php\n\n// Dibuat otomatis oleh generator/generate.mjs dari ${spec.info?.title ?? 'OpenAPI'} ${spec.info?.version ?? ''}. Jangan diubah manual.\n\ndeclare(strict_types=1);\n\n`;

  for (const m of mods) {
    const cls = pascal(m.key);
    const tags = [...m.tags].filter(Boolean).join(', ');
    let out = head + `namespace Unipo\\Siakad\\Resources;\n\nuse Unipo\\Siakad\\Http\\ApiResponse;\n\n/**\n * ${tags || m.key}\n */\nfinal class ${cls} extends Resource\n{\n`;
    for (const o of m.ops) {
      const args = [];
      const docParams = [];
      for (const p of o.pathParams) {
        args.push(`int|string $${phpVar(p.name)}`);
        docParams.push({ type: 'int|string', name: phpVar(p.name), description: p.description });
      }
      const pathArr = o.pathParams.length ? `[${o.pathParams.map((p) => `'${p.name}' => $${phpVar(p.name)}`).join(', ')}]` : '[]';
      let call;
      if (o.body) {
        args.push(`array $body${o.body.required ? '' : ' = []'}`);
        args.push('array $options = []');
        docParams.push({ type: phpShape(o.body.schema), name: 'body', description: o.body.multipart ? 'Field berkas: Upload::fromPath(), SplFileInfo, atau resource.' : '' });
        docParams.push({ type: 'array{query?: ' + phpQueryShape(o) + ', headers?: array<string, string>, max_retries?: int}', name: 'options' });
        call = `$this->send('${o.method}', '${o.path}', ${pathArr}, $options['query'] ?? [], $body, $options, ${o.body.multipart ? 'true' : 'false'}, ${o.isPublic ? 'true' : 'false'})`;
      } else {
        const qReq = o.queryParams.some((p) => p.required);
        args.push(`array $query${qReq ? '' : ' = []'}`);
        args.push('array $options = []');
        docParams.push({ type: phpQueryShape(o), name: 'query' });
        docParams.push({ type: 'array{headers?: array<string, string>, max_retries?: int}', name: 'options' });
        call = `$this->send('${o.method}', '${o.path}', ${pathArr}, $query, null, $options, false, ${o.isPublic ? 'true' : 'false'})`;
      }
      out += phpDoc(o, '    ', docParams, 'ApiResponse');
      out += `    public function ${o.name}(${args.join(', ')}): ApiResponse\n    {\n        return ${call};\n    }\n\n`;
    }
    out = out.trimEnd() + '\n}\n';
    writeFileSync(join(dir, `${cls}.php`), out);
  }

  // Trait untuk kelas Siakad
  let out = head + `namespace Unipo\\Siakad\\Concerns;\n\nuse Unipo\\Siakad\\Resources;\n\n/**\n * Akses ke semua modul API (${total} endpoint).\n */\ntrait GeneratedResources\n{\n`;
  for (const m of mods) {
    const prop = m.key === 'system' ? 'system' : camel(m.key);
    const cls = pascal(m.key);
    const tags = [...m.tags].filter(Boolean).join(', ');
    out += `    /** ${tags || m.key} (${m.ops.length} endpoint) */\n    public function ${prop}(): Resources\\${cls}\n    {\n        return $this->resource(Resources\\${cls}::class);\n    }\n\n`;
  }
  out = out.trimEnd() + '\n}\n';
  mkdirSync(join(ROOT, 'php/src/Concerns'), { recursive: true });
  writeFileSync(join(ROOT, 'php/src/Concerns/GeneratedResources.php'), out);

  // Facade Laravel (docblock @method untuk autocomplete IDE)
  const methods = mods.map((m) => ` * @method static \\Unipo\\Siakad\\Resources\\${pascal(m.key)} ${m.key === 'system' ? 'system' : camel(m.key)}()`).join('\n');
  mkdirSync(join(ROOT, 'php/src/Laravel/Facades'), { recursive: true });
  writeFileSync(
    join(ROOT, 'php/src/Laravel/Facades/Siakad.php'),
    head +
      `namespace Unipo\\Siakad\\Laravel\\Facades;\n\nuse Illuminate\\Support\\Facades\\Facade;\n\n/**\n * Facade Laravel untuk \\Unipo\\Siakad\\Siakad.\n *\n * @method static \\Unipo\\Siakad\\Auth\\AuthApi auth()\n * @method static \\Unipo\\Siakad\\Siakad withToken(\\Unipo\\Siakad\\Auth\\TokenSet|string $token)\n * @method static \\Unipo\\Siakad\\Siakad withOptions(array $options)\n * @method static \\Unipo\\Siakad\\Http\\ApiResponse request(string $method, string $path, array $query = [], mixed $body = null, array $options = [])\n * @method static \\Unipo\\Siakad\\Pagination\\Paginator paginate(callable $fetchPage, array $query = [])\n${methods}\n *\n * @see \\Unipo\\Siakad\\Siakad\n */\nfinal class Siakad extends Facade\n{\n    protected static function getFacadeAccessor(): string\n    {\n        return \\Unipo\\Siakad\\Siakad::class;\n    }\n}\n`,
  );
}

// ---------------------------------------------------------------------------- daftar modul (README)

function genIndex() {
  const rows = mods.map((m) => {
    const prop = m.key === 'system' ? 'system' : camel(m.key);
    return `| \`${prop}\` | ${[...m.tags].filter(Boolean).join(', ').replace(/\|/g, '/')} | ${m.ops.length} |`;
  });
  const md = `<!-- Dibuat otomatis oleh generator/generate.mjs. Jangan diubah manual. -->\n# Daftar modul\n\n${total} endpoint dari ${spec.info?.title ?? 'API'} ${spec.info?.version ?? ''}, dikelompokkan per modul. Node.js: \`siakad.<modul>.<metode>()\`, PHP: \`$siakad-><modul>()-><metode>()\`.\n\nNama metode = \`operationId\` di dokumentasi API tanpa nama modul, mis. \`GET /v1/lms/kelas/{id}\` (operationId \`getLmsKelasById\`) menjadi \`lms.getKelasById(id)\`. Endpoint akar modul menjadi \`list\`/\`create\`/\`update\`/\`replace\`/\`delete\`.\n\n| Modul | Kelompok di dokumentasi | Endpoint |\n|---|---|---|\n${rows.join('\n')}\n`;
  writeFileSync(join(ROOT, 'MODUL.md'), md);
}

genTs();
genPhp();
genIndex();
console.log(`Selesai: ${mods.length} modul, ${total} endpoint.`);
if (refHilang.size) {
  console.warn(`PERINGATAN: ${refHilang.size} skema dirujuk tetapi tidak ada di components.schemas (dipakai JsonObject): ${[...refHilang].join(', ')}. Daftarkan skemanya di api_schemas.php modul SIAKAD.`);
}
