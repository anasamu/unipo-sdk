import test from 'node:test';
import assert from 'node:assert/strict';
import { jarakMeter, cocokkanArea, dalamPoligon, buatKunciPresensi } from '../dist/index.js';

const kampus1 = { id: 1, kode: 'k1', nama: 'Kampus 1', lat: 0.4743, lng: 121.9378, radius_m: 150, poligon: null };
const kampus2 = { id: 2, kode: 'k2', nama: 'Kampus 2', lat: 0.4801, lng: 121.9452, radius_m: 100, poligon: [[0.4808, 121.9445], [0.4808, 121.946], [0.4795, 121.946], [0.4795, 121.9445]] };

test('jarakMeter kira-kira 111 m per 0.001 derajat lintang', () => {
  const j = jarakMeter({ lat: 0, lng: 0 }, { lat: 0.001, lng: 0 });
  assert.ok(j > 110 && j < 112);
});

test('cocokkanArea: radius dan poligon', () => {
  assert.equal(cocokkanArea([kampus1, kampus2], { lat: 0.4744, lng: 121.9379 }).area.kode, 'k1');
  assert.equal(cocokkanArea([kampus1, kampus2], { lat: 0.48, lng: 121.945 }).area.kode, 'k2');
  const luar = cocokkanArea([kampus1, kampus2], { lat: 0.49, lng: 121.9379 });
  assert.equal(luar.diArea, false);
  assert.ok(luar.jarakM > 1000);
  assert.equal(dalamPoligon({ lat: 0.49, lng: 121.945 }, kampus2.poligon), false);
});

test('buatKunciPresensi unik', () => {
  assert.notEqual(buatKunciPresensi(), buatKunciPresensi());
});
