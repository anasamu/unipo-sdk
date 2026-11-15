import assert from 'node:assert/strict';
import { test } from 'node:test';
import {
  AturanDilanggarError,
  AuthenticationError,
  ConflictError,
  MemoryTokenStore,
  NotFoundError,
  PermissionError,
  Siakad,
  ValidationError,
} from '../dist/index.js';

/** fetch tiruan: mencatat permintaan dan menjawab lewat handler. */
function mockFetch(handler) {
  const calls = [];
  const fn = async (url, init = {}) => {
    const u = new URL(url);
    const headers = Object.fromEntries(Object.entries(init.headers ?? {}).map(([k, v]) => [k.toLowerCase(), v]));
    const call = { method: init.method ?? 'GET', path: u.pathname, query: u.searchParams, headers, body: init.body };
    calls.push(call);
    const r = await handler(call, calls);
    const body = typeof r.body === 'string' || r.body instanceof Uint8Array ? r.body : JSON.stringify(r.body ?? null);
    return new Response(r.status === 204 ? null : body, {
      status: r.status ?? 200,
      headers: { 'content-type': 'application/json', 'x-request-id': 'req-1', 'x-siakad-lingkungan': 'development', ...(r.headers ?? {}) },
    });
  };
  fn.calls = calls;
  return fn;
}

const token = (n = 1, extra = {}) => ({ access_token: `tok-${n}`, token_type: 'Bearer', expires_in: 3600, scope: '', ...extra });
const opts = (fetch) => ({ clientId: 'cli_x', clientSecret: 's3cret', baseUrl: 'https://contoh.test', fetch, tokenStore: new MemoryTokenStore(), maxRetries: 2 });

test('meminta token client_credentials sekali untuk banyak permintaan serentak', async () => {
  let n = 0;
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') {
      assert.equal(c.headers.authorization, 'Basic ' + Buffer.from('cli_x:s3cret').toString('base64'));
      assert.equal(JSON.parse(c.body).grant_type, 'client_credentials');
      return { body: token(++n) };
    }
    assert.equal(c.headers.authorization, 'Bearer tok-1');
    return { body: { data: { nim: c.path.split('/').pop() } } };
  });
  const siakad = new Siakad(opts(fetch));
  const hasil = await Promise.all([siakad.mahasiswa.getByNim('1'), siakad.mahasiswa.getByNim('2'), siakad.mahasiswa.getByNim('3')]);
  assert.deepEqual(hasil.map((r) => r.data.nim), ['1', '2', '3']);
  assert.equal(fetch.calls.filter((c) => c.path === '/v1/auth/token').length, 1);
  assert.equal(hasil[0].requestId, 'req-1');
  assert.equal(hasil[0].environment, 'development');
});

test('memperbarui token saat 401 lalu mengulang permintaan', async () => {
  let n = 0;
  let pertama = true;
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token(++n) };
    if (pertama) {
      pertama = false;
      return { status: 401, body: { error: { code: 'invalid_token', message: 'Token kedaluwarsa.' }, request_id: 'r' } };
    }
    return { body: { data: { ok: true, auth: c.headers.authorization } } };
  });
  const r = await new Siakad(opts(fetch)).referensi.getProdi();
  assert.equal(r.data.auth, 'Bearer tok-2');
});

test('galat dipetakan ke kelas yang sesuai', async () => {
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    if (c.path.endsWith('/404')) return { status: 404, body: { error: { code: 'not_found', message: 'Tidak ada.' }, request_id: 'x1' } };
    if (c.path.endsWith('/403'))
      return { status: 403, body: { error: { code: 'insufficient_scope', message: 'Scope kurang.', details: { required_scopes: ['nilai:read'] } }, request_id: 'x2' } };
    return { status: 422, body: { error: { code: 'validation_failed', message: 'Tidak valid.', details: { nim: 'Wajib.' } }, request_id: 'x3' } };
  });
  const s = new Siakad(opts(fetch));
  await assert.rejects(s.mahasiswa.getByNim('404'), (e) => e instanceof NotFoundError && e.requestId === 'x1' && e.status === 404);
  await assert.rejects(s.mahasiswa.getByNim('403'), (e) => e instanceof PermissionError && e.requiredScopes[0] === 'nilai:read');
  await assert.rejects(s.mahasiswa.getByNim('422'), (e) => e instanceof ValidationError && e.fields.nim === 'Wajib.');
});

