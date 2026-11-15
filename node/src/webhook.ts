/*
 * Penerima webhook SIAKAD: verifikasi tanda tangan X-Siakad-Signature dan tipe amplop event domain.
 *
 *   const pesan = await verifikasiWebhook({ body: rawBody, tandaTangan: req.headers['x-siakad-signature'], rahasia });
 *   if (await sudahDiproses(pesan.id)) return 200;            // buang duplikat (pengantaran at-least-once)
 *   if (pesan.event === 'mahasiswa.lulus') { ... pesan.data.nim ... }
 *
 * Katalog event dan isi data: GET /v1/peristiwa/katalog (siakad.peristiwa.getKatalog()).
 */

/** Metadata event domain yang ikut di data webhook (`data._peristiwa`). */
export interface MetaPeristiwa {
  subjek: string | null;
  versi: number;
  sumber: string;
  korelasi_id: string | null;
  penyebab_id: string | null;
  waktu: string;
}

/** Isi POST webhook SIAKAD. `id` sama dengan header X-Siakad-Event-Id dan id event domain. */
export interface PesanWebhook<T = Record<string, unknown>> {
  id: string;
  event: string;
  dibuat_at: string;
  data: T & { _peristiwa?: MetaPeristiwa };
}

/** Amplop event domain (sama dengan pesan message broker dan GET /v1/peristiwa/{id}). */
export interface AmplopPeristiwa<T = Record<string, unknown>> {
  id: string;
  jenis: string;
  versi: number;
  sumber: string;
  subjek: string | null;
  waktu: string;
  korelasi_id: string | null;
  penyebab_id: string | null;
  aktor: string | null;
  data: T;
}

export class WebhookSignatureError extends Error {
  constructor(message: string) {
    super(message);
    this.name = 'WebhookSignatureError';
  }
}

export interface VerifikasiWebhookOpsi {
  /** Body mentah persis seperti diterima (string atau bytes), bukan hasil JSON.parse lalu stringify. */
  body: string | Uint8Array | ArrayBuffer;
  /** Nilai header X-Siakad-Signature: `t=<unix>,v1=<hex>`. */
  tandaTangan: string | null | undefined;
  /** Rahasia langganan (`whsec_...`), ditampilkan sekali saat langganan dibuat. */
  rahasia: string;
  /** Selisih waktu maksimal dalam detik (bawaan 300) untuk menolak pengiriman ulang lama. */
  toleransiDetik?: number;
  /** Waktu sekarang (detik unix), untuk pengujian. */
  sekarang?: number;
}

const enc = new TextEncoder();

function keString(body: VerifikasiWebhookOpsi['body']): string {
  if (typeof body === 'string') return body;
  return new TextDecoder().decode(body instanceof ArrayBuffer ? new Uint8Array(body) : body);
}

function hex(buf: ArrayBuffer): string {
  return [...new Uint8Array(buf)].map((b) => b.toString(16).padStart(2, '0')).join('');
}

function samaWaktuKonstan(a: string, b: string): boolean {
  if (a.length !== b.length) return false;
  let r = 0;
  for (let i = 0; i < a.length; i++) r |= a.charCodeAt(i) ^ b.charCodeAt(i);
  return r === 0;
}

/** Web Crypto: global di browser dan Node.js 19+, dari `node:crypto` di Node.js 18. */
async function ambilSubtle(): Promise<SubtleCrypto> {
  if (globalThis.crypto?.subtle) return globalThis.crypto.subtle;
  try {
    const nama = 'node:crypto';
    const m = (await import(/* @vite-ignore */ nama)) as { webcrypto?: { subtle?: SubtleCrypto } };
    if (m.webcrypto?.subtle) return m.webcrypto.subtle;
  } catch {
    // bukan Node.js
  }
  throw new Error('Web Crypto (crypto.subtle) tidak tersedia; pakai Node.js 18+ atau browser modern.');
}

/** Hitung tanda tangan `v1` untuk body dan waktu tertentu (HMAC-SHA256 hex dari "t.body"). */
export async function tandaTanganWebhook(body: string, rahasia: string, t: number): Promise<string> {
  const subtle = await ambilSubtle();
  const kunci = await subtle.importKey('raw', enc.encode(rahasia), { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
  return hex(await subtle.sign('HMAC', kunci, enc.encode(`${t}.${body}`)));
}

/**
 * Verifikasi webhook SIAKAD lalu kembalikan isinya. Melempar WebhookSignatureError bila header tidak ada,
 * waktu di luar toleransi, atau tanda tangan tidak cocok.
 */
export async function verifikasiWebhook<T = Record<string, unknown>>(opsi: VerifikasiWebhookOpsi): Promise<PesanWebhook<T>> {
  const header = opsi.tandaTangan ?? '';
  const bagian = Object.fromEntries(header.split(',').map((x) => x.trim().split('=', 2) as [string, string]));
  const t = Number(bagian.t);
  const v1 = bagian.v1;
  if (!Number.isFinite(t) || !v1) throw new WebhookSignatureError('Header X-Siakad-Signature tidak ada atau rusak.');
  const sekarang = opsi.sekarang ?? Math.floor(Date.now() / 1000);
  if (Math.abs(sekarang - t) > (opsi.toleransiDetik ?? 300)) throw new WebhookSignatureError('Waktu tanda tangan di luar toleransi.');
  const body = keString(opsi.body);
  const harap = await tandaTanganWebhook(body, opsi.rahasia, t);
  if (!samaWaktuKonstan(harap, v1)) throw new WebhookSignatureError('Tanda tangan webhook tidak cocok.');
  return JSON.parse(body) as PesanWebhook<T>;
}
