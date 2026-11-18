import assert from 'node:assert/strict';
import { test } from 'node:test';
import { Siakad, logSistem } from '../dist/index.js';

function mockFetch(handler) {
  const calls = [];
  const fn = async (url, init = {}) => {
    const u = new URL(url);
    const call = { method: init.method ?? 'GET', path: u.pathname, query: u.searchParams };
    calls.push(call);
    const r = await handler(call, calls);
    return new Response(typeof r.body === 'string' ? r.body : JSON.stringify(r.body), { status: 200, headers: { 'content-type': r.type ?? 'application/json', ...(r.headers ?? {}) } });
  };
  fn.calls = calls;
  return fn;
}

const baris = (i) => ({ id: `akun:${i}`, waktu: '2026-11-18 10:00:00', sumber: 'akun', sumber_nama: 'Kelola akun', kelompok: 'Akun & akses', aksi: 'buat', pelaku: 'admin', sasaran: 'x', ringkasan: null, tingkat: 'info', ip: null });

test('logSistem.daftar: saringan jadi query, kursor dari meta.berikut', async () => {
  const fetch = mockFetch(() => ({ body: { data: [baris(1)], meta: { per_page: 1, berikut: 'K2', sumber_galat: ['m'] } } }));
  const log = logSistem(new Siakad({ baseUrl: 'https://x.test/api', accessToken: 't', fetch }));
  const h = await log.daftar({ sumber: ['akun', 'aturan'], tingkat: ['galat'], q: 'abc', per_page: 1, kursor: 'K1' });
  const q = fetch.calls[0].query;
  assert.equal(fetch.calls[0].path, '/api/v1/sistem/log');
  assert.equal(q.get('sumber'), 'akun,aturan');
  assert.equal(q.get('tingkat'), 'galat');
  assert.equal(q.get('q'), 'abc');
  assert.equal(q.get('kursor'), 'K1');
  assert.equal(h.berikut, 'K2');
  assert.deepEqual(h.sumberGalat, ['m']);
});

test('logSistem.semua mengikuti kursor sampai habis; detail memecah id', async () => {
  const fetch = mockFetch((c) => {
    if (c.path.endsWith('/akun/7')) return { body: { data: { ...baris(7), detail: { jenis: 'dosen' } } } };
    const k = c.query.get('kursor');
    return { body: { data: k ? [baris(2)] : [baris(1)], meta: { berikut: k ? null : 'K' } } };
  });
  const log = logSistem(new Siakad({ baseUrl: 'https://x.test/api', accessToken: 't', fetch }));
  const semua = [];
  for await (const b of log.semua()) semua.push(b.id);
  assert.deepEqual(semua, ['akun:1', 'akun:2']);
  const d = await log.detail('akun:7');
  assert.equal(d.detail.jenis, 'dosen');
});
