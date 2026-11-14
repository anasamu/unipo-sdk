import { defineConfig } from 'tsup';

export default defineConfig({
  entry: ['src/index.ts'],
  format: ['esm', 'cjs'],
  dts: true,
  clean: true,
  target: 'es2022',
  platform: 'neutral',
  treeshake: true,
  // Dokumentasi tetap ada di .d.ts (untuk autocomplete); kode JS cukup tanpa komentar.
  esbuildOptions(o) {
    o.minifyWhitespace = true;
    o.minifySyntax = true;
    o.minifyIdentifiers = false;
    o.keepNames = true;
  },
});
