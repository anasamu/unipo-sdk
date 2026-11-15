import assert from 'node:assert/strict';
import { test } from 'node:test';
import { MemoryTokenStore, Siakad, cocokkanPdf, formatKode, kodeDariQr, qrSvg } from '../dist/index.js';

test('kodeDariQr membaca URL verifikasi, ?kode=, dan kode dengan tanda hubung', () => {
  assert.equal(kodeDariQr('https://siakad.unipo.ac.id/api/v1/dokumen/v/K7QM2XPA9RTD'), 'K7QM2XPA9RTD');
  assert.equal(kodeDariQr('https://contoh.test/cek?kode=k7qm-2xpa-9rtd'), 'K7QM2XPA9RTD');
  assert.equal(kodeDariQr(' K7QM-2XPA-9RTD '), 'K7QM2XPA9RTD');
  assert.equal(kodeDariQr('https://contoh.test/v/BUKAN'), null);
  assert.equal(kodeDariQr('K7QM2XPA9RT0'), null); // 0 tidak dipakai
  assert.equal(formatKode('k7qm2xpa9rtd'), 'K7QM-2XPA-9RTD');
});

function mockFetch(handler) {
  const calls = [];
  const fn = async (url, init = {}) => {
    const call = { method: init.method ?? 'GET', path: new URL(url).pathname, headers: init.headers ?? {}, body: init.body };
    calls.push(call);
    const r = await handler(call);
    return new Response(r.body, { status: r.status ?? 200, headers: { 'content-type': r.type ?? 'application/json' } });
  };
  fn.calls = calls;
  return fn;
}
const opts = (fetch) => ({ clientId: 'cli_x', clientSecret: 's', baseUrl: 'https://contoh.test', fetch, tokenStore: new MemoryTokenStore() });
const token = JSON.stringify({ access_token: 't', token_type: 'Bearer', expires_in: 3600, scope: 'qr:read' });

test('qrSvg mengirim keluaran svg dan mengembalikan teks SVG', async () => {
  const fetch = mockFetch((c) => c.path === '/v1/auth/token'
    ? { body: token }
    : { body: '<svg xmlns="http://www.w3.org/2000/svg"></svg>', type: 'image/svg+xml' });
  const svg = await qrSvg(new Siakad(opts(fetch)), 'https://contoh.test/x', { gaya: 'presensi', bagian: 'fik' });
  assert.match(svg, /^<svg/);
  const kirim = JSON.parse(fetch.calls.find((c) => c.path === '/v1/qr').body);
  assert.deepEqual(kirim, { gaya: 'presensi', bagian: 'fik', isi: 'https://contoh.test/x', keluaran: 'svg' });
});

test('cocokkanPdf mengirim multipart tanpa token', async () => {
  const fetch = mockFetch(() => ({ body: JSON.stringify({ data: { cocok: true, sha256: 'ab', pesan: 'ok', dokumen: null } }) }));
  const r = await cocokkanPdf(new Siakad(opts(fetch)), new Uint8Array([37, 80, 68, 70]), { kode: 'k7qm-2xpa-9rtd' });
  assert.equal(r.cocok, true);
  assert.equal(fetch.calls.length, 1);
  const c = fetch.calls[0];
  assert.equal(c.path, '/v1/dokumen/verifikasi');
  assert.ok(c.body instanceof FormData);
  assert.equal(c.body.get('kode'), 'K7QM2XPA9RTD');
  assert.equal(c.body.get('berkas').name, 'dokumen.pdf');
});
