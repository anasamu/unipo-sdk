// Uji integrasi ke API SIAKAD sungguhan (lokal/development). Tidak dijalankan `npm test`.
//
//   SIAKAD_URL=http://127.0.0.1:8090/api SIAKAD_CLIENT_ID=... SIAKAD_CLIENT_SECRET=... \
//   SIAKAD_USER=admin_uji SIAKAD_PASS=... node test/integrasi.mjs
//
// Klien butuh scope referensi:read, portal:read, portal:write, portal:admin dan izin login pengguna.
import assert from 'node:assert/strict';
import { NotFoundError, PermissionError, Siakad, ValidationError } from '../dist/index.js';

const env = process.env;
const base = { baseUrl: env.SIAKAD_URL, clientId: env.SIAKAD_CLIENT_ID, clientSecret: env.SIAKAD_CLIENT_SECRET };
const langkah = async (nama, fn) => {
  try {
    await fn();
    console.log('ok   ', nama);
  } catch (e) {
    console.log('GAGAL', nama, '-', e?.message ?? e);
    process.exitCode = 1;
  }
};

const anon = new Siakad({ baseUrl: env.SIAKAD_URL });
const siakad = new Siakad(base);
const ov = new Siakad({ ...base, methodOverride: true });

await langkah('health tanpa kredensial', async () => {
  const r = await anon.system.health();
  assert.equal(r.data.status, 'ok');
  assert.ok(r.requestId);
});

await langkah('token aplikasi otomatis + referensi prodi', async () => {
  const r = await siakad.referensi.getProdi();
  assert.ok(Array.isArray(r.data) && r.data.length >= 1);
  assert.equal(r.environment, 'live');
});

await langkah('auth.me token aplikasi', async () => {
  const me = await siakad.auth.me();
  assert.equal(me.client_id, env.SIAKAD_CLIENT_ID);
  assert.ok(me.scopes.includes('portal:write'));
});

await langkah('404 -> NotFoundError', async () => {
  await assert.rejects(siakad.referensi.getProdiByKode('99999'), NotFoundError);
});

await langkah('scope kurang -> PermissionError', async () => {
  await assert.rejects(siakad.keuangan.getBiaya(), (e) => e instanceof PermissionError && e.code === 'insufficient_scope');
});

let situs;
await langkah('buat situs portal (POST JSON)', async () => {
  const kode = 'sdk' + Date.now().toString(36);
  const r = await siakad.portal.postKelolaSitus({ kode, nama: 'Situs uji SDK', jenis: 'universitas' });
  situs = r.data.kode ?? kode;
  assert.equal(r.status, 201);
});

await langkah('validasi -> ValidationError', async () => {
  await assert.rejects(siakad.portal.postKelolaFaq({ situs, pertanyaan: '', jawaban: '' }), (e) => {
    assert.ok(e instanceof ValidationError, e.constructor.name + ' ' + e.message);
    assert.ok(Object.keys(e.fields).length > 0);
    return true;
  });
});

const ids = [];
await langkah('buat 3 FAQ', async () => {
  for (let i = 1; i <= 3; i++) {
    const r = await siakad.portal.postKelolaFaq({ situs, pertanyaan: `Pertanyaan ${i}?`, jawaban: `<p>Jawaban ${i}</p>` });
    ids.push(r.data.id);
  }
  assert.equal(ids.length, 3);
});

await langkah('paginate per_page=1 mengambil 3 halaman', async () => {
  let halaman = 0;
  for await (const p of siakad.paginate((q) => siakad.portal.getKelolaFaq(q), { situs, per_page: 1 }).pages()) {
    halaman++;
    assert.equal(p.data.length, 1);
  }
  assert.equal(halaman, 3);
});

await langkah('PATCH lewat methodOverride (POST + X-HTTP-Method-Override)', async () => {
  const r = await ov.portal.patchKelolaFaqById(ids[0], { pertanyaan: 'Diubah lewat override?', jawaban: '<p>ok</p>' });
  assert.equal(r.data.judul ?? r.data.pertanyaan, 'Diubah lewat override?');
});

await langkah('DELETE biasa', async () => {
  await siakad.portal.deleteKelolaFaqById(ids[2]);
  await assert.rejects(siakad.portal.getKelolaFaqById(ids[2]), NotFoundError);
});

await langkah('unggah media multipart', async () => {
  // PNG 1x1
  const png = Uint8Array.from(atob('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='), (c) => c.charCodeAt(0));
  const r = await siakad.portal.postKelolaMedia({ situs, berkas: { data: png, filename: 'titik.png', contentType: 'image/png' }, judul: 'Titik' });
  assert.ok(r.data.id);
});

await langkah('login pengguna + withToken + refresh + revoke', async () => {
  const t = await siakad.auth.password(env.SIAKAD_USER, env.SIAKAD_PASS);
  assert.ok(t.refresh_token);
  const disimpan = [];
  // Paksa token dianggap hampir habis supaya SDK memakai refresh token.
  const user = siakad.withToken({ ...t, expires_at: Date.now() }, (baru) => disimpan.push(baru));
  const me = await user.auth.me();
  assert.equal(me.username, env.SIAKAD_USER);
  assert.equal(disimpan.length, 1);
  await user.auth.revoke(disimpan[0].refresh_token);
  await assert.rejects(siakad.auth.refresh(disimpan[0].refresh_token));
});