test('409 aturan_dilanggar menjadi AturanDilanggarError dengan rincian aturan', async () => {
  const aturan = { titik: 'krs.ambil', boleh: false, pelanggaran: [{ id: 'u1', nama: 'Batas SKS', pesan: 'SKS yang diambil maksimal 6 (sekarang 10).' }], peringatan: [], batas: { sks_diambil: { op: '<=', nilai: 6 } } };
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    if (c.path.endsWith('/A')) return { status: 409, body: { error: { code: 'aturan_dilanggar', message: aturan.pelanggaran[0].pesan, details: { aturan } } } };
    return { status: 409, body: { error: { code: 'conflict', message: 'Masa KRS tutup.' } } };
  });
  const s = new Siakad(opts(fetch));
  await assert.rejects(s.mahasiswa.getByNim('A'), (e) =>
    e instanceof AturanDilanggarError && e instanceof ConflictError && e.titik === 'krs.ambil' && e.pelanggaran[0].nama === 'Batas SKS' && e.batas.sks_diambil.nilai === 6);
  await assert.rejects(s.mahasiswa.getByNim('B'), (e) => e instanceof ConflictError && !(e instanceof AturanDilanggarError));
});

test('modul presensi: pindai QR dan QR sesi berganti', async () => {
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    if (c.path === '/v1/presensi/pindai') return { body: { data: { sudah: false, pesan: 'Presensi tercatat.', hadir: { status: 'H' } } } };
    return { body: { data: { isi: 'UP1.S.x.y.z', sisa_detik: 12, interval_detik: 20, gaya: { kode: 'presensi', bagian: 'prodi-55201' } } } };
  });
  const s = new Siakad(opts(fetch));
  const r = await s.presensi.postPindai({ token: 'UP1.S.x.y.z', lokasi: '0.47,121.93', perangkat: 'abc' });
  assert.equal(r.data.hadir.status, 'H');
  const pindai = fetch.calls.find((c) => c.path === '/v1/presensi/pindai');
  assert.equal(pindai.method, 'POST');
  assert.equal(JSON.parse(pindai.body).perangkat, 'abc');
  const q = await s.presensi.getSesiByIdQr('5e551000-0000-4000-8000-000000000001', { svg: '1' });
  assert.equal(q.data.sisa_detik, 12);
  assert.equal(fetch.calls.at(-1).path, '/v1/presensi/sesi/5e551000-0000-4000-8000-000000000001/qr');
  assert.equal(fetch.calls.at(-1).query.get('svg'), '1');
});

test('429 diulang setelah Retry-After', async () => {
  let ke = 0;
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    if (++ke === 1) return { status: 429, headers: { 'retry-after': '0' }, body: { error: { code: 'rate_limited', message: 'Tunggu.' } } };
    return { body: { data: [] } };
  });
  const r = await new Siakad(opts(fetch)).referensi.getProdi();
  assert.deepEqual(r.data, []);
  assert.equal(ke, 2);
});

test('paginate mengambil semua halaman', async () => {
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    const page = Number(c.query.get('page'));
    assert.equal(c.query.get('per_page'), '2');
    assert.equal(c.query.get('prodi'), '86206');
    const data = page === 1 ? [1, 2] : page === 2 ? [3, 4] : [5];
    return { body: { data, meta: { page, per_page: 2, total: 5, total_pages: 3 } } };
  });
  const s = new Siakad(opts(fetch));
  const semua = await s.paginate((q) => s.mahasiswa.list(q), { prodi: '86206', per_page: 2 }).all();
  assert.deepEqual(semua, [1, 2, 3, 4, 5]);
});

