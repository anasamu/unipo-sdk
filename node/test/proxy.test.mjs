import assert from 'node:assert/strict';
import { test } from 'node:test';
import { createServer } from 'node:http';
import { MemoryTokenStore, Siakad, proxySiakad, proxySiakadNode } from '../dist/index.js';

const PRODI = [{ kode_prodi: '55201', nama_prodi: 'Informatika' }];

/** fetch tiruan API SIAKAD: mencatat permintaan. */
function apiTiruan() {
  const calls = [];
  const fn = async (url, init = {}) => {
    const u = new URL(url);
    calls.push({ method: init.method ?? 'GET', path: u.pathname, search: u.search, headers: init.headers ?? {}, body: init.body });
    if (u.pathname === '/v1/auth/token') return Response.json({ access_token: 'tok-srv', token_type: 'Bearer', expires_in: 3600 });
    if (u.pathname === '/v1/referensi/prodi') return Response.json({ data: PRODI, meta: { total: 1 } }, { headers: { 'x-request-id': 'r-1' } });
    if (u.pathname === '/v1/referensi/rahasia') return Response.json({ error: { code: 'insufficient_scope', message: 'Scope kurang' } }, { status: 403 });
    return Response.json({ error: { code: 'not_found', message: 'x' } }, { status: 404 });
  };
  fn.calls = calls;
  return fn;
}
const server = (fetch) => new Siakad({ baseUrl: 'https://api.test', clientId: 'c', clientSecret: 's', fetch, tokenStore: new MemoryTokenStore(), maxRetries: 0 });

test('proxy meneruskan GET dengan token server; browser tidak mengirim rahasia', async () => {
  const fetch = apiTiruan();
  const proxy = proxySiakad({ siakad: server(fetch), awalan: '/api/siakad', izinkan: ['/v1/referensi/'] });
  const r = await proxy(new Request('http://app.test/api/siakad/v1/referensi/prodi?fakultas=FIK&x[]=1&x[]=2'));
  assert.equal(r.status, 200);
  assert.deepEqual(await r.json(), { data: PRODI, meta: { total: 1 } });
  assert.equal(r.headers.get('x-request-id'), 'r-1');
  const panggil = fetch.calls.find((c) => c.path === '/v1/referensi/prodi');
  assert.equal(panggil.headers.Authorization, 'Bearer tok-srv');
  assert.equal(decodeURIComponent(panggil.search), '?fakultas=FIK&x[]=1&x[]=2');
});

test('proxy menolak metode, jalur di luar izin, auth, dan traversal', async () => {
  const fetch = apiTiruan();
  const proxy = proxySiakad({ siakad: server(fetch), awalan: '/api/siakad', izinkan: ['/v1/referensi/'] });
  assert.equal((await proxy(new Request('http://a/api/siakad/v1/referensi/prodi', { method: 'POST', body: '{}' }))).status, 405);
  assert.equal((await proxy(new Request('http://a/api/siakad/v1/mahasiswa'))).status, 403);
  assert.equal((await proxy(new Request('http://a/api/siakad/v1/referensi/%2e%2e/auth/token'))).status, 403); // URL menormalkan %2e%2e, lalu ditolak daftar izin
  assert.equal((await proxy(new Request('http://a/lain/v1/referensi/prodi'))).status, 404);
  const bawaan = proxySiakad({ siakad: server(fetch), metode: ['GET', 'POST'] });
  assert.equal((await bawaan(new Request('http://a/v1/auth/token', { method: 'POST', body: '{}' }))).status, 403);
  assert.equal(fetch.calls.filter((c) => c.path !== '/v1/auth/token').length, 0);
});

test('galat API diteruskan dengan status dan kode yang sama', async () => {
  const proxy = proxySiakad({ siakad: server(apiTiruan()) });
  const r = await proxy(new Request('http://a/v1/referensi/rahasia'));
  assert.equal(r.status, 403);
  assert.equal((await r.json()).error.code, 'insufficient_scope');
});

test('mode tiruan tanpa kredensial', async () => {
  const proxy = proxySiakad({ awalan: '/api/siakad', tiruan: { 'GET /v1/referensi/prodi': PRODI, 'GET /v1/referensi/fakultas': (q) => ({ data: [], meta: { cari: q.get('q') } }) } });
  const r = await proxy(new Request('http://a/api/siakad/v1/referensi/prodi'));
  assert.deepEqual(await r.json(), { data: PRODI });
  assert.equal(r.headers.get('x-siakad-lingkungan'), 'tiruan');
  assert.deepEqual(await (await proxy(new Request('http://a/api/siakad/v1/referensi/fakultas?q=x'))).json(), { data: [], meta: { cari: 'x' } });
  assert.equal((await proxy(new Request('http://a/api/siakad/v1/referensi/agama'))).status, 404);
});

test('siakad per permintaan (token pengguna) dan 401 bila belum masuk', async () => {
  const fetch = apiTiruan();
  const dasar = server(fetch);
  const proxy = proxySiakad({ siakad: (req) => (req.headers.get('cookie') === 'sesi=1' ? dasar.withToken('tok-user') : null) });
  assert.equal((await proxy(new Request('http://a/v1/referensi/prodi'))).status, 401);
  const r = await proxy(new Request('http://a/v1/referensi/prodi', { headers: { cookie: 'sesi=1' } }));
  assert.equal(r.status, 200);
  assert.equal(fetch.calls.at(-1).headers.Authorization, 'Bearer tok-user');
});

test('proxySiakadNode untuk Express/Nest/http', async () => {
  const h = proxySiakadNode({ awalan: '/api/siakad', tiruan: { 'GET /v1/referensi/prodi': PRODI } });
  const srv = createServer((req, res) => void h(req, res));
  await new Promise((r) => srv.listen(0, r));
  try {
    const r = await fetch(`http://127.0.0.1:${srv.address().port}/api/siakad/v1/referensi/prodi`);
    assert.equal(r.status, 200);
    assert.deepEqual(await r.json(), { data: PRODI });
  } finally {
    srv.close();
  }
});

test('getAccessToken: token dari luar per permintaan, null = tanpa Authorization', async () => {
  const calls = [];
  const fetch = async (url, init) => {
    calls.push(init.headers);
    return Response.json({ data: [] });
  };
  let tok = 'tok-a';
  const s = new Siakad({ baseUrl: '/api/siakad', fetch, getAccessToken: async () => tok });
  await s.request({ method: 'GET', path: '/v1/referensi/prodi' }).catch(() => {});
  assert.equal(calls[0].Authorization, 'Bearer tok-a');
  tok = null;
  await s.request({ method: 'GET', path: '/v1/referensi/prodi' }).catch(() => {});
  assert.equal(calls[1].Authorization, undefined);
});
