/*
 * Pembantu kode QR (/v1/qr) dan dokumen terverifikasi (/v1/dokumen).
 *
 *   const svg = await qrSvg(siakad, 'https://...', { gaya: 'presensi', bagian: 'fik' });
 *   const kode = kodeDariQr(hasilPindai);            // "K7QM2XPA9RTD"
 *   const cek = await siakad.dokumen.getVerifikasiByKode(kode);
 *   const cocok = await cocokkanPdf(siakad, file);   // { cocok, pesan, dokumen }
 */
import type { SiakadCore } from './core.js';
import type { RequestOptions, SiakadFile, Uploadable } from './types.js';
import type { DokCocok, QrBuatInput } from './generated/schemas.js';

const HURUF_KODE = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

/**
 * Ambil kode verifikasi dokumen dari isi QR hasil pindai: URL `.../dokumen/v/{kode}`, URL dengan `?kode=`, atau kode
 * saja (tanda `-` dan spasi boleh). Mengembalikan 12 karakter huruf besar, atau null bila bukan kode dokumen.
 */
export function kodeDariQr(teks: string): string | null {
  const t = teks.trim();
  let calon = t;
  try {
    const u = new URL(t);
    calon = u.searchParams.get('kode') ?? u.pathname.split('/').filter(Boolean).pop() ?? '';
  } catch {
    // bukan URL: anggap kode langsung
  }
  const k = decodeURIComponent(calon).replace(/[\s-]/g, '').toUpperCase();
  if (k.length !== 12) return null;
  for (const c of k) if (!HURUF_KODE.includes(c)) return null;
  return k;
}

/** Kode verifikasi untuk dibaca manusia: `K7QM-2XPA-9RTD`. */
export function formatKode(kode: string): string {
  return (kode.replace(/[\s-]/g, '').toUpperCase().match(/.{1,4}/g) ?? []).join('-');
}

export interface OpsiQr extends Omit<QrBuatInput, 'isi' | 'keluaran'> {
  /** Untuk request: signal, timeout, dsb. */
  request?: RequestOptions;
}

/** Gambar QR sebagai teks SVG (POST /v1/qr, keluaran svg). Butuh scope qr:read. */
export async function qrSvg(client: SiakadCore, isi: string, opsi: OpsiQr = {}): Promise<string> {
  const { request, ...body } = opsi;
  const r = await client.request<SiakadFile>({ method: 'POST', path: '/v1/qr', body: { ...body, isi, keluaran: 'svg' } }, request);
  return r.data.text();
}

/** Gambar QR sebagai PNG (POST /v1/qr, keluaran png). `ukuran` = lebar piksel. */
export async function qrPng(client: SiakadCore, isi: string, opsi: OpsiQr = {}): Promise<SiakadFile> {
  const { request, ...body } = opsi;
  const r = await client.request<SiakadFile>({ method: 'POST', path: '/v1/qr', body: { ...body, isi, keluaran: 'png' } }, request);
  return r.data;
}

/**
 * Cocokkan file PDF dengan catatan dokumen terbit (POST /v1/dokumen/verifikasi, tanpa token).
 * `cocok` false bila isi file berbeda dari yang diterbitkan, walau QR-nya asli.
 */
export async function cocokkanPdf(
  client: SiakadCore,
  file: Uploadable,
  opsi: { kode?: string; nama?: string; request?: RequestOptions } = {},
): Promise<DokCocok> {
  const nama = opsi.nama ?? (typeof Blob !== 'undefined' && file instanceof Blob ? (file as Blob & { name?: string }).name : undefined) ?? 'dokumen.pdf';
  const berkas = file instanceof Uint8Array || file instanceof ArrayBuffer
    ? { data: file, filename: nama, contentType: 'application/pdf' }
    : file;
  const body: Record<string, unknown> = { berkas };
  if (opsi.kode) body.kode = opsi.kode.replace(/[\s-]/g, '').toUpperCase();
  const r = await client.request<DokCocok>({ method: 'POST', path: '/v1/dokumen/verifikasi', body, multipart: true, public: true }, opsi.request);
  return r.data;
}