test('path param di-encode, query array, dan methodOverride', async () => {
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    return { body: { data: { method: c.method, override: c.headers['x-http-method-override'] ?? null, path: c.path, q: c.query.getAll('status[]') } } };
  });
  const s = new Siakad({ ...opts(fetch), methodOverride: true });
  const r = await s.lms.patchKelasById('a/b', { nama: 'X' });
  assert.equal(r.data.method, 'POST');
  assert.equal(r.data.override, 'PATCH');
  assert.equal(r.data.path, '/v1/lms/kelas/a%2Fb');
  const r2 = await s.request({ method: 'GET', path: '/v1/contoh', query: { status: ['A', 'C'] } });
  assert.deepEqual(r2.data.q, ['A', 'C']);
});

test('token pengguna diperpanjang otomatis dengan refresh token', async () => {
  const disimpan = [];
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') {
      const b = JSON.parse(c.body);
      if (b.grant_type === 'password') return { body: token('u1', { refresh_token: 'rt-1', expires_in: 1 }) };
      assert.equal(b.grant_type, 'refresh_token');
      assert.equal(b.refresh_token, 'rt-1');
      return { body: token('u2', { refresh_token: 'rt-2' }) };
    }
    return { body: { data: { auth: c.headers.authorization } } };
  });
  const s = new Siakad(opts(fetch));
  const t = await s.auth.password('2025001', 'rahasia');
  const mhs = s.withToken(t, (baru) => disimpan.push(baru.refresh_token));
  const r = await mhs.mahasiswa.getByNimKhs('2025001');
  assert.equal(r.data.auth, 'Bearer tok-u2');
  assert.deepEqual(disimpan, ['rt-2']);
});

test('tanpa kredensial: endpoint publik jalan, endpoint lain AuthenticationError', async () => {
  const fetch = mockFetch((c) => {
    assert.equal(c.headers.authorization, undefined);
    return { body: { data: { status: 'ok' } } };
  });
  const s = new Siakad({ baseUrl: 'https://contoh.test', fetch });
  assert.equal((await s.system.health()).data.status, 'ok');
  await assert.rejects(s.mahasiswa.getByNim('1'), AuthenticationError);
});

test('unggah multipart dan unduh file', async () => {
  const fetch = mockFetch(async (c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    if (c.method === 'POST') {
      assert.ok(c.body instanceof FormData);
      const f = c.body.get('berkas');
      assert.equal(f.name, 'surat.pdf');
      assert.equal(await f.text(), '%PDF');
      assert.equal(c.body.get('peran'), 'utama');
      return { status: 201, body: { data: { id: 7 } } };
    }
    return {
      body: new TextEncoder().encode('isi file'),
      headers: { 'content-type': 'application/pdf', 'content-disposition': `attachment; filename="a.pdf"; filename*=UTF-8''surat%20masuk.pdf` },
    };
  });
  const s = new Siakad(opts(fetch));
  const up = await s.arsip.postSuratByRefFile('S-1', { berkas: { data: new TextEncoder().encode('%PDF'), filename: 'surat.pdf' }, peran: 'utama' });
  assert.equal(up.status, 201);
  const down = await s.request({ method: 'GET', path: '/v1/arsip/file/{id}/unduh', query: { id: 7 } });
  assert.equal(down.data.filename, 'surat masuk.pdf');
  assert.equal(down.data.text(), 'isi file');
});

test('jawaban bukan JSON dari hosting menyarankan methodOverride', async () => {
  const fetch = mockFetch((c) => {
    if (c.path === '/v1/auth/token') return { body: token() };
    return { status: 403, headers: { 'content-type': 'text/html' }, body: '<html><h1>Forbidden</h1></html>' };
  });
  await assert.rejects(new Siakad(opts(fetch)).lms.deleteKelasById(1), (e) => e instanceof PermissionError && /methodOverride/.test(e.message));
});
