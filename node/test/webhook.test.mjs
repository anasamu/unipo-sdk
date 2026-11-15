import assert from 'node:assert/strict';
import { test } from 'node:test';
import { createHmac } from 'node:crypto';
import { verifikasiWebhook, WebhookSignatureError } from '../dist/index.js';

const rahasia = 'whsec_uji';
const body = JSON.stringify({ id: 'e1', event: 'mahasiswa.lulus', dibuat_at: '2026-11-16T09:00:00+08:00', data: { nim: '2201010001', _peristiwa: { subjek: '2201010001' } } });
const t = 1794700000;
const sig = `t=${t},v1=${createHmac('sha256', rahasia).update(`${t}.${body}`).digest('hex')}`;

test('webhook sah diterima (cocok dengan HMAC SIAKAD)', async () => {
  const p = await verifikasiWebhook({ body, tandaTangan: sig, rahasia, sekarang: t + 10 });
  assert.equal(p.event, 'mahasiswa.lulus');
  assert.equal(p.data.nim, '2201010001');
});

test('tanda tangan salah, body diubah, atau kedaluwarsa ditolak', async () => {
  await assert.rejects(verifikasiWebhook({ body, tandaTangan: sig, rahasia: 'lain', sekarang: t }), WebhookSignatureError);
  await assert.rejects(verifikasiWebhook({ body: body + ' ', tandaTangan: sig, rahasia, sekarang: t }), WebhookSignatureError);
  await assert.rejects(verifikasiWebhook({ body, tandaTangan: sig, rahasia, sekarang: t + 301 }), WebhookSignatureError);
  await assert.rejects(verifikasiWebhook({ body, tandaTangan: undefined, rahasia }), WebhookSignatureError);
});
