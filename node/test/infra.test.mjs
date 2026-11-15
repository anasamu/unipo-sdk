import assert from 'node:assert/strict';
import { test } from 'node:test';
import { Siakad, konsumsiAntrean, muatRahasia, tandaTanganGerbang, verifikasiGerbang } from '../dist/index.js';

const KUNCI = 'gwk_abc';
const T = 1794721727;
const PATH = '/app/api/v1/kuliah/kelas?x=1';

test('tanda tangan gerbang sama dengan gerbang PHP', async () => {
  // Nilai dari server/gerbang-inti.php api_unipo dan Gerbang::tandaTangan() PHP untuk masukan yang sama.
  assert.equal(await tandaTanganGerbang(KUNCI, T, 'POST', PATH, 'cli_1', '', 'rid12345'), 't=1794721727,v1=ffd4d976e2a423e5b3b05f55d6a2257a3e77cb4f8dad2788c6e8e17a607dbe86');
});

test('verifikasiGerbang menerima yang sah dan menolak yang diubah atau kedaluwarsa', async () => {
  const tanda = await tandaTanganGerbang(KUNCI, T, 'POST', PATH, 'cli_1', 'dosen1', 'rid12345');
  const header = { 'X-Unipo-Gerbang': tanda, 'x-unipo-klien': 'cli_1', 'x-unipo-pengguna': 'dosen1', 'x-unipo-level': 'DOSEN', 'x-unipo-scope': 'a b', 'x-request-id': 'rid12345' };
  const id = await verifikasiGerbang({ metode: 'post', path: PATH, header }, KUNCI, { sekarang: T + 5 });
  assert.deepEqual(id, { klien: 'cli_1', pengguna: 'dosen1', level: 'DOSEN', scope: ['a', 'b'], requestId: 'rid12345', waktu: T });
  assert.ok(await verifikasiGerbang({ metode: 'POST', path: PATH, header: new Headers(header) }, KUNCI, { sekarang: T }));
  assert.equal(await verifikasiGerbang({ metode: 'POST', path: PATH, header: { ...header, 'x-unipo-pengguna': 'admin' } }, KUNCI, { sekarang: T }), null);
  assert.equal(await verifikasiGerbang({ metode: 'POST', path: PATH + '&y=2', header }, KUNCI, { sekarang: T }), null);
  assert.equal(await verifikasiGerbang({ metode: 'POST', path: PATH, header }, KUNCI, { sekarang: T + 301 }), null);
  assert.equal(await verifikasiGerbang({ metode: 'POST', path: PATH, header }, 'kunci_lain', { sekarang: T }), null);
});

function klien(handler) {
  const calls = [];
  const fetch = async (url, init = {}) => {
    const u = new URL(url);
    const c = { method: init.method ?? 'GET', path: u.pathname, query: u.searchParams, body: init.body ? JSON.parse(init.body) : null };
    if (c.path === '/v1/auth/token') return new Response(JSON.stringify({ access_token: 'tok', token_type: 'Bearer', expires_in: 3600 }), { headers: { 'content-type': 'application/json' } });
    calls.push(c);
    return new Response(JSON.stringify(handler(c, calls)), { headers: { 'content-type': 'application/json' } });
  };
  return { siakad: new Siakad({ baseUrl: 'https://api.test', clientId: 'cli_x', clientSecret: 's', fetch }), calls };
}

test('konsumsiAntrean: ack yang berhasil, tolak yang gagal, berhenti saat kosong', async () => {
  let ambil = 0;
  const { siakad, calls } = klien((c) => {
    if (c.path.endsWith('/ambil')) {
      ambil++;
      return { data: { pesan: ambil === 1 ? [{ tanda_terima: 'a', event: { id: '1', data: { ok: true } } }, { tanda_terima: 'b', event: { id: '2', data: { ok: false } } }] : [] } };
    }
    return { data: {} };
  });
  const hasil = await konsumsiAntrean(siakad, 'lms.nilai', (e) => { if (!e.data.ok) throw new Error('gagal proses'); });
  assert.deepEqual(hasil, { diproses: 1, gagal: 1, putaran: 2 });
  const tolak = calls.find((c) => c.path.endsWith('/tolak'));
  assert.equal(tolak.path, '/v1/infra/antrean/lms.nilai/tolak');
  assert.equal(tolak.body.galat, 'gagal proses');
  assert.deepEqual(calls.find((c) => c.path.endsWith('/ack')).body, { tanda_terima: ['a'] });
});

test('muatRahasia mengisi env tanpa menimpa yang sudah ada', async () => {
  const { siakad, calls } = klien(() => ({ data: [
    { nama: 'XENDIT_SECRET_KEY', jenis: 'teks', versi: 2, nilai: 'xnd_1' },
    { nama: 'APP_KEY', jenis: 'teks', versi: 1, nilai: 'baru' },
    { nama: 'sa.json', jenis: 'berkas', versi: 1, berkas_base64: 'e30=' },
  ] }));
  const env = { APP_KEY: 'lokal' };
  const r = await muatRahasia(siakad, 'pmb', { env });
  assert.equal(r.length, 3);
  assert.deepEqual(env, { APP_KEY: 'lokal', XENDIT_SECRET_KEY: 'xnd_1' });
  assert.equal(calls[0].path, '/v1/infra/rahasia-saya/pmb');
  assert.equal(calls[0].query.get('lingkungan'), 'produksi');
});
