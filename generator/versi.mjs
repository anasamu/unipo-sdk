#!/usr/bin/env node
/**
 * Menaikkan atau membaca versi SDK. Versi PHP, Node.js, dan CHANGELOG selalu sama.
 *
 *   node generator/versi.mjs                      # tampilkan versi sekarang
 *   node generator/versi.mjs patch|minor|major    # naikkan versi
 *   node generator/versi.mjs 1.4.0                # set versi tertentu
 *   node generator/versi.mjs tetap                # versi tetap; pastikan bagian CHANGELOG-nya ada (untuk --catatan)
 *     --catatan "teks"        tambah butir di bagian versi tersebut pada CHANGELOG
 *   node generator/versi.mjs --tanggal [YYYY-MM-DD]  ganti "(belum dirilis)" versi sekarang dengan tanggal
 *   node generator/versi.mjs --catatan-rilis      cetak isi CHANGELOG untuk versi sekarang (untuk GitHub Release)
 *
 * Berkas yang diubah: node/package.json, node/package-lock.json, node/src/version.ts, php/src/Siakad.php, CHANGELOG.md.
 */
import { readFileSync, writeFileSync, existsSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const ROOT = join(dirname(fileURLToPath(import.meta.url)), '..');
const f = (p) => join(ROOT, p);
const baca = (p) => readFileSync(f(p), 'utf8');
const tulis = (p, s) => writeFileSync(f(p), s);

const args = process.argv.slice(2);
const opsi = (nama) => {
  const i = args.indexOf(nama);
  if (i < 0) return undefined;
  const v = args[i + 1];
  return v && !v.startsWith('--') ? v : true;
};

const SEMVER = /^(\d+)\.(\d+)\.(\d+)$/;

function versiSekarang() {
  const npm = JSON.parse(baca('node/package.json')).version;
  const ts = baca('node/src/version.ts').match(/VERSION = '([^']+)'/)?.[1];
  const php = baca('php/src/Siakad.php').match(/VERSION = '([^']+)'/)?.[1];
  if (npm !== ts || npm !== php) {
    console.error(`Versi tidak sama: npm=${npm} ts=${ts} php=${php}`);
    process.exit(1);
  }
  return npm;
}

function naikkan(v, jenis) {
  if (jenis === 'tetap') return v;
  if (SEMVER.test(jenis)) return jenis;
  const [, a, b, c] = v.match(SEMVER).map(Number);
  if (jenis === 'major') return `${a + 1}.0.0`;
  if (jenis === 'minor') return `${a}.${b + 1}.0`;
  if (jenis === 'patch') return `${a}.${b}.${c + 1}`;
  console.error(`Jenis kenaikan tidak dikenal: ${jenis} (patch, minor, major, atau X.Y.Z)`);
  process.exit(1);
}

function setVersi(baru) {
  const pkg = JSON.parse(baca('node/package.json'));
  pkg.version = baru;
  tulis('node/package.json', JSON.stringify(pkg, null, 2) + '\n');
  if (existsSync(f('node/package-lock.json'))) {
    const lock = JSON.parse(baca('node/package-lock.json'));
    lock.version = baru;
    if (lock.packages?.['']) lock.packages[''].version = baru;
    tulis('node/package-lock.json', JSON.stringify(lock, null, 2) + '\n');
  }
  tulis('node/src/version.ts', baca('node/src/version.ts').replace(/VERSION = '[^']+'/, `VERSION = '${baru}'`));
  tulis('php/src/Siakad.php', baca('php/src/Siakad.php').replace(/VERSION = '[^']+'/, `VERSION = '${baru}'`));
}

/** Bagian CHANGELOG: [indeks awal judul, indeks akhir isi] untuk versi tertentu. */
function bagian(md, versi) {
  const re = new RegExp(`^## ${versi.replace(/\./g, '\\.')}\\b.*$`, 'm');
  const m = re.exec(md);
  if (!m) return null;
  const sisa = md.slice(m.index + m[0].length);
  const next = sisa.search(/^## /m);
  return { awal: m.index, judul: m[0], akhir: next < 0 ? md.length : m.index + m[0].length + next };
}

function changelogVersi(baru, catatan) {
  let md = baca('CHANGELOG.md');
  let b = bagian(md, baru);
  if (!b) {
    // Bila ada bagian "(belum dirilis)" untuk versi lama, ganti nomornya; selain itu sisipkan bagian baru di atas.
    const lama = md.match(/^## (\d+\.\d+\.\d+) \(belum dirilis\)$/m);
    if (lama) {
      md = md.replace(lama[0], `## ${baru} (belum dirilis)`);
    } else {
      const i = md.search(/^## /m);
      const judul = `## ${baru} (belum dirilis)\n\n`;
      md = i < 0 ? md.trimEnd() + '\n\n' + judul : md.slice(0, i) + judul + md.slice(i);
    }
    b = bagian(md, baru);
  }
  if (typeof catatan === 'string' && catatan.trim()) {
    const isi = md.slice(b.awal + b.judul.length, b.akhir).replace(/\s+$/, '');
    const butir = catatan
      .trim()
      .split('\n')
      .map((l, i) => (i === 0 ? `- ${l}` : `  ${l}`))
      .join('\n');
    const baruIsi = (isi.trim() ? isi + '\n' : '\n\n') + butir + '\n\n';
    md = md.slice(0, b.awal + b.judul.length) + baruIsi + md.slice(b.akhir);
  }
  tulis('CHANGELOG.md', md);
}

const sekarang = versiSekarang();

if (opsi('--catatan-rilis')) {
  const md = baca('CHANGELOG.md');
  const b = bagian(md, sekarang);
  process.stdout.write(b ? md.slice(b.awal + b.judul.length, b.akhir).trim() + '\n' : 'Lihat CHANGELOG.md.\n');
  process.exit(0);
}

if (opsi('--tanggal')) {
  const t = typeof opsi('--tanggal') === 'string' ? opsi('--tanggal') : new Date().toISOString().slice(0, 10);
  const md = baca('CHANGELOG.md');
  const lama = `## ${sekarang} (belum dirilis)`;
  if (md.includes(lama)) tulis('CHANGELOG.md', md.replace(lama, `## ${sekarang} (${t})`));
  console.log(sekarang);
  process.exit(0);
}

const jenis = args.find((a) => !a.startsWith('--') && a !== opsi('--catatan') && a !== opsi('--tanggal'));
if (!jenis) {
  console.log(sekarang);
  process.exit(0);
}

const baru = naikkan(sekarang, jenis);
if (baru !== sekarang) setVersi(baru);
changelogVersi(baru, opsi('--catatan'));
console.log(baru);
