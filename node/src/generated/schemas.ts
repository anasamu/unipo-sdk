// Dibuat otomatis oleh generator/generate.mjs dari SIAKAD UNIPO API 1.0.0. Jangan diubah manual.
/* eslint-disable */
import type { Uploadable } from '../types.js';

/** Objek JSON bebas. */
export type JsonObject = { [key: string]: any };

export type Error = {
  error: {
    /** Contoh: `insufficient_scope` */
    code: string;
    message: string;
    /** Rincian, mis. field yang tidak valid */
    details?: JsonObject;
    [key: string]: any;
  };
  /** Contoh: `9f1c2a7b3d4e5f60` */
  request_id: string;
  [key: string]: any;
};

export type Meta = {
  page?: number | null;
  per_page?: number | null;
  total?: number | null;
  total_pages?: number | null;
  [key: string]: any;
};

/** Baris data dengan nama kolom huruf kecil sesuai tabel SIAKAD. */
export type Objek = JsonObject;

export type Info = {
  nama?: string | null;
  versi?: string | null;
  dokumentasi?: string | null;
  openapi?: string | null;
  waktu_server?: string | null;
  [key: string]: any;
};

export type Health = {
  /** Contoh: `ok` */
  status?: string | null;
  /** Contoh: `ok` */
  database?: string | null;
  waktu_server?: string | null;
  [key: string]: any;
};

export type StatusLingkungan = {
  /** ok atau gangguan Contoh: `ok` */
  status?: string | null;
  server?: {
    lingkungan?: "produksi" | "uji" | "pengembangan" | "lokal";
    /** Contoh: `Produksi` */
    label?: string | null;
    [key: string]: any;
  };
  database?: {
    lingkungan?: "live" | "development";
    /** Label siap tampil Contoh: `Live (produksi)` */
    label?: string | null;
    data_asli?: boolean;
    disamarkan?: boolean;
    /** Waktu salinan live terakhir (development) */
    salinan_at?: string | null;
    alasan?: "aplikasi" | "menyamar" | "dipilih" | null;
    tersambung?: boolean;
    [key: string]: any;
  };
  api?: {
    /** Contoh: `1.0.0` */
    versi?: string | null;
    /** Contoh: `bcf8aa53` */
    commit?: string | null;
    [key: string]: any;
  };
  waktu_server?: string | null;
  [key: string]: any;
};

export type TokenRequest = {
  grant_type: "client_credentials" | "password" | "refresh_token" | "urn:ietf:params:oauth:grant-type:token-exchange";
  /** Bila tidak memakai header Basic */
  client_id?: string | null;
  /** Bila tidak memakai header Basic */
  client_secret?: string | null;
  /** Opsional: daftar scope dipisah spasi, subset dari izin klien Contoh: `mahasiswa:read nilai:read` */
  scope?: string | null;
  /** grant password: NIM/NIDN/username SIAKAD */
  username?: string | null;
  /** grant password */
  password?: string | null;
  /** grant refresh_token */
  refresh_token?: string | null;
  /** grant token-exchange: id_token dari SSO UNIPO (klien wajib punya sso_audience) */
  subject_token?: string | null;
  /** grant token-exchange Contoh: `urn:ietf:params:oauth:token-type:id_token` */
  subject_token_type?: string | null;
  [key: string]: any;
};

export type TokenResponse = {
  access_token: string;
  /** Contoh: `Bearer` */
  token_type: string;
  /** Contoh: `3600` */
  expires_in: number;
  scope: string;
  /** Hanya untuk grant password/refresh_token. Sekali pakai. */
  refresh_token?: string | null;
  refresh_expires_in?: number | null;
  [key: string]: any;
};

export type RevokeRequest = {
  /** Opsional */
  refresh_token?: string | null;
  [key: string]: any;
};

export type Me = {
  client_id?: string | null;
  client_name?: string | null;
  token_type?: "client" | "user";
  scopes?: Array<string>;
  expires_at?: string | null;
  username?: string | null;
  level?: string | null;
  nama?: string | null;
  prodi?: Array<string>;
  /** Email akun (token pengguna, bila terisi) */
  email?: string;
  /** Kode peran RBAC yang sedang dipegang (docs/RBAC.md); rincian di /v1/rbac/saya */
  peran?: Array<string>;
  /** Database yang dipakai token ini (docs/LINGKUNGAN.md) */
  lingkungan?: "live" | "development";
  [key: string]: any;
};

export type Prodi = {
  kode_prodi?: string | null;
  kode_pt?: string | null;
  kode_fak?: string | null;
  nama_fakultas?: string | null;
  kode_jenjang?: string | null;
  nama_prodi?: string | null;
  sks_lulus?: number | null;
  status_prodi?: string | null;
  kode_akreditasi?: string | null;
  no_sk_ban?: string | null;
  tgl_akhir_sk_ban?: string | null;
  gelar?: string | null;
  gelar_panjang?: string | null;
  email?: string | null;
  website?: string | null;
  [key: string]: any;
};

export type TahunAkademik = {
  /** Contoh: `20261` */
  tahun_id?: string | null;
  tahun?: string | null;
  semester?: number | null;
  nama_tahun?: string | null;
  /** Y = periode aktif */
  buka?: string | null;
  krs_online_mulai?: string | null;
  krs_online_selesai?: string | null;
  krs_ubah_mulai?: string | null;
  krs_ubah_selesai?: string | null;
  kuliah_mulai?: string | null;
  kuliah_selesai?: string | null;
  uts_mulai?: string | null;
  uts_selesai?: string | null;
  uas_mulai?: string | null;
  uas_selesai?: string | null;
  nilai_mulai?: string | null;
  nilai_selesai?: string | null;
  bayar_mulai?: string | null;
  bayar_selesai?: string | null;
  max_sks?: number | null;
  min_presensi?: number | null;
  [key: string]: any;
};

export type MahasiswaRingkas = {
  nim?: string | null;
  nama?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  kode_jenjang?: string | null;
  /** L/P */
  jenis_kelamin?: string | null;
  tahun_masuk?: string | null;
  semester_masuk?: string | null;
  kelas?: string | null;
  /** Kode status (lihat /v1/referensi/kode/05) */
  status_aktif?: string | null;
  status_aktif_label?: string | null;
  nidn_pa?: string | null;
  [key: string]: any;
};

export type Mahasiswa = {
  nim?: string | null;
  nama?: string | null;
  kode_pt?: string | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  kode_jenjang?: string | null;
  jenis_kelamin?: string | null;
  agama?: string | null;
  /** B baru, P pindahan */
  status_masuk?: string | null;
  tahun_masuk?: string | null;
  semester_masuk?: string | null;
  tanggal_masuk?: string | null;
  batas_studi?: string | null;
  kelas?: string | null;
  shift?: string | null;
  semester?: number | null;
  status_aktif?: string | null;
  status_aktif_label?: string | null;
  nidn_pa?: string | null;
  nirm?: string | null;
  npm?: string | null;
  konsentrasi?: string | null;
  tanggal_lulus?: string | null;
  yudisium?: string | null;
  no_sk_yudisium?: string | null;
  tanggal_sk_yudisium?: string | null;
  no_ijazah?: string | null;
  tanggal_beri_ijazah?: string | null;
  asal?: {
    nama_sekolah?: string | null;
    tahun_lulus_sekolah?: string | null;
    nama_pt?: string | null;
    nim?: string | null;
    nama_prodi?: string | null;
    sks_diakui?: number | null;
    [key: string]: any;
  };
  /** Hanya dengan scope mahasiswa:pii */
  pribadi?: {
    nik?: string | null;
    nisn?: string | null;
    npwp?: string | null;
    tempat_lahir?: string | null;
    tanggal_lahir?: string | null;
    warga_negara?: string | null;
    status_sipil?: string | null;
    email?: string | null;
    hp?: string | null;
    telepon?: string | null;
    alamat?: {
      jalan?: string | null;
      rt?: string | null;
      rw?: string | null;
      dusun?: string | null;
      desa?: string | null;
      kecamatan?: string | null;
      kode_kabupaten?: string | null;
      kode_propinsi?: string | null;
      kode_pos?: string | null;
      [key: string]: any;
    };
    jenis_tinggal?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type Dosen = {
  nidn?: string | null;
  nama?: string | null;
  /** Dengan gelar */
  nama_lengkap?: string | null;
  gelar_depan?: string | null;
  gelar_belakang?: string | null;
  nip?: string | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  kode_jenjang?: string | null;
  jenis_kelamin?: string | null;
  status_aktif?: string | null;
  status_pegawai?: string | null;
  ikatan_kerja?: string | null;
  pendidikan?: string | null;
  pangkat_golongan?: string | null;
  jabatan_akademik?: string | null;
  jabatan_fungsional?: string | null;
  jabatan_struktural?: string | null;
  mulai_masuk?: string | null;
  /** Hanya dengan scope dosen:pii */
  pribadi?: {
    nik?: string | null;
    npwp?: string | null;
    agama?: string | null;
    tempat_lahir?: string | null;
    tanggal_lahir?: string | null;
    email?: string | null;
    hp?: string | null;
    telepon?: string | null;
    alamat?: {
      jalan?: string | null;
      rt?: string | null;
      rw?: string | null;
      dusun?: string | null;
      desa?: string | null;
      kecamatan?: string | null;
      kode_kabupaten?: string | null;
      kode_propinsi?: string | null;
      kode_pos?: string | null;
      [key: string]: any;
    };
    [key: string]: any;
  };
  [key: string]: any;
};

export type Jadwal = {
  /** ID jadwal */
  idj?: number | null;
  /** Periode Contoh: `20261` */
  tahun_id?: string | null;
  kode_prodi?: string | null;
  semester?: number | null;
  kelas?: string | null;
  kode_mk?: string | null;
  nama_mk?: string | null;
  sks?: number | null;
  /** Kode hari */
  hari?: string | null;
  jam_ke?: number | null;
  /** Contoh: `07:30:00` */
  jam_mulai?: string | null;
  jam_selesai?: string | null;
  ruang?: string | null;
  nama_ruang?: string | null;
  kapasitas?: number | null;
  dosen?: {
    nidn?: string | null;
    nama?: string | null;
    [key: string]: any;
  };
  tim_pengajar?: Array<{
    nidn?: string | null;
    nama?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type JadwalMahasiswa = {
  nim?: string | null;
  tahun_id?: string | null;
  jadwal?: Array<{
    /** ID jadwal */
    idj?: number | null;
    /** Periode Contoh: `20261` */
    tahun_id?: string | null;
    kode_prodi?: string | null;
    semester?: number | null;
    kelas?: string | null;
    kode_mk?: string | null;
    nama_mk?: string | null;
    sks?: number | null;
    /** Kode hari */
    hari?: string | null;
    jam_ke?: number | null;
    /** Contoh: `07:30:00` */
    jam_mulai?: string | null;
    jam_selesai?: string | null;
    ruang?: string | null;
    nama_ruang?: string | null;
    kapasitas?: number | null;
    dosen?: {
      nidn?: string | null;
      nama?: string | null;
      [key: string]: any;
    };
    tim_pengajar?: Array<{
      nidn?: string | null;
      nama?: string | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type Krs = {
  nim?: string | null;
  tahun_id?: string | null;
  jumlah_sks?: number | null;
  mata_kuliah?: Array<{
    idkrs?: number | null;
    tahun_id?: string | null;
    semester?: number | null;
    kode_mk?: string | null;
    nama_mk?: string | null;
    sks?: number | null;
    kelas?: string | null;
    idj?: number | null;
    /** T = disetujui */
    status_krs?: string | null;
    disetujui?: boolean;
    hari?: string | null;
    jam_ke?: number | null;
    ruang?: string | null;
    nidn_dosen?: string | null;
    ujian?: {
      uts_ruang?: string | null;
      uts_meja?: string | null;
      uas_ruang?: string | null;
      uas_meja?: string | null;
      [key: string]: any;
    };
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KrsPenawaran = {
  nim?: string | null;
  tahun_id?: string | null;
  boleh_ambil?: boolean;
  /** Sebab bila boleh_ambil false */
  alasan?: string | null;
  /** standar, uma, atau umsb */
  mode?: string | null;
  /** Batas SIAKAD, diperketat aturan batas_nilai sks_diambil */
  batas_sks?: number | null;
  ips_sebelumnya?: number | null;
  sks_terambil?: number | null;
  aturan?: AturanRingkas;
  mata_kuliah?: Array<{
    /** ID mata kuliah, dikirim saat ambil KRS */
    id?: number | null;
    kode_mk?: string | null;
    nama_mk?: string | null;
    semester?: number | null;
    sks?: number | null;
    dosen?: string | null;
    sudah_diambil?: boolean;
    bisa_dipilih?: boolean;
    /** Mis. prasyarat belum lulus */
    keterangan?: string | null;
    nilai_sebelumnya?: string | null;
    /** true: wajib mengirim idj */
    pilih_kelas?: boolean;
    kelas?: Array<{
      idj?: number | null;
      nama?: string | null;
      keterangan?: string | null;
      terpilih?: boolean;
      penuh?: boolean;
      kelas?: string | null;
      hari?: string | null;
      jamke?: number | null;
      ruang?: string | null;
      nidn?: string | null;
      kapasitas?: number | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  pesan?: Array<string>;
  [key: string]: any;
};

export type KrsAmbilRequest = {
  mata_kuliah: Array<{
    id: number;
    idj?: number;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KrsAmbilResponse = {
  nim?: string | null;
  tahun_id?: string | null;
  batas_sks?: number | null;
  melebihi_batas_sks?: boolean;
  tersimpan?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    nim?: string | null;
    hari?: string | null;
    jamke?: string | null;
    [key: string]: any;
  }>;
  sudah_ada?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    nim?: string | null;
    hari?: string | null;
    jamke?: string | null;
    [key: string]: any;
  }>;
  kelas_belum_terpilih_atau_penuh?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    nim?: string | null;
    hari?: string | null;
    jamke?: string | null;
    [key: string]: any;
  }>;
  bentrok?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    nim?: string | null;
    hari?: string | null;
    jamke?: string | null;
    [key: string]: any;
  }>;
  sks_terambil?: number | null;
  pesan?: Array<string>;
  [key: string]: any;
};

export type PesanRequest = {
  pesan: string;
  [key: string]: any;
};

export type Khs = {
  nim?: string | null;
  tahun_id?: string | null;
  mata_kuliah?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    semester?: number | null;
    kelas?: string | null;
    sks?: number | null;
    /** null bila nilai belum boleh ditampilkan */
    nilai_huruf?: string | null;
    bobot?: number | null;
    /** sks x bobot */
    mutu?: number | null;
    nilai_ditampilkan?: boolean;
    [key: string]: any;
  }>;
  jumlah_sks?: number | null;
  ips?: {
    /** Jumlah SKS yang dihitung */
    sks?: number | null;
    /** Indeks prestasi (2 desimal) */
    nilai?: number | null;
    [key: string]: any;
  };
  ipk?: {
    /** Jumlah SKS yang dihitung */
    sks?: number | null;
    /** Indeks prestasi (2 desimal) */
    nilai?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
} | {
  nim?: string | null;
  periode?: Array<{
    nim?: string | null;
    tahun_id?: string | null;
    mata_kuliah?: Array<{
      kode_mk?: string | null;
      nama_mk?: string | null;
      semester?: number | null;
      kelas?: string | null;
      sks?: number | null;
      /** null bila nilai belum boleh ditampilkan */
      nilai_huruf?: string | null;
      bobot?: number | null;
      /** sks x bobot */
      mutu?: number | null;
      nilai_ditampilkan?: boolean;
      [key: string]: any;
    }>;
    jumlah_sks?: number | null;
    ips?: {
      /** Jumlah SKS yang dihitung */
      sks?: number | null;
      /** Indeks prestasi (2 desimal) */
      nilai?: number | null;
      [key: string]: any;
    };
    ipk?: {
      /** Jumlah SKS yang dihitung */
      sks?: number | null;
      /** Indeks prestasi (2 desimal) */
      nilai?: number | null;
      [key: string]: any;
    };
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type Transkrip = {
  nim?: string | null;
  nama?: string | null;
  kode_prodi?: string | null;
  mata_kuliah?: Array<{
    kode_mk?: string | null;
    nama_mk?: string | null;
    tahun_id?: string | null;
    semester?: number | null;
    sks?: number | null;
    nilai_huruf?: string | null;
    bobot?: number | null;
    mutu?: number | null;
    [key: string]: any;
  }>;
  jumlah_sks?: number | null;
  jumlah_mutu?: number | null;
  ipk?: {
    /** Jumlah SKS yang dihitung */
    sks?: number | null;
    /** Indeks prestasi (2 desimal) */
    nilai?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type Keuangan = {
  nim?: string | null;
  /** tagihan_mahasiswa (per NIM) atau biaya_prodi */
  mode_tagihan?: string | null;
  periode?: Array<{
    tahun_id?: string | null;
    item?: Array<{
      kode_biaya?: string | null;
      jenis_biaya?: string | null;
      tagihan?: number | null;
      dibayar?: number | null;
      potongan?: number | null;
      sisa?: number | null;
      pembayaran?: Array<{
        id?: number | null;
        tanggal?: string | null;
        jumlah?: number | null;
        diskon?: number | null;
        keterangan?: string | null;
        [key: string]: any;
      }>;
      [key: string]: any;
    }>;
    ringkasan?: {
      tagihan?: number | null;
      dibayar?: number | null;
      potongan?: number | null;
      sisa?: number | null;
      [key: string]: any;
    };
    [key: string]: any;
  }>;
  ringkasan?: {
    tagihan?: number | null;
    dibayar?: number | null;
    potongan?: number | null;
    sisa?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type PusatBerkas = {
  uuid?: string;
  jenis?: string;
  nama?: string;
  mime?: string;
  ukuran?: number;
  sha256?: string;
  keterangan?: string | null;
  diunggah_oleh?: string;
  created_at?: string;
  [key: string]: any;
};

export type PusatBerkasInput = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  berkas?: Uploadable;
  /** Mis. lampiran, bukti, laporan */
  jenis?: string;
  keterangan?: string;
  /** Alternatif JSON */
  berkas_base64?: string;
  nama_file?: string;
  [key: string]: any;
};

/** Persyaratan penerimaan prodi (tabel adm_prodi_syarat) */
export type AdmisiProdiSyarat = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  jalur_masuk?: string;
  judul?: string;
  uraian?: string;
  /** Nilai JSON apa pun */
  jurusan_sma?: any;
  nilai_rapor_min?: number;
  tes_kesehatan?: boolean;
  tes_buta_warna?: boolean;
  urutan?: number;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiProdiSyaratInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi: string;
  jalur_masuk?: string;
  judul: string;
  uraian?: string;
  /** Nilai JSON apa pun */
  jurusan_sma?: any;
  nilai_rapor_min?: number;
  tes_kesehatan?: boolean;
  tes_buta_warna?: boolean;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

/** Petugas sesi tes (tabel adm_petugas_sesi) */
export type AdmisiPetugasSesi = {
  id?: number;
  sesi_id?: number;
  /** user.username */
  username?: string;
  nama?: string;
  peran?: "pengawas" | "penguji" | "pewawancara" | "operator";
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiPetugasSesiInput = {
  sesi_id: number;
  /** user.username */
  username: string;
  nama?: string;
  peran?: "pengawas" | "penguji" | "pewawancara" | "operator";
  catatan?: string;
  [key: string]: any;
};

/** Letter of Acceptance (tabel adm_loa) */
export type AdmisiLoa = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  pmb_pendaftaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  no_pmb?: string;
  /** (hanya baca) Hanya dibaca. */
  id_pilihan?: number;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** (hanya baca) Hanya dibaca. */
  tanggal?: string;
  batas_daftar_ulang?: string;
  /** (hanya baca) Hanya dibaca. */
  isi?: JsonObject;
  /** (hanya baca) Hanya dibaca. */
  kode_verifikasi?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "terbit" | "batal";
  /** (hanya baca) Hanya dibaca. */
  alasan_batal?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiLoaInput = {
  batas_daftar_ulang?: string;
  [key: string]: any;
};

export type AdmisiLoaBatalInput = {
  alasan: string;
  [key: string]: any;
};

/** KIP Kuliah (tabel adm_kip) */
export type AdmisiKip = {
  id?: number;
  pmb_pendaftaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  no_pmb?: string;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nama?: string;
  nik?: string;
  nisn?: string;
  /** (unik) */
  no_pendaftaran_kip?: string;
  nomor_kip?: string;
  punya_kks_pkh?: boolean;
  penghasilan_ortu?: number;
  jumlah_tanggungan?: number;
  skema?: "kip_kuliah" | "kip_kuliah_merdeka" | "afirmasi" | "lainnya";
  /** m_tahun.tahun_id */
  angkatan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "diusulkan" | "ditetapkan" | "ditolak" | "dicabut";
  /** (hanya baca) Hanya dibaca. */
  nomor_sk?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiKipInput = {
  pmb_pendaftaran_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nama: string;
  nik?: string;
  nisn?: string;
  /** (unik) */
  no_pendaftaran_kip?: string;
  nomor_kip?: string;
  punya_kks_pkh?: boolean;
  penghasilan_ortu?: number;
  jumlah_tanggungan?: number;
  skema?: "kip_kuliah" | "kip_kuliah_merdeka" | "afirmasi" | "lainnya";
  /** m_tahun.tahun_id */
  angkatan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type AdmisiKipVerifikasiInput = {
  catatan?: string;
  [key: string]: any;
};

export type AdmisiKipUsulkanInput = {
  no_pendaftaran_kip?: string;
  catatan?: string;
  [key: string]: any;
};

export type AdmisiKipTetapkanInput = {
  nomor_sk: string;
  catatan?: string;
  [key: string]: any;
};

export type AdmisiKipTolakInput = {
  catatan: string;
  [key: string]: any;
};

export type AdmisiKipCabutInput = {
  catatan: string;
  [key: string]: any;
};

/** UKT pendaftar (tabel adm_ukt) */
export type AdmisiUkt = {
  id?: number;
  /** (unik) */
  pmb_pendaftaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  no_pmb?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  penghasilan_ayah?: number;
  penghasilan_ibu?: number;
  penghasilan_wali?: number;
  jumlah_tanggungan?: number;
  pekerjaan_ayah?: string;
  pekerjaan_ibu?: string;
  daya_listrik?: number;
  kepemilikan_rumah?: "milik_sendiri" | "sewa" | "menumpang" | "dinas" | "lainnya";
  /** (hanya baca) Hanya dibaca. */
  penghasilan_per_kapita?: number;
  /** (hanya baca) Hanya dibaca. */
  kelompok_usulan?: string;
  /** (hanya baca) Hanya dibaca. */
  kelompok?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "ditetapkan" | "banding" | "diterapkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiUktInput = {
  /** (unik) */
  pmb_pendaftaran_id: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  penghasilan_ayah?: number;
  penghasilan_ibu?: number;
  penghasilan_wali?: number;
  jumlah_tanggungan?: number;
  pekerjaan_ayah?: string;
  pekerjaan_ibu?: string;
  daya_listrik?: number;
  kepemilikan_rumah?: "milik_sendiri" | "sewa" | "menumpang" | "dinas" | "lainnya";
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type AdmisiUktTetapkanInput = {
  kelompok?: string;
  catatan?: string;
  [key: string]: any;
};

export type AdmisiUktBandingInput = {
  catatan: string;
  [key: string]: any;
};

/** Aturan usulan kelompok UKT (tabel adm_ukt_aturan) */
export type AdmisiUktAturan = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  per_kapita_min?: number;
  per_kapita_maks?: number;
  kelompok?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiUktAturanInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  per_kapita_min?: number;
  per_kapita_maks?: number;
  kelompok: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Format NIM (tabel adm_format_nim) */
export type AdmisiFormatNim = {
  id?: number;
  /** m_program_studi.kode_prodi (unik) */
  kode_prodi?: string;
  pola?: string;
  mulai?: number;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiFormatNimInput = {
  /** m_program_studi.kode_prodi (unik) */
  kode_prodi: string;
  pola: string;
  mulai?: number;
  aktif?: boolean;
  [key: string]: any;
};

/** Aturan NIM otomatis (tabel adm_aturan_nim) */
export type AdmisiAturanNim = {
  id?: number;
  nama?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_fakultas?: string;
  kode_jenjang?: string;
  jalur_masuk?: string;
  /** m_tahun.tahun_id */
  tahun_mulai?: string;
  /** m_tahun.tahun_id */
  tahun_selesai?: string;
  pola?: string;
  kode_khusus?: string;
  mulai?: number;
  urut_per?: "pola" | "prodi_periode";
  prioritas?: number;
  aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AdmisiAturanNimInput = {
  nama: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_fakultas?: string;
  kode_jenjang?: string;
  jalur_masuk?: string;
  /** m_tahun.tahun_id */
  tahun_mulai?: string;
  /** m_tahun.tahun_id */
  tahun_selesai?: string;
  pola: string;
  kode_khusus?: string;
  mulai?: number;
  urut_per?: "pola" | "prodi_periode";
  prioritas?: number;
  aktif?: boolean;
  keterangan?: string;
  [key: string]: any;
};

/** Pengajuan status akademik (tabel akd_pengajuan) */
export type AkademikPengajuan = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  jenis?: "cuti" | "aktif_kembali" | "non_aktif" | "mengundurkan_diri" | "pindah_kelas" | "pindah_kampus" | "pindah_prodi";
  tanggal_mulai?: string;
  tanggal_akhir?: string;
  tujuan?: string;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  tercatat_siakad?: boolean;
  /** (hanya baca) Hanya dibaca. */
  hasil_siakad?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  /** Jumlah dokumen pendukung minimal (detail) */
  lampiran_wajib?: number;
  jumlah_lampiran?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AkademikPengajuanInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  jenis: "cuti" | "aktif_kembali" | "non_aktif" | "mengundurkan_diri" | "pindah_kelas" | "pindah_kampus" | "pindah_prodi";
  tanggal_mulai?: string;
  tanggal_akhir?: string;
  tujuan?: string;
  alasan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan; ada jumlah minimal wajib (lihat lampiran_wajib di detail) */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type AkademikPengajuanSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type AkademikPengajuanTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Pengajuan perbaikan nilai (tabel akd_nilai_perbaikan) */
export type AkademikNilaiPerbaikan = {
  id?: number;
  idkrs?: number;
  /** (hanya baca) Hanya dibaca. */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** (hanya baca) Hanya dibaca. */
  tahun_id?: string;
  /** (hanya baca) Hanya dibaca. */
  kode_mk?: string;
  /** (hanya baca) Hanya dibaca. */
  nama_mk?: string;
  /** (hanya baca) Hanya dibaca. */
  kelas?: string;
  /** (hanya baca) Hanya dibaca. */
  sks?: number;
  /** (hanya baca) Hanya dibaca. */
  nilai_lama?: string;
  /** (hanya baca) Hanya dibaca. */
  nilai_angka_lama?: number;
  nilai_baru?: string;
  nilai_angka_baru?: number;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  peran_pengaju?: "dosen" | "prodi" | "baak" | "dekan";
  /** (hanya baca) Hanya dibaca. */
  pengaju?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  tercatat_siakad?: boolean;
  /** (hanya baca) Hanya dibaca. */
  nilai_hasil?: string;
  /** (hanya baca) Hanya dibaca. */
  hasil_siakad?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type AkademikNilaiPerbaikanInput = {
  idkrs: number;
  nilai_baru?: string;
  nilai_angka_baru?: number;
  alasan: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type AkademikNilaiPerbaikanSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type AkademikNilaiPerbaikanTolakInput = {
  catatan: string;
  [key: string]: any;
};

export type JadwalSesiRingkas = {
  id?: number | null;
  prodi?: string;
  nama_prodi?: string;
  kode_mk?: string;
  nama_mk?: string;
  semester?: string;
  kelas?: string;
  hari?: string;
  jamke?: number | null;
  mulai?: string | null;
  sampai?: string | null;
  ruang?: string;
  /** idkp: 01 = kampus 1, 02 = kampus 2 */
  kampus?: string;
  dosen?: Array<string>;
  [key: string]: any;
};

export type JadwalTemuan = {
  jenis?: "ruang" | "dosen" | "kelas" | "mahasiswa" | "pindah_kampus" | "kampus_ruang" | "waktu";
  tingkat?: "bentrok" | "peringatan";
  hari?: string;
  nama_hari?: string;
  pesan?: string;
  a?: JadwalSesiRingkas;
  b?: JadwalSesiRingkas | null;
  detail?: {
    nidn?: string;
    dosen?: string;
    jumlah_mahasiswa?: number;
    jeda_menit?: number;
    [key: string]: any;
  } | null;
  [key: string]: any;
};

export type JadwalBentrokLaporan = {
  prodi?: string;
  tahun_id?: string;
  jeda_kampus?: number;
  ringkasan?: {
    jadwal?: number;
    jadwal_bentrok?: number;
    bentrok?: number;
    peringatan?: number;
    per_jenis?: Record<string, number>;
    [key: string]: any;
  };
  /** idj jadwal prodi ini yang bentrok */
  id_bentrok?: Array<number>;
  data?: Array<JadwalTemuan>;
  [key: string]: any;
};

export type JadwalCekHasil = {
  aman?: boolean;
  jadwal?: JadwalSesiRingkas;
  data?: Array<JadwalTemuan>;
  [key: string]: any;
};

export type JadwalOtomatisInput = {
  sumber?: "periode" | "bentrok";
  /** Contoh: `20251` */
  dari_tahun_id?: string;
  hari?: Array<string>;
  kelas?: Array<string>;
  /** Contoh: `30` */
  jeda_kampus?: number;
  /** Contoh: `50` */
  menit_per_sks?: number;
  /** Contoh: `15:00` */
  batas_sore?: string;
  [key: string]: any;
};

export type JadwalUsulan = {
  kunci?: string;
  /** Diisi bila mengubah jadwal yang ada (sumber bentrok) */
  id?: number | null;
  asal_id?: number | null;
  kode_mk?: string;
  nama_mk?: string;
  sks?: number;
  semester?: string;
  kelas?: string;
  nama_kelas?: string;
  nidn?: string;
  dosen?: string;
  tim?: Array<{
    nidn?: string;
    nama?: string;
    [key: string]: any;
  }>;
  kapasitas?: number;
  hari?: string;
  nama_hari?: string;
  jamke?: number;
  mulai?: string;
  sampai?: string;
  ruang?: string;
  nama_ruang?: string;
  kampus?: string;
  asal?: {
    hari?: string;
    nama_hari?: string;
    jamke?: number | null;
    mulai?: string | null;
    sampai?: string | null;
    ruang?: string;
    [key: string]: any;
  };
  catatan?: Array<string>;
  [key: string]: any;
};

export type JadwalOtomatisHasil = {
  prodi?: string;
  tahun_id?: string;
  opsi?: JadwalOtomatisInput;
  ringkasan?: {
    diminta?: number;
    terjadwal?: number;
    tidak_terjadwal?: number;
    [key: string]: any;
  };
  usulan?: Array<JadwalUsulan>;
  tidak_terjadwal?: Array<{
    asal_id?: number | null;
    kode_mk?: string;
    nama_mk?: string;
    sks?: number;
    semester?: string;
    kelas?: string;
    nidn?: string;
    dosen?: string;
    alasan?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type JadwalOtomatisSimpanInput = {
  usulan: Array<JadwalUsulan>;
  [key: string]: any;
};

export type JadwalOtomatisSimpanHasil = {
  tersimpan?: Array<{
    urut?: number;
    kunci?: string | null;
    id?: number;
    [key: string]: any;
  }>;
  gagal?: Array<{
    urut?: number;
    kunci?: string | null;
    pesan?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type Akun = {
  username?: string;
  nama?: string;
  email?: string | null;
  level?: string;
  aktif?: boolean;
  jenis?: "dosen" | "tendik" | "mahasiswa" | "pendaftar" | null;
  kode_prodi?: string | null;
  sedang_login?: boolean;
  login_terakhir?: string | null;
  /** Akun khusus (vendor) yang tidak bisa diubah */
  khusus?: boolean;
  [key: string]: any;
};

export type AkunHasil = {
  akun?: Akun;
  /** Hanya untuk sandi=acak; tampilkan sekali ke petugas, tidak disimpan di mana pun */
  password_sementara?: string;
  /** Password mengikuti rumus lama */
  password_bawaan?: boolean;
  [key: string]: any;
};

export type AkunCalon = {
  jenis?: string;
  id?: string;
  nama?: string;
  email?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  tanggal_lahir_ada?: boolean;
  /** false untuk tendik tanpa prodi (login lama menolaknya) */
  bisa_login?: boolean;
  [key: string]: any;
};

export type AkunOrangBaru = {
  nama: string;
  kode_prodi: string;
  gelar_depan?: string;
  gelar_belakang?: string;
  jenis_kelamin?: "L" | "P";
  tempat_lahir?: string;
  tanggal_lahir?: string;
  agama?: string;
  ktp?: string;
  hp?: string;
  email?: string;
  [key: string]: any;
};

export type AkunBuatInput = {
  jenis: "dosen" | "tendik" | "mahasiswa" | "pendaftar";
  /** NIDN, NIK karyawan, NIM, atau nomor PMB; menjadi username Contoh: `0912345601` */
  id: string;
  /** Bawaan: DOSEN, OPERATOR, MAHASISWA, MABA */
  level?: string;
  email?: string;
  aktif?: boolean;
  /** bawaan = rumus lama (ID + tanggal lahir 2 digit), acak = dibuat sistem dan dikembalikan sekali, manual = isi `password` */
  sandi?: "bawaan" | "acak" | "manual";
  password?: string;
  orang_baru?: AkunOrangBaru;
  [key: string]: any;
};

export type AkunMassalInput = {
  jenis: "dosen" | "tendik" | "mahasiswa" | "pendaftar";
  id?: Array<string>;
  semua?: boolean;
  q?: string;
  kode_prodi?: string;
  angkatan?: string;
  batas?: number;
  [key: string]: any;
};

export type AkunUbahInput = {
  level?: string;
  email?: string;
  nama?: string;
  [key: string]: any;
};

export type AkunStatusInput = {
  aktif: boolean;
  alasan?: string;
  [key: string]: any;
};

export type AkunSandiInput = {
  /** bawaan = rumus lama (ID + tanggal lahir 2 digit), acak = dibuat sistem dan dikembalikan sekali, manual = isi `password` */
  sandi?: "bawaan" | "acak" | "manual";
  password?: string;
  [key: string]: any;
};

export type AkunPegawaiInput = {
  /** NIDN/NIK karyawan bila pegawai belum punya */
  id_siakad?: string;
  kode_prodi?: string;
  level?: string;
  email?: string;
  aktif?: boolean;
  /** bawaan = rumus lama (ID + tanggal lahir 2 digit), acak = dibuat sistem dan dikembalikan sekali, manual = isi `password` */
  sandi?: "bawaan" | "acak" | "manual";
  password?: string;
  [key: string]: any;
};

export type ApiPortalPengajuan = {
  id?: number;
  uuid?: string;
  /** Contoh: `API-2026-00001` */
  nomor?: string;
  jenis?: "aplikasi_baru" | "akses_api" | "tambah_scope";
  status?: "diajukan" | "perlu_revisi" | "disetujui" | "ditolak" | "dibatalkan";
  aplikasi_id?: number | null;
  pemohon_username?: string;
  pemohon_nama?: string | null;
  pemohon_level?: string | null;
  pemohon_email?: string | null;
  nama_aplikasi?: string;
  keterangan?: string | null;
  tujuan?: string;
  platform?: "web" | "mobile" | "desktop" | "layanan" | "skrip";
  url?: string | null;
  repositori?: string | null;
  butuh_sso?: boolean;
  redirect_uris?: Array<string>;
  scopes?: Array<string>;
  scopes_disetujui?: Array<string> | null;
  data_pribadi?: boolean;
  perkiraan_pengguna?: string | null;
  pembimbing?: string | null;
  catatan_peninjau?: string | null;
  peninjau_username?: string | null;
  diajukan_at?: string | null;
  ditinjau_at?: string | null;
  bisa_diubah?: boolean;
  riwayat?: Array<{
    aksi?: string;
    oleh?: string;
    oleh_nama?: string | null;
    peran?: "pemohon" | "peninjau" | "sistem";
    catatan?: string | null;
    created_at?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type ApiPortalPengajuanInput = {
  jenis: "aplikasi_baru" | "akses_api" | "tambah_scope";
  /** Untuk tambah_scope */
  aplikasi_id?: number;
  /** Contoh: `Presensi QR Fakultas Teknik` */
  nama_aplikasi: string;
  keterangan?: string;
  /** Data apa, untuk apa, siapa penggunanya (min. 30 karakter) */
  tujuan: string;
  platform?: "web" | "mobile" | "desktop" | "layanan" | "skrip";
  /** Contoh: `https://presensi.ft.unipo.ac.id` */
  url?: string;
  repositori?: string;
  butuh_sso?: boolean;
  redirect_uris?: Array<string>;
  scopes?: Array<string>;
  /** Contoh: `500 mahasiswa` */
  perkiraan_pengguna?: string;
  /** Dosen pembimbing/penanggung jawab (dianjurkan untuk mahasiswa) */
  pembimbing?: string;
  /** Saat mengubah: pesan untuk peninjau */
  catatan?: string;
  [key: string]: any;
};

export type ApiPortalSetujuiInput = {
  scopes?: Array<string>;
  catatan?: string;
  client_id_api?: string;
  client_secret_api?: string;
  client_id_sso?: string;
  client_secret_sso?: string;
  rbac_aplikasi_id?: number;
  [key: string]: any;
};

export type ApiPortalAplikasi = {
  id?: number;
  uuid?: string;
  nama?: string;
  keterangan?: string | null;
  jenis?: "web" | "mobile" | "desktop" | "layanan" | "skrip";
  url?: string | null;
  pemilik_username?: string;
  pemilik_nama?: string | null;
  client_id_api?: string | null;
  client_id_sso?: string | null;
  aktif?: boolean;
  api?: {
    ada?: boolean;
    scopes?: Array<string>;
    aktif?: boolean;
    sso_audience?: string | null;
    lingkungan?: "live" | "development";
    akses_live?: JsonObject;
    [key: string]: any;
  } | null;
  kredensial_tersedia?: Array<"api" | "sso">;
  [key: string]: any;
};

export type ArsipUnit = {
  id?: number;
  induk_id?: number | null;
  kode?: string;
  jenis?: "universitas" | "fakultas" | "prodi" | "unit";
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  nama?: string;
  singkatan?: string | null;
  /** Dipakai {kode_unit} di nomor surat */
  kode_surat?: string | null;
  aktif?: number;
  /** admin | pimpinan | sekretaris | arsiparis | staf | pengawas | null */
  peran_saya?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipUnitInput = {
  kode: string;
  jenis: "universitas" | "fakultas" | "prodi" | "unit";
  /** ID arsip_unit */
  induk_id?: number | null;
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  nama: string;
  singkatan?: string;
  kode_surat?: string;
  email?: string;
  telepon?: string;
  alamat?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

export type ArsipPetugas = {
  id?: number;
  unit_id?: number;
  username?: string;
  nama?: string | null;
  level?: string | null;
  peran?: "admin" | "pimpinan" | "sekretaris" | "arsiparis" | "staf";
  jabatan?: string | null;
  bisa_tandatangan?: number;
  aktif?: number;
  mulai?: string | null;
  selesai?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipPetugasInput = {
  /** ID arsip_unit */
  unit_id: number | null;
  /** username SIAKAD */
  username: string;
  peran: "admin" | "pimpinan" | "sekretaris" | "arsiparis" | "staf";
  jabatan?: string;
  bisa_tandatangan?: boolean;
  aktif?: boolean;
  mulai?: string | null;
  selesai?: string | null;
  [key: string]: any;
};

export type ArsipKlasifikasi = {
  id?: number;
  induk_id?: number | null;
  kode?: string;
  nama?: string;
  /** tahun */
  retensi_aktif?: number | null;
  /** tahun */
  retensi_inaktif?: number | null;
  nasib_akhir?: "musnah" | "permanen" | "dinilai_kembali";
  keterangan_retensi?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipKlasifikasiInput = {
  /** ID arsip_klasifikasi */
  induk_id?: number | null;
  kode: string;
  nama: string;
  keterangan?: string;
  retensi_aktif?: number;
  retensi_inaktif?: number;
  nasib_akhir?: "musnah" | "permanen" | "dinilai_kembali";
  keterangan_retensi?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

export type ArsipJenis = {
  id?: number;
  kelompok?: "naskah" | "dokumen";
  kode?: string;
  nama?: string;
  untuk_pemilik?: Array<string>;
  klasifikasi_id?: number | null;
  punya_masa_berlaku?: number;
  wajib_verifikasi?: number;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipJenisInput = {
  kelompok: "naskah" | "dokumen";
  kode: string;
  nama: string;
  keterangan?: string;
  /** Kosong = semua pemilik */
  untuk_pemilik?: Array<"universitas" | "fakultas" | "prodi" | "unit" | "dosen" | "mahasiswa">;
  /** ID arsip_klasifikasi */
  klasifikasi_id?: number | null;
  punya_masa_berlaku?: boolean;
  wajib_verifikasi?: boolean;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

export type ArsipPenomoran = {
  id?: number;
  untuk?: "surat_keluar" | "agenda_masuk" | "agenda_keluar";
  unit_id?: number | null;
  jenis_id?: number | null;
  format?: string;
  reset?: "tahunan" | "bulanan" | "tidak";
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipPenomoranInput = {
  untuk: "surat_keluar" | "agenda_masuk" | "agenda_keluar";
  /** ID arsip_unit */
  unit_id?: number | null;
  /** ID arsip_jenis */
  jenis_id?: number | null;
  format: string;
  reset?: "tahunan" | "bulanan" | "tidak";
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

export type ArsipLokasi = {
  id?: number;
  unit_id?: number;
  induk_id?: number | null;
  kode?: string;
  nama?: string;
  jenis?: "gedung" | "ruang" | "lemari" | "rak" | "boks" | "folder" | "lainnya";
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipLokasiInput = {
  /** ID arsip_unit */
  unit_id: number | null;
  /** ID arsip_lokasi */
  induk_id?: number | null;
  kode: string;
  nama: string;
  jenis?: "gedung" | "ruang" | "lemari" | "rak" | "boks" | "folder" | "lainnya";
  keterangan?: string;
  kapasitas?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type ArsipTemplate = {
  id?: number;
  unit_id?: number | null;
  jenis_id?: number | null;
  nama?: string;
  perihal?: string | null;
  isi?: string;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type ArsipTemplateInput = {
  /** ID arsip_unit */
  unit_id?: number | null;
  /** ID arsip_jenis */
  jenis_id?: number | null;
  nama: string;
  perihal?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi: string;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

export type ArsipSuratRingkas = {
  id?: number;
  uuid?: string;
  arah?: "masuk" | "keluar";
  unit_id?: number;
  unit_nama?: string;
  nomor_surat?: string | null;
  nomor_agenda?: string | null;
  tanggal_surat?: string | null;
  tanggal_diterima?: string | null;
  tanggal_kirim?: string | null;
  perihal?: string;
  pengirim_nama?: string | null;
  pengirim_instansi?: string | null;
  tujuan_ringkas?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  keamanan?: "biasa" | "terbatas" | "rahasia" | "sangat_rahasia";
  status?: "draf" | "review" | "revisi" | "disetujui" | "terkirim" | "diarsipkan" | "dibatalkan" | "baru" | "didisposisi" | "diproses" | "selesai";
  batas_waktu?: string | null;
  jumlah_file?: number;
  [key: string]: any;
};

export type ArsipSurat = {
  /** arsip_jenis kelompok naskah */
  jenis_id?: number | null;
  tanggal_surat?: string | null;
  perihal?: string;
  ringkasan?: string | null;
  /** Mis. 1 (satu) berkas */
  lampiran?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  keamanan?: "biasa" | "terbatas" | "rahasia" | "sangat_rahasia";
  media?: "kertas" | "elektronik" | "email" | "pos" | "kurir" | "langsung" | "sistem";
  batas_waktu?: string | null;
  /** Surat yang dibalas */
  balasan_untuk_id?: number | null;
  /** Kosong = klasifikasi bawaan jenis */
  klasifikasi_id?: number | null;
  /** Berkas terbuka unit yang sama */
  berkas_id?: number | null;
  lokasi_id?: number | null;
  aktif_sampai?: string | null;
  inaktif_sampai?: string | null;
  nasib_akhir?: "musnah" | "permanen" | "dinilai_kembali";
  status_arsip?: "aktif" | "inaktif" | "permanen" | "dimusnahkan" | "diserahkan";
  id?: number;
  uuid?: string;
  arah?: "masuk" | "keluar";
  unit_id?: number;
  unit?: JsonObject;
  status?: string;
  nomor_surat?: string | null;
  nomor_agenda?: string | null;
  /** HTML konsep surat keluar */
  isi?: string | null;
  penandatangan_nama?: string | null;
  penandatangan_jabatan?: string | null;
  ditandatangani_pada?: string | null;
  kode_verifikasi?: string | null;
  verifikasi_url?: string | null;
  tujuan?: Array<{
    jenis: "unit" | "pengguna" | "dosen" | "mahasiswa" | "eksternal";
    /** jenis unit */
    unit_id?: number | null;
    /** jenis pengguna */
    username?: string | null;
    /** jenis dosen */
    nidn?: string | null;
    /** jenis mahasiswa */
    nim?: string | null;
    /** Wajib untuk eksternal (atau instansi); lainnya otomatis dari SIAKAD */
    nama?: string | null;
    jabatan?: string | null;
    instansi?: string | null;
    alamat?: string | null;
    email?: string | null;
    tembusan?: boolean;
    [key: string]: any;
  }>;
  persetujuan?: Array<JsonObject>;
  disposisi?: Array<ArsipDisposisi>;
  file?: Array<{
    id?: string;
    peran?: "utama" | "lampiran" | "bukti";
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    versi?: number;
    terkini?: boolean;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    dimusnahkan_pada?: string | null;
    /** Path unduh (GET, dengan token) */
    unduh?: string;
    [key: string]: any;
  }>;
  /** Tindakan yang boleh dilakukan: ubah, ajukan, setujui, beri_nomor, kirim, disposisi, selesai, arsipkan, batalkan, hapus, unggah_file */
  hak?: JsonObject;
  /** Hanya untuk pengelola */
  riwayat?: Array<JsonObject>;
  [key: string]: any;
};

export type ArsipSuratMasukInput = {
  /** arsip_jenis kelompok naskah */
  jenis_id?: number | null;
  tanggal_surat?: string | null;
  perihal: string;
  ringkasan?: string | null;
  /** Mis. 1 (satu) berkas */
  lampiran?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  keamanan?: "biasa" | "terbatas" | "rahasia" | "sangat_rahasia";
  media?: "kertas" | "elektronik" | "email" | "pos" | "kurir" | "langsung" | "sistem";
  batas_waktu?: string | null;
  /** Surat yang dibalas */
  balasan_untuk_id?: number | null;
  /** Kosong = klasifikasi bawaan jenis */
  klasifikasi_id?: number | null;
  /** Berkas terbuka unit yang sama */
  berkas_id?: number | null;
  lokasi_id?: number | null;
  /** Unit penerima */
  unit_id: number;
  /** Nomor dari pengirim */
  nomor_surat?: string | null;
  tanggal_diterima?: string | null;
  pengirim_nama?: string | null;
  pengirim_instansi?: string | null;
  pengirim_alamat?: string | null;
  pengirim_email?: string | null;
  [key: string]: any;
};

export type ArsipSuratKeluarInput = {
  /** arsip_jenis kelompok naskah */
  jenis_id?: number | null;
  tanggal_surat?: string | null;
  perihal: string;
  ringkasan?: string | null;
  /** Mis. 1 (satu) berkas */
  lampiran?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  keamanan?: "biasa" | "terbatas" | "rahasia" | "sangat_rahasia";
  media?: "kertas" | "elektronik" | "email" | "pos" | "kurir" | "langsung" | "sistem";
  batas_waktu?: string | null;
  /** Surat yang dibalas */
  balasan_untuk_id?: number | null;
  /** Kosong = klasifikasi bawaan jenis */
  klasifikasi_id?: number | null;
  /** Berkas terbuka unit yang sama */
  berkas_id?: number | null;
  lokasi_id?: number | null;
  /** Unit pengirim (hanya saat buat) */
  unit_id: number;
  /** HTML; disaring server */
  isi?: string | null;
  template_id?: number | null;
  /** Nilai penanda {{nama}} templat */
  data_templat?: JsonObject;
  tujuan?: Array<{
    jenis: "unit" | "pengguna" | "dosen" | "mahasiswa" | "eksternal";
    /** jenis unit */
    unit_id?: number | null;
    /** jenis pengguna */
    username?: string | null;
    /** jenis dosen */
    nidn?: string | null;
    /** jenis mahasiswa */
    nim?: string | null;
    /** Wajib untuk eksternal (atau instansi); lainnya otomatis dari SIAKAD */
    nama?: string | null;
    jabatan?: string | null;
    instansi?: string | null;
    alamat?: string | null;
    email?: string | null;
    tembusan?: boolean;
    [key: string]: any;
  }>;
  catat_langsung?: boolean;
  /** Hanya dengan catat_langsung */
  nomor_surat?: string | null;
  [key: string]: any;
};

export type ArsipAjukanInput = {
  persetujuan: Array<{
    username: string;
    peran?: "paraf" | "tandatangan";
    jabatan?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type ArsipCatatan = {
  catatan?: string | null;
  [key: string]: any;
};

export type ArsipDisposisi = {
  id?: number;
  surat_id?: number;
  induk_id?: number | null;
  dari_username?: string;
  dari_nama?: string | null;
  dari_jabatan?: string | null;
  ke_jenis?: "pengguna" | "unit";
  ke_username?: string | null;
  ke_unit_id?: number | null;
  ke_nama?: string | null;
  instruksi?: Array<string>;
  catatan?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  batas_waktu?: string | null;
  status?: "baru" | "dibaca" | "diproses" | "selesai" | "dikembalikan";
  lewat_batas?: boolean;
  laporan?: string | null;
  terusan?: Array<JsonObject>;
  file?: Array<{
    id?: string;
    peran?: "utama" | "lampiran" | "bukti";
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    versi?: number;
    terkini?: boolean;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    dimusnahkan_pada?: string | null;
    /** Path unduh (GET, dengan token) */
    unduh?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type ArsipDisposisiInput = {
  tujuan: Array<{
    username?: string | null;
    unit_id?: number | null;
    [key: string]: any;
  }>;
  /** Lihat /referensi instruksi_disposisi */
  instruksi?: Array<string>;
  catatan?: string | null;
  sifat?: "biasa" | "penting" | "segera" | "sangat_segera";
  batas_waktu?: string | null;
  /** Meneruskan disposisi ini */
  induk_id?: number | null;
  [key: string]: any;
};

export type ArsipLaporan = {
  /** Laporan tindak lanjut / alasan */
  laporan?: string | null;
  [key: string]: any;
};

export type ArsipDokumenRingkas = {
  id?: number;
  uuid?: string;
  pemilik_jenis?: "universitas" | "fakultas" | "prodi" | "unit" | "dosen" | "mahasiswa";
  unit_id?: number | null;
  unit_nama?: string | null;
  nidn?: string | null;
  nim?: string | null;
  pemilik_nama?: string | null;
  jenis_nama?: string | null;
  nomor?: string | null;
  judul?: string;
  tanggal_dokumen?: string | null;
  berlaku_sampai?: string | null;
  akses?: "publik" | "internal" | "terbatas" | "rahasia";
  status_verifikasi?: "tidak_perlu" | "diajukan" | "terverifikasi" | "ditolak";
  jumlah_file?: number;
  [key: string]: any;
};

export type ArsipDokumen = {
  klasifikasi_id?: number | null;
  berkas_id?: number | null;
  lokasi_id?: number | null;
  aktif_sampai?: string | null;
  inaktif_sampai?: string | null;
  nasib_akhir?: "musnah" | "permanen" | "dinilai_kembali";
  status_arsip?: "aktif" | "inaktif" | "permanen" | "dimusnahkan" | "diserahkan";
  id?: number;
  uuid?: string;
  pemilik_jenis?: "universitas" | "fakultas" | "prodi" | "unit" | "dosen" | "mahasiswa";
  unit?: JsonObject | null;
  /** Data dosen/mahasiswa dari SIAKAD */
  pemilik?: JsonObject | null;
  jenis?: JsonObject | null;
  nomor?: string | null;
  judul?: string;
  deskripsi?: string | null;
  tanggal_dokumen?: string | null;
  berlaku_mulai?: string | null;
  berlaku_sampai?: string | null;
  penerbit?: string | null;
  kata_kunci?: Array<string>;
  akses?: "publik" | "internal" | "terbatas" | "rahasia";
  status_verifikasi?: "tidak_perlu" | "diajukan" | "terverifikasi" | "ditolak";
  catatan_verifikasi?: string | null;
  sumber?: string;
  sumber_ref?: string | null;
  file?: Array<{
    id?: string;
    peran?: "utama" | "lampiran" | "bukti";
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    versi?: number;
    terkini?: boolean;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    dimusnahkan_pada?: string | null;
    /** Path unduh (GET, dengan token) */
    unduh?: string;
    [key: string]: any;
  }>;
  hak?: JsonObject;
  [key: string]: any;
};

export type ArsipDokumenInput = {
  /** Pemilik unit */
  unit_id?: number | null;
  /** Pemilik dosen */
  nidn?: string | null;
  /** Pemilik mahasiswa */
  nim?: string | null;
  /** Pemilik = pengguna token (dosen/mahasiswa) */
  pemilik?: "saya";
  /** arsip_jenis kelompok dokumen */
  jenis_id?: number | null;
  nomor?: string | null;
  judul: string;
  deskripsi?: string | null;
  tanggal_dokumen?: string | null;
  tahun?: number | null;
  berlaku_mulai?: string | null;
  berlaku_sampai?: string | null;
  penerbit?: string | null;
  kata_kunci?: Array<string>;
  /** publik: semua token; internal: semua pengguna SIAKAD; terbatas (bawaan): pengelola + pemilik; rahasia: admin/pimpinan + pemilik */
  akses?: "publik" | "internal" | "terbatas" | "rahasia";
  media?: "elektronik" | "kertas" | "keduanya";
  tingkat?: "asli" | "salinan" | "tembusan" | "petikan";
  jumlah_lembar?: number | null;
  klasifikasi_id?: number | null;
  berkas_id?: number | null;
  lokasi_id?: number | null;
  /** Integrasi: nama aplikasi (huruf kecil) */
  sumber?: string | null;
  /** Integrasi: ID di aplikasi sumber */
  sumber_ref?: string | null;
  [key: string]: any;
};

export type ArsipVerifikasiInput = {
  keputusan: "terima" | "tolak";
  catatan?: string | null;
  [key: string]: any;
};

export type ArsipFile = {
  id?: string;
  peran?: "utama" | "lampiran" | "bukti";
  nama?: string;
  mime?: string;
  ukuran?: number;
  sha256?: string;
  versi?: number;
  terkini?: boolean;
  keterangan?: string | null;
  diunggah_oleh?: string | null;
  diunggah_pada?: string;
  dimusnahkan_pada?: string | null;
  /** Path unduh (GET, dengan token) */
  unduh?: string;
  [key: string]: any;
};

export type ArsipFileUpload = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  berkas?: Uploadable;
  peran?: "utama" | "lampiran" | "bukti";
  keterangan?: string;
  /** ID file yang diganti (versi baru) */
  menggantikan?: string;
  /** Alternatif JSON */
  berkas_base64?: string;
  /** Wajib bersama berkas_base64 */
  nama_file?: string;
  [key: string]: any;
};

export type ArsipBerkas = {
  klasifikasi_id?: number | null;
  berkas_id?: number | null;
  lokasi_id?: number | null;
  aktif_sampai?: string | null;
  inaktif_sampai?: string | null;
  nasib_akhir?: "musnah" | "permanen" | "dinilai_kembali";
  status_arsip?: "aktif" | "inaktif" | "permanen" | "dimusnahkan" | "diserahkan";
  id?: number;
  unit_id?: number;
  nomor_berkas?: string;
  judul?: string;
  uraian?: string | null;
  tahun_awal?: number | null;
  tahun_akhir?: number | null;
  status?: "terbuka" | "ditutup";
  ditutup_pada?: string | null;
  surat?: Array<JsonObject>;
  dokumen?: Array<JsonObject>;
  [key: string]: any;
};

export type ArsipBerkasInput = {
  /** Hanya saat buat */
  unit_id: number;
  nomor_berkas: string;
  judul: string;
  uraian?: string | null;
  tahun_awal?: number | null;
  tahun_akhir?: number | null;
  klasifikasi_id?: number | null;
  lokasi_id?: number | null;
  [key: string]: any;
};

export type ArsipIsiBerkas = {
  surat_id?: Array<number>;
  dokumen_id?: Array<number>;
  [key: string]: any;
};

export type ArsipBagikan = {
  id?: number;
  entitas?: string;
  entitas_id?: number;
  ke_jenis?: "pengguna" | "unit";
  username?: string | null;
  unit_id?: number | null;
  hak?: "lihat" | "unduh";
  berlaku_sampai?: string | null;
  dibagikan_oleh?: string | null;
  [key: string]: any;
};

export type ArsipBagikanInput = {
  username?: string | null;
  unit_id?: number | null;
  hak?: "lihat" | "unduh";
  /** YYYY-MM-DD HH:MM */
  berlaku_sampai?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type ArsipPeminjaman = {
  id?: number;
  nomor?: string;
  entitas?: string;
  entitas_id?: number;
  judul_arsip?: string | null;
  peminjam_username?: string;
  jenis?: "fisik" | "digital";
  keperluan?: string;
  tanggal_pinjam?: string | null;
  rencana_kembali?: string | null;
  status?: string;
  terlambat?: boolean;
  [key: string]: any;
};

export type ArsipPeminjamanInput = {
  entitas: "surat" | "dokumen" | "berkas";
  entitas_id: number;
  jenis?: "fisik" | "digital";
  keperluan: string;
  tanggal_pinjam?: string | null;
  rencana_kembali: string | null;
  [key: string]: any;
};

export type ArsipPenyusutan = {
  id?: number;
  unit_id?: number;
  nomor?: string;
  jenis?: "pemindahan" | "pemusnahan" | "penyerahan";
  judul?: string;
  status?: string;
  nomor_berita_acara?: string | null;
  item?: Array<JsonObject>;
  [key: string]: any;
};

export type ArsipPenyusutanInput = {
  unit_id: number;
  jenis: "pemindahan" | "pemusnahan" | "penyerahan";
  judul?: string | null;
  keterangan?: string | null;
  item: Array<{
    entitas?: "surat" | "dokumen" | "berkas";
    entitas_id?: number;
    catatan?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type Aturan = {
  /** UUID */
  id?: string | null;
  /** Contoh: `SYARAT-KKN` */
  kode?: string | null;
  /** Contoh: `Syarat pendaftaran KKN` */
  nama?: string | null;
  keterangan?: string | null;
  /** Contoh: `kkn.daftar` */
  titik?: string | null;
  titik_judul?: string | null;
  /** Contoh: `kemahasiswaan` */
  kategori?: string | null;
  /** syarat | batas_waktu | batas_nilai */
  jenis?: string | null;
  /** Kosong = semua */
  cakupan?: {
    /** Kode prodi */
    prodi?: Array<string>;
    /** Kode fakultas (m_program_studi.kode_fak) */
    fakultas?: Array<string>;
    jenjang?: Array<string>;
    /** Titik kelas */
    kelas?: Array<string>;
    /** Semester masuk paling awal Contoh: `20221` */
    angkatan_min?: string | null;
    /** Semester masuk paling akhir */
    angkatan_max?: string | null;
    [key: string]: any;
  };
  /** {"semua": [{"indikator": "ipk", "op": ">=", "nilai": 2.75, "pesan": "..."}]} atau {"salah_satu": [...]}; boleh bersarang 3 tingkat */
  kondisi?: JsonObject | null;
  /** batas_waktu: {"mulai", "selesai"}; batas_nilai: {"target", "op", "nilai" | "tabel"} */
  parameter?: JsonObject | null;
  tahun_id?: string | null;
  berlaku_mulai?: string | null;
  berlaku_selesai?: string | null;
  /** blokir | peringatan */
  mode?: string | null;
  pesan?: string | null;
  prioritas?: number | null;
  /** draf | diajukan | aktif | nonaktif */
  status?: string | null;
  versi?: number | null;
  diaktifkan_oleh?: string | null;
  diaktifkan_at?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  dihapus_at?: string | null;
  /** Aturan bawaan kampus dari migration (tetap wajib SK) */
  bawaan?: boolean;
  /** Belum aktif dan belum punya SK */
  menunggu_sk?: boolean;
  /** SK terbaru yang melekat (null bila belum ada) */
  sk?: {
    /** UUID lampiran */
    id?: string | null;
    nomor?: string | null;
    tanggal?: string | null;
    [key: string]: any;
  };
  /** Jumlah SK yang melekat */
  jumlah_sk?: number | null;
  /** Di detail */
  lampiran?: Array<{
    /** UUID lampiran */
    id?: string | null;
    /** sk | lampiran */
    jenis?: string | null;
    /** Contoh: `045/UNIPO/SK/XI/2026` */
    nomor?: string | null;
    /** Contoh: `2026-11-15` */
    tanggal?: string | null;
    perihal?: string | null;
    /** UUID berkas terpusat */
    berkas_id?: string | null;
    nama_file?: string | null;
    mime?: string | null;
    ukuran?: number | null;
    dilepas_at?: string | null;
    oleh?: string | null;
    waktu?: string | null;
    [key: string]: any;
  }>;
  /** Di detail (pengatur) */
  pengecualian?: Array<{
    id?: string | null;
    /** mahasiswa | dosen | prodi | pegawai | pendaftar | akun */
    subjek_jenis?: string | null;
    subjek?: string | null;
    alasan?: string | null;
    berlaku_sampai?: string | null;
    /** Surat/SK dispensasi */
    berkas_id?: string | null;
    oleh?: string | null;
    waktu?: string | null;
    berlaku?: boolean;
    [key: string]: any;
  }>;
  pengatur?: Array<{
    /** peran | izin */
    jenis?: string | null;
    kode?: string | null;
    /** titik | kategori | bawaan */
    sumber?: string | null;
    [key: string]: any;
  }>;
  boleh_atur?: boolean;
  /** Hanya di respons aktifkan/ubah aturan aktif: hasil penulisan batas_waktu ke tabel batas lama */
  tulis_tembus?: {
    diterapkan?: boolean;
    /** Mengapa tidak ditulis ke tabel lama */
    alasan?: string | null;
    /** krs_mhs | krs | krs_dosen | nilai | nilai_dosen | ta | uji_ta */
    jenis_lama?: string | null;
    baris?: Array<{
      id?: number | null;
      kode_prodi?: string | null;
      idkp?: string | null;
      /** {"mulai", "selesai"} */
      dari?: JsonObject | null;
      /** {"mulai", "selesai"} */
      menjadi?: JsonObject | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  };
  [key: string]: any;
};

/** Ringkasan aturan dinamis (/v1/aturan) yang disisipkan di respons modul lain */
export type AturanRingkas = {
  titik?: string | null;
  /** false = ada aturan blokir yang tidak terpenuhi */
  boleh?: boolean;
  pelanggaran?: Array<{
    /** UUID aturan */
    id?: string | null;
    nama?: string | null;
    pesan?: string | null;
    [key: string]: any;
  }>;
  peringatan?: Array<{
    /** UUID aturan */
    id?: string | null;
    nama?: string | null;
    pesan?: string | null;
    [key: string]: any;
  }>;
  /** Batas berlaku, mis. {"sks_diambil": {"op": "<=", "nilai": 21}, "waktu": {"mulai", "selesai"}} */
  batas?: JsonObject | null;
  [key: string]: any;
};

export type AturanInput = {
  /** Opsional, unik */
  kode?: string | null;
  /** Contoh: `Batas input nilai dosen 2026 ganjil` */
  nama?: string | null;
  keterangan?: string | null;
  /** Dari katalog Contoh: `nilai.input.dosen` */
  titik?: string | null;
  /** Bawaan kategori pertama titik Contoh: `akademik` */
  kategori?: string | null;
  /** Contoh: `batas_waktu` */
  jenis?: string | null;
  /** Kosong = semua */
  cakupan?: {
    /** Kode prodi */
    prodi?: Array<string>;
    /** Kode fakultas (m_program_studi.kode_fak) */
    fakultas?: Array<string>;
    jenjang?: Array<string>;
    /** Titik kelas */
    kelas?: Array<string>;
    /** Semester masuk paling awal Contoh: `20221` */
    angkatan_min?: string | null;
    /** Semester masuk paling akhir */
    angkatan_max?: string | null;
    [key: string]: any;
  };
  /** {"semua": [{"indikator": "ipk", "op": ">=", "nilai": 2.75, "pesan": "..."}]} atau {"salah_satu": [...]}; boleh bersarang 3 tingkat */
  kondisi?: JsonObject | null;
  parameter?: JsonObject | null;
  /** Contoh: `20261` */
  tahun_id?: string | null;
  /** Masa berlaku aturan */
  berlaku_mulai?: string | null;
  berlaku_selesai?: string | null;
  /** blokir (bawaan) | peringatan */
  mode?: string | null;
  /** Pesan pengganti bila tidak terpenuhi */
  pesan?: string | null;
  prioritas?: number | null;
  /** Catatan perubahan (riwayat) */
  catatan?: string | null;
  /** Ubah aturan aktif: SK baru (wajib sk atau lampiran_id) */
  sk?: {
    berkas_id?: string | null;
    nomor?: string | null;
    tanggal?: string | null;
    perihal?: string | null;
    [key: string]: any;
  };
  /** Ubah aturan aktif: UUID SK yang sudah dilampirkan */
  lampiran_id?: string | null;
  /** Langsung ajukan untuk disetujui */
  ajukan?: boolean;
  [key: string]: any;
};

export type AturanLampiran = {
  /** UUID lampiran */
  id?: string | null;
  /** sk | lampiran */
  jenis?: string | null;
  /** Contoh: `045/UNIPO/SK/XI/2026` */
  nomor?: string | null;
  /** Contoh: `2026-11-15` */
  tanggal?: string | null;
  perihal?: string | null;
  /** UUID berkas terpusat */
  berkas_id?: string | null;
  nama_file?: string | null;
  mime?: string | null;
  ukuran?: number | null;
  dilepas_at?: string | null;
  oleh?: string | null;
  waktu?: string | null;
  [key: string]: any;
};

export type AturanLampiranInput = {
  /** UUID dari /v1/berkas */
  berkas_id?: string | null;
  /** sk (bawaan) | lampiran */
  jenis?: string | null;
  /** Wajib untuk SK */
  nomor?: string | null;
  /** YYYY-MM-DD */
  tanggal?: string | null;
  perihal?: string | null;
  [key: string]: any;
};

export type AturanPengecualian = {
  id?: string | null;
  /** mahasiswa | dosen | prodi | pegawai | pendaftar | akun */
  subjek_jenis?: string | null;
  subjek?: string | null;
  alasan?: string | null;
  berlaku_sampai?: string | null;
  /** Surat/SK dispensasi */
  berkas_id?: string | null;
  oleh?: string | null;
  waktu?: string | null;
  berlaku?: boolean;
  [key: string]: any;
};

export type AturanPengecualianInput = {
  /** mahasiswa | dosen | prodi | pegawai | pendaftar | akun */
  subjek_jenis?: string | null;
  /** NIM, NIDN/username, kode prodi, id pegawai SDM, no_pmb (atau id/UUID pendaftaran), username akun */
  subjek?: string | null;
  alasan?: string | null;
  /** YYYY-MM-DD[ HH:MM]; kosong = tanpa batas */
  berlaku_sampai?: string | null;
  /** Surat/SK dispensasi (opsional) */
  berkas_id?: string | null;
  [key: string]: any;
};

export type AturanPengaturInput = {
  /** Contoh: `akademik` */
  kategori?: string | null;
  /** Opsional: khusus satu titik */
  titik?: string | null;
  pengatur?: Array<{
    /** peran | izin */
    jenis?: string | null;
    /** Contoh: `bak` */
    kode?: string | null;
    keterangan?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type AturanPeriksaInput = {
  /** Contoh: `krs.ambil` */
  titik?: string | null;
  /** Mahasiswa: kosong = diri sendiri */
  nim?: string | null;
  /** Titik pegawai (sdm.*, spmi.*, lppm.*) */
  pegawai_id?: string | null;
  /** Titik pendaftar (pmb.*): id/UUID pmb_pendaftaran atau no_pmb Contoh: `123` */
  pendaftar?: string | null;
  /** Titik akun (akun.*): username calon akun; kirim konteks jenis_akun Contoh: `2201010001` */
  username?: string | null;
  /** Titik kelas */
  kode_prodi?: string | null;
  kelas?: string | null;
  /** NIDN/username untuk pengecualian dosen */
  dosen?: string | null;
  /** Bawaan tahun aktif */
  tahun_id?: string | null;
  /** Indikator konteks titik, mis. {"sks_diambil": 24} */
  konteks?: JsonObject | null;
  /** Uji/admin: waktu pemeriksaan lain */
  waktu?: string | null;
  [key: string]: any;
};

export type AturanHasil = {
  titik?: string | null;
  judul?: string | null;
  tahun_id?: string | null;
  waktu?: string | null;
  subjek?: JsonObject | null;
  /** false bila ada aturan blokir yang dilanggar */
  boleh?: boolean;
  pelanggaran?: Array<{
    id?: number | null;
    uuid?: string | null;
    kode?: string | null;
    nama?: string | null;
    kategori?: string | null;
    jenis?: string | null;
    mode?: string | null;
    /** Pesan untuk pengguna Contoh: `SKS lulus minimal 100 (sekarang 92).` */
    pesan?: string | null;
    /** Kondisi yang gagal: indikator, op, nilai, sekarang, pesan */
    rincian?: Array<JsonObject | null>;
    [key: string]: any;
  }>;
  peringatan?: Array<{
    id?: number | null;
    uuid?: string | null;
    kode?: string | null;
    nama?: string | null;
    kategori?: string | null;
    jenis?: string | null;
    mode?: string | null;
    /** Pesan untuk pengguna Contoh: `SKS lulus minimal 100 (sekarang 92).` */
    pesan?: string | null;
    /** Kondisi yang gagal: indikator, op, nilai, sekarang, pesan */
    rincian?: Array<JsonObject | null>;
    [key: string]: any;
  }>;
  diterapkan?: Array<number>;
  dikecualikan?: Array<JsonObject | null>;
  /** Batas yang berlaku: {"waktu": {"mulai", "selesai"}, "sks_diambil": {"op": "<=", "nilai": 21}} */
  batas?: JsonObject | null;
  /** Nilai indikator yang dipakai (tidak tampil bila pemanggil tidak berhak melihat data mahasiswa) */
  indikator?: JsonObject | null;
  [key: string]: any;
};

export type AturanKatalog = {
  kategori?: Array<{
    kode?: string | null;
    judul?: string | null;
    izin_bawaan?: string | null;
    [key: string]: any;
  }>;
  jenis?: Array<{
    kode?: string | null;
    judul?: string | null;
    [key: string]: any;
  }>;
  operator?: Array<string>;
  titik?: Array<{
    kode?: string | null;
    judul?: string | null;
    keterangan?: string | null;
    kategori?: Array<string>;
    subjek?: string | null;
    jenis?: Array<string>;
    konteks?: Array<string>;
    indikator?: Array<string>;
    /** Batas waktu lama yang ikut diperiksa */
    batas_lama?: string | null;
    /** Endpoint yang menegakkan */
    penerapan?: Array<string>;
    /** Kelompok untuk UI Contoh: `Akademik` */
    kelompok?: string | null;
    /** Unit pemilik titik: baak, bauk, pmb, pustikom, fakultas, kemahasiswaan, lppm, sdm, spmi, perpustakaan, sarpras, sekretariat Contoh: `baak` */
    unit?: string | null;
    /** Templat aturan siap pakai */
    contoh?: Array<{
      judul?: string | null;
      keterangan?: string | null;
      kategori?: string | null;
      jenis?: string | null;
      mode?: string | null;
      /** {"semua": [{"indikator": "ipk", "op": ">=", "nilai": 2.75, "pesan": "..."}]} atau {"salah_satu": [...]}; boleh bersarang 3 tingkat */
      kondisi?: JsonObject | null;
      parameter?: JsonObject | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  indikator?: Array<{
    kode?: string | null;
    judul?: string | null;
    /** angka | teks | benar_salah | daftar | pilihan */
    tipe?: string | null;
    /** mahasiswa | kelas | pegawai | pendaftar | akun | umum */
    subjek?: string | null;
    /** siakad | konteks */
    sumber?: string | null;
    keterangan?: string | null;
    /** Contoh: `Keuangan` */
    kelompok?: string | null;
    /** SKS, %, Rp, tahun, hari */
    satuan?: string | null;
    /** Pesan bawaan bila kondisi gagal */
    pesan?: string | null;
    /** Tipe pilihan: nilai untuk dropdown */
    opsi?: Array<{
      nilai?: string | null;
      label?: string | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type Berkas = {
  /** UUID Contoh: `6f1c2d3e-1111-4a2b-9c3d-123456789abc` */
  id?: string | null;
  /** Contoh: `ijazah.pdf` */
  nama?: string | null;
  /** Contoh: `pdf` */
  ekstensi?: string | null;
  /** Contoh: `application/pdf` */
  mime?: string | null;
  /** Byte */
  ukuran?: number | null;
  sha256?: string | null;
  kategori?: string | null;
  modul?: string | null;
  folder?: string | null;
  keterangan?: string | null;
  /** privat / publik */
  visibilitas?: string | null;
  /** mengunggah, menunggu_unggah, tersedia */
  status?: string | null;
  /** lokal, s3, r2, minio, google_drive */
  penyimpanan?: string | null;
  /** username pengunggah */
  pemilik?: string | null;
  klien_id?: string | null;
  jumlah_unduh?: number | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  /** Kode unit bila di ruang bersama unit */
  unit?: string | null;
  /** Kode periode akademik Contoh: `20251` */
  periode?: string | null;
  /** Isi tersimpan terenkripsi AES-256-GCM */
  terenkripsi?: boolean;
  /** Hak pemanggil: lihat, ubah, kelola (hanya di detail) */
  hak?: string | null;
  /** Hanya untuk berkas di sampah (admin, ?terhapus=1) */
  dihapus_at?: string | null;
  dihapus_oleh?: string | null;
  /** Path unduh bertoken Contoh: `/v1/berkas/6f1c2d3e-1111-4a2b-9c3d-123456789abc/unduh` */
  unduh?: string | null;
  /** Tautan unduh sementara (tanpa token) */
  url?: string | null;
  kedaluwarsa_at?: string | null;
  /** Hanya saat status mengunggah */
  sesi?: {
    ukuran_potongan?: number | null;
    jumlah_potongan?: number | null;
    diterima?: Array<number>;
    [key: string]: any;
  };
  /** Data modul yang memakai berkas ini */
  dipakai?: Array<{
    modul?: string | null;
    tabel?: string | null;
    baris?: string | null;
    peran?: string | null;
    sejak?: string | null;
    [key: string]: any;
  }>;
  /** Hanya pada unggah langsung */
  unggah?: {
    url?: string | null;
    /** Contoh: `PUT` */
    metode?: string | null;
    header?: Record<string, string>;
    kedaluwarsa_at?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type BerkasInfo = {
  penyimpanan?: {
    driver?: string | null;
    kode?: string | null;
    nama?: string | null;
    [key: string]: any;
  };
  maks_byte?: number | null;
  maks_mb?: number | null;
  /** Batas POST /v1/berkas (php.ini upload_max_filesize/post_max_size) */
  batas_sekali_unggah_byte?: number | null;
  /** Saran ukuran potongan unggah bertahap */
  ukuran_potongan?: number | null;
  ekstensi?: Array<string | null>;
  /** Penyimpanan mendukung unggah langsung ke bucket */
  unggah_langsung?: boolean;
  /** Lampiran modul ikut disimpan di penyimpanan ini */
  lampiran_modul_terpusat?: boolean;
  saran?: string | null;
  [key: string]: any;
};

export type BerkasUnggah = {
  berkas?: Uploadable;
  /** Alternatif JSON untuk file kecil */
  berkas_base64?: string | null;
  nama_file?: string | null;
  /** dokumen, foto, lampiran, tugas, … Contoh: `dokumen` */
  kategori?: string | null;
  /** Modul/aplikasi pemakai Contoh: `profil` */
  modul?: string | null;
  /** Folder di penyimpanan */
  folder?: string | null;
  keterangan?: string | null;
  /** privat (bawaan) atau publik Contoh: `privat` */
  visibilitas?: string | null;
  /** Kode penyedia storage; bawaan penyimpanan utama */
  penyimpanan?: string | null;
  /** Kode unit untuk ruang bersama Contoh: `baak` */
  unit?: string | null;
  /** Kode periode akademik; bawaan periode aktif Contoh: `20251` */
  periode?: string | null;
  /** Enkripsi isi di server */
  enkripsi?: boolean;
  [key: string]: any;
};

export type BerkasMulaiBertahap = {
  /** Contoh: `video-kuliah.mp4` */
  nama: string | null;
  /** Byte Contoh: `73400320` */
  ukuran: number | null;
  /** Byte, opsional */
  ukuran_potongan?: number | null;
  /** dokumen, foto, lampiran, tugas, … Contoh: `dokumen` */
  kategori?: string | null;
  /** Modul/aplikasi pemakai Contoh: `profil` */
  modul?: string | null;
  /** Folder di penyimpanan */
  folder?: string | null;
  keterangan?: string | null;
  /** privat (bawaan) atau publik Contoh: `privat` */
  visibilitas?: string | null;
  /** Kode penyedia storage; bawaan penyimpanan utama */
  penyimpanan?: string | null;
  /** Kode unit untuk ruang bersama Contoh: `baak` */
  unit?: string | null;
  /** Kode periode akademik; bawaan periode aktif Contoh: `20251` */
  periode?: string | null;
  /** Enkripsi isi di server */
  enkripsi?: boolean;
  [key: string]: any;
};

export type BerkasUnggahLangsung = {
  /** Contoh: `rekaman.mp4` */
  nama: string | null;
  /** Byte */
  ukuran: number | null;
  /** Contoh: `video/mp4` */
  mime: string | null;
  /** dokumen, foto, lampiran, tugas, … Contoh: `dokumen` */
  kategori?: string | null;
  /** Modul/aplikasi pemakai Contoh: `profil` */
  modul?: string | null;
  /** Folder di penyimpanan */
  folder?: string | null;
  keterangan?: string | null;
  /** privat (bawaan) atau publik Contoh: `privat` */
  visibilitas?: string | null;
  /** Kode penyedia storage; bawaan penyimpanan utama */
  penyimpanan?: string | null;
  /** Kode unit untuk ruang bersama Contoh: `baak` */
  unit?: string | null;
  /** Kode periode akademik; bawaan periode aktif Contoh: `20251` */
  periode?: string | null;
  /** Enkripsi isi di server */
  enkripsi?: boolean;
  [key: string]: any;
};

export type BerkasPotongan = {
  /** Bagian file */
  potongan: Uploadable;
  [key: string]: any;
};

export type BerkasPotonganHasil = {
  id?: string | null;
  ke?: number | null;
  diterima?: Array<number>;
  jumlah_potongan?: number | null;
  lengkap?: boolean;
  [key: string]: any;
};

export type BerkasUrl = {
  url?: string | null;
  kedaluwarsa_at?: string | null;
  [key: string]: any;
};

export type BerkasUbah = {
  nama?: string | null;
  kategori?: string | null;
  keterangan?: string | null;
  /** Pindah ke folder; null/"" = akar Contoh: `Surat Masuk/2026` */
  folder?: string | null;
  [key: string]: any;
};

export type BerkasFolder = {
  /** Contoh: `Surat Masuk/2026` */
  path?: string | null;
  /** Contoh: `2026` */
  nama?: string | null;
  /** Contoh: `Surat Masuk` */
  induk?: string | null;
  /** Berkas langsung di folder ini */
  jumlah_berkas?: number | null;
  /** Byte, isi langsung */
  ukuran?: number | null;
  /** Termasuk subfolder */
  total_berkas?: number | null;
  /** Byte, termasuk subfolder */
  total_ukuran?: number | null;
  jumlah_subfolder?: number | null;
  /** abu, merah, oranye, kuning, hijau, teal, biru, ungu, merah_muda */
  warna?: string | null;
  dibuat_at?: string | null;
  terakhir_isi_at?: string | null;
  /** Hanya pada ubah */
  berkas_dipindah?: number | null;
  [key: string]: any;
};

export type BerkasFolderDaftar = {
  akar?: {
    jumlah_berkas?: number | null;
    ukuran?: number | null;
    total_berkas?: number | null;
    total_ukuran?: number | null;
    jumlah_subfolder?: number | null;
    [key: string]: any;
  };
  folder?: Array<BerkasFolder>;
  ruang?: {
    /** u:<username>, k:<klien>, n:<unit> */
    kode?: string | null;
    unit?: string | null;
    /** pemilik, anggota, kelola, bagi, bagi-ubah */
    akses?: string | null;
    /** Folder bersama */
    batas?: string | null;
    periode?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type BerkasFolderBuat = {
  /** Contoh: `Surat Masuk` */
  nama: string | null;
  /** Path induk; kosong = akar */
  induk?: string | null;
  /** Contoh: `biru` */
  warna?: string | null;
  /** Contoh: `arsip` */
  modul?: string | null;
  /** Ruang unit */
  unit?: string | null;
  [key: string]: any;
};

export type BerkasFolderUbah = {
  /** Contoh: `Surat Masuk` */
  path: string | null;
  /** Contoh: `Surat Masuk 2026` */
  nama?: string | null;
  /** null = akar */
  induk_baru?: string | null;
  warna?: string | null;
  modul?: string | null;
  [key: string]: any;
};

export type BerkasFolderHapus = {
  /** Contoh: `Draf` */
  path: string | null;
  /** Berkas di dalamnya ikut ke sampah */
  isi?: boolean;
  modul?: string | null;
  [key: string]: any;
};

export type BerkasPindahBanyak = {
  id: Array<string | null>;
  /** null/"" = akar */
  folder: string | null;
  /** Pindah ke ruang lain: kode unit; null/"" = ruang pribadi */
  tujuan_unit?: string | null;
  [key: string]: any;
};

export type BerkasHapusBanyak = {
  id: Array<string | null>;
  [key: string]: any;
};

export type BerkasSalinBanyak = {
  id: Array<string | null>;
  /** null/"" = akar */
  folder?: string | null;
  /** Kode unit tujuan; null/"" = ruang pribadi; tidak dikirim = ruang asal */
  tujuan_unit?: string | null;
  [key: string]: any;
};

export type BerkasFolderSalin = {
  /** Contoh: `SK` */
  path: string | null;
  /** null = akar */
  induk_baru?: string | null;
  /** Ruang asal */
  unit?: string | null;
  modul?: string | null;
  /** Ruang tujuan */
  tujuan_unit?: string | null;
  [key: string]: any;
};

export type BerkasBagikan = {
  /** Folder (hanya POST /folder/bagikan) */
  path?: string | null;
  /** Ruang folder */
  unit?: string | null;
  /** pengguna, unit, tautan Contoh: `pengguna` */
  ke_jenis: string | null;
  /** username atau kode unit Contoh: `0012345678` */
  ke?: string | null;
  /** lihat atau ubah Contoh: `lihat` */
  izin?: string | null;
  /** ISO 8601 */
  kedaluwarsa_at?: string | null;
  /** Kata sandi tautan, 4-100 karakter */
  sandi?: string | null;
  pesan?: string | null;
  [key: string]: any;
};

export type BerkasBagi = {
  id?: string | null;
  /** berkas atau folder */
  jenis?: string | null;
  folder?: {
    path?: string | null;
    nama?: string | null;
    unit?: string | null;
    [key: string]: any;
  };
  ke_jenis?: string | null;
  ke?: string | null;
  ke_nama?: string | null;
  izin?: string | null;
  /** Path tautan publik Contoh: `/v1/berkas/tautan/…` */
  tautan?: string | null;
  token?: string | null;
  bersandi?: boolean;
  kedaluwarsa_at?: string | null;
  pesan?: string | null;
  jumlah_akses?: number | null;
  dibuat_oleh?: string | null;
  dibuat_at?: string | null;
  berkas?: Berkas;
  [key: string]: any;
};

export type BerkasKebijakan = {
  /** mati, opsional, wajib */
  global?: string | null;
  /** opsional, wajib; null bila bukan ruang unit */
  unit?: string | null;
  /** opsional, wajib; null bila bukan ruang pribadi */
  pengguna?: string | null;
  /** mati, opsional, wajib */
  efektif?: string | null;
  boleh_ubah?: {
    global?: boolean;
    unit?: boolean;
    pengguna?: boolean;
    [key: string]: any;
  };
  [key: string]: any;
};

export type BerkasKebijakanUbah = {
  /** global, unit, pengguna Contoh: `unit` */
  lingkup: string | null;
  /** Contoh: `baak` */
  unit?: string | null;
  /** mati, opsional, wajib Contoh: `wajib` */
  enkripsi: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type BerkasEnkripsi = {
  /** true = enkripsi, false = buka enkripsi */
  aktif: boolean;
  [key: string]: any;
};

export type BerkasPakai = {
  /** Contoh: `lms` */
  modul?: string | null;
  /** Contoh: `lms_tugas_kumpul` */
  tabel: string | null;
  /** ID/UUID baris Contoh: `42` */
  baris: string | null;
  /** Contoh: `lampiran` */
  peran?: string | null;
  [key: string]: any;
};

/** Ujian (tabel cbt_ujian) */
export type CbtUjian = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "uts" | "uas" | "kuis" | "pmb" | "komprehensif" | "bahasa" | "sertifikasi" | "lainnya";
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_mk?: string;
  kelas?: string;
  durasi_menit?: number;
  jumlah_soal?: number;
  acak_soal?: boolean;
  acak_opsi?: boolean;
  nilai_lulus?: number;
  tampil_hasil?: boolean;
  kunci_perangkat?: boolean;
  latihan?: boolean;
  petunjuk?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "siap" | "selesai" | "diarsip";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CbtUjianInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis?: "uts" | "uas" | "kuis" | "pmb" | "komprehensif" | "bahasa" | "sertifikasi" | "lainnya";
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_mk?: string;
  kelas?: string;
  durasi_menit?: number;
  jumlah_soal?: number;
  acak_soal?: boolean;
  acak_opsi?: boolean;
  nilai_lulus?: number;
  tampil_hasil?: boolean;
  kunci_perangkat?: boolean;
  latihan?: boolean;
  petunjuk?: string;
  [key: string]: any;
};

/** Soal (tabel cbt_soal) */
export type CbtSoal = {
  id?: number;
  /** ID di cbt_ujian */
  ujian_id?: number;
  /** (hanya baca) Hanya dibaca. */
  bank_soal_id?: number;
  jenis?: "pilihan_ganda" | "pilihan_ganda_banyak" | "benar_salah" | "isian_singkat" | "esai" | "menjodohkan";
  pertanyaan?: string;
  /** Nilai JSON apa pun */
  opsi?: any;
  /** Nilai JSON apa pun */
  kunci?: any;
  poin?: number;
  tingkat?: "mudah" | "sedang" | "sulit";
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CbtSoalInput = {
  /** ID di cbt_ujian */
  ujian_id: number;
  jenis?: "pilihan_ganda" | "pilihan_ganda_banyak" | "benar_salah" | "isian_singkat" | "esai" | "menjodohkan";
  pertanyaan: string;
  /** Nilai JSON apa pun */
  opsi?: any;
  /** Nilai JSON apa pun */
  kunci?: any;
  poin?: number;
  tingkat?: "mudah" | "sedang" | "sulit";
  urut?: number;
  [key: string]: any;
};

/** Sesi (tabel cbt_sesi) */
export type CbtSesi = {
  id?: number;
  /** ID di cbt_ujian */
  ujian_id?: number;
  nama?: string;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  mulai?: string;
  selesai?: string;
  /** user.username */
  pengawas?: string;
  /** (hanya baca) Hanya dibaca. */
  token?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "terjadwal" | "dibuka" | "ditutup";
  /** (hanya baca) Hanya dibaca. */
  berita_acara?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CbtSesiInput = {
  /** ID di cbt_ujian */
  ujian_id: number;
  nama: string;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  mulai: string;
  selesai: string;
  /** user.username */
  pengawas?: string;
  [key: string]: any;
};

export type CbtSesiTutupInput = {
  berita_acara?: string;
  [key: string]: any;
};

/** Peserta (tabel cbt_peserta) */
export type CbtPeserta = {
  id?: number;
  /** ID di cbt_ujian */
  ujian_id?: number;
  /** ID di cbt_sesi */
  sesi_id?: number;
  username?: string;
  nama?: string;
  nomor_peserta?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "terdaftar" | "mengerjakan" | "selesai" | "diskualifikasi" | "tidak_hadir";
  /** (hanya baca) Hanya dibaca. */
  mulai_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  batas_waktu?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  tambahan_menit?: number;
  /** (hanya baca) Hanya dibaca. */
  ip?: string;
  /** (hanya baca) Hanya dibaca. */
  skor?: number;
  /** (hanya baca) Hanya dibaca. */
  skor_maks?: number;
  /** (hanya baca) Hanya dibaca. */
  nilai?: number;
  /** (hanya baca) Hanya dibaca. */
  lulus?: boolean;
  /** (hanya baca) Hanya dibaca. */
  perlu_koreksi?: boolean;
  /** (hanya baca) Hanya dibaca. */
  pelanggaran?: number;
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CbtPesertaInput = {
  /** ID di cbt_ujian */
  ujian_id: number;
  /** ID di cbt_sesi */
  sesi_id: number;
  username: string;
  nama?: string;
  nomor_peserta?: string;
  catatan?: string;
  [key: string]: any;
};

export type CbtPesertaTambahWaktuInput = {
  menit: number;
  alasan: string;
  lewati_sesi?: boolean;
  [key: string]: any;
};

export type CbtPesertaDiskualifikasiInput = {
  alasan: string;
  [key: string]: any;
};

export type CbtPesertaBukaKembaliInput = {
  /** ID di cbt_sesi */
  sesi_id?: number;
  [key: string]: any;
};

/** Prospek calon mahasiswa (tabel crm_prospek) */
export type CrmProspek = {
  id?: number;
  nama?: string;
  email?: string;
  hp?: string;
  asal_sekolah?: string;
  npsn?: string;
  kota?: string;
  provinsi?: string;
  tahun_lulus?: number;
  /** m_program_studi.kode_prodi */
  minat_prodi?: string;
  /** m_program_studi.kode_prodi */
  minat_prodi_2?: string;
  minat_jalur?: string;
  sumber?: "website" | "media_sosial" | "brosur" | "pameran" | "sekolah" | "teman_keluarga" | "alumni" | "iklan" | "maukuliah" | "referal" | "lainnya";
  kampanye?: string;
  /** ID di pmb_referal */
  referal_id?: number;
  tahap?: "baru" | "dihubungi" | "tertarik" | "mendaftar" | "diajukan" | "diterima" | "daftar_ulang" | "tidak_tertarik";
  /** (hanya baca) Hanya dibaca. */
  skor?: number;
  /** user.username */
  petugas?: string;
  /** (hanya baca) Hanya dibaca. */
  tindak_lanjut_berikut?: string;
  /** (hanya baca) Hanya dibaca. */
  pmb_akun_id?: number;
  /** (hanya baca) Hanya dibaca. */
  pmb_pendaftaran_id?: number;
  /** Nilai JSON apa pun */
  label?: any;
  setuju_dihubungi?: boolean;
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CrmProspekInput = {
  nama: string;
  email?: string;
  hp?: string;
  asal_sekolah?: string;
  npsn?: string;
  kota?: string;
  provinsi?: string;
  tahun_lulus?: number;
  /** m_program_studi.kode_prodi */
  minat_prodi?: string;
  /** m_program_studi.kode_prodi */
  minat_prodi_2?: string;
  minat_jalur?: string;
  sumber?: "website" | "media_sosial" | "brosur" | "pameran" | "sekolah" | "teman_keluarga" | "alumni" | "iklan" | "maukuliah" | "referal" | "lainnya";
  kampanye?: string;
  /** ID di pmb_referal */
  referal_id?: number;
  tahap?: "baru" | "dihubungi" | "tertarik" | "mendaftar" | "diajukan" | "diterima" | "daftar_ulang" | "tidak_tertarik";
  /** user.username */
  petugas?: string;
  /** Nilai JSON apa pun */
  label?: any;
  setuju_dihubungi?: boolean;
  catatan?: string;
  [key: string]: any;
};

/** Riwayat interaksi prospek (tabel crm_interaksi) */
export type CrmInteraksi = {
  id?: number;
  /** ID di crm_prospek */
  prospek_id?: number;
  kanal?: "telepon" | "whatsapp" | "email" | "sms" | "tatap_muka" | "pameran" | "media_sosial" | "chat" | "lainnya";
  arah?: "masuk" | "keluar";
  waktu?: string;
  ringkasan?: string;
  hasil?: "tidak_terhubung" | "tertarik" | "pikir_pikir" | "tidak_tertarik" | "minta_info" | "akan_daftar" | "sudah_daftar" | "lainnya";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CrmInteraksiInput = {
  /** ID di crm_prospek */
  prospek_id: number;
  kanal: "telepon" | "whatsapp" | "email" | "sms" | "tatap_muka" | "pameran" | "media_sosial" | "chat" | "lainnya";
  arah?: "masuk" | "keluar";
  waktu?: string;
  ringkasan: string;
  hasil?: "tidak_terhubung" | "tertarik" | "pikir_pikir" | "tidak_tertarik" | "minta_info" | "akan_daftar" | "sudah_daftar" | "lainnya";
  [key: string]: any;
};

/** Tindak lanjut prospek (tabel crm_tindak_lanjut) */
export type CrmTindakLanjut = {
  id?: number;
  /** ID di crm_prospek */
  prospek_id?: number;
  jadwal?: string;
  kanal?: "telepon" | "whatsapp" | "email" | "sms" | "tatap_muka" | "lainnya";
  tujuan?: string;
  /** user.username */
  petugas?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "terjadwal" | "selesai" | "batal";
  /** (hanya baca) Hanya dibaca. */
  hasil?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CrmTindakLanjutInput = {
  /** ID di crm_prospek */
  prospek_id: number;
  jadwal: string;
  kanal?: "telepon" | "whatsapp" | "email" | "sms" | "tatap_muka" | "lainnya";
  tujuan: string;
  /** user.username */
  petugas?: string;
  [key: string]: any;
};

export type CrmTindakLanjutSelesaiInput = {
  hasil: string;
  hasil_interaksi?: "tidak_terhubung" | "tertarik" | "pikir_pikir" | "tidak_tertarik" | "minta_info" | "akan_daftar" | "sudah_daftar" | "lainnya";
  [key: string]: any;
};

export type CrmTindakLanjutBatalInput = {
  hasil?: string;
  [key: string]: any;
};

/** Aturan lead scoring (tabel crm_skor_aturan) */
export type CrmSkorAturan = {
  id?: number;
  kriteria?: "sumber" | "tahap" | "minat_prodi" | "minat_jalur" | "kota" | "tahun_lulus" | "ada_email" | "ada_hp" | "jumlah_interaksi" | "hasil_interaksi" | "punya_akun_pmb" | "label";
  nilai?: string;
  poin?: number;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CrmSkorAturanInput = {
  kriteria: "sumber" | "tahap" | "minat_prodi" | "minat_jalur" | "kota" | "tahun_lulus" | "ada_email" | "ada_hp" | "jumlah_interaksi" | "hasil_interaksi" | "punya_akun_pmb" | "label";
  nilai?: string;
  poin: number;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Segmen prospek (tabel crm_segmen) */
export type CrmSegmen = {
  id?: number;
  nama?: string;
  keterangan?: string;
  kriteria?: JsonObject;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type CrmSegmenInput = {
  nama: string;
  keterangan?: string;
  kriteria: JsonObject;
  aktif?: boolean;
  [key: string]: any;
};

/** Aturan EWS (tabel ews_aturan) */
export type DasborEwsAturan = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  kode?: string;
  nama?: string;
  ambang?: number;
  bobot?: number;
  aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type DasborEwsAturanInput = {
  nama: string;
  ambang?: number;
  bobot?: number;
  aktif?: boolean;
  keterangan?: string;
  [key: string]: any;
};

/** Mahasiswa berisiko (tabel ews_kasus) */
export type DasborEws = {
  id?: number;
  /** m_tahun.tahun_id (hanya baca) Hanya dibaca. */
  tahun_id?: string;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_dosen.NIDN (hanya baca) Hanya dibaca. */
  dosen_pa?: string;
  /** (hanya baca) Hanya dibaca. */
  indikator?: JsonObject;
  /** (hanya baca) Hanya dibaca. */
  skor?: number;
  /** (hanya baca) Hanya dibaca. */
  tingkat?: "rendah" | "sedang" | "tinggi";
  /** (hanya baca) Hanya dibaca. */
  status?: "baru" | "ditindaklanjuti" | "selesai" | "pulih" | "diabaikan";
  /** (hanya baca) Hanya dibaca. */
  tindak_lanjut?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  ditangani_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  dihitung_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type DasborEwsInput = JsonObject;

export type DasborEwsTindakLanjutInput = {
  tindak_lanjut: string;
  [key: string]: any;
};

export type DasborEwsAbaikanInput = {
  alasan: string;
  [key: string]: any;
};

/** Aturan dokumen (sebagian). Kunci yang tidak diisi mengikuti lapis di atasnya. */
export type DokPengaturan = {
  kertas?: "A4" | "F4" | "Letter" | "Legal" | "A5";
  orientasi?: "potret" | "lanskap";
  margin?: {
    /** mm */
    atas?: number;
    /** mm */
    kanan?: number;
    /** mm */
    bawah?: number;
    /** mm */
    kiri?: number;
    [key: string]: any;
  };
  font?: "helvetica" | "times" | "dejavusans" | "dejavuserif" | "courier";
  /** pt 7-16 */
  ukuran_font?: number;
  /** Hex, kepala tabel Contoh: `#0f3d5e` */
  warna_utama?: string;
  kop?: {
    tampil?: boolean;
    /** Kop di setiap halaman (bawaan hanya halaman pertama) */
    semua_halaman?: boolean;
    perataan?: "tengah" | "kiri";
    /** fakultas = logo fakultas unit penerbit (identitas fakultas; kosong = logo kampus) */
    logo?: "kampus" | "fakultas" | "berkas" | "tanpa";
    /** UUID berkas PNG/JPG */
    logo_berkas_id?: string;
    /** Logo kedua di kanan (mis. logo fakultas/akreditasi) */
    logo_kanan_berkas_id?: string;
    /** Kop berupa satu gambar utuh (menggantikan logo + teks) */
    gambar_berkas_id?: string;
    baris?: Array<{
      /** Boleh memakai penanda {..} Contoh: `{nama_pt}` */
      teks?: string;
      /** pt */
      ukuran?: number;
      tebal?: boolean;
      /** hex */
      warna?: string;
      [key: string]: any;
    }>;
    /** Contoh: `{alamat_unit}` */
    alamat?: string;
    /** Contoh: `Telp. {telepon_unit} · {email_unit} · {website_pt}` */
    kontak?: string;
    garis?: "tunggal" | "ganda" | "tebal_tipis" | "tanpa";
    /** hex */
    warna_garis?: string;
    /** mm 10-40 */
    tinggi_logo?: number;
    [key: string]: any;
  };
  judul?: {
    /** pt */
    ukuran?: number;
    huruf_besar?: boolean;
    garis_bawah?: boolean;
    [key: string]: any;
  };
  /** Penandatangan bawaan bila dokumen tidak membawa penandatangan sendiri */
  ttd?: {
    tampil?: boolean;
    posisi?: "kanan" | "kiri" | "tengah";
    /** Contoh: `{kota}` */
    kota?: string;
    jabatan?: string;
    nama?: string;
    nip?: string;
    /** Contoh: `NIP` */
    label_nip?: string;
    /** Gambar tanda tangan (PNG transparan) */
    gambar_berkas_id?: string;
    /** Gambar stempel */
    stempel_berkas_id?: string;
    [key: string]: any;
  };
  kaki?: {
    teks?: string;
    nomor_halaman?: boolean;
    waktu_cetak?: boolean;
    [key: string]: any;
  };
  qr?: {
    posisi?: "ttd" | "kanan_bawah" | "kiri_bawah" | "kanan_atas" | "tanpa";
    /** mm 14-45 */
    ukuran?: number;
    /** Kode gaya /v1/qr Contoh: `dokumen` */
    gaya?: string;
    teks?: string;
    [key: string]: any;
  };
  tanda_air?: {
    /** Mis. SALINAN */
    teks?: string;
    /** 0.02-0.3 */
    opasitas?: number;
    [key: string]: any;
  };
  /** Hanya bermakna di templat kampus per jenis: unit penerbit bawaan, mis. "keuangan" untuk kwitansi */
  bagian_penerbit?: string;
  [key: string]: any;
};

export type DokTemplatInput = {
  nama?: string;
  keterangan?: string;
  /** Kode unit arsip; kosong = kampus */
  bagian?: string;
  /** Kosong = semua jenis */
  jenis?: "umum" | "surat_keluar" | "surat_keterangan" | "sk" | "krs" | "khs" | "transkrip" | "kwitansi" | "sertifikat" | "berita_acara" | "laporan" | "undangan" | "kartu";
  pengaturan?: DokPengaturan;
  aktif?: boolean;
  [key: string]: any;
};

export type DokTemplat = {
  id?: string;
  nama?: string;
  keterangan?: string;
  jenis?: string;
  bagian?: string;
  bagian_nama?: string;
  pengaturan?: DokPengaturan;
  aktif?: boolean;
  diubah_oleh?: string;
  diubah_at?: string;
  [key: string]: any;
};

export type DokTemplatEfektif = {
  jenis?: string;
  bagian?: string;
  pengaturan?: DokPengaturan;
  lapis?: Array<JsonObject>;
  /** Nilai penanda {..} */
  data?: Record<string, string>;
  [key: string]: any;
};

export type DokPratinjauInput = {
  jenis?: "umum" | "surat_keluar" | "surat_keterangan" | "sk" | "krs" | "khs" | "transkrip" | "kwitansi" | "sertifikat" | "berita_acara" | "laporan" | "undangan" | "kartu";
  bagian?: string;
  pengaturan?: DokPengaturan;
  [key: string]: any;
};

export type DokSumberInput = {
  /** KRS, KHS, transkrip */
  nim?: string;
  /** KRS, KHS (bawaan tahun aktif) Contoh: `20261` */
  tahun_id?: string;
  /** Kwitansi */
  transaksi_id?: number;
  /** Surat keluar: id atau uuid */
  surat?: string;
  /** Unit penerbit (opsional) */
  bagian?: string;
  keluaran?: "json" | "pdf";
  unduh?: boolean;
  /** PDF bertanda air, tidak disimpan */
  pratinjau?: boolean;
  /** json: sertakan pdf_base64 */
  sertakan_pdf?: boolean;
  [key: string]: any;
};

export type DokBuatInput = {
  jenis?: "umum" | "surat_keluar" | "surat_keterangan" | "sk" | "krs" | "khs" | "transkrip" | "kwitansi" | "sertifikat" | "berita_acara" | "laporan" | "undangan" | "kartu";
  judul?: string;
  subjudul?: string;
  nomor?: string;
  /** YYYY-MM-DD */
  tanggal?: string;
  /** HTML aman */
  isi_html?: string;
  bagian?: string;
  penandatangan?: Array<{
    jabatan?: string;
    nama?: string;
    nip?: string;
    label_nip?: string;
    [key: string]: any;
  }>;
  pemilik?: string;
  pemilik_nama?: string;
  ringkasan?: Record<string, string>;
  /** YYYY-MM-DD */
  kedaluwarsa?: string;
  sumber_modul?: string;
  sumber_ref?: string;
  keluaran?: "json" | "pdf";
  pratinjau?: boolean;
  [key: string]: any;
};

export type DokTerbit = {
  id?: string;
  /** Contoh: `K7QM2XPA9RTD` */
  kode_verifikasi?: string;
  /** Isi QR */
  url_verifikasi?: string;
  jenis?: string;
  jenis_nama?: string;
  judul?: string;
  nomor?: string;
  bagian?: string;
  bagian_nama?: string;
  pemilik?: string;
  pemilik_nama?: string;
  ringkasan?: JsonObject;
  sha256?: string;
  ukuran?: number;
  halaman?: number;
  berkas_id?: string;
  unduh?: string;
  status?: "sah" | "diganti" | "dibatalkan";
  alasan_batal?: string;
  dibatalkan_at?: string;
  sumber_modul?: string;
  sumber_ref?: string;
  kedaluwarsa_at?: string;
  dibuat_oleh?: string;
  diterbitkan_at?: string;
  /** Bila sertakan_pdf */
  pdf_base64?: string;
  [key: string]: any;
};

export type DokVerifikasi = {
  sah?: boolean;
  status?: string;
  pesan?: string;
  /** Contoh: `K7QM-2XPA-9RTD` */
  kode?: string;
  jenis?: string;
  jenis_nama?: string;
  judul?: string;
  nomor?: string;
  penerbit?: string;
  /** Disamarkan */
  pemilik?: string;
  /** Disamarkan */
  pemilik_id?: string;
  ringkasan?: JsonObject;
  diterbitkan_at?: string;
  kedaluwarsa_at?: string;
  dibatalkan_at?: string;
  sha256?: string;
  halaman?: number;
  [key: string]: any;
};

export type DokBatalInput = {
  /** Wajib, tampil di halaman verifikasi Contoh: `Salah input nilai` */
  alasan: string;
  [key: string]: any;
};

export type DokCocokInput = {
  /** File PDF (maks. 20 MB) */
  berkas?: Uploadable;
  /** Alternatif JSON */
  berkas_base64?: string;
  /** Opsional: kode verifikasi di QR, untuk pesan yang lebih jelas */
  kode?: string;
  [key: string]: any;
};

export type DokCocok = {
  cocok?: boolean;
  sha256?: string;
  pesan?: string;
  dokumen?: DokVerifikasi;
  [key: string]: any;
};

/** Komponen gaji (tabel keu_gaji_komponen) */
export type GajiKomponen = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "pendapatan" | "potongan" | "perusahaan";
  kelompok?: "gaji_pokok" | "tunjangan_tetap" | "tunjangan_tidak_tetap" | "honor" | "lembur" | "thr_bonus" | "bpjs" | "iuran" | "pinjaman" | "potongan_lain" | "lainnya";
  perhitungan?: "tetap" | "persen" | "sdm_gaji_pokok" | "sdm_tunjangan" | "sdm_honor" | "per_hadir" | "per_tidak_hadir" | "per_menit_terlambat" | "manual";
  parameter?: string;
  nilai?: number;
  dasar?: "gaji_pokok" | "tetap" | "bruto";
  batas_bawah?: number;
  batas_atas?: number;
  kena_pajak?: boolean;
  pengurang_pajak?: boolean;
  sasaran?: JsonObject;
  jenis_periode?: JsonObject;
  /** ID di keu_akun */
  akun_id?: number;
  urutan?: number;
  aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiKomponenInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis: "pendapatan" | "potongan" | "perusahaan";
  kelompok?: "gaji_pokok" | "tunjangan_tetap" | "tunjangan_tidak_tetap" | "honor" | "lembur" | "thr_bonus" | "bpjs" | "iuran" | "pinjaman" | "potongan_lain" | "lainnya";
  perhitungan: "tetap" | "persen" | "sdm_gaji_pokok" | "sdm_tunjangan" | "sdm_honor" | "per_hadir" | "per_tidak_hadir" | "per_menit_terlambat" | "manual";
  parameter?: string;
  nilai?: number;
  dasar?: "gaji_pokok" | "tetap" | "bruto";
  batas_bawah?: number;
  batas_atas?: number;
  kena_pajak?: boolean;
  pengurang_pajak?: boolean;
  sasaran?: JsonObject;
  jenis_periode?: JsonObject;
  /** ID di keu_akun */
  akun_id?: number;
  urutan?: number;
  aktif?: boolean;
  keterangan?: string;
  [key: string]: any;
};

/** Profil gaji pegawai (tabel keu_gaji_profil) */
export type GajiProfil = {
  id?: number;
  /** ID di sdm_pegawai (unik) */
  pegawai_id?: number;
  status_ptkp?: "TK/0" | "TK/1" | "TK/2" | "TK/3" | "K/0" | "K/1" | "K/2" | "K/3";
  jenis_pajak?: "pegawai_tetap" | "pegawai_tidak_tetap" | "bukan_pegawai";
  metode_pajak?: "gross" | "gross_up";
  bank?: string;
  kode_bank?: string;
  no_rekening?: string;
  atas_nama?: string;
  ikut_bpjs_kes?: boolean;
  ikut_bpjs_tk?: boolean;
  /** ID di induk_unit */
  unit_id?: number;
  aktif?: boolean;
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiProfilInput = {
  /** ID di sdm_pegawai (unik) */
  pegawai_id: number;
  status_ptkp?: "TK/0" | "TK/1" | "TK/2" | "TK/3" | "K/0" | "K/1" | "K/2" | "K/3";
  jenis_pajak?: "pegawai_tetap" | "pegawai_tidak_tetap" | "bukan_pegawai";
  metode_pajak?: "gross" | "gross_up";
  bank?: string;
  kode_bank?: string;
  no_rekening?: string;
  atas_nama?: string;
  ikut_bpjs_kes?: boolean;
  ikut_bpjs_tk?: boolean;
  /** ID di induk_unit */
  unit_id?: number;
  aktif?: boolean;
  catatan?: string;
  [key: string]: any;
};

/** Tetapan komponen per pegawai (tabel keu_gaji_tetapan) */
export type GajiTetapan = {
  id?: number;
  /** ID di sdm_pegawai */
  pegawai_id?: number;
  /** ID di keu_gaji_komponen */
  komponen_id?: number;
  nilai?: number;
  mulai?: string;
  selesai?: string;
  jumlah_kali?: number;
  /** (hanya baca) Hanya dibaca. */
  terpakai?: number;
  total?: number;
  nomor_dokumen?: string;
  aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiTetapanInput = {
  /** ID di sdm_pegawai */
  pegawai_id: number;
  /** ID di keu_gaji_komponen */
  komponen_id: number;
  nilai: number;
  mulai: string;
  selesai?: string;
  jumlah_kali?: number;
  total?: number;
  nomor_dokumen?: string;
  aktif?: boolean;
  keterangan?: string;
  [key: string]: any;
};

/** Tarif efektif PPh 21 (TER) (tabel keu_gaji_ter) */
export type GajiTer = {
  id?: number;
  kategori?: "A" | "B" | "C";
  batas_bawah?: number;
  batas_atas?: number;
  tarif?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiTerInput = {
  kategori: "A" | "B" | "C";
  batas_bawah: number;
  batas_atas?: number;
  tarif: number;
  [key: string]: any;
};

/** Penghasilan dan PPh sebelum payroll (tabel keu_gaji_pajak_awal) */
export type GajiPajakAwal = {
  id?: number;
  tahun?: number;
  /** ID di sdm_pegawai */
  pegawai_id?: number;
  jumlah_bulan?: number;
  bruto?: number;
  iuran?: number;
  pph?: number;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiPajakAwalInput = {
  tahun: number;
  /** ID di sdm_pegawai */
  pegawai_id: number;
  jumlah_bulan?: number;
  bruto?: number;
  iuran?: number;
  pph?: number;
  keterangan?: string;
  [key: string]: any;
};

/** Periode payroll (tabel keu_gaji_periode) */
export type GajiPeriode = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  kode?: string;
  tahun?: number;
  bulan?: number;
  jenis?: "reguler" | "thr" | "gaji13" | "susulan";
  judul?: string;
  tanggal_bayar?: string;
  sasaran?: JsonObject;
  hari_kerja?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "dihitung" | "diajukan" | "disetujui" | "dibayar" | "ditutup" | "batal";
  /** (hanya baca) Hanya dibaca. */
  jumlah_pegawai?: number;
  /** (hanya baca) Hanya dibaca. */
  pendapatan?: number;
  /** (hanya baca) Hanya dibaca. */
  potongan?: number;
  /** (hanya baca) Hanya dibaca. */
  pph21?: number;
  /** (hanya baca) Hanya dibaca. */
  bpjs_pegawai?: number;
  /** (hanya baca) Hanya dibaca. */
  bpjs_perusahaan?: number;
  /** (hanya baca) Hanya dibaca. */
  netto?: number;
  /** (hanya baca) Hanya dibaca. */
  beban?: number;
  /** (hanya baca) Hanya dibaca. */
  dihitung_at?: string;
  /** (hanya baca) Hanya dibaca. */
  dihitung_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diajukan_at?: string;
  /** (hanya baca) Hanya dibaca. */
  diajukan_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_at?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  dibayar_at?: string;
  /** (hanya baca) Hanya dibaca. */
  dibayar_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  rekening_id?: number;
  /** (hanya baca) Hanya dibaca. */
  jurnal_beban_id?: number;
  /** (hanya baca) Hanya dibaca. */
  jurnal_bayar_id?: number;
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  alasan_batal?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiPeriodeInput = {
  tahun: number;
  bulan: number;
  jenis?: "reguler" | "thr" | "gaji13" | "susulan";
  judul?: string;
  tanggal_bayar?: string;
  sasaran?: JsonObject;
  hari_kerja?: number;
  catatan?: string;
  [key: string]: any;
};

/** Slip gaji (tabel keu_gaji_slip) */
export type GajiSlip = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** (hanya baca) Hanya dibaca. */
  periode_id?: number;
  /** (hanya baca) Hanya dibaca. */
  pegawai_id?: number;
  /** (hanya baca) Hanya dibaca. */
  nama?: string;
  /** (hanya baca) Hanya dibaca. */
  nip?: string;
  /** (hanya baca) Hanya dibaca. */
  jenis?: "dosen" | "tendik";
  /** (hanya baca) Hanya dibaca. */
  kategori?: string;
  /** (hanya baca) Hanya dibaca. */
  unit_id?: number;
  /** (hanya baca) Hanya dibaca. */
  unit?: string;
  /** (hanya baca) Hanya dibaca. */
  golongan?: string;
  /** (hanya baca) Hanya dibaca. */
  jabatan?: string;
  /** (hanya baca) Hanya dibaca. */
  status_ptkp?: string;
  /** (hanya baca) Hanya dibaca. */
  bank?: string;
  /** (hanya baca) Hanya dibaca. */
  no_rekening?: string;
  /** (hanya baca) Hanya dibaca. */
  hari_kerja?: number;
  /** (hanya baca) Hanya dibaca. */
  hari_hadir?: number;
  /** (hanya baca) Hanya dibaca. */
  pendapatan?: number;
  /** (hanya baca) Hanya dibaca. */
  potongan?: number;
  /** (hanya baca) Hanya dibaca. */
  bruto_pajak?: number;
  /** (hanya baca) Hanya dibaca. */
  pph21?: number;
  /** (hanya baca) Hanya dibaca. */
  bpjs_pegawai?: number;
  /** (hanya baca) Hanya dibaca. */
  bpjs_perusahaan?: number;
  /** (hanya baca) Hanya dibaca. */
  netto?: number;
  /** (hanya baca) Hanya dibaca. */
  beban?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "normal" | "ditahan";
  /** (hanya baca) Hanya dibaca. */
  dibayar_at?: string;
  /** (hanya baca) Hanya dibaca. */
  peringatan?: JsonObject;
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type GajiSlipInput = JsonObject;

/** Pegawai ringkas untuk keperluan gaji/honor (tanpa data pribadi). */
export type GajiPegawaiRingkas = {
  id?: number;
  nama?: string;
  /** Nama dengan gelar */
  nama_lengkap?: string;
  nip?: string | null;
  nidn?: string | null;
  jenis?: "dosen" | "tendik";
  unit_id?: number | null;
  unit_nama?: string | null;
  golongan_id?: number | null;
  golongan?: string | null;
  status_aktif?: string;
  [key: string]: any;
};

/** Kategori (tabel helpdesk_kategori) */
export type HelpdeskKategori = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "bantuan" | "pengaduan" | "saran" | "whistleblowing";
  /** ID di induk_unit */
  unit_id?: number;
  sla_jam?: number;
  publik?: boolean;
  keterangan?: string;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type HelpdeskKategoriInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis?: "bantuan" | "pengaduan" | "saran" | "whistleblowing";
  /** ID di induk_unit */
  unit_id?: number;
  sla_jam?: number;
  publik?: boolean;
  keterangan?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Tiket (tabel helpdesk_tiket) */
export type HelpdeskTiket = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** ID di helpdesk_kategori */
  kategori_id?: number;
  /** ID di induk_unit (hanya baca) Hanya dibaca. */
  unit_id?: number;
  /** user.username */
  pelapor?: string;
  nama_pelapor?: string;
  email_pelapor?: string;
  hp_pelapor?: string;
  anonim?: boolean;
  kanal?: "web" | "aplikasi" | "email" | "whatsapp" | "telepon" | "tatap_muka";
  judul?: string;
  isi?: string;
  prioritas?: "rendah" | "sedang" | "tinggi" | "darurat";
  /** (hanya baca) Hanya dibaca. */
  status?: "baru" | "diproses" | "menunggu_pelapor" | "selesai" | "ditutup" | "ditolak";
  /** user.username (hanya baca) Hanya dibaca. */
  petugas?: string;
  /** (hanya baca) Hanya dibaca. */
  tenggat?: string;
  /** (hanya baca) Hanya dibaca. */
  tanggapan_pertama?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  rating?: number;
  /** (hanya baca) Hanya dibaca. */
  ulasan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type HelpdeskTiketInput = {
  /** ID di helpdesk_kategori */
  kategori_id: number;
  /** user.username */
  pelapor?: string;
  nama_pelapor?: string;
  email_pelapor?: string;
  hp_pelapor?: string;
  anonim?: boolean;
  kanal?: "web" | "aplikasi" | "email" | "whatsapp" | "telepon" | "tatap_muka";
  judul: string;
  isi: string;
  prioritas?: "rendah" | "sedang" | "tinggi" | "darurat";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type HelpdeskTiketBalasInput = {
  isi: string;
  internal?: boolean;
  minta_info?: boolean;
  [key: string]: any;
};

export type HelpdeskTiketTugaskanInput = {
  /** user.username */
  petugas: string;
  /** ID di induk_unit */
  unit_id?: number;
  prioritas?: "rendah" | "sedang" | "tinggi" | "darurat";
  [key: string]: any;
};

export type HelpdeskTiketSelesaikanInput = {
  isi: string;
  [key: string]: any;
};

export type HelpdeskTiketTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type HelpdeskTiketTutupInput = {
  rating?: number;
  ulasan?: string;
  [key: string]: any;
};

/** Indikator IKU (tabel iku_indikator) */
export type IkuIndikator = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  deskripsi?: string;
  satuan?: "persen" | "rasio" | "angka";
  metode?: "iku1_tracer" | "iku2_luar_kampus" | "iku3_dosen_luar" | "iku4_kualifikasi" | "iku5_luaran" | "iku6_kerjasama" | "iku7_kelas" | "iku8_internasional" | "manual";
  parameter?: JsonObject;
  dasar_hukum?: string;
  per_prodi?: boolean;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IkuIndikatorInput = {
  /** (unik) */
  kode: string;
  nama: string;
  deskripsi?: string;
  satuan?: "persen" | "rasio" | "angka";
  metode?: "iku1_tracer" | "iku2_luar_kampus" | "iku3_dosen_luar" | "iku4_kualifikasi" | "iku5_luaran" | "iku6_kerjasama" | "iku7_kelas" | "iku8_internasional" | "manual";
  parameter?: JsonObject;
  dasar_hukum?: string;
  per_prodi?: boolean;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Target IKU (tabel iku_target) */
export type IkuTarget = {
  id?: number;
  /** ID di iku_indikator */
  indikator_id?: number;
  tahun?: number;
  kode_prodi?: string;
  target?: number;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IkuTargetInput = {
  /** ID di iku_indikator */
  indikator_id: number;
  tahun: number;
  kode_prodi?: string;
  target: number;
  keterangan?: string;
  [key: string]: any;
};

/** Bukti capaian IKU (tabel iku_bukti) */
export type IkuBukti = {
  id?: number;
  /** ID di iku_indikator */
  indikator_id?: number;
  tahun?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  jenis_subjek?: "dosen" | "mahasiswa" | "prodi" | "mata_kuliah" | "luaran";
  subjek?: string;
  nama?: string;
  kategori?: string;
  keterangan?: string;
  tautan?: string;
  status?: "diajukan" | "disetujui" | "ditolak";
  catatan_verifikasi?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IkuBuktiInput = {
  /** ID di iku_indikator */
  indikator_id: number;
  tahun: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  jenis_subjek: "dosen" | "mahasiswa" | "prodi" | "mata_kuliah" | "luaran";
  subjek: string;
  nama?: string;
  kategori?: string;
  keterangan?: string;
  tautan?: string;
  status?: "diajukan" | "disetujui" | "ditolak";
  catatan_verifikasi?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Unit organisasi (tabel induk_unit) */
export type IndukUnit = {
  id?: number;
  /** ID di induk_unit */
  induk_id?: number;
  /** (unik) */
  kode?: string;
  jenis?: "yayasan" | "universitas" | "kelompok" | "rektorat" | "kampus" | "biro" | "fakultas" | "prodi" | "lembaga" | "upt" | "bagian" | "unit";
  /** m_fakultas.kode_fakultas */
  kode_fakultas?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nama?: string;
  nama_en?: string;
  singkatan?: string;
  email?: string;
  telepon?: string;
  situs?: string;
  alamat?: string;
  tanggal_berdiri?: string;
  nomor_sk_pendirian?: string;
  aktif?: boolean;
  /** (hanya baca) Hanya dibaca. */
  bawaan?: boolean;
  koordinasi?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukUnitInput = {
  /** ID di induk_unit */
  induk_id?: number;
  /** (unik) */
  kode: string;
  jenis: "yayasan" | "universitas" | "kelompok" | "rektorat" | "kampus" | "biro" | "fakultas" | "prodi" | "lembaga" | "upt" | "bagian" | "unit";
  /** m_fakultas.kode_fakultas */
  kode_fakultas?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nama: string;
  nama_en?: string;
  singkatan?: string;
  email?: string;
  telepon?: string;
  situs?: string;
  alamat?: string;
  tanggal_berdiri?: string;
  nomor_sk_pendirian?: string;
  aktif?: boolean;
  koordinasi?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Jabatan struktural (tabel induk_jabatan) */
export type IndukJabatan = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  kelompok?: "pimpinan_universitas" | "pimpinan_fakultas" | "pimpinan_prodi" | "kepala_unit" | "sekretaris" | "lainnya";
  untuk_jenis_unit?: string;
  /** ID di induk_unit */
  unit_id?: number;
  tunggal?: boolean;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukJabatanInput = {
  /** (unik) */
  kode: string;
  nama: string;
  kelompok?: "pimpinan_universitas" | "pimpinan_fakultas" | "pimpinan_prodi" | "kepala_unit" | "sekretaris" | "lainnya";
  untuk_jenis_unit?: string;
  /** ID di induk_unit */
  unit_id?: number;
  tunggal?: boolean;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Pejabat struktural (tabel induk_pejabat) */
export type IndukPejabat = {
  id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di induk_jabatan */
  jabatan_id?: number;
  /** ID di induk_orang */
  orang_id?: number;
  /** m_dosen.NIDN */
  nidn?: string;
  /** m_karyawan.NIK */
  nik_karyawan?: string;
  /** user.username */
  username?: string;
  nama?: string;
  nip?: string;
  nomor_sk?: string;
  tanggal_sk?: string;
  mulai?: string;
  selesai?: string;
  plt?: boolean;
  plh?: boolean;
  catatan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukPejabatInput = {
  /** ID di induk_unit */
  unit_id: number;
  /** ID di induk_jabatan */
  jabatan_id: number;
  /** ID di induk_orang */
  orang_id?: number;
  /** m_dosen.NIDN */
  nidn?: string;
  /** m_karyawan.NIK */
  nik_karyawan?: string;
  /** user.username */
  username?: string;
  nama?: string;
  nip?: string;
  nomor_sk?: string;
  tanggal_sk?: string;
  mulai: string;
  selesai?: string;
  plt?: boolean;
  plh?: boolean;
  catatan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Orang (identitas tunggal) (tabel induk_orang) */
export type IndukOrang = {
  id?: number;
  nama?: string;
  gelar_depan?: string;
  gelar_belakang?: string;
  nik?: string;
  jenis_kelamin?: "L" | "P";
  tempat_lahir?: string;
  tanggal_lahir?: string;
  email?: string;
  hp?: string;
  /** user.username (hanya pengelola) */
  username?: string;
  /** (hanya pengelola) */
  sdm_pegawai_id?: number;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya pengelola) */
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukOrangInput = {
  nama: string;
  gelar_depan?: string;
  gelar_belakang?: string;
  nik?: string;
  jenis_kelamin?: "L" | "P";
  tempat_lahir?: string;
  tanggal_lahir?: string;
  email?: string;
  hp?: string;
  /** user.username (hanya pengelola) */
  username?: string;
  /** (hanya pengelola) */
  sdm_pegawai_id?: number;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya pengelola) */
  aktif?: boolean;
  [key: string]: any;
};

/** Peran orang (tabel induk_orang_peran) */
export type IndukOrangPeran = {
  id?: number;
  /** ID di induk_orang */
  orang_id?: number;
  peran?: "mahasiswa" | "dosen" | "tendik" | "alumni" | "mitra" | "umum";
  kunci?: string;
  sumber?: "m_mahasiswa" | "m_dosen" | "m_karyawan" | "sdm_pegawai" | "manual";
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  status?: string;
  aktif?: boolean;
  mulai?: string;
  selesai?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukOrangPeranInput = {
  /** ID di induk_orang */
  orang_id: number;
  peran: "mahasiswa" | "dosen" | "tendik" | "alumni" | "mitra" | "umum";
  kunci: string;
  sumber?: "m_mahasiswa" | "m_dosen" | "m_karyawan" | "sdm_pegawai" | "manual";
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  status?: string;
  aktif?: boolean;
  mulai?: string;
  selesai?: string;
  [key: string]: any;
};

/** Peran pengelola modul (tabel induk_peran) */
export type IndukPeran = {
  id?: number;
  /** user.username */
  username?: string;
  modul?: string;
  peran?: "admin" | "pengelola";
  /** ID di induk_unit */
  unit_id?: number;
  keterangan?: string;
  aktif?: boolean;
  mulai?: string;
  selesai?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukPeranInput = {
  /** user.username */
  username: string;
  modul: string;
  peran?: "admin" | "pengelola";
  /** ID di induk_unit */
  unit_id?: number;
  keterangan?: string;
  aktif?: boolean;
  mulai?: string;
  selesai?: string;
  [key: string]: any;
};

/** Log audit pusat data (tabel induk_log) */
export type IndukLog = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  modul?: string;
  /** (hanya baca) Hanya dibaca. */
  entitas?: string;
  /** (hanya baca) Hanya dibaca. */
  entitas_id?: number;
  /** (hanya baca) Hanya dibaca. */
  aksi?: string;
  /** (hanya baca) Hanya dibaca. */
  oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  ip?: string;
  /** (hanya baca) Hanya dibaca. */
  detail?: JsonObject;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type IndukLogInput = JsonObject;

export type InfraStatus = {
  /** normal, sebagian_terganggu, gangguan, tidak_diketahui Contoh: `normal` */
  status?: string | null;
  layanan?: Array<{
    /** Contoh: `sso` */
    kode?: string | null;
    /** Contoh: `SSO UNIPO` */
    nama?: string | null;
    /** monolith, layanan, frontend, eksternal */
    jenis?: string | null;
    /** sehat, terganggu, mati, tidak_diketahui Contoh: `sehat` */
    status?: string | null;
    /** Contoh: `120` */
    latensi_ms?: number | null;
    diperiksa_at?: string | null;
    berubah_at?: string | null;
    /** Persen cek yang tidak mati dalam 24 jam */
    uptime_24j?: number | null;
    [key: string]: any;
  }>;
  diperbarui_at?: string | null;
  [key: string]: any;
};

export type InfraLayanan = {
  /** UUID */
  id?: string | null;
  /** Contoh: `lms` */
  kode?: string | null;
  /** Contoh: `LMS e-learning` */
  nama?: string | null;
  /** monolith, layanan, frontend, eksternal Contoh: `layanan` */
  jenis?: string | null;
  /** Tujuan proxy gerbang Contoh: `https://e-learning.unipo.ac.id` */
  url_dasar?: string | null;
  /** Contoh: `https://e-learning.unipo.ac.id/bff/sehat` */
  url_kesehatan?: string | null;
  /** Menit Contoh: `5` */
  interval_cek?: number | null;
  /** Contoh: `2000` */
  batas_lambat_ms?: number | null;
  /** Klien API milik layanan */
  klien_id?: string | null;
  pemilik?: string | null;
  repositori?: string | null;
  keterangan?: string | null;
  aktif?: boolean;
  /** sehat, terganggu, mati, tidak_diketahui Contoh: `sehat` */
  status?: string | null;
  latensi_ms?: number | null;
  kode_http?: number | null;
  /** Dilaporkan health check */
  versi?: string | null;
  galat?: string | null;
  gagal_beruntun?: number | null;
  /** Sudah punya kunci HMAC header identitas */
  kunci_gerbang?: boolean;
  uptime_24j?: number | null;
  diperiksa_at?: string | null;
  berubah_at?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type InfraLayananInput = {
  /** Wajib saat daftar; huruf kecil/angka/- Contoh: `lms` */
  kode?: string | null;
  /** Contoh: `LMS e-learning` */
  nama?: string | null;
  /** monolith, layanan, frontend, eksternal Contoh: `layanan` */
  jenis?: string | null;
  /** Contoh: `https://e-learning.unipo.ac.id` */
  url_dasar?: string | null;
  /** Contoh: `https://e-learning.unipo.ac.id/bff/sehat` */
  url_kesehatan?: string | null;
  /** 1-1440 menit Contoh: `5` */
  interval_cek?: number | null;
  /** 100-60000 Contoh: `2000` */
  batas_lambat_ms?: number | null;
  /** Klien API layanan (boleh menerbitkan event berawalan kode) Contoh: `lms-bff` */
  klien_id?: string | null;
  /** Contoh: `Pustikom` */
  pemilik?: string | null;
  repositori?: string | null;
  keterangan?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

export type InfraRute = {
  /** UUID */
  id?: string | null;
  /** Contoh: `LMS` */
  nama?: string | null;
  /** Contoh: `/v1/lms` */
  awalan?: string | null;
  /** Kosong = semua */
  metode?: Array<string | null>;
  /** monolith atau layanan Contoh: `monolith` */
  tujuan?: string | null;
  /** Kode layanan tujuan */
  layanan?: string | null;
  layanan_nama?: string | null;
  layanan_status?: string | null;
  /** Pengganti awalan di layanan tujuan */
  jalur_tujuan?: string | null;
  /** token, publik, lewat Contoh: `token` */
  autentikasi?: string | null;
  scope?: Array<string | null>;
  batas_per_menit?: number | null;
  /** Contoh: `30` */
  timeout_detik?: number | null;
  pemeliharaan?: boolean;
  pesan_pemeliharaan?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type InfraRuteInput = {
  /** Contoh: `LMS (microservice)` */
  nama?: string | null;
  /** Berawalan /v1/ Contoh: `/v1/lms` */
  awalan?: string | null;
  /** GET, POST, ...; kosong = semua */
  metode?: Array<string | null>;
  /** monolith (bawaan) atau layanan Contoh: `layanan` */
  tujuan?: string | null;
  /** Kode layanan (wajib untuk tujuan layanan) Contoh: `lms` */
  layanan?: string | null;
  /** Ganti awalan dengan path ini Contoh: `/api/v1/lms` */
  jalur_tujuan?: string | null;
  /** token (bawaan), publik, lewat Contoh: `token` */
  autentikasi?: string | null;
  /** Scope wajib (autentikasi token) */
  scope?: Array<string | null>;
  /** Per klien/IP; null = tanpa batas rute Contoh: `600` */
  batas_per_menit?: number | null;
  /** 1-300 Contoh: `30` */
  timeout_detik?: number | null;
  pemeliharaan?: boolean;
  /** Contoh: `LMS sedang dipindahkan, kembali pukul 22.00 WITA` */
  pesan_pemeliharaan?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  [key: string]: any;
};

export type InfraRahasia = {
  /** UUID */
  id?: string | null;
  /** Contoh: `pmb` */
  ruang?: string | null;
  /** produksi atau development */
  lingkungan?: string | null;
  /** Contoh: `XENDIT_SECRET_KEY` */
  nama?: string | null;
  /** teks atau berkas */
  jenis?: string | null;
  mime?: string | null;
  keterangan?: string | null;
  /** Contoh: `1` */
  versi_aktif?: number | null;
  rotasi_hari?: number | null;
  dirotasi_at?: string | null;
  perlu_rotasi?: boolean;
  kedaluwarsa_at?: string | null;
  /** Kurang dari 30 hari */
  kedaluwarsa_segera?: boolean;
  terakhir_dibaca_at?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  /** Hanya di detail */
  versi?: Array<{
    versi?: number | null;
    /** Sidik jari 16 hex */
    sidik?: string | null;
    ukuran?: number | null;
    aktif?: boolean;
    dibuat_oleh?: string | null;
    dibuat_at?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type InfraRahasiaInput = {
  /** Wajib saat buat Contoh: `pmb` */
  ruang?: string | null;
  /** produksi (bawaan) atau development */
  lingkungan?: string | null;
  /** Teks: NAMA_VARIABEL; berkas: nama file Contoh: `XENDIT_SECRET_KEY` */
  nama?: string | null;
  /** teks (bawaan) atau berkas */
  jenis?: string | null;
  /** Isi rahasia teks (maks. 64 KB) */
  nilai?: string | null;
  /** Isi berkas base64 (maks. 1 MB) */
  berkas_base64?: string | null;
  /** Contoh: `application/json` */
  mime?: string | null;
  keterangan?: string | null;
  /** Pengingat rotasi Contoh: `90` */
  rotasi_hari?: number | null;
  /** YYYY-MM-DD */
  kedaluwarsa_at?: string | null;
  [key: string]: any;
};

export type InfraAntrean = {
  /** UUID */
  id?: string | null;
  /** Contoh: `lms.nilai-masuk` */
  kode?: string | null;
  nama?: string | null;
  klien_id?: string | null;
  /** Pola jenis event */
  jenis_event?: Array<string | null>;
  /** Contoh: `60` */
  visibilitas_detik?: number | null;
  /** Contoh: `5` */
  maks_percobaan?: number | null;
  /** Contoh: `7` */
  retensi_hari?: number | null;
  aktif?: boolean;
  keterangan?: string | null;
  statistik?: {
    siap?: number | null;
    diproses?: number | null;
    selesai?: number | null;
    /** Dead letter */
    mati?: number | null;
    tertua_menunggu_detik?: number | null;
    [key: string]: any;
  };
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type InfraAntreanInput = {
  /** Wajib saat buat Contoh: `lms.nilai-masuk` */
  kode?: string | null;
  nama?: string | null;
  /** mis. ["akademik.*", "admisi.nim_diterbitkan"] */
  jenis_event?: Array<string | null>;
  /** 5-43200 Contoh: `60` */
  visibilitas_detik?: number | null;
  /** 1-100 Contoh: `5` */
  maks_percobaan?: number | null;
  /** 1-30 Contoh: `7` */
  retensi_hari?: number | null;
  aktif?: boolean;
  keterangan?: string | null;
  /** Admin: buat antrean untuk klien lain */
  klien_id?: string | null;
  [key: string]: any;
};

export type IntegrasiDriver = {
  /** Contoh: `xendit` */
  driver?: string | null;
  /** captcha, pembayaran, penyimpanan, cache, email, whatsapp */
  kategori?: string | null;
  nama?: string | null;
  keterangan?: string | null;
  dokumentasi?: string | null;
  konfigurasi?: Array<{
    nama?: string | null;
    label?: string | null;
    wajib?: boolean;
    bawaan?: any;
    /** string, bool, number, list */
    tipe?: string | null;
    [key: string]: any;
  }>;
  rahasia?: Array<{
    nama?: string | null;
    label?: string | null;
    wajib?: boolean;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type IntegrasiPenyedia = {
  id?: number | null;
  /** Contoh: `xendit` */
  kode?: string | null;
  kategori?: string | null;
  driver?: string | null;
  nama?: string | null;
  /** sandbox / produksi */
  mode?: string | null;
  aktif?: boolean;
  /** Penyedia bawaan kategorinya */
  utama?: boolean;
  konfigurasi?: JsonObject;
  /** Hanya status: "kosong" atau "terisi (…abcd)" */
  rahasia?: Record<string, string>;
  /** false bila kunci enkripsi berubah sejak disimpan */
  rahasia_terbaca?: boolean;
  /** Pembayaran: pasang di dasbor penyedia */
  url_webhook?: string | null;
  catatan?: string | null;
  diuji_at?: string | null;
  hasil_uji?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type IntegrasiPenyediaInput = {
  /** Wajib saat tambah Contoh: `midtrans` */
  driver?: string | null;
  /** Unik, dipakai di URL webhook (bawaan = driver) Contoh: `midtrans` */
  kode?: string | null;
  nama?: string | null;
  /** sandbox / produksi Contoh: `sandbox` */
  mode?: string | null;
  aktif?: boolean;
  utama?: boolean;
  catatan?: string | null;
  konfigurasi?: JsonObject;
  rahasia?: JsonObject;
  [key: string]: any;
};

export type IntegrasiCaptchaWidget = {
  penyedia?: string | null;
  /** Contoh: `turnstile` */
  driver?: string | null;
  site_key?: string | null;
  /** URL skrip widget */
  skrip?: string | null;
  /** Nama field token di formulir Contoh: `cf-turnstile-response` */
  field_token?: string | null;
  /** reCAPTCHA v3 */
  skor_minimal?: number | null;
  /** Formulir yang wajib captcha: login, lupa_password, reset_password, daftar, formulir_publik */
  halaman?: Array<string | null>;
  [key: string]: any;
};

export type IntegrasiStatus = {
  captcha?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `turnstile` */
    driver?: string | null;
    site_key?: string | null;
    skrip?: string | null;
    field_token?: string | null;
    skor_minimal?: number | null;
    halaman?: Array<string | null>;
    [key: string]: any;
  };
  pembayaran?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `xendit` */
    driver?: string | null;
    /** sandbox atau produksi */
    mode?: string | null;
    /** Midtrans: client key untuk Snap.js */
    client_key?: string | null;
    [key: string]: any;
  };
  penyimpanan?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `r2` */
    driver?: string | null;
    [key: string]: any;
  };
  cache?: {
    aktif?: boolean;
    penyedia?: string | null;
    driver?: string | null;
    [key: string]: any;
  };
  email?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `smtp` */
    driver?: string | null;
    [key: string]: any;
  };
  whatsapp?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `fonnte` */
    driver?: string | null;
    [key: string]: any;
  };
  rapat?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `zoom` */
    driver?: string | null;
    [key: string]: any;
  };
  esign?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `bsre` */
    driver?: string | null;
    [key: string]: any;
  };
  ai?: {
    aktif?: boolean;
    penyedia?: string | null;
    /** Contoh: `anthropic` */
    driver?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type IntegrasiCaptchaVerifikasi = {
  /** Token dari widget */
  token: string | null;
  /** IP pengguna (disarankan) Contoh: `203.0.113.10` */
  ip?: string | null;
  /** reCAPTCHA v3/Turnstile: aksi yang diharapkan Contoh: `login` */
  aksi?: string | null;
  /** Kode penyedia (kosong = utama) */
  penyedia?: string | null;
  [key: string]: any;
};

export type IntegrasiCaptchaHasil = {
  /** true = lolos */
  valid?: boolean;
  /** reCAPTCHA v3 */
  skor?: number | null;
  aksi?: string | null;
  hostname?: string | null;
  /** Kode galat penyedia, mis. invalid-input-response, timeout-or-duplicate, skor-terlalu-rendah */
  galat?: Array<string | null>;
  penyedia?: string | null;
  driver?: string | null;
  [key: string]: any;
};

export type IntegrasiTransaksiInput = {
  /** checkout (bawaan), va, qris Contoh: `va` */
  metode?: string | null;
  /** Kode bank untuk va (BNI, BRI, MANDIRI, ...), atau batasi kanal checkout Contoh: `BNI` */
  kanal?: string | null;
  /** Rupiah; boleh kosong bila sumber punya tagihan Contoh: `150000` */
  jumlah?: number | null;
  /** Contoh: `Biaya pendaftaran PMB` */
  keterangan?: string | null;
  pelanggan?: {
    /** Contoh: `Siti Aminah` */
    nama?: string | null;
    /** Contoh: `siti@example.com` */
    email?: string | null;
    /** Contoh: `081234567890` */
    hp?: string | null;
    [key: string]: any;
  };
  item?: Array<{
    nama?: string | null;
    harga?: number | null;
    jumlah?: number | null;
    [key: string]: any;
  }>;
  /** 5-43200, bawaan 1440 Contoh: `1440` */
  kedaluwarsa_menit?: number | null;
  /** Opsional, unik 5-64 karakter; bawaan dibuat otomatis */
  order_id?: string | null;
  sumber?: {
    /** pmb, atau nama modul aplikasi Anda Contoh: `pmb` */
    modul?: string | null;
    /** Nomor tagihan Contoh: `PMB2611000123` */
    referensi?: string | null;
    [key: string]: any;
  };
  /** Redirect setelah bayar (checkout) */
  url_kembali?: string | null;
  metadata?: JsonObject;
  /** Kode penyedia (kosong = utama) */
  penyedia?: string | null;
  [key: string]: any;
};

export type IntegrasiTransaksi = {
  /** UUID */
  id?: string | null;
  order_id?: string | null;
  /** xendit / midtrans */
  penyedia?: string | null;
  metode?: string | null;
  kanal?: string | null;
  jumlah?: number | null;
  mata_uang?: string | null;
  /** menunggu, dibayar, kedaluwarsa, gagal, dibatalkan, dikembalikan */
  status?: string | null;
  keterangan?: string | null;
  pelanggan?: {
    nama?: string | null;
    email?: string | null;
    hp?: string | null;
    [key: string]: any;
  };
  /** checkout */
  url_bayar?: string | null;
  /** va */
  nomor_va?: string | null;
  /** qris: isi untuk dibuat gambar QR */
  qr_string?: string | null;
  /** Data tambahan: snap_token + client_key (Midtrans), biller_code (Mandiri), url_qr */
  instruksi?: JsonObject;
  kedaluwarsa_at?: string | null;
  dibayar_at?: string | null;
  jumlah_dibayar?: number | null;
  sumber?: {
    modul?: string | null;
    referensi?: string | null;
    /** menunggu, diproses, gagal */
    status?: string | null;
    pesan?: string | null;
    [key: string]: any;
  };
  url_kembali?: string | null;
  metadata?: JsonObject;
  id_eksternal?: string | null;
  klien_id?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type IntegrasiUnggah = {
  berkas: Uploadable;
  /** Contoh: `pmb/berkas` */
  folder?: string | null;
  /** privat / publik */
  visibilitas?: string | null;
  modul?: string | null;
  referensi?: string | null;
  /** Kode penyedia */
  penyimpanan?: string | null;
  [key: string]: any;
};

export type IntegrasiUnggahLangsung = {
  /** Contoh: `video-profil.mp4` */
  nama: string | null;
  /** byte Contoh: `10485760` */
  ukuran: number | null;
  /** Contoh: `video/mp4` */
  mime?: string | null;
  folder?: string | null;
  visibilitas?: string | null;
  modul?: string | null;
  referensi?: string | null;
  penyimpanan?: string | null;
  [key: string]: any;
};

export type IntegrasiBerkas = {
  /** UUID */
  id?: string | null;
  nama?: string | null;
  mime?: string | null;
  ukuran?: number | null;
  sha256?: string | null;
  visibilitas?: string | null;
  /** menunggu_unggah / tersedia */
  status?: string | null;
  /** lokal, s3, r2, minio */
  penyimpanan?: string | null;
  /** Object key */
  kunci?: string | null;
  folder?: string | null;
  modul?: string | null;
  referensi?: string | null;
  klien_id?: string | null;
  dibuat_at?: string | null;
  /** URL unduh sementara */
  url?: string | null;
  kedaluwarsa_at?: string | null;
  /** Hanya pada unggah langsung */
  unggah?: {
    url?: string | null;
    /** PUT */
    metode?: string | null;
    header?: JsonObject;
    kedaluwarsa_at?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type IntegrasiEmail = {
  /** Alamat tujuan (atau teks dipisah koma) */
  ke: Array<string | null>;
  /** Contoh: `Pengumuman PMB` */
  subjek: string | null;
  teks?: string | null;
  html?: string | null;
  balas_ke?: string | null;
  penyedia?: string | null;
  [key: string]: any;
};

export type IntegrasiWhatsapp = {
  /** Nomor 08xx/628xx */
  ke: Array<string | null>;
  teks: string | null;
  penyedia?: string | null;
  [key: string]: any;
};

export type IntegrasiPesanHasil = {
  terkirim?: boolean;
  penyedia?: string | null;
  driver?: string | null;
  jumlah_penerima?: number | null;
  id_pesan?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type IntegrasiLanggananInput = {
  /** Contoh: `Aplikasi PMB` */
  nama: string | null;
  /** https:// Contoh: `https://pmb.unipo.ac.id/webhook/siakad` */
  url: string | null;
  /** Event: * atau pembayaran.dibuat, pembayaran.dibayar, pembayaran.kedaluwarsa, pembayaran.gagal, pembayaran.dibatalkan, pembayaran.dikembalikan, berkas.diunggah, berkas.dihapus */
  event?: Array<string | null>;
  aktif?: boolean;
  /** Admin: terima event semua aplikasi */
  semua_klien?: boolean;
  /** PATCH: buat rahasia baru */
  rahasia_baru?: boolean;
  [key: string]: any;
};

export type IntegrasiLangganan = {
  /** UUID */
  id?: string | null;
  klien_id?: string | null;
  nama?: string | null;
  url?: string | null;
  event?: Array<string | null>;
  semua_klien?: boolean;
  aktif?: boolean;
  gagal_beruntun?: number | null;
  terakhir_kirim_at?: string | null;
  dibuat_at?: string | null;
  /** Hanya saat dibuat/diganti */
  rahasia?: string | null;
  [key: string]: any;
};

export type IntegrasiRapatInput = {
  /** Contoh: `Kelas daring Pemrograman Web - Pertemuan 11` */
  judul: string | null;
  /** Teks/HTML, dikirim sebagai agenda/deskripsi */
  agenda?: string | null;
  /** Y-m-d H:i (zona_waktu) Contoh: `2026-11-20 08:00` */
  mulai: string | null;
  /** 1-1440, bawaan 90 Contoh: `100` */
  durasi_menit?: number | null;
  /** Alternatif durasi_menit */
  selesai?: string | null;
  /** Bawaan zona penyedia Contoh: `Asia/Makassar` */
  zona_waktu?: string | null;
  /** Kode penyedia rapat (kosong = utama) Contoh: `zoom` */
  penyedia?: string | null;
  /** Nama modul/aplikasi Anda Contoh: `lms` */
  modul?: string | null;
  /** ID di aplikasi Anda */
  referensi?: string | null;
  [key: string]: any;
};

export type IntegrasiRapat = {
  /** UUID */
  id?: string | null;
  /** zoom / google_meet */
  driver?: string | null;
  /** Zoom / Google Meet */
  penyedia?: string | null;
  judul?: string | null;
  agenda?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  durasi_menit?: number | null;
  zona_waktu?: string | null;
  /** terjadwal / dibatalkan */
  status?: string | null;
  /** akan_datang / berlangsung (15 menit sebelum mulai s.d. selesai) / selesai / dibatalkan */
  waktu?: string | null;
  /** Tautan peserta */
  url_gabung?: string | null;
  /** Zoom */
  kata_sandi?: string | null;
  /** Zoom: tautan mulai untuk penyelenggara */
  url_host?: string | null;
  /** ID meeting Zoom / kode Meet */
  id_rapat?: string | null;
  modul?: string | null;
  referensi?: string | null;
  dibuat_oleh?: string | null;
  dibuat_at?: string | null;
  diubah_at?: string | null;
  [key: string]: any;
};

export type IntegrasiEsignInput = {
  /** NIK 16 digit pemilik sertifikat BSrE (tidak disimpan) */
  nik: string | null;
  /** Passphrase sertifikat (tidak disimpan) */
  passphrase: string | null;
  /** UUID berkas /v1/integrasi/berkas */
  berkas_id?: string | null;
  /** Alternatif: isi PDF base64 */
  file_base64?: string | null;
  /** Contoh: `Surat Keputusan Rektor No. 12/2026` */
  judul?: string | null;
  tampilan?: {
    /** invisible (bawaan) atau visible Contoh: `visible` */
    jenis?: string | null;
    /** Nomor halaman (v1 juga FIRST/LAST) Contoh: `1` */
    halaman?: number | null;
    /** Posisi X (point) */
    x?: number | null;
    /** Posisi Y (point) */
    y?: number | null;
    lebar?: number | null;
    tinggi?: number | null;
    /** Teks penanda posisi, mis. #ttd# */
    tag?: string | null;
    /** PNG base64 spesimen tanda tangan */
    gambar?: string | null;
    alasan?: string | null;
    lokasi?: string | null;
    /** v1: URL di QR */
    tautan_qr?: string | null;
    [key: string]: any;
  };
  /** Kode penyedia esign (kosong = utama) */
  penyedia?: string | null;
  /** Kode penyimpanan hasil (kosong = utama) */
  penyimpanan?: string | null;
  /** false = tidak disimpan sebagai berkas (hasil hanya pdf_base64) */
  simpan?: boolean;
  /** true = sertakan pdf_base64 */
  kembalikan_pdf?: boolean;
  /** Contoh: `arsip` */
  modul?: string | null;
  referensi?: string | null;
  [key: string]: any;
};

export type IntegrasiEsign = {
  /** UUID */
  id?: string | null;
  /** tanda_tangan / verifikasi */
  jenis?: string | null;
  /** Contoh: `bsre` */
  driver?: string | null;
  judul?: string | null;
  /** berhasil / gagal */
  status?: string | null;
  galat?: string | null;
  /** Disamarkan, mis. ************1234 */
  nik?: string | null;
  /** Username yang menandatangani */
  penanda?: string | null;
  /** UUID berkas sumber */
  berkas_asal?: string | null;
  /** UUID berkas PDF bertanda tangan */
  berkas_hasil?: string | null;
  sha256_asal?: string | null;
  sha256_hasil?: string | null;
  /** ID dokumen di BSrE */
  id_dokumen?: string | null;
  modul?: string | null;
  referensi?: string | null;
  waktu?: string | null;
  berkas?: JsonObject;
  /** Bila kembalikan_pdf atau simpan=false */
  pdf_base64?: string | null;
  [key: string]: any;
};

export type IntegrasiEsignVerifikasiInput = {
  /** UUID berkas */
  berkas_id?: string | null;
  /** Alternatif: isi PDF base64 */
  file_base64?: string | null;
  judul?: string | null;
  penyedia?: string | null;
  modul?: string | null;
  referensi?: string | null;
  [key: string]: any;
};

export type IntegrasiEsignVerifikasi = {
  valid?: boolean;
  /** VALID / WARNING / INVALID / NO_SIGNATURE */
  kesimpulan?: string | null;
  penanda?: Array<{
    nama?: string | null;
    penerbit?: string | null;
    waktu?: string | null;
    alasan?: string | null;
    lokasi?: string | null;
    sertifikat_valid?: boolean;
    dokumen_utuh?: boolean;
    [key: string]: any;
  }>;
  sha256?: string | null;
  ditandatangani_lewat_siakad?: {
    id?: string | null;
    judul?: string | null;
    penanda?: string | null;
    waktu?: string | null;
    [key: string]: any;
  };
  data?: JsonObject;
  [key: string]: any;
};

export type IntegrasiEsignStatusInput = {
  /** NIK 16 digit */
  nik: string | null;
  penyedia?: string | null;
  [key: string]: any;
};

export type IntegrasiAiInput = {
  /** Teks tunggal Contoh: `Ringkas pengumuman berikut dalam 3 poin: ...` */
  prompt?: string | null;
  /** Alternatif prompt: percakapan, diakhiri user */
  pesan?: Array<{
    /** user / assistant */
    role?: string | null;
    content?: string | null;
    [key: string]: any;
  }>;
  /** Instruksi sistem tambahan, maks. 20.000 karakter Contoh: `Anda asisten akademik UNIPO. Jawab dalam bahasa Indonesia.` */
  sistem?: string | null;
  /** Dibatasi pengaturan penyedia Contoh: `2000` */
  maks_token?: number | null;
  /** Claude: low, medium, high, xhigh, max */
  effort?: string | null;
  /** Minta jawaban JSON (OpenAI/Gemini) */
  json?: boolean;
  /** Kode penyedia AI (kosong = utama) */
  penyedia?: string | null;
  /** Nama modul/aplikasi Anda Contoh: `lms` */
  modul?: string | null;
  [key: string]: any;
};

export type IntegrasiAiHasil = {
  /** Jawaban model */
  teks?: string | null;
  /** true = ditolak pengaman model */
  ditolak?: boolean;
  keterangan?: string | null;
  /** end_turn, max_tokens, refusal, stop, ... */
  alasan_berhenti?: string | null;
  /** Contoh: `claude-opus-5-5` */
  model?: string | null;
  penyedia?: string | null;
  driver?: string | null;
  token?: {
    masuk?: number | null;
    keluar?: number | null;
    [key: string]: any;
  };
  /** Durasi */
  ms?: number | null;
  [key: string]: any;
};

/** Kegiatan kalender (tabel kalender_kegiatan) */
export type KalenderKegiatan = {
  id?: number;
  judul?: string;
  jenis?: "akademik" | "perkuliahan" | "ujian" | "krs" | "nilai" | "libur" | "cuti_bersama" | "wisuda" | "pmb" | "keuangan" | "kemahasiswaan" | "rapat" | "lainnya";
  keterangan?: string;
  mulai?: string;
  selesai?: string;
  jam_mulai?: string;
  jam_selesai?: string;
  libur?: boolean;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  untuk?: string;
  lokasi?: string;
  tautan?: string;
  warna?: string;
  status?: "draf" | "terbit" | "batal";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KalenderKegiatanInput = {
  judul: string;
  jenis?: "akademik" | "perkuliahan" | "ujian" | "krs" | "nilai" | "libur" | "cuti_bersama" | "wisuda" | "pmb" | "keuangan" | "kemahasiswaan" | "rapat" | "lainnya";
  keterangan?: string;
  mulai: string;
  selesai?: string;
  jam_mulai?: string;
  jam_selesai?: string;
  libur?: boolean;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  untuk?: string;
  lokasi?: string;
  tautan?: string;
  warna?: string;
  status?: "draf" | "terbit" | "batal";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Profil karier (tabel karier_profil) */
export type KarierProfil = {
  id?: number;
  /** m_mahasiswa.NIM (unik) */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  judul_profil?: string;
  ringkasan?: string;
  keahlian?: JsonObject;
  bahasa?: JsonObject;
  minat_bidang?: string;
  lokasi_diinginkan?: string;
  status_kerja?: "mencari" | "terbuka" | "bekerja" | "studi_lanjut" | "wirausaha" | "tidak_mencari";
  linkedin?: string;
  portofolio?: string;
  tampil_ke_mitra?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierProfilInput = {
  /** m_mahasiswa.NIM (unik) */
  nim: string;
  judul_profil?: string;
  ringkasan?: string;
  keahlian?: JsonObject;
  bahasa?: JsonObject;
  minat_bidang?: string;
  lokasi_diinginkan?: string;
  status_kerja?: "mencari" | "terbuka" | "bekerja" | "studi_lanjut" | "wirausaha" | "tidak_mencari";
  linkedin?: string;
  portofolio?: string;
  tampil_ke_mitra?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Pengalaman (tabel karier_pengalaman) */
export type KarierPengalaman = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  jenis?: "kerja" | "magang" | "organisasi" | "proyek" | "pelatihan" | "sertifikasi" | "penghargaan" | "relawan" | "lainnya";
  judul?: string;
  instansi?: string;
  mulai?: string;
  selesai?: string;
  uraian?: string;
  nomor_kredensial?: string;
  tautan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierPengalamanInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  jenis: "kerja" | "magang" | "organisasi" | "proyek" | "pelatihan" | "sertifikasi" | "penghargaan" | "relawan" | "lainnya";
  judul: string;
  instansi?: string;
  mulai?: string;
  selesai?: string;
  uraian?: string;
  nomor_kredensial?: string;
  tautan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Lamaran kerja (tabel karier_lamaran) */
export type KarierLamaran = {
  id?: number;
  /** ID di tracer_lowongan */
  lowongan_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  surat_lamaran?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "dikirim" | "dilihat" | "seleksi" | "wawancara" | "diterima" | "ditolak" | "ditarik";
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierLamaranInput = {
  /** ID di tracer_lowongan */
  lowongan_id: number;
  /** m_mahasiswa.NIM */
  nim: string;
  surat_lamaran?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KarierLamaranTandaiDilihatInput = {
  catatan?: string;
  [key: string]: any;
};

export type KarierLamaranSeleksiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KarierLamaranWawancaraInput = {
  catatan?: string;
  [key: string]: any;
};

export type KarierLamaranTerimaInput = {
  catatan?: string;
  [key: string]: any;
};

export type KarierLamaranTolakInput = {
  catatan?: string;
  [key: string]: any;
};

/** Acara karier (tabel karier_acara) */
export type KarierAcara = {
  id?: number;
  judul?: string;
  jenis?: "job_fair" | "rekrutmen_kampus" | "pelatihan" | "sertifikasi" | "seminar" | "kunjungan_industri" | "lainnya";
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** ID di tracer_instansi */
  instansi_id?: number;
  deskripsi?: string;
  mulai?: string;
  selesai?: string;
  mode?: "luring" | "daring" | "hibrida";
  lokasi?: string;
  tautan?: string;
  kuota?: number;
  sasaran?: "mahasiswa" | "alumni" | "semua";
  status?: "draf" | "terbit" | "selesai" | "batal";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierAcaraInput = {
  judul: string;
  jenis?: "job_fair" | "rekrutmen_kampus" | "pelatihan" | "sertifikasi" | "seminar" | "kunjungan_industri" | "lainnya";
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** ID di tracer_instansi */
  instansi_id?: number;
  deskripsi?: string;
  mulai: string;
  selesai?: string;
  mode?: "luring" | "daring" | "hibrida";
  lokasi?: string;
  tautan?: string;
  kuota?: number;
  sasaran?: "mahasiswa" | "alumni" | "semua";
  status?: "draf" | "terbit" | "selesai" | "batal";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Pendaftar acara (tabel karier_acara_peserta) */
export type KarierPeserta = {
  id?: number;
  /** ID di karier_acara */
  acara_id?: number;
  /** user.username */
  username?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "terdaftar" | "hadir" | "batal";
  /** (hanya baca) Hanya dibaca. */
  sertifikat_nomor?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierPesertaInput = {
  /** ID di karier_acara */
  acara_id: number;
  /** user.username */
  username: string;
  [key: string]: any;
};

export type KarierPesertaHadirInput = {
  sertifikat_nomor?: string;
  [key: string]: any;
};

/** Perusahaan mitra (tabel karier_mitra) */
export type KarierMitra = {
  id?: number;
  /** ID di tracer_instansi (unik) */
  instansi_id?: number;
  /** ID di kerjasama_mitra */
  kerjasama_mitra_id?: number;
  status?: "calon" | "diundang" | "aktif" | "nonaktif";
  kategori?: "biasa" | "prioritas" | "strategis";
  bidang_rekrutmen?: string;
  prodi_sasaran?: string;
  pic_nama?: string;
  pic_jabatan?: string;
  pic_email?: string;
  pic_hp?: string;
  terakhir_kontak?: string;
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierMitraInput = {
  /** ID di tracer_instansi (unik) */
  instansi_id: number;
  /** ID di kerjasama_mitra */
  kerjasama_mitra_id?: number;
  status?: "calon" | "diundang" | "aktif" | "nonaktif";
  kategori?: "biasa" | "prioritas" | "strategis";
  bidang_rekrutmen?: string;
  prodi_sasaran?: string;
  pic_nama?: string;
  pic_jabatan?: string;
  pic_email?: string;
  pic_hp?: string;
  terakhir_kontak?: string;
  catatan?: string;
  [key: string]: any;
};

/** Interaksi dengan mitra (tabel karier_interaksi) */
export type KarierInteraksi = {
  id?: number;
  /** ID di karier_mitra */
  mitra_id?: number;
  jenis?: "kunjungan" | "rapat" | "email" | "telepon" | "pameran" | "mou" | "rekrutmen" | "magang" | "lainnya";
  tanggal?: string;
  ringkasan?: string;
  tindak_lanjut?: string;
  tenggat?: string;
  status?: "terbuka" | "selesai";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierInteraksiInput = {
  /** ID di karier_mitra */
  mitra_id: number;
  jenis?: "kunjungan" | "rapat" | "email" | "telepon" | "pameran" | "mou" | "rekrutmen" | "magang" | "lainnya";
  tanggal: string;
  ringkasan: string;
  tindak_lanjut?: string;
  tenggat?: string;
  status?: "terbuka" | "selesai";
  [key: string]: any;
};

/** Tips dan artikel karier (tabel karier_artikel) */
export type KarierArtikel = {
  id?: number;
  judul?: string;
  /** (unik) */
  slug?: string;
  kategori?: "cv_lamaran" | "wawancara" | "pengembangan_diri" | "dunia_kerja" | "wirausaha" | "studi_lanjut" | "lainnya";
  ringkasan?: string;
  isi?: string;
  penulis?: string;
  tag?: string;
  status?: "draf" | "terbit";
  /** (hanya baca) Hanya dibaca. */
  terbit_at?: string;
  /** (hanya baca) Hanya dibaca. */
  dibaca?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierArtikelInput = {
  judul: string;
  /** (unik) */
  slug?: string;
  kategori?: "cv_lamaran" | "wawancara" | "pengembangan_diri" | "dunia_kerja" | "wirausaha" | "studi_lanjut" | "lainnya";
  ringkasan?: string;
  isi: string;
  penulis?: string;
  tag?: string;
  status?: "draf" | "terbit";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Rekomendasi lulusan (tabel karier_rekomendasi) */
export type KarierRekomendasi = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** ID di tracer_lowongan */
  lowongan_id?: number;
  /** ID di karier_mitra */
  mitra_id?: number;
  skor?: number;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diusulkan" | "dikirim" | "diminati" | "ditolak" | "direkrut";
  /** (hanya baca) Hanya dibaca. */
  tanggapan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KarierRekomendasiInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** ID di tracer_lowongan */
  lowongan_id?: number;
  /** ID di karier_mitra */
  mitra_id?: number;
  skor?: number;
  alasan?: string;
  [key: string]: any;
};

export type KarierRekomendasiKirimInput = {
  tanggapan?: string;
  [key: string]: any;
};

export type KarierRekomendasiDiminatiInput = {
  tanggapan?: string;
  [key: string]: any;
};

export type KarierRekomendasiTolakInput = {
  tanggapan?: string;
  [key: string]: any;
};

export type KarierRekomendasiDirekrutInput = {
  tanggapan?: string;
  [key: string]: any;
};

/** Syarat kelulusan tambahan (tabel kls_syarat) */
export type KelulusanSyarat = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  untuk?: "yudisium" | "wisuda" | "keduanya";
  kode?: string;
  nama?: string;
  keterangan?: string;
  jenis?: "manual" | "unggah" | "poin_minimal" | "bebas_tunggakan" | "bebas_pustaka";
  nilai_minimal?: number;
  wajib?: boolean;
  urutan?: number;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanSyaratInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  untuk?: "yudisium" | "wisuda" | "keduanya";
  kode: string;
  nama: string;
  keterangan?: string;
  jenis?: "manual" | "unggah" | "poin_minimal" | "bebas_tunggakan" | "bebas_pustaka";
  nilai_minimal?: number;
  wajib?: boolean;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

/** Pemenuhan syarat mahasiswa (tabel kls_syarat_mhs) */
export type KelulusanSyaratMahasiswa = {
  id?: number;
  /** ID di kls_syarat */
  syarat_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  keterangan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "terpenuhi" | "ditolak";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanSyaratMahasiswaInput = {
  /** ID di kls_syarat */
  syarat_id: number;
  /** m_mahasiswa.NIM */
  nim: string;
  keterangan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KelulusanSyaratMahasiswaTerpenuhiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KelulusanSyaratMahasiswaTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Aturan poin kemahasiswaan (tabel kls_poin_aturan) */
export type KelulusanPoinAturan = {
  id?: number;
  kategori?: "prestasi" | "organisasi" | "kepanitiaan" | "seminar" | "pengabdian" | "kewirausahaan" | "sertifikasi" | "lainnya";
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  peran?: string;
  poin?: number;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanPoinAturanInput = {
  kategori: "prestasi" | "organisasi" | "kepanitiaan" | "seminar" | "pengabdian" | "kewirausahaan" | "sertifikasi" | "lainnya";
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  peran?: string;
  poin: number;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Kegiatan dan poin mahasiswa (tabel kls_poin) */
export type KelulusanPoin = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kategori?: "prestasi" | "organisasi" | "kepanitiaan" | "seminar" | "pengabdian" | "kewirausahaan" | "sertifikasi" | "lainnya";
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  peran?: string;
  nama_kegiatan?: string;
  nama_kegiatan_en?: string;
  penyelenggara?: string;
  tanggal?: string;
  /** (hanya pengelola) */
  poin?: number;
  tampil_skpi?: boolean;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "ditolak";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanPoinInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kategori: "prestasi" | "organisasi" | "kepanitiaan" | "seminar" | "pengabdian" | "kewirausahaan" | "sertifikasi" | "lainnya";
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  peran?: string;
  nama_kegiatan: string;
  nama_kegiatan_en?: string;
  penyelenggara?: string;
  tanggal?: string;
  /** (hanya pengelola) */
  poin?: number;
  tampil_skpi?: boolean;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KelulusanPoinVerifikasiInput = {
  poin?: number;
  catatan?: string;
  [key: string]: any;
};

export type KelulusanPoinTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** SKPI (tabel kls_skpi) */
export type KelulusanSkpi = {
  id?: number;
  /** m_mahasiswa.NIM (unik) */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  capaian?: JsonObject;
  informasi_tambahan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "disetujui" | "terbit" | "ditolak";
  /** (hanya baca) Hanya dibaca. */
  tanggal_terbit?: string;
  /** (hanya baca) Hanya dibaca. */
  kode_verifikasi?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanSkpiInput = {
  /** m_mahasiswa.NIM (unik) */
  nim: string;
  capaian?: JsonObject;
  informasi_tambahan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  [key: string]: any;
};

export type KelulusanSkpiSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KelulusanSkpiTerbitkanInput = {
  nomor?: string;
  tanggal_terbit?: string;
  [key: string]: any;
};

export type KelulusanSkpiTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Sertifikat profesi dan kompetensi (tabel kls_sertifikat) */
export type KelulusanSertifikat = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  jenis?: "profesi" | "kompetensi" | "keahlian" | "lainnya";
  nama?: string;
  nomor?: string;
  /** (unik) */
  nomor_pisn?: string;
  penerbit?: string;
  skema?: string;
  tanggal_terbit?: string;
  berlaku_sampai?: string;
  tampil_skpi?: boolean;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "ditolak";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KelulusanSertifikatInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  jenis?: "profesi" | "kompetensi" | "keahlian" | "lainnya";
  nama: string;
  nomor?: string;
  /** (unik) */
  nomor_pisn?: string;
  penerbit?: string;
  skema?: string;
  tanggal_terbit?: string;
  berlaku_sampai?: string;
  tampil_skpi?: boolean;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KelulusanSertifikatVerifikasiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KelulusanSertifikatTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Program beasiswa (tabel kmhs_beasiswa) */
export type KemahasiswaanBeasiswa = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "kip_kuliah" | "prestasi" | "ekonomi" | "yayasan" | "pemerintah_daerah" | "swasta" | "lainnya";
  penyelenggara?: string;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nominal?: number;
  periode_pencairan?: "sekali" | "bulanan" | "semester" | "tahunan";
  kuota?: number;
  ipk_minimal?: number;
  semester_minimal?: number;
  semester_maksimal?: number;
  syarat?: string;
  lampiran_minimal?: number;
  daftar_mulai?: string;
  daftar_selesai?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "buka" | "seleksi" | "berjalan" | "selesai";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanBeasiswaInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis: "kip_kuliah" | "prestasi" | "ekonomi" | "yayasan" | "pemerintah_daerah" | "swasta" | "lainnya";
  penyelenggara?: string;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** m_tahun.tahun_id */
  tahun_id: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  nominal?: number;
  periode_pencairan?: "sekali" | "bulanan" | "semester" | "tahunan";
  kuota?: number;
  ipk_minimal?: number;
  semester_minimal?: number;
  semester_maksimal?: number;
  syarat?: string;
  lampiran_minimal?: number;
  daftar_mulai?: string;
  daftar_selesai?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Pendaftar beasiswa (tabel kmhs_beasiswa_pendaftar) */
export type KemahasiswaanPendaftar = {
  id?: number;
  /** ID di kmhs_beasiswa */
  beasiswa_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** (hanya pengelola) */
  ipk?: number;
  semester?: number;
  penghasilan_ortu?: number;
  alasan?: string;
  /** (hanya pengelola) */
  skor?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "diterima" | "ditolak" | "dicabut";
  /** (hanya pengelola) */
  catatan?: string;
  /** Jumlah dokumen pendukung minimal (detail) */
  lampiran_wajib?: number;
  jumlah_lampiran?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanPendaftarInput = {
  /** ID di kmhs_beasiswa */
  beasiswa_id: number;
  /** m_mahasiswa.NIM */
  nim: string;
  /** (hanya pengelola) */
  ipk?: number;
  semester?: number;
  penghasilan_ortu?: number;
  alasan?: string;
  /** (hanya pengelola) */
  skor?: number;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan; ada jumlah minimal wajib (lihat lampiran_wajib di detail) */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KemahasiswaanPendaftarVerifikasiInput = {
  skor?: number;
  ipk?: number;
  [key: string]: any;
};

export type KemahasiswaanPendaftarTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type KemahasiswaanPendaftarCabutInput = {
  alasan: string;
  [key: string]: any;
};

/** Pencairan beasiswa (tabel kmhs_beasiswa_pencairan) */
export type KemahasiswaanPencairan = {
  id?: number;
  /** ID di kmhs_beasiswa_pendaftar */
  pendaftar_id?: number;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  tanggal?: string;
  nominal?: number;
  cara?: "transfer" | "potong_ukt" | "tunai" | "lainnya";
  status?: "rencana" | "dicairkan" | "gagal";
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanPencairanInput = {
  /** ID di kmhs_beasiswa_pendaftar */
  pendaftar_id: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  tanggal?: string;
  nominal: number;
  cara?: "transfer" | "potong_ukt" | "tunai" | "lainnya";
  status?: "rencana" | "dicairkan" | "gagal";
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Organisasi mahasiswa (tabel kmhs_ormawa) */
export type KemahasiswaanOrmawa = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "bem" | "dpm" | "hima" | "ukm" | "komunitas" | "lainnya";
  bidang?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_dosen.NIDN */
  pembina_nidn?: string;
  deskripsi?: string;
  email?: string;
  instagram?: string;
  nomor_sk?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanOrmawaInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis: "bem" | "dpm" | "hima" | "ukm" | "komunitas" | "lainnya";
  bidang?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_dosen.NIDN */
  pembina_nidn?: string;
  deskripsi?: string;
  email?: string;
  instagram?: string;
  nomor_sk?: string;
  aktif?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Pengurus organisasi (tabel kmhs_ormawa_pengurus) */
export type KemahasiswaanPengurus = {
  id?: number;
  /** ID di kmhs_ormawa */
  ormawa_id?: number;
  /** ID di kmhs_ormawa_periode */
  periode_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  jabatan_kode?: "ketua" | "wakil_ketua" | "sekretaris" | "wakil_sekretaris" | "bendahara" | "wakil_bendahara" | "koordinator" | "anggota" | "lainnya";
  divisi?: string;
  jabatan?: string;
  inti?: boolean;
  urut?: number;
  mulai?: string;
  selesai?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanPengurusInput = {
  /** ID di kmhs_ormawa */
  ormawa_id: number;
  /** ID di kmhs_ormawa_periode */
  periode_id?: number;
  /** m_mahasiswa.NIM */
  nim: string;
  jabatan_kode?: "ketua" | "wakil_ketua" | "sekretaris" | "wakil_sekretaris" | "bendahara" | "wakil_bendahara" | "koordinator" | "anggota" | "lainnya";
  divisi?: string;
  jabatan?: string;
  inti?: boolean;
  urut?: number;
  mulai?: string;
  selesai?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Kegiatan ormawa (proposal dan LPJ) (tabel kmhs_kegiatan) */
export type KemahasiswaanKegiatan = {
  id?: number;
  /** ID di kmhs_ormawa */
  ormawa_id?: number;
  /** m_mahasiswa.NIM */
  pengaju_nim?: string;
  nama?: string;
  jenis?: string;
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  mulai?: string;
  selesai?: string;
  lokasi?: string;
  jumlah_peserta?: number;
  tujuan?: string;
  anggaran_diajukan?: number;
  /** (hanya pengelola) */
  anggaran_disetujui?: number;
  realisasi?: number;
  laporan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "disetujui" | "ditolak" | "lpj_diajukan" | "selesai" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanKegiatanInput = {
  /** ID di kmhs_ormawa */
  ormawa_id: number;
  /** m_mahasiswa.NIM */
  pengaju_nim?: string;
  nama: string;
  jenis?: string;
  tingkat?: "internal" | "lokal" | "wilayah" | "nasional" | "internasional";
  mulai?: string;
  selesai?: string;
  lokasi?: string;
  jumlah_peserta?: number;
  tujuan?: string;
  anggaran_diajukan?: number;
  /** (hanya pengelola) */
  anggaran_disetujui?: number;
  realisasi?: number;
  laporan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KemahasiswaanKegiatanSetujuiInput = {
  anggaran_disetujui?: number;
  catatan?: string;
  [key: string]: any;
};

export type KemahasiswaanKegiatanTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type KemahasiswaanKegiatanKembalikanLpjInput = {
  alasan: string;
  [key: string]: any;
};

/** Prestasi mahasiswa (tabel kmhs_prestasi) */
export type KemahasiswaanPrestasi = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  nama_kegiatan?: string;
  penyelenggara?: string;
  tingkat?: "lokal" | "wilayah" | "nasional" | "internasional";
  kategori?: "akademik" | "non_akademik";
  bidang?: string;
  jenis?: "individu" | "kelompok";
  peringkat?: string;
  tanggal?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  url?: string;
  /** m_dosen.NIDN */
  pembimbing_nidn?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "ditolak";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanPrestasiInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  nama_kegiatan: string;
  penyelenggara?: string;
  tingkat: "lokal" | "wilayah" | "nasional" | "internasional";
  kategori?: "akademik" | "non_akademik";
  bidang?: string;
  jenis?: "individu" | "kelompok";
  peringkat: string;
  tanggal?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  url?: string;
  /** m_dosen.NIDN */
  pembimbing_nidn?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KemahasiswaanPrestasiTolakInput = {
  alasan: string;
  [key: string]: any;
};

/** Konseling (tabel kmhs_konseling) */
export type KemahasiswaanKonseling = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** user.username (hanya pengelola) */
  konselor?: string;
  jenis?: "akademik" | "pribadi" | "karier" | "keuangan" | "lainnya";
  topik?: string;
  uraian?: string;
  /** (hanya pengelola) */
  jadwal?: string;
  media?: "tatap_muka" | "daring" | "telepon";
  /** (hanya baca) Hanya dibaca. */
  catatan_konselor?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "dijadwalkan" | "selesai" | "dibatalkan";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanKonselingInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** user.username (hanya pengelola) */
  konselor?: string;
  jenis?: "akademik" | "pribadi" | "karier" | "keuangan" | "lainnya";
  topik: string;
  uraian?: string;
  /** (hanya pengelola) */
  jadwal?: string;
  media?: "tatap_muka" | "daring" | "telepon";
  [key: string]: any;
};

export type KemahasiswaanKonselingJadwalkanInput = {
  /** user.username */
  konselor: string;
  jadwal: string;
  media?: "tatap_muka" | "daring" | "telepon";
  [key: string]: any;
};

export type KemahasiswaanKonselingSelesaiInput = {
  catatan_konselor?: string;
  [key: string]: any;
};

/** Pelanggaran dan sanksi (tabel kmhs_pelanggaran) */
export type KemahasiswaanPelanggaran = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  tanggal?: string;
  jenis?: string;
  tingkat?: "ringan" | "sedang" | "berat";
  uraian?: string;
  sanksi?: string;
  sanksi_mulai?: string;
  sanksi_selesai?: string;
  nomor_sk?: string;
  status?: "proses" | "ditetapkan" | "selesai" | "dibatalkan";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KemahasiswaanPelanggaranInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  tanggal: string;
  jenis: string;
  tingkat?: "ringan" | "sedang" | "berat";
  uraian?: string;
  sanksi?: string;
  sanksi_mulai?: string;
  sanksi_selesai?: string;
  nomor_sk?: string;
  status?: "proses" | "ditetapkan" | "selesai" | "dibatalkan";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Mitra (tabel kerjasama_mitra) */
export type KerjasamaMitra = {
  id?: number;
  nama?: string;
  singkatan?: string;
  jenis?: "perguruan_tinggi" | "pemerintah" | "bumn_bumd" | "swasta" | "industri" | "organisasi" | "sekolah" | "rumah_sakit" | "lembaga_internasional" | "lainnya";
  lingkup?: "lokal" | "nasional" | "internasional";
  negara?: string;
  kota?: string;
  alamat?: string;
  situs?: string;
  email?: string;
  telepon?: string;
  bidang_usaha?: string;
  kontak_nama?: string;
  kontak_jabatan?: string;
  kontak_email?: string;
  kontak_hp?: string;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KerjasamaMitraInput = {
  nama: string;
  singkatan?: string;
  jenis?: "perguruan_tinggi" | "pemerintah" | "bumn_bumd" | "swasta" | "industri" | "organisasi" | "sekolah" | "rumah_sakit" | "lembaga_internasional" | "lainnya";
  lingkup?: "lokal" | "nasional" | "internasional";
  negara?: string;
  kota?: string;
  alamat?: string;
  situs?: string;
  email?: string;
  telepon?: string;
  bidang_usaha?: string;
  kontak_nama?: string;
  kontak_jabatan?: string;
  kontak_email?: string;
  kontak_hp?: string;
  keterangan?: string;
  aktif?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Dokumen kerja sama (tabel kerjasama_dokumen) */
export type KerjasamaDokumen = {
  id?: number;
  /** ID di kerjasama_dokumen */
  induk_id?: number;
  jenis?: "mou" | "moa" | "pks" | "ia" | "lainnya";
  nomor?: string;
  nomor_mitra?: string;
  judul?: string;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tingkat?: "lokal" | "nasional" | "internasional";
  bidang_pendidikan?: boolean;
  bidang_penelitian?: boolean;
  bidang_pkm?: boolean;
  bidang_lain?: boolean;
  ruang_lingkup?: string;
  tanggal_ttd?: string;
  mulai?: string;
  selesai?: string;
  nilai?: number;
  sumber_dana?: string;
  penandatangan?: string;
  penandatangan_mitra?: string;
  arsip_dokumen_id?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "aktif" | "berakhir" | "dibatalkan";
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KerjasamaDokumenInput = {
  /** ID di kerjasama_dokumen */
  induk_id?: number;
  jenis: "mou" | "moa" | "pks" | "ia" | "lainnya";
  nomor?: string;
  nomor_mitra?: string;
  judul: string;
  /** ID di kerjasama_mitra */
  mitra_id: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tingkat?: "lokal" | "nasional" | "internasional";
  bidang_pendidikan?: boolean;
  bidang_penelitian?: boolean;
  bidang_pkm?: boolean;
  bidang_lain?: boolean;
  ruang_lingkup?: string;
  tanggal_ttd?: string;
  mulai?: string;
  selesai?: string;
  nilai?: number;
  sumber_dana?: string;
  penandatangan?: string;
  penandatangan_mitra?: string;
  arsip_dokumen_id?: number;
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KerjasamaDokumenAkhiriInput = {
  tanggal?: string;
  [key: string]: any;
};

export type KerjasamaDokumenBatalkanInput = {
  alasan: string;
  [key: string]: any;
};

/** Pihak tambahan dokumen (tabel kerjasama_dokumen_mitra) */
export type KerjasamaDokumenMitra = {
  id?: number;
  /** ID di kerjasama_dokumen */
  dokumen_id?: number;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  peran?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KerjasamaDokumenMitraInput = {
  /** ID di kerjasama_dokumen */
  dokumen_id: number;
  /** ID di kerjasama_mitra */
  mitra_id: number;
  peran?: string;
  [key: string]: any;
};

/** Kegiatan pelaksanaan (tabel kerjasama_kegiatan) */
export type KerjasamaKegiatan = {
  id?: number;
  /** ID di kerjasama_dokumen */
  dokumen_id?: number;
  judul?: string;
  bidang?: "pendidikan" | "penelitian" | "pkm" | "mbkm" | "lainnya";
  bentuk?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  mulai?: string;
  selesai?: string;
  lokasi?: string;
  jumlah_mahasiswa?: number;
  jumlah_dosen?: number;
  manfaat?: string;
  luaran?: string;
  nilai?: number;
  status?: "rencana" | "berjalan" | "selesai" | "batal";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KerjasamaKegiatanInput = {
  /** ID di kerjasama_dokumen */
  dokumen_id: number;
  judul: string;
  bidang: "pendidikan" | "penelitian" | "pkm" | "mbkm" | "lainnya";
  bentuk?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  mulai?: string;
  selesai?: string;
  lokasi?: string;
  jumlah_mahasiswa?: number;
  jumlah_dosen?: number;
  manfaat?: string;
  luaran?: string;
  nilai?: number;
  status?: "rencana" | "berjalan" | "selesai" | "batal";
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Evaluasi kerja sama (tabel kerjasama_evaluasi) */
export type KerjasamaEvaluasi = {
  id?: number;
  /** ID di kerjasama_dokumen */
  dokumen_id?: number;
  tanggal?: string;
  skor?: number;
  rekomendasi?: "lanjut" | "perbaiki" | "hentikan";
  catatan?: string;
  evaluator?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KerjasamaEvaluasiInput = {
  /** ID di kerjasama_dokumen */
  dokumen_id: number;
  tanggal: string;
  skor?: number;
  rekomendasi?: "lanjut" | "perbaiki" | "hentikan";
  catatan?: string;
  evaluator?: string;
  [key: string]: any;
};

/** Akun (tabel keu_akun) */
export type KeuAkun = {
  id?: number;
  /** ID di keu_akun */
  induk_id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "pendapatan" | "belanja" | "aset" | "kewajiban" | "ekuitas";
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuAkunInput = {
  /** ID di keu_akun */
  induk_id?: number;
  /** (unik) */
  kode: string;
  nama: string;
  jenis: "pendapatan" | "belanja" | "aset" | "kewajiban" | "ekuitas";
  aktif?: boolean;
  [key: string]: any;
};

/** Periode anggaran (tabel keu_periode) */
export type KeuPeriode = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  mulai?: string;
  selesai?: string;
  status?: "perencanaan" | "berjalan" | "tutup";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuPeriodeInput = {
  /** (unik) */
  kode: string;
  nama: string;
  mulai: string;
  selesai: string;
  status?: "perencanaan" | "berjalan" | "tutup";
  [key: string]: any;
};

/** RKA unit (tabel keu_rka) */
export type KeuRka = {
  id?: number;
  /** ID di keu_periode */
  periode_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  judul?: string;
  /** (hanya baca) Hanya dibaca. */
  revisi_ke?: number;
  /** (hanya baca) Hanya dibaca. */
  total?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "revisi" | "disetujui" | "ditolak";
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  disetujui_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuRkaInput = {
  /** ID di keu_periode */
  periode_id: number;
  /** ID di induk_unit */
  unit_id: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  judul: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuRkaSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuRkaMintaRevisiInput = {
  catatan: string;
  [key: string]: any;
};

export type KeuRkaTolakInput = {
  alasan: string;
  [key: string]: any;
};

/** Rincian RKA (tabel keu_rka_item) */
export type KeuRkaItem = {
  id?: number;
  /** ID di keu_rka */
  rka_id?: number;
  /** ID di induk_unit (hanya baca) Hanya dibaca. */
  unit_id?: number;
  /** ID di keu_akun */
  akun_id?: number;
  kode?: string;
  kegiatan?: string;
  uraian?: string;
  volume?: number;
  satuan?: string;
  harga_satuan?: number;
  /** (hanya baca) Hanya dibaca. */
  jumlah?: number;
  sumber_dana?: string;
  bulan?: number;
  indikator?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuRkaItemInput = {
  /** ID di keu_rka */
  rka_id: number;
  /** ID di keu_akun */
  akun_id?: number;
  kode?: string;
  kegiatan: string;
  uraian?: string;
  volume?: number;
  satuan?: string;
  harga_satuan: number;
  sumber_dana?: string;
  bulan?: number;
  indikator?: string;
  [key: string]: any;
};

/** Pengajuan dana/realisasi (tabel keu_realisasi) */
export type KeuRealisasi = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** ID di keu_rka_item */
  rka_item_id?: number;
  /** ID di induk_unit (hanya baca) Hanya dibaca. */
  unit_id?: number;
  /** user.username */
  pengaju?: string;
  jenis?: "uang_muka" | "pembayaran_langsung" | "penggantian";
  tanggal?: string;
  uraian?: string;
  jumlah?: number;
  penerima?: string;
  rekening_penerima?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diverifikasi" | "disetujui" | "dibayar" | "selesai" | "ditolak" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  tanggal_bayar?: string;
  /** (hanya baca) Hanya dibaca. */
  nomor_bukti?: string;
  /** (hanya baca) Hanya dibaca. */
  jumlah_spj?: number;
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  diverifikasi_oleh?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  disetujui_oleh?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuRealisasiInput = {
  /** ID di keu_rka_item */
  rka_item_id: number;
  /** user.username */
  pengaju?: string;
  jenis?: "uang_muka" | "pembayaran_langsung" | "penggantian";
  tanggal: string;
  uraian: string;
  jumlah: number;
  penerima?: string;
  rekening_penerima?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuRealisasiVerifikasiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuRealisasiSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuRealisasiBayarInput = {
  tanggal_bayar: string;
  nomor_bukti?: string;
  [key: string]: any;
};

export type KeuRealisasiSpjInput = {
  jumlah_spj: number;
  catatan?: string;
  [key: string]: any;
};

export type KeuRealisasiTolakInput = {
  alasan: string;
  [key: string]: any;
};

/** Penerimaan lain (tabel keu_penerimaan) */
export type KeuPenerimaan = {
  id?: number;
  /** ID di keu_periode */
  periode_id?: number;
  /** ID di keu_akun */
  akun_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  tanggal?: string;
  sumber?: "hibah_pemerintah" | "hibah_swasta" | "kerja_sama" | "sewa" | "donasi" | "jasa_layanan" | "bunga_bank" | "lainnya";
  uraian?: string;
  jumlah?: number;
  nomor_bukti?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuPenerimaanInput = {
  /** ID di keu_periode */
  periode_id?: number;
  /** ID di keu_akun */
  akun_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  tanggal: string;
  sumber?: "hibah_pemerintah" | "hibah_swasta" | "kerja_sama" | "sewa" | "donasi" | "jasa_layanan" | "bunga_bank" | "lainnya";
  uraian: string;
  jumlah: number;
  nomor_bukti?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Virtual account (tabel keu_va) */
export type KeuVa = {
  id?: number;
  bank?: string;
  nomor_va?: string;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya?: string;
  keterangan?: string;
  jumlah?: number;
  /** (hanya baca) Hanya dibaca. */
  jumlah_dibayar?: number;
  berlaku_sampai?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "aktif" | "dibayar" | "kedaluwarsa" | "batal";
  /** (hanya baca) Hanya dibaca. */
  referensi_bank?: string;
  /** (hanya baca) Hanya dibaca. */
  dibayar_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  data_bank?: JsonObject;
  /** (hanya baca) Hanya dibaca. */
  sudah_dibukukan?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuVaInput = {
  bank: string;
  nomor_va: string;
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya?: string;
  keterangan?: string;
  jumlah: number;
  berlaku_sampai?: string;
  [key: string]: any;
};

/** Rekening kas/bank (tabel keu_rekening) */
export type KeuRekening = {
  id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di keu_akun */
  akun_id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "kas" | "kas_kecil" | "bank" | "virtual";
  bank?: string;
  nomor_rekening?: string;
  atas_nama?: string;
  saldo_awal?: number;
  tanggal_saldo_awal?: string;
  utama?: boolean;
  aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuRekeningInput = {
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di keu_akun */
  akun_id: number;
  /** (unik) */
  kode: string;
  nama: string;
  jenis?: "kas" | "kas_kecil" | "bank" | "virtual";
  bank?: string;
  nomor_rekening?: string;
  atas_nama?: string;
  saldo_awal?: number;
  tanggal_saldo_awal?: string;
  utama?: boolean;
  aktif?: boolean;
  keterangan?: string;
  [key: string]: any;
};

/** Pos laporan akun (tabel keu_akun_pos) */
export type KeuAkunPos = {
  id?: number;
  /** ID di keu_akun (unik) */
  akun_id?: number;
  pos?: "kas" | "piutang" | "aset_lancar_lain" | "aset_tetap" | "akumulasi_penyusutan" | "aset_lain" | "kewajiban_pendek" | "kewajiban_panjang" | "aset_neto_tanpa_pembatasan" | "aset_neto_dengan_pembatasan" | "pendapatan" | "beban" | "penghasilan_lain" | "beban_lain";
  arus_kas?: "operasi" | "investasi" | "pendanaan" | "bukan_kas";
  dengan_pembatasan?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuAkunPosInput = {
  /** ID di keu_akun (unik) */
  akun_id: number;
  pos: "kas" | "piutang" | "aset_lancar_lain" | "aset_tetap" | "akumulasi_penyusutan" | "aset_lain" | "kewajiban_pendek" | "kewajiban_panjang" | "aset_neto_tanpa_pembatasan" | "aset_neto_dengan_pembatasan" | "pendapatan" | "beban" | "penghasilan_lain" | "beban_lain";
  arus_kas?: "operasi" | "investasi" | "pendanaan" | "bukan_kas";
  dengan_pembatasan?: boolean;
  [key: string]: any;
};

/** Pemetaan jurnal otomatis (tabel keu_pemetaan) */
export type KeuPemetaan = {
  id?: number;
  jenis?: "biaya_mahasiswa" | "penerimaan" | "belanja" | "saldo_awal" | "gaji";
  kunci?: string;
  /** ID di keu_akun */
  akun_id?: number;
  /** ID di keu_rekening */
  rekening_id?: number;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuPemetaanInput = {
  jenis: "biaya_mahasiswa" | "penerimaan" | "belanja" | "saldo_awal" | "gaji";
  kunci?: string;
  /** ID di keu_akun */
  akun_id?: number;
  /** ID di keu_rekening */
  rekening_id?: number;
  keterangan?: string;
  [key: string]: any;
};

/** Periode pembayaran (tabel keu_mhs_periode) */
export type KeuanganPeriode = {
  id?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_biaya?: string;
  nama?: string;
  mulai?: string;
  jatuh_tempo?: string;
  denda_jenis?: "tidak_ada" | "tetap" | "per_hari" | "persen";
  denda_nilai?: number;
  denda_maks?: number;
  kode_biaya_denda?: string;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganPeriodeInput = {
  /** m_tahun.tahun_id */
  tahun_id: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_biaya?: string;
  nama: string;
  mulai: string;
  jatuh_tempo: string;
  denda_jenis?: "tidak_ada" | "tetap" | "per_hari" | "persen";
  denda_nilai?: number;
  denda_maks?: number;
  kode_biaya_denda?: string;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Kelompok UKT (tabel keu_mhs_ukt_kelompok) */
export type KeuanganUktKelompok = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  semester_masuk?: string;
  kelompok?: string;
  nama?: string;
  kode_biaya?: string;
  rupiah?: number;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganUktKelompokInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi: string;
  semester_masuk?: string;
  kelompok: string;
  nama?: string;
  kode_biaya: string;
  rupiah: number;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Penetapan UKT mahasiswa (tabel keu_mhs_ukt_mahasiswa) */
export type KeuanganUktMahasiswa = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** ID di keu_mhs_ukt_kelompok */
  kelompok_id?: number;
  /** m_tahun.tahun_id */
  berlaku_mulai?: string;
  dasar?: string;
  status?: "usulan" | "ditetapkan" | "dibatalkan";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganUktMahasiswaInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** ID di keu_mhs_ukt_kelompok */
  kelompok_id: number;
  /** m_tahun.tahun_id */
  berlaku_mulai?: string;
  dasar?: string;
  status?: "usulan" | "ditetapkan" | "dibatalkan";
  [key: string]: any;
};

/** Tarif per mata kuliah (tabel keu_mhs_tarif_mk) */
export type KeuanganTarifMk = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_mk?: string;
  kode_biaya?: string;
  dasar?: "per_sks" | "per_mk";
  rupiah?: number;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganTarifMkInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi: string;
  /** m_tahun.tahun_id */
  tahun_id: string;
  kode_mk?: string;
  kode_biaya: string;
  dasar?: "per_sks" | "per_mk";
  rupiah: number;
  keterangan?: string;
  [key: string]: any;
};

/** Voucher (tabel keu_mhs_voucher) */
export type KeuanganVoucher = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "nominal" | "persen";
  nilai?: number;
  maks_potongan?: number;
  kode_biaya?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kuota?: number;
  /** (hanya baca) Hanya dibaca. */
  terpakai?: number;
  berlaku_mulai?: string;
  berlaku_sampai?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganVoucherInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis?: "nominal" | "persen";
  nilai: number;
  maks_potongan?: number;
  kode_biaya?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kuota?: number;
  berlaku_mulai?: string;
  berlaku_sampai?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Potongan tagihan (tabel keu_mhs_potongan) */
export type KeuanganPotongan = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya?: string;
  jenis?: "potongan" | "beasiswa" | "voucher" | "lainnya";
  nominal?: number;
  persen?: number;
  /** ID di keu_mhs_voucher (hanya baca) Hanya dibaca. */
  voucher_id?: number;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diterapkan" | "ditolak" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  idmb_tagihan?: number;
  /** (hanya baca) Hanya dibaca. */
  rupiah_sebelum?: number;
  /** (hanya baca) Hanya dibaca. */
  rupiah_sesudah?: number;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganPotonganInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya: string;
  jenis?: "potongan" | "beasiswa" | "voucher" | "lainnya";
  nominal?: number;
  persen?: number;
  alasan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  [key: string]: any;
};

export type KeuanganPotonganTerapkanInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuanganPotonganTolakInput = {
  catatan: string;
  [key: string]: any;
};

export type KeuanganPotonganBatalkanInput = {
  catatan?: string;
  [key: string]: any;
};

/** Dispensasi pembayaran (tabel keu_mhs_dispensasi) */
export type KeuanganDispensasi = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  untuk?: "krs" | "ujian" | "semua";
  janji_bayar?: string;
  jumlah_janji?: number;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganDispensasiInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  untuk?: "krs" | "ujian" | "semua";
  janji_bayar?: string;
  jumlah_janji?: number;
  alasan: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuanganDispensasiSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuanganDispensasiTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Cicilan pembayaran (tabel keu_mhs_cicilan) */
export type KeuanganCicilan = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya?: string;
  /** (hanya baca) Hanya dibaca. */
  total?: number;
  jumlah_angsuran?: number;
  mulai?: string;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "lunas" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganCicilanInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  kode_biaya: string;
  jumlah_angsuran: number;
  mulai?: string;
  alasan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuanganCicilanSetujuiInput = {
  catatan?: string;
  mulai?: string;
  jumlah_angsuran?: number;
  [key: string]: any;
};

export type KeuanganCicilanTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Refund (tabel keu_mhs_refund) */
export type KeuanganRefund = {
  id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** ID di keu_mhs_transaksi */
  transaksi_id?: number;
  jumlah?: number;
  alasan?: string;
  tujuan?: "deposit" | "rekening";
  bank?: string;
  no_rekening?: string;
  atas_nama?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dibayar" | "dibatalkan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  bukti_bayar?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganRefundInput = {
  /** m_mahasiswa.NIM */
  nim: string;
  /** ID di keu_mhs_transaksi */
  transaksi_id?: number;
  jumlah: number;
  alasan: string;
  tujuan?: "deposit" | "rekening";
  bank?: string;
  no_rekening?: string;
  atas_nama?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuanganRefundSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuanganRefundBayarInput = {
  bukti_bayar?: string;
  catatan?: string;
  [key: string]: any;
};

export type KeuanganRefundTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Denda keterlambatan (tabel keu_mhs_denda) */
export type KeuanganDenda = {
  id?: number;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id (hanya baca) Hanya dibaca. */
  tahun_id?: string;
  /** (hanya baca) Hanya dibaca. */
  kode_biaya?: string;
  /** ID di keu_mhs_periode (hanya baca) Hanya dibaca. */
  periode_id?: number;
  /** (hanya baca) Hanya dibaca. */
  sisa?: number;
  /** (hanya baca) Hanya dibaca. */
  hari_telat?: number;
  /** (hanya baca) Hanya dibaca. */
  jumlah?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "aktif" | "dihapuskan";
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  dihitung_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganDendaInput = {
  /** (hanya pengelola) */
  catatan?: string;
  [key: string]: any;
};

export type KeuanganDendaHapuskanInput = {
  catatan: string;
  [key: string]: any;
};

/** Sesi kasir (tabel keu_mhs_kasir) */
export type KeuanganKasir = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  kasir?: string;
  /** (hanya baca) Hanya dibaca. */
  loket?: string;
  /** (hanya baca) Hanya dibaca. */
  dibuka_at?: string;
  /** (hanya baca) Hanya dibaca. */
  ditutup_at?: string;
  /** (hanya baca) Hanya dibaca. */
  saldo_awal?: number;
  /** (hanya baca) Hanya dibaca. */
  total_tunai?: number;
  /** (hanya baca) Hanya dibaca. */
  total_nontunai?: number;
  /** (hanya baca) Hanya dibaca. */
  jumlah_transaksi?: number;
  /** (hanya baca) Hanya dibaca. */
  setoran?: number;
  /** (hanya baca) Hanya dibaca. */
  selisih?: number;
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "buka" | "tutup";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganKasirInput = JsonObject;

/** Skema potongan, keringanan, dan beasiswa (tabel keu_mhs_skema_potongan) */
export type KeuanganSkemaPotongan = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  kategori?: "potongan" | "keringanan" | "beasiswa" | "prestasi" | "keluarga" | "kerjasama" | "lainnya";
  dasar?: "persen" | "nominal";
  nilai?: number;
  maks_nominal?: number;
  kode_biaya?: JsonObject;
  sasaran?: "maba" | "mahasiswa" | "semua";
  kode_prodi?: JsonObject;
  /** m_tahun.tahun_id */
  angkatan_min?: string;
  /** m_tahun.tahun_id */
  angkatan_maks?: string;
  lama_semester?: number;
  syarat?: JsonObject;
  wajib_sk?: boolean;
  perlu_verifikasi?: boolean;
  kuota?: number;
  daftar_mulai?: string;
  daftar_selesai?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di kmhs_beasiswa */
  beasiswa_id?: number;
  gabung?: boolean;
  status?: "draf" | "buka" | "tutup";
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganSkemaPotonganInput = {
  /** (unik) */
  kode: string;
  nama: string;
  kategori?: "potongan" | "keringanan" | "beasiswa" | "prestasi" | "keluarga" | "kerjasama" | "lainnya";
  dasar?: "persen" | "nominal";
  nilai: number;
  maks_nominal?: number;
  kode_biaya?: JsonObject;
  sasaran?: "maba" | "mahasiswa" | "semua";
  kode_prodi?: JsonObject;
  /** m_tahun.tahun_id */
  angkatan_min?: string;
  /** m_tahun.tahun_id */
  angkatan_maks?: string;
  lama_semester?: number;
  syarat?: JsonObject;
  wajib_sk?: boolean;
  perlu_verifikasi?: boolean;
  kuota?: number;
  daftar_mulai?: string;
  daftar_selesai?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di kmhs_beasiswa */
  beasiswa_id?: number;
  gabung?: boolean;
  status?: "draf" | "buka" | "tutup";
  keterangan?: string;
  [key: string]: any;
};

/** Pengajuan potongan/keringanan (tabel keu_mhs_pengajuan_potongan) */
export type KeuanganPengajuanPotongan = {
  id?: number;
  /** ID di keu_mhs_skema_potongan */
  skema_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** (hanya baca) Hanya dibaca. */
  pmb_pendaftaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  no_pmb?: string;
  /** (hanya baca) Hanya dibaca. */
  nama?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** (hanya baca) Hanya dibaca. */
  pengaju?: string;
  /** (hanya baca) Hanya dibaca. */
  sumber?: "pengajuan" | "beasiswa" | "petugas" | "pmb";
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "diverifikasi" | "disetujui" | "ditolak" | "dicabut" | "selesai";
  /** (hanya pengelola) */
  nomor_sk?: string;
  /** (hanya pengelola) */
  tanggal_sk?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_at?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_at?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  total_potongan?: number;
  /** (hanya baca) Hanya dibaca. */
  semester_terpakai?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganInput = {
  /** ID di keu_mhs_skema_potongan */
  skema_id: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  alasan?: string;
  /** (hanya pengelola) */
  nomor_sk?: string;
  /** (hanya pengelola) */
  tanggal_sk?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganKembalikanInput = {
  catatan: string;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganVerifikasiInput = {
  catatan?: string;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganSetujuiInput = {
  nomor_sk?: string;
  tanggal_sk?: string;
  catatan?: string;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganTolakInput = {
  catatan: string;
  [key: string]: any;
};

export type KeuanganPengajuanPotonganCabutInput = {
  catatan: string;
  kembalikan?: boolean;
  [key: string]: any;
};

/** Pemetaan biaya PMB ke jenis biaya (tabel keu_mhs_pemetaan_pmb) */
export type KeuanganPemetaanPmb = {
  id?: number;
  jenis?: "daftar_ulang" | "ukt" | "spp" | "pengembangan" | "almamater" | "lainnya";
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_biaya?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganPemetaanPmbInput = {
  jenis: "daftar_ulang" | "ukt" | "spp" | "pengembangan" | "almamater" | "lainnya";
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  kode_biaya: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Pengaturan keuangan mahasiswa (tabel keu_mhs_pengaturan) */
export type KeuanganPengaturan = {
  id?: number;
  /** (unik) */
  kunci?: string;
  nilai?: string;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type KeuanganPengaturanInput = {
  /** (unik) */
  kunci: string;
  nilai?: string;
  keterangan?: string;
  [key: string]: any;
};

export type Kurikulum = {
  id?: number | null;
  kode_jenjang?: string | null;
  status?: "draf" | "diajukan" | "disahkan" | "berlaku" | "arsip";
  versi?: number | null;
  induk_id?: number | null;
  sumber?: "baru" | "migrasi" | "salinan";
  nama_prodi?: string | null;
  jumlah_mk?: number | null;
  total_sks_mk?: number | null;
  jumlah_cpl?: number | null;
  disahkan_oleh?: string | null;
  disahkan_at?: string | null;
  jenjang?: JsonObject;
  ringkasan?: JsonObject;
  angkatan?: Array<number>;
  transisi_status?: Array<string>;
  dibuat_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  /** Wajib saat membuat Contoh: `55201` */
  kode_prodi?: string | null;
  /** Unik per prodi Contoh: `K2025` */
  kode?: string | null;
  /** Contoh: `Kurikulum OBE 2025` */
  nama?: string | null;
  nama_en?: string | null;
  tahun_berlaku?: number | null;
  /** Semester mulai berlaku Contoh: `20251` */
  tahun_id_mulai?: string | null;
  tahun_id_selesai?: string | null;
  regulasi?: string | null;
  no_sk?: string | null;
  tanggal_sk?: string | null;
  /** Semester */
  masa_tempuh?: number | null;
  /** Semester, maks. 2x masa tempuh */
  masa_studi_maks?: number | null;
  sks_lulus?: number | null;
  sks_wajib?: number | null;
  sks_pilihan?: number | null;
  ipk_min_lulus?: number | null;
  visi_keilmuan?: string | null;
  /** Pasal 9-10 */
  kompetensi_utama?: string | null;
  metode_pembelajaran?: string | null;
  modalitas_pembelajaran?: string | null;
  syarat_masuk?: string | null;
  penilaian?: string | null;
  /** Termasuk RPL */
  tata_cara_penerimaan?: string | null;
  tugas_akhir?: string | null;
  keterangan?: string | null;
  /** id_kurikulum Neo Feeder */
  id_kurikulum_feeder?: string | null;
  [key: string]: any;
};

export type KurikulumInput = {
  /** Wajib saat membuat Contoh: `55201` */
  kode_prodi: string | null;
  /** Unik per prodi Contoh: `K2025` */
  kode: string | null;
  /** Contoh: `Kurikulum OBE 2025` */
  nama: string | null;
  nama_en?: string | null;
  tahun_berlaku?: number | null;
  /** Semester mulai berlaku Contoh: `20251` */
  tahun_id_mulai?: string | null;
  tahun_id_selesai?: string | null;
  regulasi?: string | null;
  no_sk?: string | null;
  tanggal_sk?: string | null;
  /** Semester */
  masa_tempuh?: number | null;
  /** Semester, maks. 2x masa tempuh */
  masa_studi_maks?: number | null;
  sks_lulus?: number | null;
  sks_wajib?: number | null;
  sks_pilihan?: number | null;
  ipk_min_lulus?: number | null;
  visi_keilmuan?: string | null;
  /** Pasal 9-10 */
  kompetensi_utama?: string | null;
  metode_pembelajaran?: string | null;
  modalitas_pembelajaran?: string | null;
  syarat_masuk?: string | null;
  penilaian?: string | null;
  /** Termasuk RPL */
  tata_cara_penerimaan?: string | null;
  tugas_akhir?: string | null;
  keterangan?: string | null;
  /** id_kurikulum Neo Feeder */
  id_kurikulum_feeder?: string | null;
  [key: string]: any;
};

export type KurikulumStatus = {
  status: "draf" | "diajukan" | "disahkan" | "berlaku" | "arsip";
  no_sk?: string | null;
  tanggal_sk?: string | null;
  tahun_id_mulai?: string | null;
  tahun_id_selesai?: string | null;
  abaikan_galat?: boolean;
  [key: string]: any;
};

export type KurikulumProfil = {
  id?: number | null;
  kurikulum_id?: number | null;
  /** Contoh: `PL1` */
  kode?: string | null;
  /** Contoh: `Pengembang perangkat lunak` */
  nama?: string | null;
  deskripsi?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumProfilInput = {
  kode: string | null;
  nama: string | null;
  deskripsi?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumCpl = {
  id?: number | null;
  kurikulum_id?: number | null;
  /** Contoh: `CPL1` */
  kode?: string | null;
  ranah?: "sikap" | "pengetahuan" | "keterampilan_umum" | "keterampilan_khusus";
  /** Pasal 7: a, b, c, d */
  kelompok_sn?: string | null;
  deskripsi?: string | null;
  deskripsi_en?: string | null;
  /** sn_dikti, kkni, asosiasi, prodi, dudika */
  sumber?: string | null;
  /** Batas tercapai 0-100 */
  target?: number | null;
  urutan?: number | null;
  mata_kuliah?: Array<{
    mk_id?: number | null;
    kode_mk?: string | null;
    nama?: string | null;
    bobot?: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumCplInput = {
  kode: string | null;
  ranah: "sikap" | "pengetahuan" | "keterampilan_umum" | "keterampilan_khusus";
  kelompok_sn?: "a" | "b" | "c" | "d";
  deskripsi: string | null;
  deskripsi_en?: string | null;
  sumber?: "sn_dikti" | "kkni" | "asosiasi" | "prodi" | "dudika";
  target?: number | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumBk = {
  id?: number | null;
  kurikulum_id?: number | null;
  /** Contoh: `BK1` */
  kode?: string | null;
  nama?: string | null;
  deskripsi?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumBkInput = {
  kode: string | null;
  nama: string | null;
  deskripsi?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumMatriks = {
  pasangan?: Array<JsonObject>;
  tambah?: Array<JsonObject>;
  hapus?: Array<JsonObject>;
  [key: string]: any;
};

export type KurikulumMk = {
  id?: number | null;
  kurikulum_id?: number | null;
  /** m_mata_kuliah.id sumber impor */
  legacy_id?: number | null;
  legacy_tahun_id?: string | null;
  jumlah_cpmk?: number | null;
  cpl?: Array<string>;
  prasyarat?: Array<JsonObject>;
  status_rps?: string | null;
  cpmk?: Array<{
    id?: number | null;
    mk_id?: number | null;
    /** Contoh: `CPMK1` */
    kode?: string | null;
    deskripsi?: string | null;
    target?: number | null;
    urutan?: number | null;
    cpl?: Array<{
      cpl_id?: number | null;
      kode?: string | null;
      bobot?: number | null;
      [key: string]: any;
    }>;
    sub_cpmk?: Array<{
      id?: number | null;
      kode?: string | null;
      deskripsi?: string | null;
      indikator?: string | null;
      urutan?: number | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  bahan_kajian?: Array<JsonObject>;
  rps?: Array<JsonObject>;
  kurikulum?: JsonObject;
  /** Contoh: `IF101` */
  kode_mk?: string | null;
  /** Contoh: `Algoritma dan Pemrograman` */
  nama?: string | null;
  nama_en?: string | null;
  /** 1-14, null = pilihan bebas */
  semester?: number | null;
  /** Total */
  sks?: number | null;
  sks_tatap_muka?: number | null;
  sks_praktikum?: number | null;
  sks_praktik_lapangan?: number | null;
  sks_simulasi?: number | null;
  /** A wajib, B pilihan, C wajib peminatan, D pilihan peminatan, S tugas akhir, W wajib nasional */
  jenis?: "A" | "B" | "C" | "D" | "S" | "W";
  /** Kelompok MK lama (r_kode 10) */
  kelompok?: string | null;
  /** A inti, B institusi */
  kode_kurikulum?: string | null;
  /** Konsentrasi (m_kosentrasi.idks) */
  idks?: string | null;
  bentuk_nilai?: "ip" | "lulus";
  modalitas?: "luring" | "daring" | "bauran";
  /** kuliah, responsi, tutorial, seminar, praktikum, praktik, studio, penelitian, perancangan, pengembangan, tugas_akhir, pelatihan_bela_negara, pertukaran_pelajar, magang, wirausaha, pengabdian_masyarakat, proyek, lainnya */
  bentuk_pembelajaran?: Array<string>;
  /** Dapat ditempuh di luar prodi/PT */
  luar_prodi?: boolean;
  pertemuan?: number | null;
  deskripsi?: string | null;
  nidn_koordinator?: string | null;
  id_matkul_feeder?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumMkInput = {
  /** Contoh: `IF101` */
  kode_mk: string | null;
  /** Contoh: `Algoritma dan Pemrograman` */
  nama: string | null;
  nama_en?: string | null;
  /** 1-14, null = pilihan bebas */
  semester?: number | null;
  /** Total */
  sks?: number | null;
  sks_tatap_muka?: number | null;
  sks_praktikum?: number | null;
  sks_praktik_lapangan?: number | null;
  sks_simulasi?: number | null;
  /** A wajib, B pilihan, C wajib peminatan, D pilihan peminatan, S tugas akhir, W wajib nasional */
  jenis: "A" | "B" | "C" | "D" | "S" | "W";
  /** Kelompok MK lama (r_kode 10) */
  kelompok?: string | null;
  /** A inti, B institusi */
  kode_kurikulum?: string | null;
  /** Konsentrasi (m_kosentrasi.idks) */
  idks?: string | null;
  bentuk_nilai?: "ip" | "lulus";
  modalitas?: "luring" | "daring" | "bauran";
  /** kuliah, responsi, tutorial, seminar, praktikum, praktik, studio, penelitian, perancangan, pengembangan, tugas_akhir, pelatihan_bela_negara, pertukaran_pelajar, magang, wirausaha, pengabdian_masyarakat, proyek, lainnya */
  bentuk_pembelajaran?: Array<string>;
  /** Dapat ditempuh di luar prodi/PT */
  luar_prodi?: boolean;
  pertemuan?: number | null;
  deskripsi?: string | null;
  nidn_koordinator?: string | null;
  id_matkul_feeder?: string | null;
  urutan?: number | null;
  [key: string]: any;
};

export type KurikulumCpmk = {
  id?: number | null;
  mk_id?: number | null;
  /** Contoh: `CPMK1` */
  kode?: string | null;
  deskripsi?: string | null;
  target?: number | null;
  urutan?: number | null;
  cpl?: Array<{
    cpl_id?: number | null;
    kode?: string | null;
    bobot?: number | null;
    [key: string]: any;
  }>;
  sub_cpmk?: Array<{
    id?: number | null;
    kode?: string | null;
    deskripsi?: string | null;
    indikator?: string | null;
    urutan?: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumCpmkInput = {
  kode: string | null;
  deskripsi: string | null;
  target?: number | null;
  urutan?: number | null;
  cpl?: Array<{
    cpl_id?: number | null;
    bobot?: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumRps = {
  id?: number | null;
  mk_id?: number | null;
  versi?: number | null;
  status?: "draf" | "disahkan" | "arsip";
  disahkan_oleh?: string | null;
  disahkan_at?: string | null;
  mata_kuliah?: JsonObject;
  cpl?: Array<JsonObject>;
  cpmk?: Array<{
    id?: number | null;
    mk_id?: number | null;
    /** Contoh: `CPMK1` */
    kode?: string | null;
    deskripsi?: string | null;
    target?: number | null;
    urutan?: number | null;
    cpl?: Array<{
      cpl_id?: number | null;
      kode?: string | null;
      bobot?: number | null;
      [key: string]: any;
    }>;
    sub_cpmk?: Array<{
      id?: number | null;
      kode?: string | null;
      deskripsi?: string | null;
      indikator?: string | null;
      urutan?: number | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  pertemuan?: Array<{
    pertemuan_ke: number | null;
    sampai_ke?: number | null;
    sub_cpmk_id?: number | null;
    materi?: string | null;
    materi_en?: string | null;
    indikator?: string | null;
    kriteria_penilaian?: string | null;
    metode?: string | null;
    modalitas?: "luring" | "daring" | "bauran";
    waktu_menit?: number | null;
    penugasan?: string | null;
    pustaka?: string | null;
    /** % */
    bobot?: number | null;
    ujian?: boolean;
    [key: string]: any;
  }>;
  evaluasi?: Array<{
    /** 1 aktivitas partisipatif, 2 hasil proyek, 3 kognitif tugas, 4 kognitif ujian */
    jenis_evaluasi: number | null;
    nama: string | null;
    nama_en?: string | null;
    deskripsi?: string | null;
    /** % */
    bobot: number | null;
    komponen_siakad?: "Harian" | "Tugas" | "HDR" | "UTS" | "UAS";
    cpmk?: Array<{
      cpmk_id?: number | null;
      bobot?: number | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  total_bobot_evaluasi?: number | null;
  total_bobot_pertemuan?: number | null;
  tahun_id?: string | null;
  deskripsi?: string | null;
  materi_pokok?: string | null;
  pustaka_utama?: Array<string>;
  pustaka_pendukung?: Array<string>;
  media_perangkat_lunak?: string | null;
  media_perangkat_keras?: string | null;
  dosen_pengampu?: Array<string>;
  nidn_penyusun?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type KurikulumRpsInput = {
  tahun_id?: string | null;
  deskripsi?: string | null;
  materi_pokok?: string | null;
  pustaka_utama?: Array<string>;
  pustaka_pendukung?: Array<string>;
  media_perangkat_lunak?: string | null;
  media_perangkat_keras?: string | null;
  dosen_pengampu?: Array<string>;
  nidn_penyusun?: string | null;
  catatan?: string | null;
  /** ID RPS sumber (hanya saat membuat) */
  salin_dari?: number | null;
  [key: string]: any;
};

export type KurikulumRpsPertemuan = {
  pertemuan: Array<{
    pertemuan_ke: number | null;
    sampai_ke?: number | null;
    sub_cpmk_id?: number | null;
    materi?: string | null;
    materi_en?: string | null;
    indikator?: string | null;
    kriteria_penilaian?: string | null;
    metode?: string | null;
    modalitas?: "luring" | "daring" | "bauran";
    waktu_menit?: number | null;
    penugasan?: string | null;
    pustaka?: string | null;
    /** % */
    bobot?: number | null;
    ujian?: boolean;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumRpsEvaluasi = {
  evaluasi: Array<{
    /** 1 aktivitas partisipatif, 2 hasil proyek, 3 kognitif tugas, 4 kognitif ujian */
    jenis_evaluasi: number | null;
    nama: string | null;
    nama_en?: string | null;
    deskripsi?: string | null;
    /** % */
    bobot: number | null;
    komponen_siakad?: "Harian" | "Tugas" | "HDR" | "UTS" | "UAS";
    cpmk?: Array<{
      cpmk_id?: number | null;
      bobot?: number | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  izinkan_total_bukan_100?: boolean;
  [key: string]: any;
};

export type KurikulumEkuivalensi = {
  id?: number | null;
  kurikulum_id?: number | null;
  mk_id?: number | null;
  kode_mk?: string | null;
  nama_mk?: string | null;
  sks_mk?: number | null;
  kode_mk_lama?: string | null;
  nama_mk_lama?: string | null;
  sks_lama?: number | null;
  kurikulum_lama_id?: number | null;
  tahun_id_lama?: string | null;
  jenis?: "setara" | "gabung" | "pecah" | "dihapus";
  catatan?: string | null;
  [key: string]: any;
};

export type KurikulumEkuivalensiInput = {
  kode_mk_lama: string | null;
  nama_mk_lama?: string | null;
  sks_lama?: number | null;
  mk_id?: number | null;
  kurikulum_lama_id?: number | null;
  tahun_id_lama?: string | null;
  jenis?: "setara" | "gabung" | "pecah" | "dihapus";
  catatan?: string | null;
  [key: string]: any;
};

export type KurikulumPeninjauanInput = {
  jenis?: "evaluasi_tahunan" | "peninjauan" | "audit_mutu" | "masukan_pemangku" | "lainnya";
  judul: string | null;
  tanggal?: string | null;
  pelaksana?: string | null;
  ringkasan?: string | null;
  temuan?: string | null;
  tindak_lanjut?: string | null;
  status?: "rencana" | "berjalan" | "selesai";
  tautan_dokumen?: string | null;
  [key: string]: any;
};

export type KurikulumValidasi = {
  ringkasan?: {
    galat?: number | null;
    peringatan?: number | null;
    info?: number | null;
    regulasi?: string | null;
    jenjang?: string | null;
    sks_wajib_mk?: number | null;
    sks_pilihan_mk?: number | null;
    jumlah_mk?: number | null;
    jumlah_cpl?: number | null;
    kelengkapan_persen?: number | null;
    siap_disahkan?: boolean;
    [key: string]: any;
  };
  temuan?: Array<{
    tingkat?: "galat" | "peringatan" | "info";
    kode?: string | null;
    pesan?: string | null;
    pasal?: string | null;
    data?: JsonObject;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumCapaian = {
  kurikulum_id?: number | null;
  angkatan?: number | null;
  sampai_tahun_id?: string | null;
  metode?: string | null;
  cpl?: Array<{
    cpl_id?: number | null;
    kode?: string | null;
    ranah?: string | null;
    deskripsi?: string | null;
    target?: number | null;
    jumlah_mk?: number | null;
    jumlah_mahasiswa?: number | null;
    rata_rata?: number | null;
    persen_tercapai?: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumMigrasi = {
  id?: number | null;
  jenis?: "impor" | "terbit";
  kode_prodi?: string | null;
  kurikulum_id?: number | null;
  tahun_id?: string | null;
  opsi?: JsonObject;
  ringkasan?: JsonObject;
  status?: "selesai" | "dibatalkan";
  oleh?: string | null;
  dibatalkan_oleh?: string | null;
  dibatalkan_at?: string | null;
  created_at?: string | null;
  baris?: Array<{
    tabel?: string | null;
    aksi?: "tambah" | "ubah";
    baris_id?: number | null;
    kunci?: JsonObject;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type KurikulumMigrasiImpor = {
  /** Contoh: `55201` */
  kode_prodi: string | null;
  /** Semester sumber: "20251" atau ["20251","20252"] */
  tahun_id: string | Array<string>;
  /** Sinkron ke kurikulum draf yang ada */
  kurikulum_id?: number | null;
  kurikulum?: {
    kode?: string | null;
    nama?: string | null;
    tahun_berlaku?: number | null;
    [key: string]: any;
  };
  /** false = pratinjau */
  jalankan?: boolean;
  [key: string]: any;
};

export type KurikulumMigrasiTerbit = {
  kurikulum_id: number | null;
  /** Semester tujuan Contoh: `20261` */
  tahun_id: string | null;
  /** semua (bawaan), ganjil, genap, atau daftar semester paket [1,3,5] */
  semester?: any;
  mk_id?: Array<number>;
  /** Perbarui baris buatan terbit sebelumnya */
  perbarui?: boolean;
  /** Bulatkan SKS desimal (tabel lama bilangan bulat) */
  bulatkan_sks?: boolean;
  abaikan_galat?: boolean;
  /** false = pratinjau */
  jalankan?: boolean;
  [key: string]: any;
};

export type KurikulumMigrasiHasil = {
  pratinjau?: boolean;
  ringkasan?: JsonObject;
  rencana?: JsonObject;
  catatan?: string | null;
  [key: string]: any;
};

/** Jenis layanan (tabel layanan_jenis) */
export type LayananJenis = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  kategori?: "akademik" | "keuangan" | "kemahasiswaan" | "kepegawaian" | "umum";
  untuk?: string;
  /** ID di induk_unit */
  unit_id?: number;
  keterangan?: string;
  syarat?: string;
  isian?: JsonObject;
  biaya?: number;
  sla_hari?: number;
  wajib_berkas?: boolean;
  terbitkan_dokumen?: boolean;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type LayananJenisInput = {
  /** (unik) */
  kode: string;
  nama: string;
  kategori?: "akademik" | "keuangan" | "kemahasiswaan" | "kepegawaian" | "umum";
  untuk?: string;
  /** ID di induk_unit */
  unit_id?: number;
  keterangan?: string;
  syarat?: string;
  isian?: JsonObject;
  biaya?: number;
  sla_hari?: number;
  wajib_berkas?: boolean;
  terbitkan_dokumen?: boolean;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Permohonan layanan (tabel layanan_permohonan) */
export type LayananPermohonan = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** ID di layanan_jenis */
  jenis_id?: number;
  /** ID di induk_unit (hanya baca) Hanya dibaca. */
  unit_id?: number;
  /** user.username */
  pemohon?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  keperluan?: string;
  data?: JsonObject;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "diproses" | "perlu_perbaikan" | "selesai" | "ditolak" | "dibatalkan";
  /** user.username (hanya pengelola) */
  petugas?: string;
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  tenggat?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  dokumen_id?: number;
  /** Jumlah dokumen pendukung minimal (detail) */
  lampiran_wajib?: number;
  jumlah_lampiran?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type LayananPermohonanInput = {
  /** ID di layanan_jenis */
  jenis_id: number;
  /** user.username */
  pemohon: string;
  keperluan?: string;
  data?: JsonObject;
  /** user.username (hanya pengelola) */
  petugas?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan; ada jumlah minimal wajib (lihat lampiran_wajib di detail) */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type LayananPermohonanProsesInput = {
  catatan?: string;
  [key: string]: any;
};

export type LayananPermohonanMintaPerbaikanInput = {
  catatan: string;
  [key: string]: any;
};

export type LayananPermohonanKirimUlangInput = {
  catatan?: string;
  [key: string]: any;
};

export type LayananPermohonanSelesaiInput = {
  catatan?: string;
  nomor_dokumen?: string;
  judul_dokumen?: string;
  penandatangan?: string;
  berlaku_sampai?: string;
  [key: string]: any;
};

export type LayananPermohonanTolakInput = {
  alasan: string;
  [key: string]: any;
};

/** Dokumen terverifikasi (tabel layanan_dokumen) */
export type LayananDokumen = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  kode?: string;
  jenis?: "surat_keterangan" | "surat" | "transkrip" | "ijazah" | "skpi" | "sertifikat" | "lainnya";
  nomor?: string;
  judul?: string;
  pemilik_nama?: string;
  /** user.username */
  pemilik_username?: string;
  tanggal_terbit?: string;
  berlaku_sampai?: string;
  /** ID di induk_unit */
  unit_id?: number;
  penandatangan?: string;
  sha256?: string;
  /** ID di layanan_permohonan (hanya baca) Hanya dibaca. */
  permohonan_id?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "sah" | "dicabut";
  /** (hanya baca) Hanya dibaca. */
  alasan_cabut?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type LayananDokumenInput = {
  jenis: "surat_keterangan" | "surat" | "transkrip" | "ijazah" | "skpi" | "sertifikat" | "lainnya";
  nomor?: string;
  judul: string;
  pemilik_nama?: string;
  /** user.username */
  pemilik_username?: string;
  tanggal_terbit: string;
  berlaku_sampai?: string;
  /** ID di induk_unit */
  unit_id?: number;
  penandatangan?: string;
  sha256?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type LayananDokumenCabutInput = {
  alasan: string;
  [key: string]: any;
};

export type LmsSaya = {
  pengguna?: {
    username?: string | null;
    nama?: string | null;
    level?: string | null;
    [key: string]: any;
  };
  jumlah_kelas?: number | null;
  notifikasi_belum_dibaca?: number | null;
  tugas_mendatang?: Array<{
    id?: number | null;
    kelas_id?: number | null;
    kelas?: string | null;
    judul?: string | null;
    tenggat?: string | null;
    status_jawaban?: string | null;
    [key: string]: any;
  }>;
  kuis_terbuka?: Array<{
    id?: number | null;
    kelas_id?: number | null;
    kelas?: string | null;
    judul?: string | null;
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  }>;
  /** Pengajar: jawaban tugas belum dinilai + percobaan kuis perlu koreksi */
  perlu_dinilai?: number | null;
  [key: string]: any;
};

export type LmsAcara = {
  jenis?: "tugas" | "kuis" | "konferensi" | "presensi";
  id?: number | null;
  kelas_id?: number | null;
  kelas?: string | null;
  judul?: string | null;
  waktu?: string | null;
  selesai?: string | null;
  tautan?: string | null;
  [key: string]: any;
};

export type LmsNotifikasi = {
  id?: number | null;
  kelas_id?: number | null;
  /** mis. tugas.baru, tugas.dinilai, pengumuman, forum.balasan */
  jenis?: string | null;
  judul?: string | null;
  isi?: string | null;
  /** Path API objek terkait */
  tautan?: string | null;
  dibaca_at?: string | null;
  created_at?: string | null;
  [key: string]: any;
};

export type LmsNotifikasiBaca = {
  id?: Array<number>;
  semua?: boolean;
  [key: string]: any;
};

export type LmsKelas = {
  id?: number | null;
  /** ID jadwal SIAKAD (null = kelas non-jadwal) */
  idj?: number | null;
  /** Contoh: `20261` */
  tahun_id?: string | null;
  kode_prodi?: string | null;
  kode_mk?: string | null;
  kelas?: string | null;
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  ringkasan?: string | null;
  format?: "mingguan" | "topik";
  status?: "draf" | "aktif" | "selesai" | "arsip";
  /** Hanya untuk pengelola */
  kode_gabung?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  pengaturan?: JsonObject | null;
  /** Peran pemilik token di kelas */
  peran?: "admin" | "pengajar" | "asisten" | "mahasiswa" | "pengamat";
  sampul_url?: string | null;
  /** Data t_jadwal + nama MK, SKS, dosen (detail) */
  jadwal?: JsonObject | null;
  jumlah?: {
    materi?: number | null;
    tugas?: number | null;
    kuis?: number | null;
    forum?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type LmsKelasBaru = {
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  ringkasan?: string | null;
  kode_prodi?: string | null;
  kode_mk?: string | null;
  tahun_id?: string | null;
  kelas?: string | null;
  format?: "mingguan" | "topik";
  status?: "draf" | "aktif";
  mulai?: string | null;
  selesai?: string | null;
  /** true = buat kode bergabung */
  kode_gabung?: boolean;
  pengaturan?: JsonObject;
  [key: string]: any;
};

export type LmsKelasUbah = {
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  ringkasan?: string | null;
  format?: "mingguan" | "topik";
  status?: "draf" | "aktif" | "selesai" | "arsip";
  mulai?: string | null;
  selesai?: string | null;
  pengaturan?: JsonObject;
  /** File konteks sampul di kelas ini */
  sampul_file_id?: number | null;
  kode_gabung?: "baru" | "hapus";
  [key: string]: any;
};

export type LmsDariJadwal = {
  /** ID jadwal SIAKAD */
  idj: number | null;
  /** Bawaan: nama MK - Kelas X */
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  ringkasan?: string | null;
  status?: "draf" | "aktif";
  [key: string]: any;
};

export type LmsSinkronJadwal = {
  /** Contoh: `20261` */
  tahun_id: string | null;
  prodi?: string | null;
  status?: "draf" | "aktif";
  [key: string]: any;
};

export type LmsGabung = {
  /** Kode dari pengajar Contoh: `K7XM2QD` */
  kode: string | null;
  [key: string]: any;
};

export type LmsAnggota = {
  username?: string | null;
  nama?: string | null;
  /** Peran pemilik token di kelas */
  peran?: "admin" | "pengajar" | "asisten" | "mahasiswa" | "pengamat";
  /** jadwal, krs, manual, kode_gabung (hanya pengelola) */
  sumber?: string | null;
  [key: string]: any;
};

export type LmsAnggotaBaru = {
  username: string | null;
  peran: "pengajar" | "asisten" | "mahasiswa" | "pengamat";
  [key: string]: any;
};

export type LmsKonten = {
  kelas?: {
    id?: number | null;
    /** ID jadwal SIAKAD (null = kelas non-jadwal) */
    idj?: number | null;
    /** Contoh: `20261` */
    tahun_id?: string | null;
    kode_prodi?: string | null;
    kode_mk?: string | null;
    kelas?: string | null;
    judul?: string | null;
    /** HTML; tag/atribut berbahaya dibuang server */
    ringkasan?: string | null;
    format?: "mingguan" | "topik";
    status?: "draf" | "aktif" | "selesai" | "arsip";
    /** Hanya untuk pengelola */
    kode_gabung?: string | null;
    mulai?: string | null;
    selesai?: string | null;
    pengaturan?: JsonObject | null;
    /** Peran pemilik token di kelas */
    peran?: "admin" | "pengajar" | "asisten" | "mahasiswa" | "pengamat";
    sampul_url?: string | null;
    /** Data t_jadwal + nama MK, SKS, dosen (detail) */
    jadwal?: JsonObject | null;
    jumlah?: {
      materi?: number | null;
      tugas?: number | null;
      kuis?: number | null;
      forum?: number | null;
      [key: string]: any;
    };
    [key: string]: any;
  };
  /** Peran pemilik token di kelas */
  peran?: "admin" | "pengajar" | "asisten" | "mahasiswa" | "pengamat";
  umum?: {
    item?: Array<JsonObject>;
    presensi?: Array<JsonObject>;
    [key: string]: any;
  };
  topik?: Array<{
    id?: number | null;
    urutan?: number | null;
    pertemuan_ke?: number | null;
    judul?: string | null;
    /** HTML; tag/atribut berbahaya dibuang server */
    deskripsi?: string | null;
    tanggal?: string | null;
    tampil?: boolean;
    item?: Array<{
      tipe?: "materi" | "tugas" | "kuis" | "forum";
      id?: number | null;
      judul?: string | null;
      progres?: JsonObject | null;
      [key: string]: any;
    }>;
    presensi?: Array<JsonObject>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LmsTopik = {
  id?: number | null;
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  deskripsi?: string | null;
  urutan?: number | null;
  pertemuan_ke?: number | null;
  tanggal?: string | null;
  tampil?: boolean;
  [key: string]: any;
};

export type LmsMateri = {
  id?: number | null;
  kelas_id?: number | null;
  topik_id?: number | null;
  jenis?: "teks" | "file" | "tautan" | "video" | "konferensi";
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  konten?: string | null;
  url?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  wajib_selesai?: boolean;
  urutan?: number | null;
  tampil?: boolean;
  tersedia_mulai?: string | null;
  tersedia_sampai?: string | null;
  lampiran?: Array<{
    id?: number | null;
    uuid?: string | null;
    nama?: string | null;
    mime?: string | null;
    /** byte */
    ukuran?: number | null;
    /** Path unduh, mis. /v1/lms/file/<uuid> */
    url?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LmsMateriBaru = {
  topik_id?: number | null;
  jenis: "teks" | "file" | "tautan" | "video" | "konferensi";
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  konten?: string | null;
  /** Wajib untuk tautan/video/konferensi */
  url?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  selesai?: string | null;
  wajib_selesai?: boolean;
  urutan?: number | null;
  tampil?: boolean;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  tersedia_mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  tersedia_sampai?: string | null;
  file_ids?: Array<number>;
  beritahu?: boolean;
  [key: string]: any;
};

export type LmsKelasDaringBaru = {
  topik_id?: number | null;
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  konten?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  mulai: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  selesai: string | null;
  /** Kode penyedia rapat (kosong = utama), lihat GET /v1/lms/rapat/penyedia */
  penyedia?: string | null;
  tampil?: boolean;
  beritahu?: boolean;
  wajib_selesai?: boolean;
  [key: string]: any;
};

export type LmsKelasDaring = {
  materi_id?: number | null;
  kelas_id?: number | null;
  judul?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  selesai?: string | null;
  /** true = ruang dibuat lewat integrasi */
  otomatis?: boolean;
  /** UUID rapat integrasi */
  id?: string | null;
  /** zoom, google_meet, tautan */
  driver?: string | null;
  /** Zoom, Google Meet, ... */
  penyedia?: string | null;
  /** terjadwal, dibatalkan, belum_ada */
  status?: string | null;
  waktu?: "akan_datang" | "berlangsung" | "selesai";
  url_gabung?: string | null;
  kata_sandi?: string | null;
  /** Hanya pengajar */
  url_host?: string | null;
  id_rapat?: string | null;
  [key: string]: any;
};

export type LmsUnggah = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  file?: Uploadable;
  kelas_id: number;
  konteks: "materi" | "tugas" | "jawaban" | "forum" | "soal" | "sampul";
  [key: string]: any;
};

export type LmsFile = {
  id?: number | null;
  uuid?: string | null;
  nama?: string | null;
  mime?: string | null;
  /** byte */
  ukuran?: number | null;
  /** Path unduh, mis. /v1/lms/file/<uuid> */
  url?: string | null;
  [key: string]: any;
};

export type LmsTugas = {
  id?: number | null;
  kelas_id?: number | null;
  topik_id?: number | null;
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  instruksi?: string | null;
  jenis_pengumpulan?: string | null;
  maks_file?: number | null;
  ekstensi?: Array<string>;
  mulai?: string | null;
  tenggat?: string | null;
  batas_akhir?: string | null;
  terima_terlambat?: boolean;
  nilai_maks?: number | null;
  rubrik?: Array<JsonObject>;
  tampil?: boolean;
  lampiran?: Array<{
    id?: number | null;
    uuid?: string | null;
    nama?: string | null;
    mime?: string | null;
    /** byte */
    ukuran?: number | null;
    /** Path unduh, mis. /v1/lms/file/<uuid> */
    url?: string | null;
    [key: string]: any;
  }>;
  buku_nilai?: JsonObject | null;
  /** Mahasiswa */
  jawaban_saya?: JsonObject | null;
  jumlah?: {
    dikumpulkan?: number | null;
    dinilai?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type LmsTugasBaru = {
  topik_id?: number | null;
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  instruksi?: string | null;
  jenis_pengumpulan?: "file" | "teks" | "file_teks" | "luring";
  maks_file?: number | null;
  /** Dipisah koma, mis. pdf,docx */
  ekstensi?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  tenggat?: string | null;
  /** Penutupan akhir (terlambat masih diterima sampai sini) Contoh: `2026-09-14 23:59:00` */
  batas_akhir?: string | null;
  terima_terlambat?: boolean;
  nilai_maks?: number | null;
  rubrik?: Array<{
    kriteria?: string | null;
    deskripsi?: string | null;
    skor_maks?: number | null;
    [key: string]: any;
  }>;
  tampil?: boolean;
  file_ids?: Array<number>;
  /** Jenis nilai SIAKAD, bawaan Tugas */
  komponen?: string | null;
  /** Bobot di dalam komponen */
  bobot?: number | null;
  beritahu?: boolean;
  [key: string]: any;
};

export type LmsJawabanTugas = {
  id?: number | null;
  tugas_id?: number | null;
  nim?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  teks?: string | null;
  status?: "draf" | "dikumpulkan" | "dinilai" | "dikembalikan";
  dikumpulkan_at?: string | null;
  terlambat?: boolean;
  percobaan?: number | null;
  /** null bila kolom nilai disembunyikan dari mahasiswa */
  nilai?: number | null;
  nilai_rubrik?: Array<number>;
  umpan_balik?: string | null;
  dinilai_at?: string | null;
  lampiran?: Array<{
    id?: number | null;
    uuid?: string | null;
    nama?: string | null;
    mime?: string | null;
    /** byte */
    ukuran?: number | null;
    /** Path unduh, mis. /v1/lms/file/<uuid> */
    url?: string | null;
    [key: string]: any;
  }>;
  file_ids?: Array<number>;
  /** Body: true = kumpulkan, false/kosong = simpan draf */
  kumpulkan?: boolean;
  [key: string]: any;
};

export type LmsNilaiTugas = {
  nilai?: number | null;
  nilai_rubrik?: Array<number>;
  umpan_balik?: string | null;
  kembalikan?: boolean;
  [key: string]: any;
};

export type LmsSoal = {
  id?: number | null;
  kode_prodi?: string | null;
  kode_mk?: string | null;
  jenis: "pilihan_ganda" | "pilihan_ganda_banyak" | "benar_salah" | "isian_singkat" | "esai" | "menjodohkan";
  /** HTML; tag/atribut berbahaya dibuang server */
  pertanyaan: string | null;
  /** Lihat keterangan POST /v1/lms/bank-soal */
  opsi?: any;
  /** Lihat keterangan POST /v1/lms/bank-soal */
  kunci?: any;
  /** HTML; tag/atribut berbahaya dibuang server */
  pembahasan?: string | null;
  poin?: number | null;
  tingkat?: "mudah" | "sedang" | "sulit";
  tag?: string | null;
  /** Boleh dipakai dosen lain */
  dibagikan?: boolean;
  [key: string]: any;
};

export type LmsKuis = {
  id?: number | null;
  kelas_id?: number | null;
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  deskripsi?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  durasi_menit?: number | null;
  maks_percobaan?: number | null;
  metode_nilai?: string | null;
  acak_soal?: boolean;
  acak_opsi?: boolean;
  tampil_hasil?: string | null;
  tampil_kunci?: boolean;
  nilai_maks?: number | null;
  berkata_sandi?: boolean;
  tampil?: boolean;
  jumlah_soal?: number | null;
  soal?: Array<{
    id?: number | null;
    kode_prodi?: string | null;
    kode_mk?: string | null;
    jenis: "pilihan_ganda" | "pilihan_ganda_banyak" | "benar_salah" | "isian_singkat" | "esai" | "menjodohkan";
    /** HTML; tag/atribut berbahaya dibuang server */
    pertanyaan: string | null;
    /** Lihat keterangan POST /v1/lms/bank-soal */
    opsi?: any;
    /** Lihat keterangan POST /v1/lms/bank-soal */
    kunci?: any;
    /** HTML; tag/atribut berbahaya dibuang server */
    pembahasan?: string | null;
    poin?: number | null;
    tingkat?: "mudah" | "sedang" | "sulit";
    tag?: string | null;
    /** Boleh dipakai dosen lain */
    dibagikan?: boolean;
    [key: string]: any;
  }>;
  percobaan_saya?: Array<JsonObject>;
  [key: string]: any;
};

export type LmsKuisBaru = {
  topik_id?: number | null;
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  deskripsi?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS (zona waktu server) atau ISO 8601 Contoh: `2026-09-14 23:59:00` */
  selesai?: string | null;
  /** null = tanpa batas */
  durasi_menit?: number | null;
  /** 0 = tidak dibatasi */
  maks_percobaan?: number | null;
  metode_nilai?: "tertinggi" | "terakhir" | "pertama" | "rata_rata";
  acak_soal?: boolean;
  acak_opsi?: boolean;
  tampil_hasil?: "segera" | "setelah_tutup" | "tidak";
  tampil_kunci?: boolean;
  nilai_maks?: number | null;
  kata_sandi?: string | null;
  tampil?: boolean;
  /** Bawaan Kuis; mis. UTS, UAS */
  komponen?: string | null;
  bobot?: number | null;
  beritahu?: boolean;
  [key: string]: any;
};

export type LmsPercobaan = {
  id?: number | null;
  kuis_id?: number | null;
  percobaan_ke?: number | null;
  status?: "berlangsung" | "selesai";
  mulai_at?: string | null;
  batas_at?: string | null;
  sisa_detik?: number | null;
  skor?: number | null;
  skor_maks?: number | null;
  nilai?: number | null;
  perlu_koreksi?: boolean;
  hasil_terbuka?: boolean;
  soal?: Array<{
    nomor?: number | null;
    soal_id?: number | null;
    jenis?: string | null;
    /** HTML; tag/atribut berbahaya dibuang server */
    pertanyaan?: string | null;
    /** Urutan sesuai percobaan */
    opsi?: any;
    poin?: number | null;
    /** Jawaban tersimpan */
    jawaban?: any;
    benar?: boolean | null;
    /** Bila diizinkan */
    kunci?: any;
    /** HTML; tag/atribut berbahaya dibuang server */
    pembahasan?: string | null;
    lampiran?: Array<{
      id?: number | null;
      uuid?: string | null;
      nama?: string | null;
      mime?: string | null;
      /** byte */
      ukuran?: number | null;
      /** Path unduh, mis. /v1/lms/file/<uuid> */
      url?: string | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LmsForum = {
  id?: number | null;
  kelas_id?: number | null;
  topik_id?: number | null;
  jenis?: "diskusi" | "pengumuman" | "tanya_jawab";
  judul: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  deskripsi?: string | null;
  terkunci?: boolean;
  tampil?: boolean;
  jumlah_utas?: number | null;
  post_terakhir?: string | null;
  [key: string]: any;
};

export type LmsPost = {
  id?: number | null;
  forum_id?: number | null;
  induk_id?: number | null;
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi?: string | null;
  disematkan?: boolean;
  diedit?: boolean;
  penulis?: {
    username?: string | null;
    nama?: string | null;
    level?: string | null;
    [key: string]: any;
  };
  jumlah_balasan?: number | null;
  lampiran?: Array<{
    id?: number | null;
    uuid?: string | null;
    nama?: string | null;
    mime?: string | null;
    /** byte */
    ukuran?: number | null;
    /** Path unduh, mis. /v1/lms/file/<uuid> */
    url?: string | null;
    [key: string]: any;
  }>;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type LmsPostBaru = {
  /** Wajib untuk utas baru */
  judul?: string | null;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi: string | null;
  /** Isi untuk membalas */
  induk_id?: number | null;
  file_ids?: Array<number>;
  /** Pengajar */
  disematkan?: boolean;
  [key: string]: any;
};

export type LmsSesiPresensi = {
  pertemuan_ke: number | null;
  tanggal: string | null;
  /** Contoh: `07:30` */
  jam_mulai?: string | null;
  jam_selesai?: string | null;
  topik_id?: number | null;
  metode?: "kode" | "manual";
  bahasan?: string | null;
  buka?: boolean;
  durasi_menit?: number | null;
  /** PATCH: ganti kode */
  kode_baru?: boolean;
  [key: string]: any;
};

export type LmsNilaiItem = {
  id?: number | null;
  sumber?: "tugas" | "kuis" | "manual";
  sumber_id?: number | null;
  nama: string | null;
  /** Jenis nilai SIAKAD */
  komponen?: string | null;
  nilai_maks?: number | null;
  bobot?: number | null;
  /** Terlihat oleh mahasiswa */
  tampil?: boolean;
  urutan?: number | null;
  [key: string]: any;
};

export type LmsBukuNilai = {
  item?: Array<{
    id?: number | null;
    sumber?: "tugas" | "kuis" | "manual";
    sumber_id?: number | null;
    nama: string | null;
    /** Jenis nilai SIAKAD */
    komponen?: string | null;
    nilai_maks?: number | null;
    bobot?: number | null;
    /** Terlihat oleh mahasiswa */
    tampil?: boolean;
    urutan?: number | null;
    [key: string]: any;
  }>;
  /** Persentase komponen dari t_mahasiswa_nilai_persen, mis. {"Tugas": 30, "UTS": 30, "UAS": 40} */
  persen_siakad?: JsonObject | null;
  mahasiswa?: Array<{
    nim?: string | null;
    nama?: string | null;
    nilai?: Array<{
      item_id?: number | null;
      nilai?: number | null;
      catatan?: string | null;
      [key: string]: any;
    }>;
    /** Rekap 0-100 per komponen */
    komponen?: JsonObject;
    /** Bila persen_siakad ada */
    nilai_akhir_perkiraan?: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LmsImporNilaiOpsi = {
  /** komponen (bawaan): satu nilai rata-rata berbobot per komponen (Harian/Tugas/UTS/UAS ke-1). item: setiap kolom Harian/Tugas menjadi nilai ke-1, ke-2, dst. di SIAKAD */
  mode?: "komponen" | "item";
  item_ids?: Array<number>;
  /** Bawaan true: kolom yang belum dinilai dihitung 0 (sama dengan rekap buku nilai). Sel tanpa nilai sama sekali tetap dilewati */
  kosong_nol?: boolean;
  [key: string]: any;
};

export type LmsImporPresensiOpsi = {
  sesi_ids?: Array<number>;
  /** Dosen pengampu pemilik pertemuan di SIAKAD. Bawaan: dosen yang mengimpor, atau dosen utama jadwal bila staf */
  nidn?: string | null;
  /** Bawaan true: peserta yang tidak mengisi presensi LMS dicatat A (alpa) */
  kosong_alpa?: boolean;
  [key: string]: any;
};

export type LmsImporSiakad = {
  id?: number | null;
  kelas_id?: number | null;
  jenis?: "nilai" | "presensi";
  idj?: number | null;
  kode_prodi?: string | null;
  tahun_id?: string | null;
  kode_mk?: string | null;
  kelas?: string | null;
  pengaturan?: JsonObject;
  ringkasan?: JsonObject;
  status?: "aktif" | "dibatalkan" | "sebagian_dibatalkan";
  dibuat_oleh?: string | null;
  created_at?: string | null;
  dibatalkan_oleh?: string | null;
  dibatalkan_at?: string | null;
  baris?: Array<{
    id?: number | null;
    tabel?: string | null;
    /** idnm/iddm/idpm di SIAKAD */
    baris_id?: number | null;
    nim?: string | null;
    /** null = baris dibuat oleh impor */
    nilai_lama?: JsonObject | null;
    nilai_baru?: JsonObject;
    status?: "ditulis" | "dipulihkan" | "konflik";
    keterangan?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

/** Objek JSON; lihat deskripsi endpoint untuk isinya. */
export type LppmObjek = JsonObject;

/** Impor t_dosen_penelitian / t_dosen_pengabdian lama menjadi kegiatan berstatus selesai (asal impor_lama). Tabel lama tidak diubah. */
export type LppmImpor = {
  /** Bawaan keduanya */
  jenis?: Array<"penelitian" | "pengabdian">;
  /** Batasi ke satu dosen */
  nidn?: string | null;
  /** false (bawaan) = pratinjau saja; true = simpan. Aman diulang: baris yang sudah diimpor (sumber_lama) dilewati. */
  simpan?: boolean;
  [key: string]: any;
};

export type LppmReviewInput = {
  nilai?: Array<{
    kriteria_id: number;
    skor: number;
    komentar?: string | null;
    [key: string]: any;
  }>;
  rekomendasi?: "layak" | "layak_revisi" | "tidak_layak";
  /** Rupiah */
  dana_rekomendasi?: number | null;
  /** Terlihat oleh tim pengusul (tanpa nama reviewer) */
  komentar?: string | null;
  /** Hanya untuk pengelola LPPM */
  komentar_internal?: string | null;
  /** true = reviewer menyatakan konflik; tugas dibatalkan */
  konflik_kepentingan?: boolean;
  /** false = simpan draf; true = kirim (semua kriteria dan rekomendasi wajib terisi), skor total = Σ bobot×skor (pola BIMA, maks. 700 untuk skor 1-7) */
  kirim?: boolean;
  [key: string]: any;
};

export type LppmKegiatanRingkas = {
  id?: number;
  uuid?: string;
  /** Terbit saat diajukan, mis. P-2026-0001 */
  nomor?: string | null;
  jenis?: "penelitian" | "pengabdian";
  asal?: "usulan" | "hibah_eksternal" | "mandiri" | "impor_lama";
  judul?: string;
  periode_id?: number | null;
  skema_id?: number | null;
  skema?: string | null;
  tahun_usulan?: number;
  tahun_pelaksanaan?: number | null;
  lama_tahun?: number;
  nidn_ketua?: string;
  nama_ketua?: string | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  sumber_dana?: "internal" | "kemdiktisaintek" | "pemerintah_lain" | "swasta" | "luar_negeri" | "mandiri";
  dana_usulan?: number;
  dana_disetujui?: number | null;
  status?: "draf" | "diajukan" | "direview" | "revisi" | "diterima" | "ditolak" | "berjalan" | "selesai" | "dibatalkan";
  persetujuan_fakultas?: "tidak_perlu" | "menunggu" | "disetujui" | "ditolak";
  /** Rata-rata skor reviewer tahap usulan */
  skor_review?: number | null;
  diajukan_pada?: string | null;
  /** ketua | anggota | reviewer | pengelola | null */
  peran_saya?: string | null;
  [key: string]: any;
};

export type LppmKegiatanInput = {
  jenis: "penelitian" | "pengabdian";
  /** usulan = hibah internal lewat periode; hibah_eksternal/mandiri langsung berjalan (pencatatan) */
  asal?: "usulan" | "hibah_eksternal" | "mandiri";
  /** Wajib untuk asal usulan (periode dibuka) */
  periode_id?: number | null;
  /** Wajib untuk asal usulan (skema dibuka di periode) */
  skema_id?: number | null;
  judul: string;
  ringkasan?: string | null;
  /** Dipisah koma */
  kata_kunci?: string | null;
  /** Bagian proposal: latar_belakang, tujuan, tinjauan_pustaka, metode, permasalahan_mitra, jadwal, roadmap, daftar_pustaka */
  substansi?: Record<string, string>;
  /** lppm_bidang jenis fokus */
  bidang_id?: number | null;
  /** lppm_bidang jenis tema */
  tema_id?: number | null;
  /** lppm_bidang jenis rumpun */
  rumpun_id?: number | null;
  topik?: string | null;
  tkt_awal?: number;
  tkt_target?: number;
  tahun_usulan?: number;
  tahun_pelaksanaan?: number;
  lama_tahun?: number;
  /** Tahun akademik SIAKAD (5 digit) */
  tahun_id?: string | null;
  lokasi?: string | null;
  kabupaten?: string | null;
  provinsi?: string | null;
  /** Hanya pengelola; dosen otomatis menjadi ketua */
  nidn_ketua?: string | null;
  sumber_dana?: "internal" | "kemdiktisaintek" | "pemerintah_lain" | "swasta" | "luar_negeri" | "mandiri";
  nama_pemberi_dana?: string | null;
  /** Usulan hibah internal dihitung dari RAB */
  dana_usulan?: number | null;
  /** Kegiatan non-usulan */
  dana_disetujui?: number | null;
  nomor_sk?: string | null;
  nomor_kontrak?: string | null;
  tanggal_kontrak?: string | null;
  tanggal_mulai?: string | null;
  tanggal_selesai?: string | null;
  /** ID usulan di BIMA */
  id_bima?: string | null;
  /** Kegiatan non-usulan */
  status?: "berjalan" | "selesai" | "dibatalkan";
  keterangan?: string | null;
  [key: string]: any;
};

export type LppmKegiatan = {
  id?: number;
  uuid?: string;
  /** Terbit saat diajukan, mis. P-2026-0001 */
  nomor?: string | null;
  jenis?: "penelitian" | "pengabdian";
  asal?: "usulan" | "hibah_eksternal" | "mandiri" | "impor_lama";
  judul?: string;
  periode_id?: number | null;
  skema_id?: number | null;
  skema?: string | null;
  tahun_usulan?: number;
  tahun_pelaksanaan?: number | null;
  lama_tahun?: number;
  nidn_ketua?: string;
  nama_ketua?: string | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  sumber_dana?: "internal" | "kemdiktisaintek" | "pemerintah_lain" | "swasta" | "luar_negeri" | "mandiri";
  dana_usulan?: number;
  dana_disetujui?: number | null;
  status?: "draf" | "diajukan" | "direview" | "revisi" | "diterima" | "ditolak" | "berjalan" | "selesai" | "dibatalkan";
  persetujuan_fakultas?: "tidak_perlu" | "menunggu" | "disetujui" | "ditolak";
  /** Rata-rata skor reviewer tahap usulan */
  skor_review?: number | null;
  diajukan_pada?: string | null;
  /** ketua | anggota | reviewer | pengelola | null */
  peran_saya?: string | null;
  ringkasan?: string | null;
  kata_kunci?: string | null;
  substansi?: JsonObject;
  bidang?: string | null;
  tema?: string | null;
  rumpun?: string | null;
  skema_detail?: JsonObject | null;
  periode?: JsonObject | null;
  ketua?: JsonObject | null;
  anggota?: Array<{
    jenis?: "dosen" | "mahasiswa" | "tendik" | "eksternal";
    /** jenis dosen */
    nidn?: string | null;
    /** jenis mahasiswa */
    nim?: string | null;
    /** jenis tendik */
    nik?: string | null;
    /** Wajib untuk eksternal; lainnya otomatis dari SIAKAD */
    nama?: string | null;
    /** eksternal */
    instansi?: string | null;
    id?: number;
    peran?: "ketua" | "anggota" | "pembantu_lapangan" | "teknisi" | "pembimbing";
    username?: string | null;
    kode_prodi?: string | null;
    tugas?: string | null;
    jam_per_minggu?: number | null;
    konfirmasi?: "menunggu" | "setuju" | "menolak";
    dikonfirmasi_pada?: string | null;
    urut?: number;
    [key: string]: any;
  }>;
  mitra?: Array<JsonObject>;
  /** item[] + per_tahun (ringkasan per kelompok biaya) */
  rab?: JsonObject;
  luaran_target?: Array<JsonObject>;
  /** Untuk tim pengusul: tanpa nama reviewer dan komentar internal */
  review?: Array<JsonObject>;
  laporan?: Array<JsonObject>;
  pencairan?: Array<JsonObject>;
  file?: Array<{
    id?: string;
    entitas?: "usulan" | "laporan" | "logbook" | "luaran" | "mitra" | "pencairan" | "kkn_peserta" | "kkn_kelompok" | "kkn_proposal";
    entitas_id?: number;
    /** proposal, kontrak, laporan, bukti, sertifikat, lampiran, ... */
    peran?: string;
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    /** Path unduh (GET, dengan token; ?inline=1 untuk PDF/gambar) */
    unduh?: string;
    [key: string]: any;
  }>;
  /** Aksi yang boleh dilakukan pemanggil */
  hak?: Record<string, boolean>;
  [key: string]: any;
};

export type LppmKeputusan = {
  /** persetujuan-fakultas: disetujui|ditolak|revisi; tetapkan: diterima|ditolak|revisi */
  keputusan: "disetujui" | "diterima" | "ditolak" | "revisi";
  /** tetapkan */
  dana_disetujui?: number | null;
  /** tetapkan */
  nomor_sk?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type LppmKontrak = {
  nomor_kontrak: string;
  tanggal_kontrak?: string | null;
  tanggal_mulai?: string | null;
  tanggal_selesai?: string | null;
  /** Persen per tahap, total 100. Bawaan [70, 30] */
  pencairan_persen?: Array<number>;
  [key: string]: any;
};

export type LppmAnggota = {
  jenis?: "dosen" | "mahasiswa" | "tendik" | "eksternal";
  /** jenis dosen */
  nidn?: string | null;
  /** jenis mahasiswa */
  nim?: string | null;
  /** jenis tendik */
  nik?: string | null;
  /** Wajib untuk eksternal; lainnya otomatis dari SIAKAD */
  nama?: string | null;
  /** eksternal */
  instansi?: string | null;
  id?: number;
  peran?: "ketua" | "anggota" | "pembantu_lapangan" | "teknisi" | "pembimbing";
  username?: string | null;
  kode_prodi?: string | null;
  tugas?: string | null;
  jam_per_minggu?: number | null;
  konfirmasi?: "menunggu" | "setuju" | "menolak";
  dikonfirmasi_pada?: string | null;
  urut?: number;
  [key: string]: any;
};

/** Dosen/mahasiswa SIAKAD diundang dan harus konfirmasi (POST /konfirmasi). */
export type LppmAnggotaInput = {
  jenis: "dosen" | "mahasiswa" | "tendik" | "eksternal";
  /** jenis dosen */
  nidn?: string | null;
  /** jenis mahasiswa */
  nim?: string | null;
  /** jenis tendik */
  nik?: string | null;
  /** Wajib untuk eksternal; lainnya otomatis dari SIAKAD */
  nama?: string | null;
  /** eksternal */
  instansi?: string | null;
  peran?: "anggota" | "pembantu_lapangan" | "teknisi" | "pembimbing";
  tugas?: string | null;
  jam_per_minggu?: number | null;
  urut?: number | null;
  [key: string]: any;
};

export type LppmRabInput = {
  /** Mengganti seluruh RAB. dana_usulan = jumlah item sumber hibah. */
  item: Array<{
    tahun_ke?: number;
    kelompok: "honor" | "bahan" | "pengumpulan_data" | "sewa_peralatan" | "analisis_data" | "pelaporan_luaran" | "perjalanan" | "lainnya";
    uraian: string;
    satuan?: string | null;
    volume?: number;
    harga_satuan: number;
    sumber?: "hibah" | "mitra" | "mandiri";
    keterangan?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LppmLogbookInput = {
  tanggal: string | null;
  kegiatan: string;
  capaian_persen?: number | null;
  biaya?: number | null;
  /** Hanya untuk periksa logbook KKN (DPL) */
  status?: "disetujui" | "ditolak";
  /** Periksa logbook KKN */
  catatan?: string | null;
  [key: string]: any;
};

export type LppmLaporanInput = {
  ringkasan?: string | null;
  capaian_persen?: number | null;
  dana_terpakai?: number | null;
  /** Bebas: capaian, kendala, rencana, dsb. File laporan diunggah ke /file/laporan/{id} */
  isi?: JsonObject;
  /** Hanya untuk /periksa */
  keputusan?: "diterima" | "revisi" | "ditolak";
  /** Hanya untuk /periksa */
  catatan?: string | null;
  [key: string]: any;
};

export type LppmPencairanInput = {
  tahap: number;
  uraian?: string | null;
  persen?: number | null;
  /** Bawaan persen × dana disetujui */
  jumlah?: number | null;
  status?: "direncanakan" | "diajukan" | "dicairkan" | "dibatalkan";
  syarat?: string | null;
  tanggal_cair?: string | null;
  nomor_bukti?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type LppmLuaranInput = {
  jenis_luaran_id: number;
  /** Kegiatan asal (opsional) */
  usulan_id?: number | null;
  judul: string;
  tahun: number;
  tanggal?: string | null;
  /** Nama jurnal/prosiding/penerbit/media */
  nama_wadah?: string | null;
  /** Jurnal kampus */
  jurnal_id?: number | null;
  penerbit?: string | null;
  issn?: string | null;
  isbn?: string | null;
  volume?: string | null;
  nomor?: string | null;
  halaman?: string | null;
  doi?: string | null;
  url?: string | null;
  tingkat?: "lokal" | "wilayah" | "nasional" | "internasional";
  peringkat?: "sinta_1" | "sinta_2" | "sinta_3" | "sinta_4" | "sinta_5" | "sinta_6" | "q1" | "q2" | "q3" | "q4" | "scopus" | "wos" | "bereputasi" | "terakreditasi" | "tidak_terakreditasi";
  /** Scopus, WoS, DOAJ, Garuda, ... */
  terindeks?: string | null;
  status?: "draf" | "submitted" | "under_review" | "accepted" | "published" | "didaftarkan" | "granted" | "diterapkan";
  /** HKI */
  nomor_permohonan?: string | null;
  tanggal_permohonan?: string | null;
  /** HKI */
  nomor_sertifikat?: string | null;
  tanggal_sertifikat?: string | null;
  /** HKI */
  pemegang?: string | null;
  jumlah_sitasi?: number | null;
  sitasi_diperbarui?: string | null;
  /** Produk/TTG: pihak pengguna */
  pengguna?: string | null;
  abstrak?: string | null;
  keterangan?: string | null;
  sumber?: "manual" | "sinta" | "impor";
  id_eksternal?: string | null;
  /** Mengganti daftar penulis. Dosen/mahasiswa dicocokkan ke SIAKAD; pencatat non-pengelola harus termasuk penulis. */
  penulis?: Array<{
    jenis: "dosen" | "mahasiswa" | "tendik" | "eksternal";
    /** jenis dosen */
    nidn?: string | null;
    /** jenis mahasiswa */
    nim?: string | null;
    /** jenis tendik */
    nik?: string | null;
    /** Wajib untuk eksternal; lainnya otomatis dari SIAKAD */
    nama?: string | null;
    /** eksternal */
    instansi?: string | null;
    urut?: number;
    afiliasi?: string | null;
    korespondensi?: boolean;
    kode_prodi?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type LppmLuaran = {
  id?: number;
  uuid?: string;
  jenis_luaran_id?: number;
  jenis_luaran?: string | null;
  kategori?: string | null;
  kategori_lkps?: string | null;
  usulan_id?: number | null;
  judul?: string;
  tahun?: number;
  nama_wadah?: string | null;
  doi?: string | null;
  url?: string | null;
  tingkat?: string | null;
  peringkat?: string | null;
  status?: "draf" | "submitted" | "under_review" | "accepted" | "published" | "didaftarkan" | "granted" | "diterapkan";
  jumlah_sitasi?: number | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  verifikasi?: "belum" | "diajukan" | "terverifikasi" | "ditolak";
  penulis?: Array<{
    jenis: "dosen" | "mahasiswa" | "tendik" | "eksternal";
    /** jenis dosen */
    nidn?: string | null;
    /** jenis mahasiswa */
    nim?: string | null;
    /** jenis tendik */
    nik?: string | null;
    /** Wajib untuk eksternal; lainnya otomatis dari SIAKAD */
    nama?: string | null;
    /** eksternal */
    instansi?: string | null;
    urut?: number;
    afiliasi?: string | null;
    korespondensi?: boolean;
    kode_prodi?: string | null;
    [key: string]: any;
  }>;
  file?: Array<{
    id?: string;
    entitas?: "usulan" | "laporan" | "logbook" | "luaran" | "mitra" | "pencairan" | "kkn_peserta" | "kkn_kelompok" | "kkn_proposal";
    entitas_id?: number;
    /** proposal, kontrak, laporan, bukti, sertifikat, lampiran, ... */
    peran?: string;
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    /** Path unduh (GET, dengan token; ?inline=1 untuk PDF/gambar) */
    unduh?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmKknPeriode = {
  kode: string;
  nama: string;
  jenis?: "reguler" | "tematik" | "mbkm" | "nusantara" | "internasional" | "lainnya";
  /** Tahun akademik SIAKAD, 5 digit (mis. 20261) */
  tahun_id?: string | null;
  daftar_mulai?: string | null;
  daftar_selesai?: string | null;
  tanggal_mulai?: string | null;
  tanggal_selesai?: string | null;
  sks?: number;
  syarat_sks_min?: number;
  syarat_ipk_min?: number;
  kuota?: number;
  /** Rupiah */
  biaya?: number | null;
  status?: "draf" | "pendaftaran" | "penempatan" | "berjalan" | "penilaian" | "selesai";
  keterangan?: string;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmKknKelompok = {
  kode: string;
  nama: string;
  desa?: string;
  kecamatan?: string;
  kabupaten?: string;
  provinsi?: string;
  lat?: number;
  lng?: number;
  /** ID lppm_mitra */
  mitra_id?: number | null;
  /** NIDN dosen (m_dosen) */
  nidn_dpl?: string | null;
  kuota?: number;
  tema?: string;
  /** ID lppm_usulan */
  usulan_id?: number | null;
  keterangan?: string;
  [key: string]: any;
};

/** Berkas proposal diunggah ke POST /v1/lppm/file/kkn_proposal/{id} dengan peran=proposal (atau berkas_id dari /v1/berkas). */
export type LppmKknProposalInput = {
  /** Periode KKN (wajib saat membuat) */
  periode_id: number;
  /** Hanya pengelola: membuatkan untuk peserta */
  peserta_id?: number | null;
  jenis?: "penelitian" | "pengabdian" | "program_kerja";
  judul: string;
  /** Minimal 50 karakter sebelum diajukan */
  ringkasan?: string | null;
  /** Desa/lokasi penelitian */
  lokasi?: string | null;
  /** Mitra/desa sasaran */
  mitra?: string | null;
  [key: string]: any;
};

export type LppmKknProposal = {
  id?: number;
  uuid?: string;
  /** KKN-2026-0001, terbit saat pertama diajukan */
  nomor?: string | null;
  periode_id?: number;
  periode_nama?: string | null;
  peserta_id?: number;
  kelompok_id?: number | null;
  kelompok_nama?: string | null;
  nim?: string;
  nama?: string | null;
  kode_prodi?: string | null;
  jenis?: "penelitian" | "pengabdian" | "program_kerja";
  judul?: string;
  ringkasan?: string | null;
  lokasi?: string | null;
  mitra?: string | null;
  status?: "draf" | "diajukan" | "revisi" | "diterima" | "ditolak" | "dibatalkan";
  diajukan_pada?: string | null;
  diverifikasi_oleh?: string | null;
  diverifikasi_pada?: string | null;
  /** Catatan LP2M terakhir */
  catatan_verifikasi?: string | null;
  file?: Array<{
    id?: string;
    entitas?: "usulan" | "laporan" | "logbook" | "luaran" | "mitra" | "pencairan" | "kkn_peserta" | "kkn_kelompok" | "kkn_proposal";
    entitas_id?: number;
    /** proposal, kontrak, laporan, bukti, sertifikat, lampiran, ... */
    peran?: string;
    nama?: string;
    mime?: string;
    ukuran?: number;
    sha256?: string;
    keterangan?: string | null;
    diunggah_oleh?: string | null;
    diunggah_pada?: string;
    /** Path unduh (GET, dengan token; ?inline=1 untuk PDF/gambar) */
    unduh?: string;
    [key: string]: any;
  }>;
  /** aksi, oleh, nama_oleh, detail (catatan/alasan), created_at */
  riwayat?: Array<JsonObject>;
  /** ubah, unggah, ajukan, batal, verifikasi */
  hak?: Record<string, boolean>;
  [key: string]: any;
};

export type LppmKknProposalVerifikasi = {
  keputusan: "diterima" | "revisi" | "ditolak";
  /** Wajib untuk revisi/ditolak; terlihat pengusul */
  catatan?: string | null;
  [key: string]: any;
};

export type LppmFile = {
  id?: string;
  entitas?: "usulan" | "laporan" | "logbook" | "luaran" | "mitra" | "pencairan" | "kkn_peserta" | "kkn_kelompok" | "kkn_proposal";
  entitas_id?: number;
  /** proposal, kontrak, laporan, bukti, sertifikat, lampiran, ... */
  peran?: string;
  nama?: string;
  mime?: string;
  ukuran?: number;
  sha256?: string;
  keterangan?: string | null;
  diunggah_oleh?: string | null;
  diunggah_pada?: string;
  /** Path unduh (GET, dengan token; ?inline=1 untuk PDF/gambar) */
  unduh?: string;
  [key: string]: any;
};

export type LppmFileUnggah = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  /** File (multipart). Alternatif JSON: berkas_base64 + nama_file */
  berkas?: Uploadable;
  /** proposal, kontrak, laporan, bukti, sertifikat, lampiran (bawaan) */
  peran?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterPengelola = {
  /** username SIAKAD */
  username: string;
  peran: "admin" | "operator" | "pimpinan" | "keuangan" | "fakultas";
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  jabatan?: string;
  aktif?: boolean;
  mulai?: string | null;
  selesai?: string | null;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterReviewer = {
  jenis?: "internal" | "eksternal";
  /** username SIAKAD */
  username?: string;
  nidn?: string;
  nama?: string;
  instansi?: string;
  email?: string;
  hp?: string;
  bidang_keahlian?: string;
  nomor_sertifikat?: string;
  untuk?: "penelitian" | "pengabdian" | "keduanya";
  aktif?: boolean;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterBidang = {
  /** ID lppm_bidang */
  induk_id?: number | null;
  jenis: "fokus" | "tema" | "topik" | "rumpun";
  kode: string;
  nama: string;
  keterangan?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterJenisLuaran = {
  kode: string;
  nama: string;
  kategori: "jurnal" | "prosiding" | "buku" | "hki" | "produk" | "media" | "kebijakan" | "rekognisi" | "karya_seni" | "lainnya";
  /** Baris LKPS tempat luaran dihitung */
  kategori_lkps?: "jurnal_nasional_tidak_terakreditasi" | "jurnal_nasional_terakreditasi" | "jurnal_internasional" | "jurnal_internasional_bereputasi" | "seminar_wilayah" | "seminar_nasional" | "seminar_internasional" | "media_massa_wilayah" | "media_massa_nasional" | "media_massa_internasional" | "hki_paten" | "hki_lain" | "ttg_produk" | "buku_isbn" | "produk_diadopsi" | "rekognisi" | "kebijakan";
  tingkat?: "lokal" | "wilayah" | "nasional" | "internasional";
  keterangan?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterSkema = {
  kode: string;
  nama: string;
  jenis: "penelitian" | "pengabdian";
  kelompok?: string;
  sumber_dana?: "internal" | "kemdiktisaintek" | "pemerintah_lain" | "swasta" | "luar_negeri" | "mandiri";
  penyelenggara?: string;
  /** Rupiah */
  dana_maks?: number | null;
  durasi_tahun_maks?: number;
  tkt_min?: number;
  tkt_maks?: number;
  anggota_dosen_min?: number;
  anggota_dosen_maks?: number;
  mahasiswa_min?: number;
  mahasiswa_maks?: number;
  syarat_jabatan_ketua?: string;
  syarat_lain?: string;
  wajib_mitra?: boolean;
  wajib_persetujuan_fakultas?: boolean;
  maks_usulan_ketua?: number;
  keterangan?: string;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterSkemaLuaran = {
  /** ID lppm_skema */
  skema_id: number | null;
  /** ID lppm_jenis_luaran */
  jenis_luaran_id: number | null;
  wajib?: boolean;
  target_status?: "submitted" | "under_review" | "accepted" | "published" | "didaftarkan" | "granted" | "diterapkan";
  keterangan?: string;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterPeriode = {
  kode: string;
  nama: string;
  tahun: number;
  jenis?: "penelitian" | "pengabdian" | "keduanya";
  buka_usulan?: string | null;
  tutup_usulan?: string | null;
  batas_persetujuan?: string | null;
  mulai_review?: string | null;
  selesai_review?: string | null;
  pengumuman?: string | null;
  mulai_pelaksanaan?: string | null;
  selesai_pelaksanaan?: string | null;
  batas_laporan_kemajuan?: string | null;
  batas_laporan_akhir?: string | null;
  batas_luaran?: string | null;
  status?: "draf" | "dibuka" | "ditutup" | "review" | "diumumkan" | "berjalan" | "selesai";
  keterangan?: string;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterPeriodeSkema = {
  /** ID lppm_periode */
  periode_id: number | null;
  /** ID lppm_skema */
  skema_id: number | null;
  kuota?: number;
  /** Rupiah */
  pagu?: number | null;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterKriteria = {
  /** ID lppm_skema */
  skema_id?: number | null;
  jenis?: "penelitian" | "pengabdian" | "keduanya";
  tahap: "usulan" | "kemajuan" | "akhir" | "monev" | "seminar";
  nama: string;
  keterangan?: string;
  bobot: number;
  skor_min?: number;
  skor_maks?: number;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterMitra = {
  nama: string;
  jenis: "industri" | "umkm" | "pemerintah" | "desa" | "masyarakat" | "ormas" | "koperasi" | "sekolah" | "perguruan_tinggi" | "lembaga_riset" | "lainnya";
  bidang_usaha?: string;
  alamat?: string;
  kota?: string;
  provinsi?: string;
  negara?: string;
  kontak_nama?: string;
  kontak_jabatan?: string;
  telepon?: string;
  email?: string;
  website?: string;
  keterangan?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Respons memuat kolom yang sama ditambah id, created_at, updated_at. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type LppmMasterJurnal = {
  nama: string;
  singkatan?: string;
  issn?: string;
  eissn?: string;
  url?: string;
  penerbit?: string;
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  peringkat?: "belum" | "sinta_1" | "sinta_2" | "sinta_3" | "sinta_4" | "sinta_5" | "sinta_6";
  sk_akreditasi?: string;
  akreditasi_sampai?: string | null;
  frekuensi?: string;
  bidang?: string;
  /** username SIAKAD */
  editor_username?: string;
  aktif?: boolean;
  [key: string]: any;
};

export type LppmKolaboratorInput = {
  nama: string | null;
  /** Unik */
  email?: string | null;
  hp?: string | null;
  instansi?: string | null;
  jabatan?: string | null;
  negara?: string | null;
  /** 0000-0000-0000-0000 */
  orcid?: string | null;
  sinta_id?: string | null;
  scopus_id?: string | null;
  scholar_id?: string | null;
  bidang_keahlian?: string | null;
  catatan?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

export type LppmUndangKolaborator = {
  /** Kolaborator yang sudah ada */
  kolaborator_id?: number | null;
  /** Bila kolaborator_id kosong: dicari/dibuat dari email ini */
  email?: string | null;
  [key: string]: any;
};

export type LppmJawabUndangan = {
  setuju: boolean;
  /** Opsional: lengkapi profil kolaborator */
  profil?: {
    hp?: string | null;
    instansi?: string | null;
    jabatan?: string | null;
    negara?: string | null;
    orcid?: string | null;
    sinta_id?: string | null;
    scopus_id?: string | null;
    scholar_id?: string | null;
    bidang_keahlian?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type LppmImporOrcid = {
  /** Ambil metadata dan penulis dari Crossref untuk karya ber-DOI (bawaan true) */
  lengkapi_crossref?: boolean;
  /** Luaran baru per panggilan, 1-100 (bawaan 50) */
  batas?: number | null;
  [key: string]: any;
};

export type LppmPerbaruiSitasi = {
  luaran_id?: Array<number> | null;
  /** Hanya luaran dosen ini (wajib untuk dosen) */
  nidn?: string | null;
  /** 1-200 (bawaan 50) */
  batas?: number | null;
  [key: string]: any;
};

/** Program MBKM (tabel mbkm_program) */
export type MbkmProgram = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "magang" | "pkl" | "kkn" | "kkn_tematik" | "kampus_mengajar" | "asistensi_mengajar" | "pertukaran_pelajar" | "penelitian" | "proyek_kemanusiaan" | "wirausaha" | "studi_independen" | "bela_negara" | "kompetisi" | "lainnya";
  id_jenis_aktivitas_feeder?: number;
  penyelenggara?: "internal" | "kementerian" | "mitra";
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** ID di kerjasama_dokumen */
  kerjasama_dokumen_id?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  deskripsi?: string;
  syarat?: string;
  lampiran_minimal?: number;
  lokasi?: string;
  daftar_mulai?: string;
  daftar_selesai?: string;
  mulai?: string;
  selesai?: string;
  kuota?: number;
  sks_maks?: number;
  daftar_mandiri?: boolean;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "buka" | "berjalan" | "selesai" | "dibatalkan";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmProgramInput = {
  /** (unik) */
  kode: string;
  nama: string;
  jenis: "magang" | "pkl" | "kkn" | "kkn_tematik" | "kampus_mengajar" | "asistensi_mengajar" | "pertukaran_pelajar" | "penelitian" | "proyek_kemanusiaan" | "wirausaha" | "studi_independen" | "bela_negara" | "kompetisi" | "lainnya";
  id_jenis_aktivitas_feeder?: number;
  penyelenggara?: "internal" | "kementerian" | "mitra";
  /** ID di kerjasama_mitra */
  mitra_id?: number;
  /** ID di kerjasama_dokumen */
  kerjasama_dokumen_id?: number;
  /** m_tahun.tahun_id */
  tahun_id: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  deskripsi?: string;
  syarat?: string;
  lampiran_minimal?: number;
  lokasi?: string;
  daftar_mulai?: string;
  daftar_selesai?: string;
  mulai?: string;
  selesai?: string;
  kuota?: number;
  sks_maks?: number;
  daftar_mandiri?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Peserta (tabel mbkm_peserta) */
export type MbkmPeserta = {
  id?: number;
  /** ID di mbkm_program */
  program_id?: number;
  /** m_mahasiswa.NIM */
  nim?: string;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** m_tahun.tahun_id (hanya baca) Hanya dibaca. */
  tahun_id?: string;
  peran?: "ketua" | "anggota" | "personal";
  judul?: string;
  posisi?: string;
  lokasi?: string;
  motivasi?: string;
  /** (hanya pengelola) */
  mulai?: string;
  /** (hanya pengelola) */
  selesai?: string;
  /** (hanya pengelola) */
  nomor_sk?: string;
  /** (hanya pengelola) */
  nilai_angka?: number;
  /** (hanya pengelola) */
  nilai_huruf?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "berjalan" | "selesai" | "mengundurkan_diri";
  /** (hanya pengelola) */
  catatan?: string;
  /** Jumlah dokumen pendukung minimal (detail) */
  lampiran_wajib?: number;
  jumlah_lampiran?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmPesertaInput = {
  /** ID di mbkm_program */
  program_id: number;
  /** m_mahasiswa.NIM */
  nim: string;
  peran?: "ketua" | "anggota" | "personal";
  judul?: string;
  posisi?: string;
  lokasi?: string;
  motivasi?: string;
  /** (hanya pengelola) */
  mulai?: string;
  /** (hanya pengelola) */
  selesai?: string;
  /** (hanya pengelola) */
  nomor_sk?: string;
  /** (hanya pengelola) */
  nilai_angka?: number;
  /** (hanya pengelola) */
  nilai_huruf?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan; ada jumlah minimal wajib (lihat lampiran_wajib di detail) */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type MbkmPesertaSetujuiInput = {
  nomor_sk?: string;
  catatan?: string;
  [key: string]: any;
};

export type MbkmPesertaTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type MbkmPesertaSelesaiInput = {
  nilai_angka?: number;
  nilai_huruf?: string;
  [key: string]: any;
};

export type MbkmPesertaMundurInput = {
  alasan: string;
  [key: string]: any;
};

/** Pembimbing dan penguji (tabel mbkm_pembimbing) */
export type MbkmPembimbing = {
  id?: number;
  /** ID di mbkm_peserta */
  peserta_id?: number;
  peran?: "pembimbing" | "pembimbing_lapangan" | "penguji";
  urut?: number;
  /** m_dosen.NIDN */
  nidn?: string;
  nama?: string;
  instansi?: string;
  email?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmPembimbingInput = {
  /** ID di mbkm_peserta */
  peserta_id: number;
  peran?: "pembimbing" | "pembimbing_lapangan" | "penguji";
  urut?: number;
  /** m_dosen.NIDN */
  nidn?: string;
  nama?: string;
  instansi?: string;
  email?: string;
  [key: string]: any;
};

/** Logbook kegiatan (tabel mbkm_logbook) */
export type MbkmLogbook = {
  id?: number;
  /** ID di mbkm_peserta */
  peserta_id?: number;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  tanggal?: string;
  jam?: number;
  kegiatan?: string;
  hasil?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "disetujui" | "revisi";
  /** (hanya baca) Hanya dibaca. */
  catatan_pembimbing?: string;
  /** (hanya baca) Hanya dibaca. */
  diperiksa_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diperiksa_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmLogbookInput = {
  /** ID di mbkm_peserta */
  peserta_id: number;
  tanggal: string;
  jam?: number;
  kegiatan: string;
  hasil?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type MbkmLogbookSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type MbkmLogbookRevisiInput = {
  catatan: string;
  [key: string]: any;
};

/** Komponen penilaian (tabel mbkm_penilaian) */
export type MbkmPenilaian = {
  id?: number;
  /** ID di mbkm_peserta */
  peserta_id?: number;
  komponen?: string;
  bobot?: number;
  nilai?: number;
  penilai?: "pembimbing" | "pembimbing_lapangan" | "penguji" | "lainnya";
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmPenilaianInput = {
  /** ID di mbkm_peserta */
  peserta_id: number;
  komponen: string;
  bobot?: number;
  nilai: number;
  penilai?: "pembimbing" | "pembimbing_lapangan" | "penguji" | "lainnya";
  catatan?: string;
  [key: string]: any;
};

/** Konversi ke mata kuliah (tabel mbkm_konversi) */
export type MbkmKonversi = {
  id?: number;
  /** ID di mbkm_peserta */
  peserta_id?: number;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  mata_kuliah_id?: number;
  kode_mk?: string;
  nama_mk?: string;
  sks?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  nilai_angka?: number;
  nilai_huruf?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "usulan" | "disetujui" | "ditolak";
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  disetujui_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type MbkmKonversiInput = {
  /** ID di mbkm_peserta */
  peserta_id: number;
  mata_kuliah_id?: number;
  kode_mk?: string;
  nama_mk?: string;
  sks?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  nilai_angka?: number;
  nilai_huruf?: string;
  catatan?: string;
  [key: string]: any;
};

export type MbkmKonversiTolakInput = {
  alasan: string;
  [key: string]: any;
};

/** Kotak masuk (tabel notif_kotak) */
export type NotifKotak = {
  id?: number;
  /** user.username (hanya baca) Hanya dibaca. */
  username?: string;
  /** (hanya baca) Hanya dibaca. */
  modul?: string;
  /** (hanya baca) Hanya dibaca. */
  judul?: string;
  /** (hanya baca) Hanya dibaca. */
  isi?: string;
  /** (hanya baca) Hanya dibaca. */
  tautan?: string;
  /** (hanya baca) Hanya dibaca. */
  entitas?: string;
  /** (hanya baca) Hanya dibaca. */
  entitas_id?: number;
  /** (hanya baca) Hanya dibaca. */
  dibaca_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type NotifKotakInput = JsonObject;

/** Preferensi kanal (tabel notif_preferensi) */
export type NotifPreferensi = {
  id?: number;
  /** user.username */
  username?: string;
  kanal?: "email" | "whatsapp" | "push" | "telegram";
  tujuan?: string;
  modul?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type NotifPreferensiInput = {
  /** user.username */
  username: string;
  kanal: "email" | "whatsapp" | "push" | "telegram";
  tujuan: string;
  modul?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Antrean pengiriman (tabel notif_antrean) */
export type NotifAntrean = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  kotak_id?: number;
  /** (hanya baca) Hanya dibaca. */
  kanal?: "email" | "whatsapp" | "push" | "telegram";
  /** (hanya baca) Hanya dibaca. */
  tujuan?: string;
  /** (hanya baca) Hanya dibaca. */
  judul?: string;
  /** (hanya baca) Hanya dibaca. */
  isi?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "antre" | "terkirim" | "gagal" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  percobaan?: number;
  /** (hanya baca) Hanya dibaca. */
  galat?: string;
  /** (hanya baca) Hanya dibaca. */
  terkirim_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type NotifAntreanInput = JsonObject;

/** Pengumuman massal (tabel notif_pengumuman) */
export type NotifPengumuman = {
  id?: number;
  judul?: string;
  isi?: string;
  tautan?: string;
  sasaran?: "semua" | "level" | "prodi" | "angkatan" | "daftar";
  level?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  angkatan?: string;
  daftar_username?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "terkirim";
  /** (hanya baca) Hanya dibaca. */
  jumlah_penerima?: number;
  /** (hanya baca) Hanya dibaca. */
  dikirim_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type NotifPengumumanInput = {
  judul: string;
  isi: string;
  tautan?: string;
  sasaran?: "semua" | "level" | "prodi" | "angkatan" | "daftar";
  level?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  angkatan?: string;
  daftar_username?: string;
  [key: string]: any;
};

/** Jadwal sinkronisasi otomatis (tabel pddikti_jadwal) */
export type PddiktiJadwal = {
  id?: number;
  nama?: string;
  entitas?: "mahasiswa" | "akm" | "krs" | "nilai" | "nilai-transfer" | "kelas" | "ajar-dosen" | "lulus-do" | "mata-kuliah" | "kurikulum" | "skala-nilai" | "periode";
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tahun_id?: string;
  cakupan?: "gagal" | "semua";
  frekuensi?: "jam" | "harian" | "mingguan";
  jam?: number;
  hari?: number;
  batas?: number;
  aktif?: boolean;
  /** (hanya baca) Hanya dibaca. */
  terakhir_at?: string;
  /** (hanya baca) Hanya dibaca. */
  berikut_at?: string;
  /** (hanya baca) Hanya dibaca. */
  terakhir_jumlah?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type PddiktiJadwalInput = {
  nama: string;
  entitas: "mahasiswa" | "akm" | "krs" | "nilai" | "nilai-transfer" | "kelas" | "ajar-dosen" | "lulus-do" | "mata-kuliah" | "kurikulum" | "skala-nilai" | "periode";
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tahun_id?: string;
  cakupan?: "gagal" | "semua";
  frekuensi?: "jam" | "harian" | "mingguan";
  jam?: number;
  hari?: number;
  batas?: number;
  aktif?: boolean;
  [key: string]: any;
};

/** Amplop event domain (mirip CloudEvents). Sama persis dengan isi pesan webhook/broker. */
export type PeristiwaAmplop = {
  /** UUID event; dipakai penerima untuk membuang duplikat Contoh: `0b6f9c1e-6d1a-4a4e-9d7e-3f1f8a2b7c11` */
  id?: string | null;
  /** Contoh: `mahasiswa.lulus` */
  jenis?: string | null;
  /** Versi skema data Contoh: `1` */
  versi?: number | null;
  /** Contoh: `siakad/mahasiswa` */
  sumber?: string | null;
  /** Kunci entitas utama Contoh: `2201010001` */
  subjek?: string | null;
  /** ISO 8601 Contoh: `2026-11-16T09:30:00+08:00` */
  waktu?: string | null;
  /** request_id API pemicu; sama untuk semua event dalam satu rantai alur */
  korelasi_id?: string | null;
  /** UUID event yang memicu event ini (null bila dipicu langsung oleh pengguna) */
  penyebab_id?: string | null;
  /** username atau klien:<client_id> */
  aktor?: string | null;
  data?: JsonObject;
  [key: string]: any;
};

export type PeristiwaRingkas = {
  id?: string | null;
  jenis?: string | null;
  sumber?: string | null;
  subjek?: string | null;
  korelasi_id?: string | null;
  aktor?: string | null;
  waktu?: string | null;
  /** baru (belum disebar) atau disebar */
  status?: string | null;
  pengantaran?: {
    total?: number | null;
    terkirim?: number | null;
    antre?: number | null;
    mati?: number | null;
    dilewati?: number | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type PeristiwaDetail = {
  amplop?: PeristiwaAmplop;
  status?: string | null;
  disebar_at?: string | null;
  pengantaran?: Array<{
    /** pendengar (modul SIAKAD) atau penerus (webhook, broker) */
    jenis_tujuan?: string | null;
    /** Contoh: `tracer.alumni_baru` */
    tujuan?: string | null;
    judul?: string | null;
    /** antre, proses, terkirim, mati (dead letter), dilewati */
    status?: string | null;
    percobaan?: number | null;
    galat?: string | null;
    /** Jadwal percobaan berikutnya */
    berikutnya_at?: string | null;
    selesai_at?: string | null;
    [key: string]: any;
  }>;
  /** Event lain dengan korelasi_id yang sama */
  rantai?: Array<{
    id?: string | null;
    jenis?: string | null;
    waktu?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type PeristiwaJenis = {
  /** Contoh: `keuangan.tagihan_lunas` */
  jenis?: string | null;
  judul?: string | null;
  keterangan?: string | null;
  /** Modul penerbit */
  modul?: string | null;
  versi?: number | null;
  /** Scope yang wajib dimiliki aplikasi untuk berlangganan event ini lewat webhook */
  scope?: string | null;
  /** Isi data: nama => tipe dan keterangan */
  data?: Record<string, string>;
  contoh?: JsonObject;
  /** Kode pendengar di SIAKAD yang bereaksi */
  pendengar?: Array<string | null>;
  [key: string]: any;
};

export type PeristiwaPendengar = {
  /** Contoh: `tracer.alumni_baru` */
  kode?: string | null;
  modul?: string | null;
  judul?: string | null;
  keterangan?: string | null;
  /** Event yang didengar */
  jenis?: Array<string | null>;
  /** Event yang mungkin diterbitkan pendengar ini (rantai alur) */
  terbit?: Array<string | null>;
  aktif?: boolean;
  [key: string]: any;
};

export type PeristiwaKatalog = {
  /** Contoh: `1.0` */
  versi_amplop?: string | null;
  jenis?: Array<PeristiwaJenis>;
  pendengar?: Array<PeristiwaPendengar>;
  penerus?: Array<{
    kode?: string | null;
    aktif?: boolean;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type PeristiwaAlur = {
  alur?: Array<{
    /** Contoh: `pmb-ke-mahasiswa` */
    kode?: string | null;
    judul?: string | null;
    keterangan?: string | null;
    langkah?: Array<{
      urut?: number | null;
      modul?: string | null;
      /** Endpoint API pemicu */
      endpoint?: string | null;
      event?: string | null;
      reaksi?: Array<string | null>;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  /** Diagram alur event -> pendengar dalam sintaks Mermaid */
  mermaid?: string | null;
  [key: string]: any;
};

export type PeristiwaStatistik = {
  outbox?: {
    baru?: number | null;
    disebar?: number | null;
    total?: number | null;
    [key: string]: any;
  };
  pengantaran?: JsonObject;
  per_tujuan?: Array<JsonObject>;
  /** Waktu event tertua yang belum terkirim */
  tertua_antre?: string | null;
  [key: string]: any;
};

export type PeristiwaUlangInput = {
  /** Kode pendengar/penerus; kosong = semua pengantaran yang mati/dilewati Contoh: `webhook` */
  tujuan?: string | null;
  [key: string]: any;
};

/** Buku tamu kunjungan (tabel perpus_kunjungan) */
export type PerpustakaanKunjungan = {
  id?: number;
  username?: string;
  nama?: string;
  /** (hanya baca) Hanya dibaca. */
  jenis?: "MAHASISWA" | "DOSEN" | "KARYAWAN" | "TAMU";
  /** (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  instansi?: string;
  keperluan?: "baca" | "pinjam" | "kembali" | "referensi" | "diskusi" | "lain";
  waktu?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type PerpustakaanKunjunganInput = {
  username?: string;
  nama?: string;
  instansi?: string;
  keperluan?: "baca" | "pinjam" | "kembali" | "referensi" | "diskusi" | "lain";
  waktu?: string;
  [key: string]: any;
};

/** Usulan pengadaan koleksi (tabel perpus_usulan) */
export type PerpustakaanUsulan = {
  id?: number;
  judul?: string;
  penulis?: string;
  penerbit?: string;
  tahun?: number;
  isbn?: string;
  jumlah?: number;
  alasan?: string;
  /** user.username */
  pengusul?: string;
  /** (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  /** (hanya pengelola) */
  status?: "diajukan" | "disetujui" | "ditolak" | "dipesan" | "tersedia";
  /** (hanya pengelola) */
  tanggapan?: string;
  /** (hanya pengelola) */
  idpus?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type PerpustakaanUsulanInput = {
  judul: string;
  penulis?: string;
  penerbit?: string;
  tahun?: number;
  isbn?: string;
  jumlah?: number;
  alasan?: string;
  /** user.username */
  pengusul?: string;
  /** (hanya pengelola) */
  status?: "diajukan" | "disetujui" | "ditolak" | "dipesan" | "tersedia";
  /** (hanya pengelola) */
  tanggapan?: string;
  /** (hanya pengelola) */
  idpus?: string;
  [key: string]: any;
};

/** Arahan pimpinan (tabel pimpinan_arahan) */
export type PimpinanArahan = {
  id?: number;
  judul?: string;
  isi?: string;
  bidang?: string;
  prioritas?: "biasa" | "penting" | "segera";
  /** ID di induk_unit */
  unit_id?: number;
  /** user.username */
  penanggung_jawab?: string;
  tenggat?: string;
  rujukan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "dikirim" | "dikerjakan" | "dilaporkan" | "selesai" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  tindak_lanjut?: string;
  /** (hanya baca) Hanya dibaca. */
  progres?: number;
  /** user.username (hanya baca) Hanya dibaca. */
  pemberi?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_pada?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type PimpinanArahanInput = {
  judul: string;
  isi: string;
  bidang?: string;
  prioritas?: "biasa" | "penting" | "segera";
  /** ID di induk_unit */
  unit_id?: number;
  /** user.username */
  penanggung_jawab?: string;
  tenggat?: string;
  rujukan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type PimpinanArahanTindakLanjutInput = {
  catatan: string;
  progres?: number;
  [key: string]: any;
};

export type PimpinanArahanLaporSelesaiInput = {
  catatan: string;
  [key: string]: any;
};

export type PimpinanArahanTerimaInput = {
  catatan?: string;
  [key: string]: any;
};

export type PimpinanArahanKembalikanInput = {
  catatan: string;
  [key: string]: any;
};

export type PimpinanArahanBatalkanInput = {
  alasan: string;
  [key: string]: any;
};

export type PmbGelombang = {
  id?: number | null;
  slug?: string | null;
  nama?: string | null;
  periode_id?: string | null;
  tahun_akademik?: string | null;
  jalur?: {
    id?: number | null;
    nama?: string | null;
    slug?: string | null;
    [key: string]: any;
  };
  deskripsi?: string | null;
  poster?: string | null;
  sedang_buka?: boolean;
  pendaftaran?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  ujian?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  pembayaran?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  pengumuman_mulai?: string | null;
  biaya_pendaftaran?: number | null;
  maks_pilihan?: number | null;
  kuota?: number | null;
  perlu_tes?: boolean;
  kontak_panitia?: string | null;
  [key: string]: any;
};

export type PmbGelombangDetail = {
  id?: number | null;
  slug?: string | null;
  nama?: string | null;
  periode_id?: string | null;
  tahun_akademik?: string | null;
  jalur?: {
    id?: number | null;
    nama?: string | null;
    slug?: string | null;
    [key: string]: any;
  };
  deskripsi?: string | null;
  poster?: string | null;
  sedang_buka?: boolean;
  pendaftaran?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  ujian?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  pembayaran?: {
    mulai?: string | null;
    selesai?: string | null;
    [key: string]: any;
  };
  pengumuman_mulai?: string | null;
  biaya_pendaftaran?: number | null;
  maks_pilihan?: number | null;
  kuota?: number | null;
  perlu_tes?: boolean;
  kontak_panitia?: string | null;
  [key: string]: any;
} & {
  prodi?: Array<{
    kode_prodi?: string | null;
    nama_prodi?: string | null;
    jenjang?: string | null;
    kode_fakultas?: string | null;
    nama_fakultas?: string | null;
    kuota?: number | null;
    jumlah_peminat?: number | null;
    [key: string]: any;
  }>;
  jadwal?: Array<{
    tahap?: string | null;
    judul?: string | null;
    mulai?: string | null;
    selesai?: string | null;
    lokasi?: string | null;
    keterangan?: string | null;
    [key: string]: any;
  }>;
  biaya?: Array<{
    /** kosong = semua prodi */
    kode_prodi?: string | null;
    jenis?: string | null;
    nama?: string | null;
    nominal?: number | null;
    wajib?: boolean;
    bisa_dicicil?: boolean;
    keterangan?: string | null;
    [key: string]: any;
  }>;
  syarat_berkas?: Array<{
    jenis?: string | null;
    nama?: string | null;
    keterangan?: string | null;
    wajib?: boolean;
    ekstensi?: Array<string | null>;
    maks_kb?: number | null;
    [key: string]: any;
  }>;
  perlu_rapor?: boolean;
  perlu_prestasi?: boolean;
  [key: string]: any;
};

export type PmbAkun = {
  /** UUID akun */
  id?: string | null;
  nama?: string | null;
  email?: string | null;
  hp?: string | null;
  email_terverifikasi?: boolean;
  email_terverifikasi_at?: string | null;
  /** aktif, diblokir */
  status?: string | null;
  login_terakhir_at?: string | null;
  dibuat_at?: string | null;
  [key: string]: any;
};

export type PmbDaftarAkun = {
  nama: string | null;
  email: string | null;
  hp?: string | null;
  /** min. 8 karakter, huruf dan angka */
  password: string | null;
  [key: string]: any;
};

export type PmbMasuk = {
  email: string | null;
  password: string | null;
  [key: string]: any;
};

export type PmbMasukResponse = {
  akun?: {
    /** UUID akun */
    id?: string | null;
    nama?: string | null;
    email?: string | null;
    hp?: string | null;
    email_terverifikasi?: boolean;
    email_terverifikasi_at?: string | null;
    /** aktif, diblokir */
    status?: string | null;
    login_terakhir_at?: string | null;
    dibuat_at?: string | null;
    [key: string]: any;
  };
  /** Kirim di header X-Pmb-Akun-Token */
  token?: string | null;
  kedaluwarsa?: string | null;
  /** Contoh: `X-Pmb-Akun-Token` */
  header?: string | null;
  [key: string]: any;
};

export type PmbToken = {
  token: string | null;
  [key: string]: any;
};

export type PmbEmail = {
  email: string | null;
  [key: string]: any;
};

export type PmbReset = {
  token: string | null;
  password: string | null;
  [key: string]: any;
};

export type PmbBuatPendaftaran = {
  gelombang_id: number | null;
  [key: string]: any;
};

export type PmbFormulir = {
  pribadi?: {
    /** maks. 30 karakter (batas kolom SIAKAD) */
    nama?: string | null;
    /** NIK */
    no_identitas?: string | null;
    nisn?: string | null;
    /** kode */
    jenis_kelamin?: string | null;
    tempat_lahir?: string | null;
    tanggal_lahir?: string | null;
    /** kode */
    agama?: string | null;
    /** kode */
    warga_negara?: string | null;
    /** kode */
    status_sipil?: string | null;
    hp?: string | null;
    telepon?: string | null;
    email?: string | null;
    [key: string]: any;
  };
  alamat?: {
    alamat?: string | null;
    rt?: string | null;
    rw?: string | null;
    dusun?: string | null;
    desa?: string | null;
    kecamatan?: string | null;
    kode_pos?: string | null;
    [key: string]: any;
  };
  asal_sekolah?: {
    /** kode: baru/pindahan */
    status_masuk?: string | null;
    /** dari /v1/pmb/info/sekolah */
    kode_sekolah?: string | null;
    nama_sekolah?: string | null;
    nis_asal?: string | null;
    nilai_un?: string | null;
    tahun_lulus?: number | null;
    kode_asal_pt?: string | null;
    nama_asal_pt?: string | null;
    nim_asal?: string | null;
    /** kode */
    asal_jenjang?: string | null;
    kode_asal_prodi?: string | null;
    nama_asal_prodi?: string | null;
    sks_diakui?: number | null;
    [key: string]: any;
  };
  orang_tua?: {
    ayah?: {
      nama?: string | null;
      tanggal_lahir?: string | null;
      /** kode */
      agama?: string | null;
      /** kode */
      pendidikan?: string | null;
      /** kode */
      pekerjaan?: string | null;
      /** kode */
      penghasilan?: string | null;
      /** kode */
      hidup?: string | null;
      alamat?: string | null;
      kota?: string | null;
      propinsi?: string | null;
      pos?: string | null;
      telepon?: string | null;
      hp?: string | null;
      /** maks. 20 karakter (batas kolom SIAKAD) */
      email?: string | null;
      [key: string]: any;
    };
    ibu?: {
      nama?: string | null;
      tanggal_lahir?: string | null;
      /** kode */
      agama?: string | null;
      /** kode */
      pendidikan?: string | null;
      /** kode */
      pekerjaan?: string | null;
      /** kode */
      penghasilan?: string | null;
      /** kode */
      hidup?: string | null;
      alamat?: string | null;
      kota?: string | null;
      propinsi?: string | null;
      pos?: string | null;
      telepon?: string | null;
      hp?: string | null;
      /** maks. 20 karakter (batas kolom SIAKAD) */
      email?: string | null;
      [key: string]: any;
    };
    wali?: {
      nama?: string | null;
      tanggal_lahir?: string | null;
      /** kode */
      agama?: string | null;
      /** kode */
      pendidikan?: string | null;
      /** kode */
      pekerjaan?: string | null;
      /** kode */
      penghasilan?: string | null;
      /** kode */
      hidup?: string | null;
      alamat?: string | null;
      kota?: string | null;
      propinsi?: string | null;
      pos?: string | null;
      telepon?: string | null;
      hp?: string | null;
      /** maks. 20 karakter (batas kolom SIAKAD) */
      email?: string | null;
      [key: string]: any;
    };
    [key: string]: any;
  };
  pilihan?: Array<string | null>;
  /** website, media_sosial, brosur, pameran, sekolah, teman_keluarga, alumni, iklan, lainnya */
  sumber_informasi?: string | null;
  kode_referal?: string | null;
  [key: string]: any;
};

export type PmbPrestasi = {
  nama: string | null;
  /** akademik, olahraga, seni, keagamaan, organisasi, lainnya */
  bidang?: string | null;
  /** sekolah, kabupaten, provinsi, nasional, internasional */
  tingkat: string | null;
  peringkat?: string | null;
  tahun?: number | null;
  penyelenggara?: string | null;
  /** ID berkas sertifikat yang sudah diunggah */
  berkas_id?: number | null;
  [key: string]: any;
};

export type PmbRapor = {
  nilai: Array<{
    /** 1-6 */
    semester: number | null;
    mapel: string | null;
    /** 0-100 */
    nilai: number | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type PmbUnggahBerkas = {
  /** kode jenis berkas Contoh: `pas_foto` */
  jenis: string | null;
  berkas: Uploadable;
  [key: string]: any;
};

export type PmbUnggahBukti = {
  bukti: Uploadable;
  jumlah: number | null;
  tanggal_bayar?: string | null;
  [key: string]: any;
};

export type PmbBerkas = {
  id?: number | null;
  /** Contoh: `pas_foto` */
  jenis?: string | null;
  jenis_nama?: string | null;
  nama_asli?: string | null;
  mime?: string | null;
  /** byte */
  ukuran?: number | null;
  sha256?: string | null;
  /** menunggu, valid, ditolak */
  status?: string | null;
  catatan?: string | null;
  diverifikasi_at?: string | null;
  diunggah_at?: string | null;
  [key: string]: any;
};

export type PmbTagihan = {
  id?: number | null;
  /** Contoh: `PMB261112A1B2C3` */
  nomor?: string | null;
  /** formulir, daftar_ulang, lainnya */
  jenis?: string | null;
  keterangan?: string | null;
  nominal?: number | null;
  potongan?: number | null;
  total?: number | null;
  kanal?: string | null;
  nomor_va?: string | null;
  /** belum_bayar, menunggu_konfirmasi, lunas, kedaluwarsa, batal */
  status?: string | null;
  kedaluwarsa_at?: string | null;
  lunas_at?: string | null;
  dibuat_at?: string | null;
  [key: string]: any;
};

export type PmbVerifikasi = {
  /** terverifikasi, perlu_perbaikan, ditolak */
  keputusan: string | null;
  /** wajib selain terverifikasi */
  catatan?: string | null;
  [key: string]: any;
};

export type PmbDaftarUlang = {
  /** dari detail pendaftaran / info daftar ulang */
  id_pilihan: number | null;
  nim: string | null;
  /** Contoh: `20271` */
  tahun_id?: string | null;
  [key: string]: any;
};

export type PmbNotifikasiBank = {
  /** Nomor tagihan atau nomor VA */
  nomor: string | null;
  jumlah: number | null;
  /** ID transaksi bank (unik) */
  referensi: string | null;
  dibayar_at?: string | null;
  [key: string]: any;
};

export type PmbPendaftaranRingkas = {
  /** UUID */
  id?: string | null;
  /** Nomor pendaftaran SIAKAD, null selama draf */
  no_pmb?: string | null;
  nama?: string | null;
  gelombang?: {
    id?: number | null;
    nama?: string | null;
    periode_id?: string | null;
    [key: string]: any;
  };
  pilihan?: Array<string | null>;
  /** draf, diajukan, perlu_perbaikan, terverifikasi, ditolak, mengundurkan_diri */
  status?: string | null;
  tahap?: {
    /** mengisi_formulir, menunggu_pembayaran, menunggu_verifikasi, perlu_perbaikan, seleksi, menunggu_pengumuman, lulus_seleksi, tidak_lulus, diterima, ditolak, mengundurkan_diri */
    kode?: string | null;
    /** Teks langkah berikutnya untuk ditampilkan */
    label?: string | null;
    [key: string]: any;
  };
  diajukan_at?: string | null;
  dibuat_at?: string | null;
  [key: string]: any;
};

export type PmbPendaftaran = {
  /** UUID */
  id?: string | null;
  no_pmb?: string | null;
  nomor_peserta?: string | null;
  gelombang?: {
    id?: number | null;
    nama?: string | null;
    periode_id?: string | null;
    jalur?: string | null;
    pengumuman_mulai?: string | null;
    [key: string]: any;
  };
  status?: string | null;
  tahap?: {
    /** mengisi_formulir, menunggu_pembayaran, menunggu_verifikasi, perlu_perbaikan, seleksi, menunggu_pengumuman, lulus_seleksi, tidak_lulus, diterima, ditolak, mengundurkan_diri */
    kode?: string | null;
    /** Teks langkah berikutnya untuk ditampilkan */
    label?: string | null;
    [key: string]: any;
  };
  formulir?: {
    pribadi?: {
      /** maks. 30 karakter (batas kolom SIAKAD) */
      nama?: string | null;
      /** NIK */
      no_identitas?: string | null;
      nisn?: string | null;
      /** kode */
      jenis_kelamin?: string | null;
      tempat_lahir?: string | null;
      tanggal_lahir?: string | null;
      /** kode */
      agama?: string | null;
      /** kode */
      warga_negara?: string | null;
      /** kode */
      status_sipil?: string | null;
      hp?: string | null;
      telepon?: string | null;
      email?: string | null;
      [key: string]: any;
    };
    alamat?: {
      alamat?: string | null;
      rt?: string | null;
      rw?: string | null;
      dusun?: string | null;
      desa?: string | null;
      kecamatan?: string | null;
      kode_pos?: string | null;
      [key: string]: any;
    };
    asal_sekolah?: {
      /** kode: baru/pindahan */
      status_masuk?: string | null;
      /** dari /v1/pmb/info/sekolah */
      kode_sekolah?: string | null;
      nama_sekolah?: string | null;
      nis_asal?: string | null;
      nilai_un?: string | null;
      tahun_lulus?: number | null;
      kode_asal_pt?: string | null;
      nama_asal_pt?: string | null;
      nim_asal?: string | null;
      /** kode */
      asal_jenjang?: string | null;
      kode_asal_prodi?: string | null;
      nama_asal_prodi?: string | null;
      sks_diakui?: number | null;
      [key: string]: any;
    };
    orang_tua?: {
      ayah?: {
        nama?: string | null;
        tanggal_lahir?: string | null;
        /** kode */
        agama?: string | null;
        /** kode */
        pendidikan?: string | null;
        /** kode */
        pekerjaan?: string | null;
        /** kode */
        penghasilan?: string | null;
        /** kode */
        hidup?: string | null;
        alamat?: string | null;
        kota?: string | null;
        propinsi?: string | null;
        pos?: string | null;
        telepon?: string | null;
        hp?: string | null;
        /** maks. 20 karakter (batas kolom SIAKAD) */
        email?: string | null;
        [key: string]: any;
      };
      ibu?: {
        nama?: string | null;
        tanggal_lahir?: string | null;
        /** kode */
        agama?: string | null;
        /** kode */
        pendidikan?: string | null;
        /** kode */
        pekerjaan?: string | null;
        /** kode */
        penghasilan?: string | null;
        /** kode */
        hidup?: string | null;
        alamat?: string | null;
        kota?: string | null;
        propinsi?: string | null;
        pos?: string | null;
        telepon?: string | null;
        hp?: string | null;
        /** maks. 20 karakter (batas kolom SIAKAD) */
        email?: string | null;
        [key: string]: any;
      };
      wali?: {
        nama?: string | null;
        tanggal_lahir?: string | null;
        /** kode */
        agama?: string | null;
        /** kode */
        pendidikan?: string | null;
        /** kode */
        pekerjaan?: string | null;
        /** kode */
        penghasilan?: string | null;
        /** kode */
        hidup?: string | null;
        alamat?: string | null;
        kota?: string | null;
        propinsi?: string | null;
        pos?: string | null;
        telepon?: string | null;
        hp?: string | null;
        /** maks. 20 karakter (batas kolom SIAKAD) */
        email?: string | null;
        [key: string]: any;
      };
      [key: string]: any;
    };
    pilihan?: Array<string | null>;
    /** website, media_sosial, brosur, pameran, sekolah, teman_keluarga, alumni, iklan, lainnya */
    sumber_informasi?: string | null;
    kode_referal?: string | null;
    [key: string]: any;
  };
  sumber_informasi?: string | null;
  pilihan?: Array<{
    urut?: number | null;
    kode_prodi?: string | null;
    nama_prodi?: string | null;
    jenjang?: string | null;
    /** null sebelum pengumuman */
    lulus?: boolean | null;
    diterima?: boolean;
    nim?: string | null;
    [key: string]: any;
  }>;
  berkas?: Array<{
    id?: number | null;
    /** Contoh: `pas_foto` */
    jenis?: string | null;
    jenis_nama?: string | null;
    nama_asli?: string | null;
    mime?: string | null;
    /** byte */
    ukuran?: number | null;
    sha256?: string | null;
    /** menunggu, valid, ditolak */
    status?: string | null;
    catatan?: string | null;
    diverifikasi_at?: string | null;
    diunggah_at?: string | null;
    [key: string]: any;
  }>;
  syarat_berkas?: Array<{
    jenis?: string | null;
    nama?: string | null;
    wajib?: boolean;
    ekstensi?: string | null;
    maks_kb?: number | null;
    /** belum_diunggah, menunggu, valid, ditolak */
    status?: string | null;
    [key: string]: any;
  }>;
  prestasi?: Array<JsonObject>;
  rapor?: Array<JsonObject>;
  /** field => keterangan yang masih kurang sebelum bisa diajukan */
  kelengkapan?: Record<string, string>;
  tagihan?: Array<{
    id?: number | null;
    /** Contoh: `PMB261112A1B2C3` */
    nomor?: string | null;
    /** formulir, daftar_ulang, lainnya */
    jenis?: string | null;
    keterangan?: string | null;
    nominal?: number | null;
    potongan?: number | null;
    total?: number | null;
    kanal?: string | null;
    nomor_va?: string | null;
    /** belum_bayar, menunggu_konfirmasi, lunas, kedaluwarsa, batal */
    status?: string | null;
    kedaluwarsa_at?: string | null;
    lunas_at?: string | null;
    dibuat_at?: string | null;
    [key: string]: any;
  }>;
  jadwal_tes?: Array<{
    sesi_id?: number | null;
    jenis?: string | null;
    nama?: string | null;
    tanggal?: string | null;
    mulai?: string | null;
    selesai?: string | null;
    ruang_nama?: string | null;
    lokasi?: string | null;
    tautan?: string | null;
    nomor_kursi?: string | null;
    kehadiran?: string | null;
    nilai?: number | null;
    [key: string]: any;
  }>;
  catatan_verifikasi?: string | null;
  diajukan_at?: string | null;
  diverifikasi_at?: string | null;
  dibuat_at?: string | null;
  diperbarui_at?: string | null;
  [key: string]: any;
};

export type PortalSitus = {
  id?: number;
  kode?: string;
  jenis?: "universitas" | "fakultas" | "prodi" | "unit";
  induk_id?: number | null;
  kode_fakultas?: string | null;
  kode_prodi?: string | null;
  nama?: string;
  nama_en?: string | null;
  tagline?: string | null;
  domain?: string | null;
  logo?: PortalMedia;
  media_sosial?: JsonObject | null;
  /** Hanya di detail */
  pengaturan?: JsonObject;
  /** Data resmi SIAKAD (hanya di detail) */
  siakad?: JsonObject | null;
  [key: string]: any;
};

export type PortalMedia = {
  id?: number;
  jenis?: "gambar" | "dokumen" | "video" | "audio" | "tautan";
  url?: string;
  mime?: string | null;
  ukuran?: number;
  lebar?: number | null;
  tinggi?: number | null;
  judul?: string | null;
  alt?: string | null;
  kredit?: string | null;
  [key: string]: any;
} | null;

/** Baris konten sesuai jenis. Kolom *_media_id disertai objek media (mis. gambar_media_id → gambar), kategori_id → kategori, situs_id → situs. */
export type PortalKonten = {
  id?: number;
  situs_id?: number | null;
  slug?: string;
  judul?: string;
  status?: "draf" | "review" | "terbit" | "arsip";
  terbit_pada?: string | null;
  situs?: JsonObject | null;
  kategori?: JsonObject | null;
  [key: string]: any;
};

export type PortalMediaUpload = {
  situs: string;
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  berkas: Uploadable;
  judul?: string;
  alt?: string;
  alt_en?: string;
  kredit?: string;
  [key: string]: any;
};

export type PortalStatusRequest = {
  status: "draf" | "review" | "terbit" | "arsip";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalPesanRequest = {
  situs: string;
  jenis?: "kontak" | "saran" | "pengaduan" | "permohonan_informasi";
  nama: string;
  email: string;
  telepon?: string;
  subjek: string;
  pesan: string;
  ip_pengunjung?: string;
  [key: string]: any;
};

export type PortalDaftarAgendaRequest = {
  nama?: string;
  email?: string;
  telepon?: string;
  instansi?: string;
  ip_pengunjung?: string;
  [key: string]: any;
};

export type PortalPengelolaRequest = {
  username: string;
  peran?: "admin" | "editor" | "penulis";
  aktif?: boolean;
  [key: string]: any;
};

export type PortalSitusRequest = {
  kode?: string;
  jenis?: "universitas" | "fakultas" | "prodi" | "unit";
  induk?: number;
  kode_fakultas?: string;
  kode_prodi?: string;
  nama?: string;
  nama_en?: string;
  singkatan?: string;
  tagline?: string;
  domain?: string;
  logo_media_id?: number;
  warna_utama?: string;
  email?: string;
  telepon?: string;
  alamat?: string;
  media_sosial?: JsonObject;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalBeritaRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  /** ID kategori */
  kategori_id?: number;
  jenis?: "berita" | "artikel" | "opini" | "prestasi" | "liputan" | "siaran_pers";
  ringkasan?: string;
  ringkasan_en?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi_en?: string;
  /** ID portal_media situs yang sama */
  gambar_media_id?: number;
  penulis_tampil?: string;
  sumber?: string;
  unggulan?: boolean;
  sematkan?: boolean;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  tag?: Array<string>;
  orang?: Array<{
    jenis?: "mahasiswa" | "dosen";
    nim?: string;
    nidn?: string;
    peran?: string;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type PortalPengumumanRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  nomor?: string;
  /** ID kategori */
  kategori_id?: number;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi_en?: string;
  /** ID portal_media situs yang sama */
  lampiran_media_id?: number;
  prioritas?: "biasa" | "penting" | "darurat";
  sasaran?: Array<"umum" | "mahasiswa" | "dosen" | "tendik" | "calon_mahasiswa" | "alumni">;
  /** Kode prodi SIAKAD */
  sasaran_prodi?: string;
  sasaran_angkatan?: string;
  /** Contoh: `2026-12-01 08:00:00` */
  berlaku_sampai?: string;
  sematkan?: boolean;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalAgendaRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  /** ID kategori */
  kategori_id?: number;
  ringkasan?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi_en?: string;
  /** ID portal_media situs yang sama */
  gambar_media_id?: number;
  /** Contoh: `2026-12-01 08:00:00` */
  mulai: string;
  /** Contoh: `2026-12-01 08:00:00` */
  selesai?: string;
  sepanjang_hari?: boolean;
  /** Contoh: `Asia/Makassar` */
  zona_waktu?: string;
  mode?: "luring" | "daring" | "hibrida";
  lokasi?: string;
  /** m_ruang.id SIAKAD */
  ruang_id?: number;
  tautan_daring?: string;
  penyelenggara?: string;
  narahubung?: string;
  narahubung_kontak?: string;
  pendaftaran?: boolean;
  /** Contoh: `2026-12-01 08:00:00` */
  pendaftaran_tutup?: string;
  kuota?: number;
  biaya?: number;
  sasaran?: Array<"umum" | "mahasiswa" | "dosen" | "tendik" | "calon_mahasiswa" | "alumni">;
  /** tahun_id SIAKAD */
  tahun_id?: string;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalGaleriRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  /** ID kategori */
  kategori_id?: number;
  /** ID agenda */
  agenda_id?: number;
  deskripsi?: string;
  deskripsi_en?: string;
  /** ID portal_media situs yang sama */
  sampul_media_id?: number;
  tanggal?: string;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalHalamanRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  /** ID induk */
  induk_id?: number;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  isi_en?: string;
  /** ID portal_media situs yang sama */
  gambar_media_id?: number;
  templat?: string;
  urutan?: number;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalDokumenRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  /** ID kategori */
  kategori_id?: number;
  /** ID portal_media situs yang sama */
  media_id?: number;
  tautan?: string;
  nomor?: string;
  tanggal?: string;
  deskripsi?: string;
  klasifikasi_ppid?: "berkala" | "serta_merta" | "setiap_saat";
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalBannerRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  posisi?: "slider" | "samping" | "popup" | "pita";
  judul?: string;
  judul_en?: string;
  keterangan?: string;
  keterangan_en?: string;
  /** ID portal_media situs yang sama */
  media_id?: number;
  tautan?: string;
  teks_tombol?: string;
  /** Contoh: `2026-12-01 08:00:00` */
  mulai?: string;
  /** Contoh: `2026-12-01 08:00:00` */
  selesai?: string;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalTautanRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  grup?: "layanan" | "mitra" | "terkait";
  nama: string;
  nama_en?: string;
  url: string;
  ikon?: string;
  /** ID portal_media situs yang sama */
  logo_media_id?: number;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalStrukturRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  jabatan: string;
  jabatan_en?: string;
  grup?: string;
  /** NIDN dosen SIAKAD */
  nidn?: string;
  nama?: string;
  /** ID portal_media situs yang sama */
  foto_media_id?: number;
  sambutan?: string;
  periode_mulai?: string;
  periode_selesai?: string;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalFaqRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  /** ID kategori */
  kategori_id?: number;
  pertanyaan: string;
  pertanyaan_en?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  jawaban: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  jawaban_en?: string;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalMenuRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  lokasi?: "utama" | "atas" | "footer" | "sidebar";
  /** ID induk */
  induk_id?: number;
  label: string;
  label_en?: string;
  tipe?: "halaman" | "kategori" | "url" | "modul";
  ref_id?: number;
  url?: string;
  tab_baru?: boolean;
  urutan?: number;
  aktif?: boolean;
  [key: string]: any;
};

export type PortalLowonganRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  judul: string;
  judul_en?: string;
  /** Kosong = dibuat dari judul */
  slug?: string;
  instansi?: string;
  /** ID portal_media situs yang sama */
  logo_media_id?: number;
  /** ID portal_media situs yang sama */
  gambar_media_id?: number;
  /** ID portal_media situs yang sama */
  lampiran_media_id?: number;
  lokasi?: string;
  tipe?: "penuh_waktu" | "paruh_waktu" | "kontrak" | "magang" | "lepas";
  sistem_kerja?: "kantor" | "hibrida" | "jarak_jauh";
  bidang?: string;
  pendidikan?: string;
  gaji?: string;
  jumlah?: number;
  /** HTML; tag/atribut berbahaya dibuang server */
  deskripsi?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  syarat?: string;
  /** HTML; tag/atribut berbahaya dibuang server */
  cara_melamar?: string;
  tautan?: string;
  email?: string;
  batas_lamaran?: string;
  sematkan?: boolean;
  meta_judul?: string;
  meta_deskripsi?: string;
  /** Hanya saat membuat */
  status?: "draf" | "review" | "terbit";
  /** Contoh: `2026-12-01 08:00:00` */
  terbit_pada?: string;
  [key: string]: any;
};

export type PortalKategoriRequest = {
  /** Kode atau ID situs (wajib saat membuat) */
  situs?: string;
  jenis: "berita" | "pengumuman" | "agenda" | "galeri" | "dokumen" | "faq";
  /** ID induk */
  induk_id?: number;
  /** Kosong = dibuat dari judul */
  slug?: string;
  nama: string;
  nama_en?: string;
  deskripsi?: string;
  warna?: string;
  urutan?: number;
  [key: string]: any;
};

export type PresensiSesi = {
  /** UUID */
  id?: string | null;
  /** kuliah | kegiatan */
  jenis?: string | null;
  /** Contoh: `Basis Data kelas A` */
  judul?: string | null;
  keterangan?: string | null;
  /** draf | buka | tutup | disahkan | batal */
  status?: string | null;
  /** Contoh: `2026-11-16` */
  tanggal?: string | null;
  mulai_at?: string | null;
  selesai_at?: string | null;
  dibuka_at?: string | null;
  ditutup_at?: string | null;
  /** Hanya untuk jenis kuliah */
  kuliah?: {
    idj?: number | null;
    kode_prodi?: string | null;
    tahun_id?: string | null;
    kode_mk?: string | null;
    kelas?: string | null;
    nidn?: string | null;
    /** m_jam.idj */
    jam?: number | null;
    jam_selesai?: number | null;
    lama?: number | null;
    /** Jurnal/berita acara */
    bahasan?: string | null;
    /** t_dosen_presensi.iddm setelah disahkan */
    siakad_iddm?: number | null;
    /** Kelas LMS jadwal ini (bila ada) */
    lms_kelas_id?: number | null;
    /** lms_presensi_sesi salinan setelah disahkan */
    lms_sesi_id?: number | null;
    [key: string]: any;
  };
  /** kelas | undangan | terbuka | mahasiswa | pegawai */
  peserta?: string | null;
  /** Bagian penyelenggara (gaya QR) */
  unit?: string | null;
  /** Contoh: `20` */
  interval_detik?: number | null;
  pakai_kode?: boolean;
  /** Kode cadangan (hanya pengelola) */
  kode?: string | null;
  izinkan_kartu?: boolean;
  terlambat_menit?: number | null;
  lokasi?: {
    lat?: number | null;
    lng?: number | null;
    radius_m?: number | null;
    wajib?: boolean;
    [key: string]: any;
  };
  tolak_perangkat_ganda?: boolean;
  /** A | I | S */
  status_kosong?: string | null;
  jumlah_hadir?: number | null;
  ringkasan?: {
    /** Jumlah peserta daftar (null = terbuka) */
    peserta?: number | null;
    hadir?: number | null;
    izin?: number | null;
    sakit?: number | null;
    alpa?: number | null;
    belum?: number | null;
    terlambat?: number | null;
    curiga?: number | null;
    persen_hadir?: number | null;
    [key: string]: any;
  };
  hak?: {
    kelola?: boolean;
    bantu?: boolean;
    [key: string]: any;
  };
  petugas?: Array<string>;
  disahkan_at?: string | null;
  disahkan_oleh?: string | null;
  dibuat_oleh?: string | null;
  created_at?: string | null;
  /** Hasil pengesahan ke SIAKAD: iddm, baru, mahasiswa/diubah, tidak_tercatat, pesan */
  siakad?: JsonObject | null;
  /** Salinan ke kelas LMS: kelas_id, sesi_id, pertemuan_ke, mahasiswa (null bila jadwal tanpa kelas LMS) */
  lms?: JsonObject | null;
  [key: string]: any;
};

export type PresensiSesiInput = {
  /** kuliah | kegiatan */
  jenis?: string | null;
  /** Kuliah: t_jadwal.idj */
  idj?: number | null;
  /** Kuliah: kelas LMS (pengganti idj) */
  lms_kelas_id?: number | null;
  tanggal?: string | null;
  jam?: number | null;
  jam_selesai?: number | null;
  lama?: number | null;
  nidn?: string | null;
  bahasan?: string | null;
  judul?: string | null;
  keterangan?: string | null;
  mulai_at?: string | null;
  selesai_at?: string | null;
  /** Kegiatan: undangan | terbuka | mahasiswa | pegawai */
  peserta?: string | null;
  undangan?: Array<{
    /** mahasiswa | dosen | tendik */
    jenis?: string | null;
    /** NIM/NIDN/username */
    subjek?: string | null;
    nama?: string | null;
    peran?: string | null;
    [key: string]: any;
  }>;
  ganti_undangan?: boolean;
  unit?: string | null;
  /** Contoh: `20` */
  interval_detik?: number | null;
  pakai_kode?: boolean;
  izinkan_kartu?: boolean;
  /** "lat,lng" Contoh: `-0.5435,123.0568` */
  lokasi?: string | null;
  radius_m?: number | null;
  wajib_lokasi?: boolean;
  /** Kode/UUID titik (pakai lokasinya) */
  titik?: string | null;
  tolak_perangkat_ganda?: boolean;
  terlambat_menit?: number | null;
  status_kosong?: string | null;
  petugas?: Array<string>;
  /** Langsung buka */
  buka?: boolean;
  [key: string]: any;
};

export type PresensiQr = {
  /** Token bertanda tangan */
  token?: string | null;
  /** Teks yang dijadikan QR (token, atau URL PRESENSI_URL?t=token) */
  isi?: string | null;
  jendela?: number | null;
  berlaku_sampai?: string | null;
  /** Panggil ulang setelah ini */
  sisa_detik?: number | null;
  interval_detik?: number | null;
  /** Kode cadangan sesi */
  kode?: string | null;
  /** Gaya QR untuk KodeQrSiakad / GET /v1/qr/gaya/efektif */
  gaya?: {
    /** Contoh: `presensi` */
    kode?: string | null;
    bagian?: string | null;
    [key: string]: any;
  };
  /** SVG bila ?svg=1 dan generator QR terpasang */
  svg?: string | null;
  ringkasan?: {
    /** Jumlah peserta daftar (null = terbuka) */
    peserta?: number | null;
    hadir?: number | null;
    izin?: number | null;
    sakit?: number | null;
    alpa?: number | null;
    belum?: number | null;
    terlambat?: number | null;
    curiga?: number | null;
    persen_hadir?: number | null;
    [key: string]: any;
  };
  terbaru?: Array<JsonObject | null>;
  /** Kartu: jenis, subjek, nama */
  pemilik?: JsonObject | null;
  /** QR titik: data titik */
  titik?: JsonObject | null;
  /** QR titik: jumlah masuk/pulang */
  hari_ini?: JsonObject | null;
  peringatan?: string | null;
  [key: string]: any;
};

export type PresensiPindaiInput = {
  /** Isi QR yang dipindai */
  token?: string | null;
  /** Kode cadangan (tanpa token) */
  kode?: string | null;
  /** "lat,lng" */
  lokasi?: string | null;
  /** ID perangkat stabil dari aplikasi */
  perangkat?: string | null;
  /** Titik kerja: masuk | pulang (bawaan otomatis) */
  aksi?: string | null;
  [key: string]: any;
};

export type PresensiPindaiHasil = {
  /** Sudah tercatat sebelumnya */
  sudah?: boolean;
  /** Contoh: `Presensi tercatat.` */
  pesan?: string | null;
  hadir?: {
    jenis?: string | null;
    subjek?: string | null;
    nama?: string | null;
    status?: string | null;
    waktu?: string | null;
    cara?: string | null;
    terlambat?: boolean;
    terlambat_menit?: number | null;
    jarak_m?: number | null;
    curiga?: boolean;
    [key: string]: any;
  };
  /** Sesi (id, jenis, judul, tanggal, kelas, kode_mk) */
  sesi?: JsonObject | null;
  /** Titik kerja: masuk | pulang */
  aksi?: string | null;
  titik?: JsonObject | null;
  /** Titik kerja: baris sdm_presensi */
  presensi?: JsonObject | null;
  [key: string]: any;
};

export type PresensiIzin = {
  id?: string | null;
  sesi_id?: string | null;
  sesi_judul?: string | null;
  idj?: number | null;
  tanggal?: string | null;
  jenis_subjek?: string | null;
  subjek?: string | null;
  nama?: string | null;
  /** izin | sakit */
  jenis?: string | null;
  alasan?: string | null;
  berkas_id?: string | null;
  /** diajukan | disetujui | ditolak | batal */
  status?: string | null;
  diproses_oleh?: string | null;
  diproses_at?: string | null;
  catatan_proses?: string | null;
  created_at?: string | null;
  diterapkan?: JsonObject | null;
  [key: string]: any;
};

export type PresensiIzinInput = {
  sesi_id?: string | null;
  idj?: number | null;
  tanggal?: string | null;
  /** izin | sakit */
  jenis?: string | null;
  alasan?: string | null;
  /** UUID dari /v1/berkas */
  berkas_id?: string | null;
  [key: string]: any;
};

export type PresensiTitik = {
  id?: string | null;
  /** Contoh: `gerbang-utama` */
  kode?: string | null;
  nama?: string | null;
  /** gerbang | kantor | ruang | lainnya */
  jenis?: string | null;
  /** pegawai | dosen | tendik */
  untuk?: string | null;
  unit?: string | null;
  lokasi?: {
    lat?: number | null;
    lng?: number | null;
    radius_m?: number | null;
    wajib?: boolean;
    [key: string]: any;
  };
  wajib_lokasi?: boolean;
  interval_detik?: number | null;
  aktif?: boolean;
  keterangan?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type PresensiTitikInput = {
  kode?: string | null;
  nama?: string | null;
  jenis?: string | null;
  untuk?: string | null;
  unit?: string | null;
  /** "lat,lng" */
  lokasi?: string | null;
  radius_m?: number | null;
  wajib_lokasi?: boolean;
  interval_detik?: number | null;
  aktif?: boolean;
  keterangan?: string | null;
  ganti_rahasia?: boolean;
  [key: string]: any;
};

/** Riwayat pekerjaan (tabel profil_riwayat_pekerjaan) */
export type ProfilPekerjaan = {
  id?: number;
  /** user.username */
  username?: string;
  instansi?: string;
  jabatan?: string;
  unit_kerja?: string;
  jenis?: "tetap" | "kontrak" | "paruh_waktu" | "honorer" | "magang" | "wirausaha" | "lepas" | "lainnya";
  sektor?: "pemerintah" | "swasta" | "bumn" | "pendidikan" | "nirlaba" | "wirausaha" | "internasional" | "lainnya";
  lokasi?: string;
  mulai?: string;
  selesai?: string;
  masih_bekerja?: boolean;
  deskripsi?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilPekerjaanInput = {
  /** user.username */
  username: string;
  instansi: string;
  jabatan: string;
  unit_kerja?: string;
  jenis?: "tetap" | "kontrak" | "paruh_waktu" | "honorer" | "magang" | "wirausaha" | "lepas" | "lainnya";
  sektor?: "pemerintah" | "swasta" | "bumn" | "pendidikan" | "nirlaba" | "wirausaha" | "internasional" | "lainnya";
  lokasi?: string;
  mulai: string;
  selesai?: string;
  masih_bekerja?: boolean;
  deskripsi?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Riwayat pendidikan (tabel profil_riwayat_pendidikan) */
export type ProfilPendidikan = {
  id?: number;
  /** user.username */
  username?: string;
  jenjang?: "SD" | "SMP" | "SMA" | "D1" | "D2" | "D3" | "D4" | "S1" | "S2" | "S3" | "PROFESI" | "SPESIALIS" | "NONFORMAL";
  institusi?: string;
  program_studi?: string;
  gelar?: string;
  negara?: string;
  tahun_masuk?: number;
  tahun_lulus?: number;
  masih_studi?: boolean;
  ipk?: number;
  nomor_ijazah?: string;
  judul_tugas_akhir?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilPendidikanInput = {
  /** user.username */
  username: string;
  jenjang: "SD" | "SMP" | "SMA" | "D1" | "D2" | "D3" | "D4" | "S1" | "S2" | "S3" | "PROFESI" | "SPESIALIS" | "NONFORMAL";
  institusi: string;
  program_studi?: string;
  gelar?: string;
  negara?: string;
  tahun_masuk?: number;
  tahun_lulus?: number;
  masih_studi?: boolean;
  ipk?: number;
  nomor_ijazah?: string;
  judul_tugas_akhir?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Prestasi dan sertifikasi (tabel profil_riwayat_prestasi) */
export type ProfilPrestasi = {
  id?: number;
  /** user.username */
  username?: string;
  jenis?: "penghargaan" | "sertifikasi" | "pelatihan" | "kompetisi" | "publikasi" | "lainnya";
  judul?: string;
  penyelenggara?: string;
  tingkat?: "internal" | "lokal" | "provinsi" | "nasional" | "internasional";
  peringkat?: string;
  tanggal?: string;
  berlaku_sampai?: string;
  nomor_sertifikat?: string;
  tautan?: string;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilPrestasiInput = {
  /** user.username */
  username: string;
  jenis: "penghargaan" | "sertifikasi" | "pelatihan" | "kompetisi" | "publikasi" | "lainnya";
  judul: string;
  penyelenggara?: string;
  tingkat?: "internal" | "lokal" | "provinsi" | "nasional" | "internasional";
  peringkat?: string;
  tanggal?: string;
  berlaku_sampai?: string;
  nomor_sertifikat?: string;
  tautan?: string;
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Organisasi (tabel profil_riwayat_organisasi) */
export type ProfilOrganisasi = {
  id?: number;
  /** user.username */
  username?: string;
  nama_organisasi?: string;
  jabatan?: string;
  jenis?: "kemahasiswaan" | "profesi" | "kemasyarakatan" | "kepanitiaan" | "relawan" | "lainnya";
  mulai?: string;
  selesai?: string;
  masih_aktif?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilOrganisasiInput = {
  /** user.username */
  username: string;
  nama_organisasi: string;
  jabatan?: string;
  jenis?: "kemahasiswaan" | "profesi" | "kemasyarakatan" | "kepanitiaan" | "relawan" | "lainnya";
  mulai?: string;
  selesai?: string;
  masih_aktif?: boolean;
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Dokumen pribadi (tabel profil_dokumen) */
export type ProfilDokumen = {
  id?: number;
  /** user.username */
  username?: string;
  /** (hanya baca) Hanya dibaca. */
  peran?: "mahasiswa" | "alumni" | "dosen" | "tendik" | "pengguna";
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  jenis?: string;
  judul?: string;
  nomor?: string;
  penerbit?: string;
  tanggal_terbit?: string;
  berlaku_sampai?: string;
  keterangan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "tidak_perlu" | "diajukan" | "terverifikasi" | "ditolak";
  /** (hanya baca) Hanya dibaca. */
  catatan_verifikasi?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diverifikasi_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilDokumenInput = {
  /** user.username */
  username: string;
  jenis: string;
  judul?: string;
  nomor?: string;
  penerbit?: string;
  tanggal_terbit?: string;
  berlaku_sampai?: string;
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type ProfilDokumenVerifikasiInput = {
  catatan?: string;
  [key: string]: any;
};

export type ProfilDokumenTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Permohonan perubahan data induk (tabel profil_permohonan) */
export type ProfilPermohonan = {
  id?: number;
  /** user.username */
  username?: string;
  /** (hanya baca) Hanya dibaca. */
  peran?: "mahasiswa" | "alumni" | "dosen" | "tendik" | "pengguna";
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  kolom?: string;
  /** (hanya baca) Hanya dibaca. */
  nilai_lama?: string;
  nilai_baru?: string;
  alasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type ProfilPermohonanInput = {
  /** user.username */
  username: string;
  kolom: string;
  nilai_baru: string;
  alasan: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type ProfilPermohonanSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type ProfilPermohonanTolakInput = {
  catatan: string;
  [key: string]: any;
};

/** Gaya QR. Kunci yang tidak dikirim memakai bawaan (atau gaya dasar yang ditimpa). */
export type QrGaya = {
  /** Warna modul (hex) Contoh: `#0f172a` */
  warna?: string;
  /** Warna latar (hex) atau "transparan" Contoh: `#ffffff` */
  latar?: string;
  /** Gradasi warna modul; null = polos */
  gradasi?: {
    jenis?: "linear" | "radial";
    /** Derajat untuk linear (0 = kiri ke kanan, 90 = atas ke bawah) */
    sudut?: number;
    warna?: Array<string>;
    [key: string]: any;
  };
  /** Bentuk titik data */
  modul?: "kotak" | "bulat" | "titik" | "rounded" | "menyatu" | "berlian" | "garis_v" | "garis_h";
  /** Bentuk bingkai mata (pola pencari di 3 pojok) */
  mata_luar?: "kotak" | "rounded" | "bulat" | "daun";
  /** Bentuk bola mata */
  mata_dalam?: "kotak" | "rounded" | "bulat" | "daun" | "berlian";
  /** Hex; null = ikut warna/gradasi modul */
  warna_mata_luar?: string;
  /** Hex; null = ikut warna/gradasi modul */
  warna_mata_dalam?: string;
  logo?: {
    /** kampus = logo di data perguruan tinggi; berkas = berkas_id dari /v1/berkas; data = data URI */
    sumber?: "kampus" | "berkas" | "data";
    /** UUID berkas PNG/JPG/WebP */
    berkas_id?: string;
    /** data:image/png;base64,... (maks. 400 KB) */
    data?: string;
    /** Lebar logo terhadap QR, 0.08-0.30 (bawaan 0.2) */
    ukuran?: number;
    /** Kosongkan modul di bawah logo (bawaan true) */
    kosongkan?: boolean;
    /** Jarak kosong di sekitar logo, modul (0-4) */
    margin?: number;
    /** Warna di belakang logo (hex) atau null */
    latar?: string;
    /** Logo dipotong lingkaran */
    bulat?: boolean;
    [key: string]: any;
  };
  bingkai?: {
    /** Maks. 40 karakter Contoh: `Pindai untuk presensi` */
    teks?: string;
    posisi?: "bawah" | "atas";
    bentuk?: "kotak" | "pil";
    /** Warna bingkai (hex) */
    warna?: string;
    /** Warna teks (hex) */
    warna_teks?: string;
    [key: string]: any;
  };
  /** Tingkat koreksi galat; naik otomatis ke Q/H bila ada logo */
  koreksi?: "L" | "M" | "Q" | "H";
  /** Zona sunyi, modul (0-10, bawaan 4) */
  margin?: number;
  /** Sudut bulat latar, persen setengah sisi (0-50) */
  radius_latar?: number;
  [key: string]: any;
};

export type QrBuatInput = {
  /** Teks/URL (maks. 2000 byte) Contoh: `https://siakad.unipo.ac.id/v/AB12CD` */
  isi: string;
  /** Kode gaya tersimpan (string) atau objek QrGaya */
  gaya?: string | QrGaya;
  gaya_tambahan?: QrGaya;
  /** Kode unit untuk mencari gaya Contoh: `fik` */
  bagian?: string;
  /** Lebar px 64-2048 Contoh: `512` */
  ukuran?: number;
  koreksi?: "L" | "M" | "Q" | "H";
  margin?: number;
  keluaran?: "json" | "svg" | "png";
  /** Keluaran json: sertakan data_uri_png */
  png?: boolean;
  /** Simpan PNG ke /v1/berkas (scope qr:write) */
  simpan?: boolean;
  /** Modul pemakai berkas Contoh: `presensi` */
  modul?: string;
  /** Referensi di modul */
  referensi?: string;
  visibilitas?: "privat" | "publik";
  folder?: string;
  nama_file?: string;
  [key: string]: any;
};

export type QrHasil = {
  /** SVG lengkap */
  svg?: string;
  /** data:image/svg+xml;base64,... */
  data_uri?: string;
  /** Bila png=true */
  data_uri_png?: string;
  /** Versi QR 1-40 */
  versi?: number;
  /** Jumlah modul per sisi */
  modul?: number;
  koreksi?: string;
  ukuran?: number;
  gaya?: QrGaya;
  peringatan?: Array<string>;
  /** Bila simpan=true: {id, baru, berkas {id, nama, unduh, url, ...}} */
  simpan?: JsonObject;
  [key: string]: any;
};

export type QrGayaInput = {
  /** Huruf kecil/angka/_/-, mis. presensi, dokumen, kartu Contoh: `presensi` */
  kode?: string;
  /** Nama gaya */
  nama?: string;
  keterangan?: string;
  /** Kode unit arsip; kosong = kampus */
  bagian?: string;
  gaya?: QrGaya;
  aktif?: boolean;
  [key: string]: any;
};

export type QrGayaTersimpan = {
  /** UUID */
  id?: string;
  kode?: string;
  nama?: string;
  keterangan?: string;
  bagian?: string;
  bagian_nama?: string;
  gaya?: QrGaya;
  aktif?: boolean;
  diubah_oleh?: string;
  diubah_at?: string;
  [key: string]: any;
};

export type QrGayaEfektif = {
  kode?: string;
  /** Unit pemilik gaya yang dipakai; null = kampus/preset */
  bagian?: string;
  sumber?: "tersimpan" | "bawaan";
  /** UUID gaya tersimpan */
  id?: string;
  nama?: string;
  gaya?: QrGaya;
  [key: string]: any;
};

/** Aplikasi (tabel rbac_aplikasi) */
export type RbacAplikasi = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  keterangan?: string;
  jenis?: "web" | "mobile" | "layanan" | "api";
  url?: string;
  visibilitas?: "publik" | "privat";
  url_android?: string;
  url_ios?: string;
  client_id_api?: string;
  client_id_sso?: string;
  /** (hanya baca) Hanya dibaca. */
  sistem?: boolean;
  aktif?: boolean;
  urut?: number;
  /** Nilai JSON apa pun */
  sasaran?: any;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacAplikasiInput = {
  /** (unik) */
  kode: string;
  nama: string;
  keterangan?: string;
  jenis?: "web" | "mobile" | "layanan" | "api";
  url?: string;
  visibilitas?: "publik" | "privat";
  url_android?: string;
  url_ios?: string;
  client_id_api?: string;
  client_id_sso?: string;
  aktif?: boolean;
  urut?: number;
  /** Nilai JSON apa pun */
  sasaran?: any;
  [key: string]: any;
};

/** Izin (permission) (tabel rbac_izin) */
export type RbacIzin = {
  id?: number;
  /** ID di rbac_aplikasi */
  aplikasi_id?: number;
  /** (unik) */
  kode?: string;
  jenis?: "akses" | "aksi" | "menu" | "data" | "scope";
  grup?: string;
  nama?: string;
  keterangan?: string;
  berlingkup?: boolean;
  /** (hanya baca) Hanya dibaca. */
  sistem?: boolean;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacIzinInput = {
  /** ID di rbac_aplikasi */
  aplikasi_id: number;
  /** (unik) */
  kode: string;
  jenis?: "akses" | "aksi" | "menu" | "data" | "scope";
  grup?: string;
  nama: string;
  keterangan?: string;
  berlingkup?: boolean;
  aktif?: boolean;
  [key: string]: any;
};

/** Peran (role) (tabel rbac_peran) */
export type RbacPeran = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  keterangan?: string;
  /** ID di rbac_aplikasi */
  aplikasi_id?: number;
  /** ID di rbac_peran */
  induk_id?: number;
  lingkup?: "global" | "unit";
  jenis_unit?: string;
  level_siakad?: string;
  boleh_didelegasikan?: boolean;
  maks_pemegang?: number;
  /** (hanya baca) Hanya dibaca. */
  sistem?: boolean;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacPeranInput = {
  /** (unik) */
  kode: string;
  nama: string;
  keterangan?: string;
  /** ID di rbac_aplikasi */
  aplikasi_id?: number;
  /** ID di rbac_peran */
  induk_id?: number;
  lingkup?: "global" | "unit";
  jenis_unit?: string;
  level_siakad?: string;
  boleh_didelegasikan?: boolean;
  maks_pemegang?: number;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

/** Izin peran (tabel rbac_peran_izin) */
export type RbacPeranIzin = {
  id?: number;
  /** ID di rbac_peran */
  peran_id?: number;
  izin?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacPeranIzinInput = {
  /** ID di rbac_peran */
  peran_id: number;
  izin: string;
  [key: string]: any;
};

/** Penugasan peran (tabel rbac_penugasan) */
export type RbacPenugasan = {
  id?: number;
  /** user.username */
  username?: string;
  /** ID di rbac_peran */
  peran_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  mulai?: string;
  selesai?: string;
  aktif?: boolean;
  sumber?: "manual" | "impor" | "aplikasi";
  nomor_sk?: string;
  alasan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacPenugasanInput = {
  /** user.username */
  username: string;
  /** ID di rbac_peran */
  peran_id: number;
  /** ID di induk_unit */
  unit_id?: number;
  mulai?: string;
  selesai?: string;
  aktif?: boolean;
  sumber?: "manual" | "impor" | "aplikasi";
  nomor_sk?: string;
  alasan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type RbacPenugasanCabutInput = {
  alasan?: string;
  [key: string]: any;
};

/** Peran untuk level lama (tabel rbac_level) */
export type RbacLevel = {
  id?: number;
  level?: string;
  /** ID di rbac_peran */
  peran_id?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacLevelInput = {
  level: string;
  /** ID di rbac_peran */
  peran_id: number;
  [key: string]: any;
};

/** Peran untuk jabatan (tabel rbac_jabatan) */
export type RbacJabatan = {
  id?: number;
  /** ID di induk_jabatan */
  jabatan_id?: number;
  /** ID di rbac_peran */
  peran_id?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RbacJabatanInput = {
  /** ID di induk_jabatan */
  jabatan_id: number;
  /** ID di rbac_peran */
  peran_id: number;
  [key: string]: any;
};

export type RbacHakAkses = {
  username?: string;
  nama?: string;
  /** Level lama SIAKAD (user.level) */
  level?: string;
  peran?: Array<{
    kode?: string;
    nama?: string;
    sumber?: "level" | "penugasan" | "jabatan" | "pegawai" | "akun";
    unit?: {
      id?: number;
      kode?: string;
      jenis?: string;
      kode_prodi?: string | null;
      kode_fakultas?: string | null;
      [key: string]: any;
    };
    aplikasi?: string;
    level_siakad?: string;
    mulai?: string;
    selesai?: string;
    [key: string]: any;
  }>;
  kode_peran?: Array<string>;
  izin?: Array<{
    kode?: string;
    aplikasi?: string;
    lingkup?: "semua" | "unit";
    unit?: Array<{
      id?: number;
      kode?: string;
      jenis?: string;
      kode_prodi?: string | null;
      kode_fakultas?: string | null;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  /** Pola izin mentah => "semua" atau daftar ID unit */
  pola?: JsonObject;
  aplikasi?: Array<{
    kode?: string;
    nama?: string;
    jenis?: string;
    url?: string;
    client_id_sso?: string;
    akses?: boolean;
    [key: string]: any;
  }>;
  scope_api?: Array<string>;
  /** Level lama yang setara dengan peran yang dipegang */
  level_siakad_tersedia?: Array<string>;
  /** Aplikasi yang dinonaktifkan Pustikom: SSO menolak login ke kliennya dengan pesan */
  aplikasi_nonaktif?: Array<{
    kode?: string;
    nama?: string;
    client_id_sso?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type RbacCekInput = {
  /** Contoh: `lms.kelas.kelola` */
  izin: string | Array<string>;
  /** Contoh: `55201` */
  unit?: string;
  username?: string;
  di_mana_saja?: boolean;
  [key: string]: any;
};

export type RbacCek = {
  username?: string;
  unit_id?: number | null;
  semua_boleh?: boolean;
  izin?: Record<string, {
    boleh?: boolean;
    lingkup?: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type RbacDaftarIzinInput = {
  izin: Array<{
    kode: string;
    nama: string;
    jenis?: "akses" | "aksi" | "menu" | "data";
    grup?: string;
    keterangan?: string;
    berlingkup?: boolean;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type RbacAksesLive = {
  id?: string;
  client_id?: string;
  nama_klien?: string | null;
  klien_ada?: boolean;
  status?: "menunggu" | "disetujui" | "ditolak" | "dicabut" | "dibatalkan";
  alasan?: string;
  diajukan_oleh?: string;
  diajukan_at?: string;
  diputuskan_oleh?: string | null;
  diputuskan_at?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type RbacSalinanDev = {
  id?: string;
  status?: "menunggu" | "berjalan" | "selesai" | "gagal" | "dibatalkan";
  opsi?: JsonObject;
  dibuat_oleh?: string;
  dibuat_at?: string;
  mulai_at?: string | null;
  selesai_at?: string | null;
  tabel_total?: number;
  tabel_selesai?: number;
  tabel_sekarang?: string | null;
  baris?: number;
  disamarkan?: Array<JsonObject>;
  pesan?: string | null;
  galat?: string | null;
  [key: string]: any;
};

export type RbacKlienApi = {
  id?: string;
  name?: string;
  scopes?: Array<string>;
  allow_user_login?: boolean;
  trust_user_ip?: boolean;
  sso_audience?: string | null;
  allowed_ips?: Array<string>;
  allowed_origins?: Array<string>;
  prodi?: Array<string>;
  rate_limit?: number | null;
  active?: boolean;
  created_at?: string;
  logo_uri?: string | null;
  /** Kode aplikasi bawaan pemilik klien (null = klien biasa) */
  aplikasi_bawaan?: string | null;
  /** Scope wajib aplikasi bawaan; selalu ada dan tidak bisa dicabut */
  scopes_wajib?: Array<string>;
  /** Hanya saat dibuat */
  client_secret?: string;
  [key: string]: any;
};

export type RbacKlienApiInput = {
  name?: string;
  scopes?: Array<string>;
  allow_user_login?: boolean;
  trust_user_ip?: boolean;
  /** Contoh: `lms` */
  sso_audience?: string | null;
  allowed_ips?: Array<string>;
  allowed_origins?: Array<string>;
  prodi?: Array<string>;
  rate_limit?: number | null;
  active?: boolean;
  [key: string]: any;
};

export type RbacAturIzinInput = {
  izin: Array<string>;
  [key: string]: any;
};

/** Koleksi (tabel repo_koleksi) */
export type RepositoriKoleksi = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  deskripsi?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RepositoriKoleksiInput = {
  /** (unik) */
  kode: string;
  nama: string;
  deskripsi?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Karya ilmiah (tabel repo_karya) */
export type RepositoriKarya = {
  id?: number;
  /** ID di repo_koleksi */
  koleksi_id?: number;
  jenis?: "skripsi" | "tesis" | "disertasi" | "tugas_akhir" | "laporan_kp" | "laporan_pkl" | "artikel" | "prosiding" | "buku" | "laporan_penelitian" | "laporan_pkm" | "modul_ajar" | "lainnya";
  judul?: string;
  judul_en?: string;
  abstrak?: string;
  abstrak_en?: string;
  kata_kunci?: string;
  /** user.username */
  penulis_username?: string;
  penulis_nama?: string;
  penulis_lain?: JsonObject;
  pembimbing?: JsonObject;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tahun?: number;
  tanggal?: string;
  bahasa?: string;
  halaman?: number;
  penerbit?: string;
  doi?: string;
  isbn_issn?: string;
  url?: string;
  lisensi?: string;
  akses?: "publik" | "login" | "tertutup";
  embargo_sampai?: string;
  /** (hanya pengelola) */
  skor_plagiasi?: number;
  /** (hanya pengelola) */
  alat_plagiasi?: string;
  /** (hanya pengelola) */
  ta_id?: number;
  /** (hanya pengelola) */
  lppm_luaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "revisi" | "diterbitkan" | "ditolak" | "ditarik";
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diterbitkan_pada?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  diperiksa_oleh?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RepositoriKaryaInput = {
  /** ID di repo_koleksi */
  koleksi_id?: number;
  jenis: "skripsi" | "tesis" | "disertasi" | "tugas_akhir" | "laporan_kp" | "laporan_pkl" | "artikel" | "prosiding" | "buku" | "laporan_penelitian" | "laporan_pkm" | "modul_ajar" | "lainnya";
  judul: string;
  judul_en?: string;
  abstrak?: string;
  abstrak_en?: string;
  kata_kunci?: string;
  /** user.username */
  penulis_username: string;
  penulis_nama?: string;
  penulis_lain?: JsonObject;
  pembimbing?: JsonObject;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tahun: number;
  tanggal?: string;
  bahasa?: string;
  halaman?: number;
  penerbit?: string;
  doi?: string;
  isbn_issn?: string;
  url?: string;
  lisensi?: string;
  akses?: "publik" | "login" | "tertutup";
  embargo_sampai?: string;
  /** (hanya pengelola) */
  skor_plagiasi?: number;
  /** (hanya pengelola) */
  alat_plagiasi?: string;
  /** (hanya pengelola) */
  ta_id?: number;
  /** (hanya pengelola) */
  lppm_luaran_id?: number;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type RepositoriKaryaTerbitkanInput = {
  skor_plagiasi?: number;
  alat_plagiasi?: string;
  catatan?: string;
  [key: string]: any;
};

export type RepositoriKaryaMintaRevisiInput = {
  catatan: string;
  skor_plagiasi?: number;
  alat_plagiasi?: string;
  [key: string]: any;
};

export type RepositoriKaryaTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type RepositoriKaryaTarikInput = {
  alasan: string;
  [key: string]: any;
};

/** Skema RPL (tabel rpl_skema) */
export type RplSkema = {
  id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  tipe?: "transfer_kredit" | "perolehan_kredit";
  nama?: string;
  keterangan?: string;
  sks_maks?: number;
  nilai_lulus?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplSkemaInput = {
  /** m_program_studi.kode_prodi */
  kode_prodi: string;
  tipe?: "transfer_kredit" | "perolehan_kredit";
  nama: string;
  keterangan?: string;
  sks_maks?: number;
  nilai_lulus?: number;
  /** m_tahun.tahun_id */
  tahun_id?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Komposisi penilaian RPL (tabel rpl_komponen) */
export type RplKomponen = {
  id?: number;
  /** ID di rpl_skema */
  skema_id?: number;
  nama?: string;
  bobot?: number;
  urutan?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplKomponenInput = {
  /** ID di rpl_skema */
  skema_id: number;
  nama: string;
  bobot: number;
  urutan?: number;
  [key: string]: any;
};

/** Asesor RPL (tabel rpl_asesor) */
export type RplAsesor = {
  id?: number;
  /** m_dosen.NIDN */
  nidn?: string;
  /** user.username */
  username?: string;
  nama?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  bidang?: string;
  nomor_sertifikat?: string;
  instansi?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplAsesorInput = {
  /** m_dosen.NIDN */
  nidn?: string;
  /** user.username */
  username?: string;
  nama?: string;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  bidang?: string;
  nomor_sertifikat?: string;
  instansi?: string;
  aktif?: boolean;
  [key: string]: any;
};

/** Pengajuan RPL (tabel rpl_pengajuan) */
export type RplPengajuan = {
  id?: number;
  /** ID di rpl_skema */
  skema_id?: number;
  /** m_program_studi.kode_prodi (hanya baca) Hanya dibaca. */
  kode_prodi?: string;
  pmb_pendaftaran_id?: number;
  /** (hanya baca) Hanya dibaca. */
  no_pmb?: string;
  /** m_mahasiswa.NIM (hanya baca) Hanya dibaca. */
  nim?: string;
  nama?: string;
  email?: string;
  hp?: string;
  asal_pt?: string;
  asal_prodi?: string;
  ringkasan?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "draf" | "diajukan" | "asesmen" | "ditetapkan" | "ditolak" | "batal";
  /** (hanya baca) Hanya dibaca. */
  sks_diakui?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor_sk?: string;
  /** (hanya baca) Hanya dibaca. */
  tanggal_sk?: string;
  /** (hanya baca) Hanya dibaca. */
  diintegrasi_at?: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_at?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplPengajuanInput = {
  /** ID di rpl_skema */
  skema_id: number;
  pmb_pendaftaran_id?: number;
  nama: string;
  email?: string;
  hp?: string;
  asal_pt?: string;
  asal_prodi?: string;
  ringkasan?: string;
  /** (hanya pengelola) */
  catatan?: string;
  [key: string]: any;
};

export type RplPengajuanMulaiAsesmenInput = {
  catatan?: string;
  [key: string]: any;
};

export type RplPengajuanKembalikanInput = {
  catatan: string;
  [key: string]: any;
};

export type RplPengajuanTolakInput = {
  catatan: string;
  [key: string]: any;
};

export type RplPengajuanBatalInput = {
  catatan?: string;
  [key: string]: any;
};

/** Pengalaman pemohon RPL (tabel rpl_pengalaman) */
export type RplPengalaman = {
  id?: number;
  /** ID di rpl_pengajuan */
  pengajuan_id?: number;
  jenis?: "kerja" | "pelatihan" | "sertifikasi" | "pendidikan_formal" | "pendidikan_nonformal" | "organisasi" | "karya" | "lainnya";
  judul?: string;
  instansi?: string;
  mulai?: string;
  selesai?: string;
  durasi_jam?: number;
  uraian?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplPengalamanInput = {
  /** ID di rpl_pengajuan */
  pengajuan_id: number;
  jenis: "kerja" | "pelatihan" | "sertifikasi" | "pendidikan_formal" | "pendidikan_nonformal" | "organisasi" | "karya" | "lainnya";
  judul: string;
  instansi?: string;
  mulai?: string;
  selesai?: string;
  durasi_jam?: number;
  uraian?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Dokumen bukti RPL (tabel rpl_dokumen) */
export type RplDokumen = {
  id?: number;
  /** ID di rpl_pengajuan */
  pengajuan_id?: number;
  /** ID di rpl_pengalaman */
  pengalaman_id?: number;
  jenis?: "cv" | "ijazah" | "transkrip" | "sertifikat" | "surat_keterangan_kerja" | "portofolio" | "silabus" | "lainnya";
  judul?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "valid" | "tidak_valid";
  /** (hanya pengelola) */
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplDokumenInput = {
  /** ID di rpl_pengajuan */
  pengajuan_id: number;
  /** ID di rpl_pengalaman */
  pengalaman_id?: number;
  jenis: "cv" | "ijazah" | "transkrip" | "sertifikat" | "surat_keterangan_kerja" | "portofolio" | "silabus" | "lainnya";
  judul: string;
  /** (hanya pengelola) */
  catatan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type RplDokumenValidInput = {
  catatan?: string;
  [key: string]: any;
};

export type RplDokumenTidakValidInput = {
  catatan: string;
  [key: string]: any;
};

/** Mata kuliah yang diklaim (tabel rpl_klaim) */
export type RplKlaim = {
  id?: number;
  /** ID di rpl_pengajuan */
  pengajuan_id?: number;
  id_mk?: number;
  /** (hanya baca) Hanya dibaca. */
  kode_mk?: string;
  /** (hanya baca) Hanya dibaca. */
  nama_mk?: string;
  /** (hanya baca) Hanya dibaca. */
  sks?: number;
  kode_mk_asal?: string;
  nama_mk_asal?: string;
  sks_asal?: number;
  nilai_asal?: string;
  asesmen_mandiri?: "sangat_baik" | "baik" | "cukup" | "tidak_pernah";
  bukti?: string;
  /** (hanya baca) Hanya dibaca. */
  nilai_akhir?: number;
  /** (hanya baca) Hanya dibaca. */
  nilai_huruf?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diklaim" | "diakui" | "tidak_diakui";
  /** (hanya pengelola) */
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplKlaimInput = {
  /** ID di rpl_pengajuan */
  pengajuan_id: number;
  id_mk: number;
  kode_mk_asal?: string;
  nama_mk_asal?: string;
  sks_asal?: number;
  nilai_asal?: string;
  asesmen_mandiri?: "sangat_baik" | "baik" | "cukup" | "tidak_pernah";
  bukti?: string;
  /** (hanya pengelola) */
  catatan?: string;
  [key: string]: any;
};

/** Penugasan asesor (tabel rpl_penugasan) */
export type RplPenugasan = {
  id?: number;
  /** ID di rpl_pengajuan */
  pengajuan_id?: number;
  /** ID di rpl_asesor */
  asesor_id?: number;
  peran?: "ketua" | "anggota";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplPenugasanInput = {
  /** ID di rpl_pengajuan */
  pengajuan_id: number;
  /** ID di rpl_asesor */
  asesor_id: number;
  peran?: "ketua" | "anggota";
  [key: string]: any;
};

/** Nilai asesor (tabel rpl_nilai) */
export type RplNilai = {
  id?: number;
  /** ID di rpl_klaim */
  klaim_id?: number;
  /** ID di rpl_asesor */
  asesor_id?: number;
  /** ID di rpl_komponen */
  komponen_id?: number;
  nilai?: number;
  catatan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type RplNilaiInput = {
  /** ID di rpl_klaim */
  klaim_id: number;
  /** ID di rpl_asesor */
  asesor_id?: number;
  /** ID di rpl_komponen */
  komponen_id: number;
  nilai: number;
  catatan?: string;
  [key: string]: any;
};

/** Gedung (tabel sarpras_gedung) */
export type SarprasGedung = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  /** ID di induk_unit */
  unit_id?: number;
  idkp?: string;
  alamat?: string;
  jumlah_lantai?: number;
  luas?: number;
  tahun_bangun?: number;
  status_milik?: "milik_sendiri" | "sewa" | "pinjam" | "kerja_sama";
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  lintang?: number;
  bujur?: number;
  keterangan?: string;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasGedungInput = {
  /** (unik) */
  kode: string;
  nama: string;
  /** ID di induk_unit */
  unit_id?: number;
  idkp?: string;
  alamat?: string;
  jumlah_lantai?: number;
  luas?: number;
  tahun_bangun?: number;
  status_milik?: "milik_sendiri" | "sewa" | "pinjam" | "kerja_sama";
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  lintang?: number;
  bujur?: number;
  keterangan?: string;
  aktif?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Ruang (tabel sarpras_ruang) */
export type SarprasRuang = {
  id?: number;
  /** ID di sarpras_gedung */
  gedung_id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  jenis?: "kelas" | "laboratorium" | "studio" | "kantor" | "dosen" | "rapat" | "aula" | "perpustakaan" | "ibadah" | "kesehatan" | "olahraga" | "gudang" | "toilet" | "lainnya";
  lantai?: number;
  kapasitas?: number;
  luas?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  ruang_lama?: string;
  m_ruang_id?: number;
  fasilitas?: string;
  bisa_dipinjam?: boolean;
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasRuangInput = {
  /** ID di sarpras_gedung */
  gedung_id?: number;
  /** (unik) */
  kode: string;
  nama: string;
  jenis?: "kelas" | "laboratorium" | "studio" | "kantor" | "dosen" | "rapat" | "aula" | "perpustakaan" | "ibadah" | "kesehatan" | "olahraga" | "gudang" | "toilet" | "lainnya";
  lantai?: number;
  kapasitas?: number;
  luas?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** m_program_studi.kode_prodi */
  kode_prodi?: string;
  ruang_lama?: string;
  m_ruang_id?: number;
  fasilitas?: string;
  bisa_dipinjam?: boolean;
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  aktif?: boolean;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

/** Kategori aset (tabel sarpras_kategori) */
export type SarprasKategori = {
  id?: number;
  /** ID di sarpras_kategori */
  induk_id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  umur_ekonomis?: number;
  habis_pakai?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasKategoriInput = {
  /** ID di sarpras_kategori */
  induk_id?: number;
  /** (unik) */
  kode: string;
  nama: string;
  umur_ekonomis?: number;
  habis_pakai?: boolean;
  [key: string]: any;
};

/** Aset (tabel sarpras_aset) */
export type SarprasAset = {
  id?: number;
  /** (unik) */
  kode?: string;
  nama?: string;
  /** ID di sarpras_kategori */
  kategori_id?: number;
  merk?: string;
  tipe?: string;
  nomor_seri?: string;
  jumlah?: number;
  satuan?: string;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** user.username */
  penanggung_jawab?: string;
  tanggal_perolehan?: string;
  cara_perolehan?: "pembelian" | "hibah" | "kerja_sama" | "produksi" | "lainnya";
  sumber_dana?: string;
  nilai_perolehan?: number;
  umur_ekonomis?: number;
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  /** (hanya baca) Hanya dibaca. */
  status?: "aktif" | "dipinjam" | "perbaikan" | "dihapuskan";
  bisa_dipinjam?: boolean;
  keterangan?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasAsetInput = {
  /** (unik) */
  kode: string;
  nama: string;
  /** ID di sarpras_kategori */
  kategori_id?: number;
  merk?: string;
  tipe?: string;
  nomor_seri?: string;
  jumlah?: number;
  satuan?: string;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** ID di induk_unit */
  unit_id?: number;
  /** user.username */
  penanggung_jawab?: string;
  tanggal_perolehan?: string;
  cara_perolehan?: "pembelian" | "hibah" | "kerja_sama" | "produksi" | "lainnya";
  sumber_dana?: string;
  nilai_perolehan?: number;
  umur_ekonomis?: number;
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  bisa_dipinjam?: boolean;
  keterangan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type SarprasAsetHapuskanInput = {
  nomor_sk: string;
  alasan: string;
  tanggal?: string;
  [key: string]: any;
};

/** Peminjaman ruang/aset (tabel sarpras_peminjaman) */
export type SarprasPeminjaman = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  /** user.username */
  peminjam?: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** ID di sarpras_aset */
  aset_id?: number;
  jumlah?: number;
  kegiatan?: string;
  ormawa_id?: number;
  mulai?: string;
  selesai?: string;
  jumlah_peserta?: number;
  kontak?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "diajukan" | "disetujui" | "ditolak" | "dipinjam" | "dikembalikan" | "dibatalkan";
  /** (hanya baca) Hanya dibaca. */
  catatan?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  diputus_oleh?: string;
  /** (hanya baca) Hanya dibaca. */
  diputus_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  dikembalikan_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  kondisi_kembali?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasPeminjamanInput = {
  /** user.username */
  peminjam: string;
  /** ID di induk_unit */
  unit_id?: number;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** ID di sarpras_aset */
  aset_id?: number;
  jumlah?: number;
  kegiatan: string;
  ormawa_id?: number;
  mulai: string;
  selesai: string;
  jumlah_peserta?: number;
  kontak?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type SarprasPeminjamanSetujuiInput = {
  catatan?: string;
  [key: string]: any;
};

export type SarprasPeminjamanTolakInput = {
  alasan: string;
  [key: string]: any;
};

export type SarprasPeminjamanKembalikanInput = {
  kondisi_kembali: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  catatan?: string;
  [key: string]: any;
};

/** Pemeliharaan dan perbaikan (tabel sarpras_pemeliharaan) */
export type SarprasPemeliharaan = {
  id?: number;
  /** (hanya baca) Hanya dibaca. */
  nomor?: string;
  jenis?: "kerusakan" | "perbaikan" | "rutin" | "kalibrasi";
  /** ID di sarpras_aset */
  aset_id?: number;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** user.username */
  pelapor?: string;
  judul?: string;
  uraian?: string;
  prioritas?: "rendah" | "sedang" | "tinggi" | "darurat";
  /** (hanya pengelola) */
  jadwal?: string;
  /** user.username (hanya pengelola) */
  petugas?: string;
  /** (hanya pengelola) */
  vendor?: string;
  /** (hanya pengelola) */
  biaya?: number;
  /** (hanya pengelola) */
  tindakan?: string;
  /** (hanya baca) Hanya dibaca. */
  selesai_pada?: string;
  /** (hanya baca) Hanya dibaca. */
  status?: "dilaporkan" | "dijadwalkan" | "dikerjakan" | "selesai" | "tidak_dapat_diperbaiki" | "dibatalkan";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasPemeliharaanInput = {
  jenis?: "kerusakan" | "perbaikan" | "rutin" | "kalibrasi";
  /** ID di sarpras_aset */
  aset_id?: number;
  /** ID di sarpras_ruang */
  ruang_id?: number;
  /** user.username */
  pelapor: string;
  judul: string;
  uraian?: string;
  prioritas?: "rendah" | "sedang" | "tinggi" | "darurat";
  /** (hanya pengelola) */
  jadwal?: string;
  /** user.username (hanya pengelola) */
  petugas?: string;
  /** (hanya pengelola) */
  vendor?: string;
  /** (hanya pengelola) */
  biaya?: number;
  /** (hanya pengelola) */
  tindakan?: string;
  /** Hanya saat membuat: dokumen pendukung (UUID dari /v1/berkas) yang langsung dilampirkan */
  lampiran?: Array<string>;
  [key: string]: any;
};

export type SarprasPemeliharaanJadwalkanInput = {
  jadwal: string;
  /** user.username */
  petugas?: string;
  vendor?: string;
  [key: string]: any;
};

export type SarprasPemeliharaanSelesaiInput = {
  tindakan: string;
  biaya?: number;
  kondisi?: "baik" | "rusak_ringan" | "rusak_berat" | "hilang";
  [key: string]: any;
};

export type SarprasPemeliharaanTidakDapatDiperbaikiInput = {
  tindakan: string;
  [key: string]: any;
};

/** Mutasi aset (tabel sarpras_mutasi) */
export type SarprasMutasi = {
  id?: number;
  /** ID di sarpras_aset (hanya baca) Hanya dibaca. */
  aset_id?: number;
  /** (hanya baca) Hanya dibaca. */
  jenis?: "pindah" | "kondisi" | "penghapusan" | "penanggung_jawab";
  /** (hanya baca) Hanya dibaca. */
  dari_ruang_id?: number;
  /** (hanya baca) Hanya dibaca. */
  ke_ruang_id?: number;
  /** (hanya baca) Hanya dibaca. */
  dari?: string;
  /** (hanya baca) Hanya dibaca. */
  ke?: string;
  /** (hanya baca) Hanya dibaca. */
  tanggal?: string;
  /** (hanya baca) Hanya dibaca. */
  nomor_sk?: string;
  /** (hanya baca) Hanya dibaca. */
  alasan?: string;
  /** user.username (hanya baca) Hanya dibaca. */
  oleh?: string;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SarprasMutasiInput = JsonObject;

/** Data pribadi (NIK, NPWP, tanggal lahir, alamat, HP, ...) hanya muncul untuk pegawai itu sendiri dan petugas SDM. */
export type SdmPegawai = {
  id?: number | null;
  uuid?: string | null;
  jenis?: "dosen" | "tendik";
  nidn?: string | null;
  nik_karyawan?: string | null;
  username?: string | null;
  nip?: string | null;
  nama?: string | null;
  /** Dengan gelar */
  nama_lengkap?: string | null;
  unit_id?: number | null;
  unit_nama?: string | null;
  kode_prodi?: string | null;
  kategori?: "tetap" | "tidak_tetap";
  status_kepegawaian?: string | null;
  status_aktif?: "aktif" | "cuti" | "tugas_belajar" | "izin_belajar" | "diperbantukan" | "nonaktif" | "pensiun" | "keluar" | "meninggal" | "diberhentikan";
  jabatan_akademik?: string | null;
  golongan?: string | null;
  pendidikan_tertinggi?: string | null;
  serdos?: boolean;
  masa_kerja?: {
    tahun?: number | null;
    bulan?: number | null;
    [key: string]: any;
  };
  tanggal_pensiun_perkiraan?: string | null;
  [key: string]: any;
};

/** Tambah: wajib jenis + nama; nidn/nik_karyawan menautkan ke m_dosen/m_karyawan dan mengisi kolom kosong dari SIAKAD. Pegawai sendiri hanya boleh mengubah: gelar_depan, gelar_belakang, tempat_lahir, agama, status_nikah, npwp, nama_ibu, email, hp, alamat, bidang_keahlian. */
export type SdmPegawaiInput = {
  jenis: "dosen" | "tendik";
  nidn?: string | null;
  nik_karyawan?: string | null;
  username?: string | null;
  nip?: string | null;
  nuptk?: string | null;
  nidk?: string | null;
  nama: string | null;
  gelar_depan?: string | null;
  gelar_belakang?: string | null;
  jenis_kelamin?: "L" | "P";
  tempat_lahir?: string | null;
  tanggal_lahir?: string | null;
  agama?: string | null;
  status_nikah?: "belum" | "menikah" | "cerai_hidup" | "cerai_mati";
  nik_ktp?: string | null;
  npwp?: string | null;
  nama_ibu?: string | null;
  email?: string | null;
  /** Nomor HP 8-15 digit */
  hp?: string | null;
  alamat?: string | null;
  kewarganegaraan?: string | null;
  rt?: string | null;
  rw?: string | null;
  dusun?: string | null;
  desa?: string | null;
  kode_kecamatan?: string | null;
  kode_pos?: string | null;
  domisili_sama?: boolean;
  domisili_alamat?: string | null;
  domisili_rt?: string | null;
  domisili_rw?: string | null;
  domisili_dusun?: string | null;
  domisili_desa?: string | null;
  domisili_kode_kecamatan?: string | null;
  domisili_kode_pos?: string | null;
  /** ID sdm_unit */
  unit_id?: number | null;
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  /** ID sdm_pegawai */
  atasan_id?: number | null;
  kategori?: "tetap" | "tidak_tetap";
  status_kepegawaian?: "pns" | "pppk" | "dpk" | "tetap_yayasan" | "kontrak" | "honorer";
  status_aktif?: "aktif" | "cuti" | "tugas_belajar" | "izin_belajar" | "diperbantukan" | "nonaktif" | "pensiun" | "keluar" | "meninggal" | "diberhentikan";
  jenis_tendik?: string | null;
  bidang_keahlian?: string | null;
  tmt_masuk?: string | null;
  tanggal_pensiun?: string | null;
  [key: string]: any;
};

/** Kolom lain mengikuti jenis riwayat (lihat skema SdmRiwayat*Input). */
export type SdmRiwayat = {
  id?: number | null;
  uuid?: string | null;
  pegawai_id?: number | null;
  jenis_riwayat?: string | null;
  status_verifikasi?: "diajukan" | "disetujui" | "ditolak";
  catatan_verifikasi?: string | null;
  diverifikasi_oleh?: string | null;
  sumber?: string | null;
  sumber_ref?: string | null;
  file?: Array<SdmFile>;
  [key: string]: any;
};

export type SdmVerifikasiInput = {
  status: "disetujui" | "ditolak";
  /** Wajib bila ditolak */
  catatan?: string | null;
  [key: string]: any;
};

export type SdmFile = {
  uuid?: string | null;
  nama?: string | null;
  mime?: string | null;
  ukuran?: number | null;
  sha256?: string | null;
  keterangan?: string | null;
  url?: string | null;
  [key: string]: any;
};

export type SdmFileInput = {
  /** pegawai, riwayat:<jenis> (mis. riwayat:pendidikan), cuti, kinerja_item, usulan */
  entitas: string | null;
  entitas_id: number | null;
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  /** PDF/JPG/PNG/WebP/DOC/DOCX/XLS/XLSX */
  berkas?: Uploadable;
  keterangan?: string | null;
  /** Alternatif JSON */
  berkas_base64?: string | null;
  /** Wajib bersama berkas_base64 */
  nama_file?: string | null;
  [key: string]: any;
};

export type SdmPetugasInput = {
  username: string | null;
  peran: "admin" | "operator" | "pimpinan" | "asesor";
  /** Kosong = seluruh universitas */
  unit_id?: number | null;
  aktif?: boolean;
  mulai?: string | null;
  selesai?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPengaturanInput = {
  /** Batas usia pensiun dosen (tahun) (bawaan 65) */
  bup_dosen?: string;
  /** Batas usia pensiun dosen dengan jabatan Profesor (tahun) (bawaan 70) */
  bup_profesor?: string;
  /** Batas usia pensiun tenaga kependidikan (tahun) (bawaan 58) */
  bup_tendik?: string;
  /** Interval kenaikan gaji berkala (tahun) (bawaan 2) */
  kgb_tahun?: string;
  /** Interval kenaikan pangkat reguler (tahun) (bawaan 4) */
  kenaikan_pangkat_tahun?: string;
  /** Pengalaman minimal sebagai pendidik untuk sertifikasi dosen (tahun, Pasal 17) (bawaan 2) */
  serdos_min_tahun?: string;
  /** Beban kerja dosen tetap minimal per semester (SKS, Pasal 2 ayat 2) (bawaan 12) */
  bkd_min_sks?: string;
  /** Batas atas SKS yang diakui per semester (isi sesuai juknis) (bawaan 16) */
  bkd_max_sks?: string;
  /** Jam masuk kerja (HH:MM) (bawaan 07:30) */
  jam_masuk?: string;
  /** Jam pulang kerja (HH:MM) (bawaan 16:00) */
  jam_pulang?: string;
  /** Jam pulang hari Jumat (HH:MM) (bawaan 16:30) */
  jam_pulang_jumat?: string;
  /** Toleransi keterlambatan (menit) (bawaan 15) */
  toleransi_terlambat_menit?: string;
  /** Hari kerja (1 = Senin ... 7 = Minggu) (bawaan 1,2,3,4,5) */
  hari_kerja?: string;
  /** Cara lama: titik presensi "lat,long,radius_meter" dipisah titik koma. Dipakai hanya bila belum ada Area presensi (menu Presensi » Area); kosong = tanpa batas lokasi (bawaan ) */
  presensi_lokasi?: string;
  /** Presensi: masuk dibuka sekian menit sebelum jam masuk (untuk jadwal bawaan; jadwal kerja punya isian sendiri) (bawaan 120) */
  presensi_buka_masuk_menit?: string;
  /** Presensi: pulang ditutup sekian menit setelah jam pulang (untuk jadwal bawaan) (bawaan 360) */
  presensi_batas_pulang_menit?: string;
  /** Presensi: akurasi GPS terburuk yang diterima (meter); lebih buruk dari ini ditolak (bawaan 100) */
  presensi_akurasi_maks_m?: string;
  /** Presensi di luar area: tolak, atau tinjau (tercatat setelah disetujui atasan/SDM, pegawai wajib menulis alasan) (bawaan tolak) */
  presensi_luar_area?: string;
  /** Presensi dengan lokasi palsu (dilaporkan aplikasi mobile): tolak atau tinjau (bawaan tolak) */
  presensi_lokasi_palsu?: string;
  /** Presensi di hari libur/bukan hari kerja: tolak, tinjau (lembur disetujui atasan), atau izinkan (bawaan tinjau) */
  presensi_hari_libur?: string;
  /** Presensi wajib swafoto untuk semua jadwal: 1 = ya, 0 = mengikuti jadwal kerja (bawaan 0) */
  presensi_wajib_foto?: string;
  /** Presensi: jumlah perangkat aktif per pegawai; 0 = tanpa batas (bawaan 2) */
  presensi_batas_perangkat?: string;
  /** Perangkat presensi baru: otomatis (aktif selama di bawah batas) atau persetujuan (perangkat kedua dan seterusnya menunggu petugas SDM) (bawaan otomatis) */
  presensi_perangkat_baru?: string;
  /** Presensi: selisih jam perangkat dengan server yang ditandai mencurigakan (detik) (bawaan 300) */
  presensi_selisih_waktu_detik?: string;
  /** Presensi: skor risiko (0-100) yang membuat presensi masuk antrean tinjauan (bawaan 60) */
  presensi_skor_tinjau?: string;
  /** Koreksi presensi paling lambat sekian hari setelah tanggalnya; 0 = tanpa batas (bawaan 7) */
  presensi_koreksi_maks_hari?: string;
  /** Rentang hari ke depan untuk laporan pengingat (bawaan 90) */
  pengingat_hari?: string;
  /** Ukuran maksimal file unggahan (MB) (bawaan 10) */
  file_maks_mb?: string;
  /** PAK: angka kredit per SKS pendidikan BKD untuk Tenaga Pengajar/Asisten Ahli (isi sesuai juknis) (bawaan 0.5) */
  pak_ak_per_sks_aa?: string;
  /** PAK: angka kredit per SKS pendidikan BKD untuk Lektor ke atas (isi sesuai juknis) (bawaan 1) */
  pak_ak_per_sks?: string;
  /** PAK: angka kredit per kegiatan pengabdian selesai, per dosen (isi sesuai juknis) (bawaan 3) */
  pak_ak_pkm?: string;
  /** PAK: angka kredit per SKS penunjang BKD (isi sesuai juknis) (bawaan 1) */
  pak_ak_penunjang_per_sks?: string;
  /** PAK: batas pengabdian dari angka kredit yang dibutuhkan (%) (bawaan 15) */
  pak_maks_pengabdian_persen?: string;
  /** PAK: batas penunjang dari angka kredit yang dibutuhkan (%) (bawaan 15) */
  pak_maks_penunjang_persen?: string;
  /** PAK: bagian penulis utama bila penulis lebih dari satu (%); sisanya dibagi rata penulis lain (bawaan 60) */
  pak_porsi_penulis_utama?: string;
  [key: string]: any;
};

export type SdmHonorPengaturanInput = {
  /** PPh 21 honor/vakasi/remunerasi untuk pegawai ber-NPWP (%) (bawaan 5) */
  honor_pph_persen?: string;
  /** PPh 21 untuk pegawai tanpa NPWP (%) (bawaan 6) */
  honor_pph_tanpa_npwp_persen?: string;
  [key: string]: any;
};

export type SdmJabatanTunjanganInput = {
  /** Tunjangan jabatan per bulan (rupiah), 0 = tanpa tunjangan */
  tunjangan: number;
  [key: string]: any;
};

export type SdmCutiInput = {
  /** Kosong = diri sendiri; petugas boleh mengisi untuk pegawai lain */
  pegawai_id?: number | null;
  /** sdm_ref_cuti */
  jenis_id: number | null;
  tanggal_mulai: string | null;
  tanggal_selesai: string | null;
  alasan?: string | null;
  alamat_selama_cuti?: string | null;
  telepon?: string | null;
  /** Pegawai pengganti */
  pengganti_id?: number | null;
  /** Lampiran (surat dokter, SK, surat tugas): UUID dari /v1/berkas, langsung ditautkan ke pengajuan. Boleh juga satu UUID (string). Lampiran berikutnya lewat POST /v1/sdm/file entitas=cuti. */
  berkas_id?: Array<string>;
  [key: string]: any;
};

export type SdmCutiProses = {
  /** Wajib saat tolak */
  catatan?: string | null;
  /** Saat disetujui pejabat */
  nomor_surat?: string | null;
  [key: string]: any;
};

export type SdmPresensiCatat = {
  /** Kosong = otomatis (masuk bila belum masuk, selain itu pulang) */
  aksi?: "masuk" | "pulang";
  /** Lintang WGS84 dari GPS */
  lat?: number | null;
  /** Bujur WGS84 */
  lng?: number | null;
  /** Akurasi lokasi (meter), wajib bila presensi dibatasi area */
  akurasi?: number | null;
  /** Cara lama: "lat,long" (dipakai bila lat/lng kosong) */
  lokasi?: string | null;
  /** true bila sistem operasi melaporkan lokasi tiruan (Android Location.isMock) */
  lokasi_palsu?: boolean;
  perangkat?: {
    /** ID instalasi aplikasi/peramban, stabil per perangkat */
    id: string | null;
    /** Mis. Samsung A54 */
    nama?: string | null;
    platform?: "android" | "ios" | "web" | "desktop";
    versi_app?: string | null;
    [key: string]: any;
  };
  /** Jam perangkat (ISO 8601), hanya untuk mendeteksi selisih; waktu presensi selalu jam server */
  waktu_perangkat?: string | null;
  /** Swafoto sebagai data URI JPEG/PNG/WebP (maks. ~1 MB) */
  foto?: string | null;
  /** Atau UUID swafoto yang sudah diunggah ke /v1/berkas */
  foto_berkas_id?: string | null;
  /** Kunci idempoten 8-64 karakter (mis. UUID per ketukan); kirim ulang dengan kunci sama mengembalikan hasil pertama */
  kunci?: string | null;
  /** Alasan bila di luar area (wajib bila pengaturan presensi_luar_area = tinjau) */
  catatan?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPresensiTinjau = {
  keputusan: "terima" | "tolak";
  /** Wajib bila ditolak */
  catatan?: string | null;
  [key: string]: any;
};

export type SdmPresensiLokasi = {
  /** Unik, huruf/angka/titik/garis */
  kode: string | null;
  nama: string | null;
  jenis?: "kampus" | "gedung" | "kantor" | "lapangan" | "lainnya";
  /** Mis. Kampus 1 */
  kampus?: string | null;
  /** sdm_unit.id pemilik; kosong = untuk semua unit (admin) */
  unit_id?: number | null;
  alamat?: string | null;
  lat: number | null;
  lng: number | null;
  /** 10-20000 meter */
  radius_m?: number | null;
  /** [[lat,lng], ...] minimal 3 titik; bila diisi menggantikan radius */
  poligon?: Array<Array<number>> | null;
  /** IP publik/CIDR jaringan kampus dipisah koma; presensi dari jaringan ini dianggap di area */
  jaringan?: string | null;
  aktif?: boolean;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPresensiJadwal = {
  kode: string | null;
  nama: string | null;
  jenis?: "tetap" | "shift" | "fleksibel";
  /** {"1": {"masuk": "07:30", "pulang": "16:00"}, ...}; 1 = Senin ... 7 = Minggu; hari yang tidak ada = libur */
  hari: Record<string, {
    /** HH:MM */
    masuk?: string | null;
    /** HH:MM */
    pulang?: string | null;
    [key: string]: any;
  }>;
  toleransi_terlambat_menit?: number | null;
  /** Masuk dibuka sekian menit sebelum jam masuk */
  buka_masuk_menit?: number | null;
  /** Pulang ditutup sekian menit setelah jam pulang */
  batas_pulang_menit?: number | null;
  /** Wajib untuk fleksibel */
  min_kerja_menit?: number | null;
  lintas_hari?: boolean;
  ikut_libur?: boolean;
  wajib_lokasi?: boolean;
  wajib_foto?: boolean;
  aktif?: boolean;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPresensiPenugasan = {
  sasaran: "semua" | "jenis" | "unit" | "pegawai";
  jenis_pegawai?: "dosen" | "tendik";
  unit_id?: number | null;
  pegawai_id?: number | null;
  /** UUID, ID, atau kode jadwal */
  jadwal_id: string | null;
  /** bebas = kerja jarak jauh, lokasi dicatat tanpa batas area */
  mode_lokasi?: "area" | "bebas";
  /** UUID/ID/kode area; null = area unit pegawai + area untuk semua */
  lokasi_ids?: Array<string> | null;
  mulai: string | null;
  selesai?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPresensiPerangkatUbah = {
  /** lepas = hapus perangkat (pegawai sendiri atau petugas) */
  status: "aktif" | "diblokir" | "lepas";
  [key: string]: any;
};

export type SdmPresensiKoreksi = {
  tanggal: string | null;
  jenis: "lupa_masuk" | "lupa_pulang" | "salah_jam" | "luar_area" | "gangguan" | "lainnya";
  /** YYYY-MM-DD HH:MM */
  jam_masuk?: string | null;
  /** YYYY-MM-DD HH:MM (boleh esok hari untuk shift malam) */
  jam_pulang?: string | null;
  alasan: string | null;
  /** Lampiran dari /v1/berkas */
  berkas_id?: string | null;
  /** UUID percobaan presensi yang ditolak/ditinjau, bila ada */
  kejadian_id?: string | null;
  [key: string]: any;
};

export type SdmPresensiKoreksiProses = {
  /** Wajib bila ditolak */
  catatan?: string | null;
  [key: string]: any;
};

export type SdmPresensiImpor = {
  data: Array<{
    pegawai_id?: number | null;
    nidn?: string | null;
    nik_karyawan?: string | null;
    username?: string | null;
    nip?: string | null;
    /** YYYY-MM-DD HH:MM:SS */
    waktu: string | null;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type SdmPresensiManual = {
  pegawai_id: number | null;
  tanggal: string | null;
  /** YYYY-MM-DD HH:MM[:SS] */
  jam_masuk?: string | null;
  jam_pulang?: string | null;
  /** Kosong = dihitung dari jam */
  status?: "hadir" | "terlambat" | "izin" | "sakit" | "cuti" | "dinas" | "alpa" | "libur";
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmPeriodeInput = {
  jenis: "bkd" | "skp";
  /** Mis. BKD Ganjil 2026/2027 */
  nama: string | null;
  /** m_tahun.tahun_id untuk BKD */
  tahun_id?: string | null;
  mulai: string | null;
  selesai: string | null;
  batas_pengisian?: string | null;
  status?: "draft" | "buka" | "tutup";
  [key: string]: any;
};

export type SdmKinerjaInput = {
  periode_id: number | null;
  /** Kosong = diri sendiri */
  pegawai_id?: number | null;
  [key: string]: any;
};

export type SdmKinerjaUbah = {
  catatan_pegawai?: string | null;
  /** Asesor 1 / atasan langsung */
  penilai1_id?: number | null;
  /** Asesor 2 / atasan penilai */
  penilai2_id?: number | null;
  [key: string]: any;
};

export type SdmKinerjaItemInput = {
  /** BKD: pendidikan|penelitian|pengabdian|penunjang|tugas_tambahan; SKP: utama|tambahan */
  unsur: "pendidikan" | "penelitian" | "pengabdian" | "penunjang" | "tugas_tambahan" | "utama" | "tambahan";
  kegiatan: string | null;
  uraian?: string | null;
  indikator?: string | null;
  target?: number | null;
  satuan?: string | null;
  realisasi?: number | null;
  sks_rencana?: number | null;
  sks_realisasi?: number | null;
  /** Tautan/keterangan */
  bukti?: string | null;
  urut?: number | null;
  [key: string]: any;
};

/** nilai: item + catatan_penilai (+ predikat SKP). kembalikan: catatan_penilai. ajukan/sahkan: tanpa isi. */
export type SdmKinerjaProses = {
  item?: Array<{
    id: number | null;
    penilaian?: "belum" | "diterima" | "ditolak";
    sks_realisasi?: number | null;
    realisasi?: number | null;
    /** SKP, 0-200 */
    capaian_persen?: number | null;
    catatan?: string | null;
    [key: string]: any;
  }>;
  /** Wajib saat kembalikan */
  catatan_penilai?: string | null;
  /** SKP; kosong = dihitung dari rata-rata capaian */
  predikat?: "sangat_baik" | "baik" | "butuh_perbaikan" | "kurang" | "sangat_kurang";
  [key: string]: any;
};

/** Ganti versi aturan periode berjalan lewat /v1/sdm/bkd/aturan/{id}/terapkan (dengan pratinjau dampak). */
export type SdmBkdPeriodeInput = {
  /** Mis. BKD Ganjil 2026/2027 */
  nama: string | null;
  /** m_tahun.tahun_id */
  tahun_id?: string | null;
  mulai: string | null;
  selesai: string | null;
  status?: "draft" | "buka" | "tutup";
  /** Versi aturan BKD terbit; kosong = yang berlaku untuk semester ini */
  aturan_id?: number | null;
  rencana_selesai?: string | null;
  kirim_selesai?: string | null;
  penilaian_selesai?: string | null;
  penetapan_selesai?: string | null;
  penugasan_asesor?: "otomatis" | "manual";
  catatan?: string | null;
  [key: string]: any;
};

/** SKS dihitung dari rumus kategori (per SKS, per volume, tetap, jabatan); manual = isi sks_rencana/sks_realisasi. */
export type SdmBkdKegiatan = {
  /** Kode kategori di aturan BKD periode */
  kategori?: string | null;
  kegiatan?: string | null;
  uraian?: string | null;
  /** Jumlah satuan (mahasiswa, kelas, judul) */
  volume?: number | null;
  /** SKS kelas/kegiatan untuk rumus per SKS */
  sks_dasar?: number | null;
  /** Diisi bila rumus kategori manual */
  sks_rencana?: number | null;
  sks_realisasi?: number | null;
  /** Tautan/keterangan bukti */
  bukti?: string | null;
  /** Tautan kegiatan di SISTER */
  sister_url?: string | null;
  /** Masa penugasan */
  masa?: string | null;
  [key: string]: any;
};

/** selesai=true mengirim penilaian asesor ini (semua kegiatan wajib dinilai). */
export type SdmBkdNilai = {
  item: Array<{
    id: number | null;
    hasil: "M" | "TM";
    sks_diakui?: number | null;
    /** Wajib untuk TM */
    catatan?: string | null;
    [key: string]: any;
  }>;
  catatan?: string | null;
  selesai?: boolean;
  /** Admin SDM saja: menilai atas nama asesor 1/2 */
  asesor_ke?: number | null;
  [key: string]: any;
};

export type SdmBkdAturan = {
  nama?: string | null;
  dasar_hukum?: string | null;
  /** tahun_id */
  berlaku_mulai?: string | null;
  catatan_perubahan?: string | null;
  /** UUID SK registri (PilihSK) */
  sk_id?: string | null;
  /** bidang, kategori, batas, kombinasi, kewajiban_khusus, pembebasan, tugas_tambahan, asesor, tahap, tenggat (docs/BKD.md) */
  isi?: JsonObject;
  [key: string]: any;
};

export type SdmBkdAsesor = {
  pegawai_id: number | null;
  nira?: string | null;
  asal?: "internal" | "luar";
  pt_asal?: string | null;
  kode_prodi?: string | null;
  bidang_ilmu?: string | null;
  berlaku_sampai?: string | null;
  kuota?: number | null;
  aktif?: boolean;
  [key: string]: any;
};

export type SdmUsulanInput = {
  /** Kosong = diri sendiri */
  pegawai_id?: number | null;
  jenis: "jabatan_akademik" | "pangkat" | "kgb" | "serdos" | "studi_lanjut" | "pensiun";
  /** Jabatan akademik/golongan sasaran; kosong = satu jenjang di atas */
  ke_id?: number | null;
  loncat_jabatan?: boolean;
  ak_pendidikan?: number | null;
  ak_penelitian?: number | null;
  ak_pengabdian?: number | null;
  ak_penunjang?: number | null;
  publikasi_khusus?: number | null;
  uji_kompetensi?: "belum" | "lulus" | "tidak_lulus";
  /** KGB */
  gaji_pokok_baru?: number | null;
  tmt_usulan?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type SdmUsulanProses = {
  /** Wajib saat tolak/kembalikan, dan saat nilai tidak_memenuhi */
  catatan?: string | null;
  /** kirim */
  nomor_usulan?: string | null;
  /** tetapkan alur lama, wajib bila tanpa sk_id */
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt_sk?: string | null;
  /** UUID SK registri (PilihSK) */
  sk_id?: string | null;
  /** SK dari LLDIKTI/Kementerian yang belum ada di registri: nomor, tanggal, penerbit_luar, berkas_id, perihal? */
  sk_luar?: JsonObject;
  pak_pendidikan?: number | null;
  pak_penelitian?: number | null;
  pak_pengabdian?: number | null;
  pak_penunjang?: number | null;
  hasil?: "memenuhi" | "tidak_memenuhi";
  [key: string]: any;
};

/** Jabatan akademik (jabatan fungsional dosen). Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatJabatanAkademikInput = {
  /** ID sdm_ref_jabatan_akademik */
  jabatan_akademik_id: number | null;
  angka_kredit?: number | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt: string | null;
  penetap?: "kementerian" | "lldikti" | "perguruan_tinggi";
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Pangkat/golongan dan inpassing. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatPangkatInput = {
  /** ID sdm_ref_golongan */
  golongan_id: number | null;
  jenis?: "cpns" | "pns" | "pppk" | "inpassing" | "yayasan" | "reguler" | "pilihan" | "penyesuaian";
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt: string | null;
  masa_kerja_tahun?: number | null;
  masa_kerja_bulan?: number | null;
  angka_kredit?: number | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Jabatan struktural / tugas tambahan / jabatan tendik. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatJabatanInput = {
  /** ID sdm_ref_jabatan */
  jabatan_id: number | null;
  /** ID sdm_unit */
  unit_id?: number | null;
  nama_jabatan?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt_mulai: string | null;
  tmt_selesai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Pengangkatan, penempatan, mutasi, status, pemberhentian. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatStatusInput = {
  jenis: "pengangkatan" | "penempatan" | "mutasi" | "perubahan_status" | "tugas_belajar" | "aktif_kembali" | "pemberhentian" | "pensiun" | "meninggal";
  kategori?: "tetap" | "tidak_tetap";
  status_kepegawaian?: "pns" | "pppk" | "dpk" | "tetap_yayasan" | "kontrak" | "honorer";
  status_aktif?: "aktif" | "cuti" | "tugas_belajar" | "izin_belajar" | "diperbantukan" | "nonaktif" | "pensiun" | "keluar" | "meninggal" | "diberhentikan";
  /** ID sdm_unit */
  unit_id?: number | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt: string | null;
  tmt_selesai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Pendidikan formal. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatPendidikanInput = {
  jenjang: "SD" | "SMP" | "SMA" | "D1" | "D2" | "D3" | "D4" | "S1" | "S2" | "S3" | "Profesi" | "Sp1" | "Sp2";
  gelar?: string | null;
  nama_pt: string | null;
  kode_pt?: string | null;
  negara?: string | null;
  program_studi?: string | null;
  bidang_ilmu?: string | null;
  tahun_masuk?: number | null;
  tahun_lulus?: number | null;
  tanggal_ijazah?: string | null;
  nomor_ijazah?: string | null;
  ipk?: number | null;
  judul_tugas_akhir?: string | null;
  sumber_biaya?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Diklat dan pelatihan. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatDiklatInput = {
  jenis: "pekerti" | "aa" | "prajabatan" | "latsar" | "kepemimpinan" | "fungsional" | "teknis" | "seminar" | "lainnya";
  nama: string | null;
  penyelenggara?: string | null;
  tingkat?: "lokal" | "nasional" | "internasional";
  tanggal_mulai?: string | null;
  tanggal_selesai?: string | null;
  jumlah_jam?: number | null;
  nomor_sertifikat?: string | null;
  tahun?: number | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Sertifikasi (serdos, profesi, kompetensi). Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatSertifikasiInput = {
  jenis: "serdos" | "profesi" | "kompetensi" | "lainnya";
  nama: string | null;
  bidang?: string | null;
  nomor_sertifikat?: string | null;
  nomor_registrasi?: string | null;
  penyelenggara?: string | null;
  tahun?: number | null;
  tanggal_terbit?: string | null;
  berlaku_sampai?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Tes bahasa dan potensi akademik. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatTesInput = {
  jenis: "toefl" | "ielts" | "toeic" | "toafl" | "tpa" | "lainnya";
  nama?: string | null;
  penyelenggara?: string | null;
  tanggal?: string | null;
  skor?: number | null;
  berlaku_sampai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Keluarga. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatKeluargaInput = {
  hubungan: "suami" | "istri" | "anak" | "ayah" | "ibu";
  nama: string | null;
  nik?: string | null;
  jenis_kelamin?: "L" | "P";
  tempat_lahir?: string | null;
  tanggal_lahir?: string | null;
  pekerjaan?: string | null;
  nip?: string | null;
  tanggal_nikah?: string | null;
  hidup?: boolean;
  tanggungan?: boolean;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Penghargaan. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatPenghargaanInput = {
  nama: string | null;
  pemberi?: string | null;
  tingkat?: "lokal" | "nasional" | "internasional";
  tahun?: number | null;
  tanggal?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Hukuman disiplin. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatDisiplinInput = {
  tingkat: "ringan" | "sedang" | "berat";
  jenis_hukuman: string | null;
  pelanggaran?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt_mulai?: string | null;
  tmt_selesai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Pengalaman kerja. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatPekerjaanInput = {
  instansi: string | null;
  jabatan?: string | null;
  bidang?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Organisasi/asosiasi profesi. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatOrganisasiInput = {
  nama_organisasi: string | null;
  peran?: string | null;
  tingkat?: "lokal" | "nasional" | "internasional";
  nomor_anggota?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Gaji pokok dan kenaikan gaji berkala (KGB). Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatGajiInput = {
  jenis: "awal" | "kgb" | "pangkat" | "penyesuaian" | "kontrak";
  /** ID sdm_ref_golongan */
  golongan_id?: number | null;
  gaji_pokok: number | null;
  masa_kerja_tahun?: number | null;
  masa_kerja_bulan?: number | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  tmt: string | null;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Tunjangan. Petugas: status_verifikasi (disetujui|diajukan, bawaan disetujui). Aplikasi: sumber_ref untuk kirim ulang idempoten. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmRiwayatTunjanganInput = {
  jenis: "profesi" | "fungsional" | "kehormatan" | "khusus" | "struktural" | "keluarga" | "lainnya";
  nama?: string | null;
  nominal?: number | null;
  mulai: string | null;
  selesai?: string | null;
  sumber_dana?: string | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  dihentikan?: boolean;
  keterangan?: string | null;
  sumber_ref?: string | null;
  status_verifikasi?: "disetujui" | "diajukan";
  [key: string]: any;
};

/** Unit kerja. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterUnitInput = {
  /** ID sdm_unit */
  induk_id?: number | null;
  kode: string | null;
  jenis: "universitas" | "fakultas" | "prodi" | "lembaga" | "biro" | "upt" | "bagian" | "lainnya";
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  nama: string | null;
  singkatan?: string | null;
  /** ID sdm_pegawai */
  kepala_pegawai_id?: number | null;
  induk_unit_id?: number | null;
  aktif?: boolean;
  urut?: number | null;
  [key: string]: any;
};

/** Jenjang jabatan akademik dan syarat promosi. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterJabatanAkademikInput = {
  kode: string | null;
  kode_siakad?: string | null;
  kode_pddikti?: string | null;
  nama: string | null;
  urutan: number | null;
  angka_kredit_minimal?: number | null;
  proporsi_penelitian_min?: number | null;
  publikasi_khusus_min?: number | null;
  pendidikan_minimal?: "S2" | "S3";
  masa_dosen_tetap_min?: number | null;
  wajib_serdos?: boolean;
  wajib_uji_kompetensi?: boolean;
  keterangan?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

/** Pangkat/golongan. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterGolonganInput = {
  kode: string | null;
  kode_siakad?: string | null;
  golongan: string | null;
  ruang?: string | null;
  pangkat: string | null;
  urutan: number | null;
  aktif?: boolean;
  [key: string]: any;
};

/** Jabatan struktural, tugas tambahan, fungsional tendik. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterJabatanInput = {
  kode: string | null;
  nama: string | null;
  jenis: "struktural" | "tugas_tambahan" | "fungsional_tendik" | "pelaksana";
  eselon?: string | null;
  setara_sks?: number | null;
  aktif?: boolean;
  urut?: number | null;
  [key: string]: any;
};

/** Jenis cuti, izin, dan dinas. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterJenisCutiInput = {
  kode: string | null;
  nama: string | null;
  kategori: "cuti" | "izin" | "dinas";
  kuota_hari_tahun?: number | null;
  maks_hari?: number | null;
  hitung_hari_kerja?: boolean;
  wajib_lampiran?: boolean;
  untuk?: "semua" | "dosen" | "tendik";
  butuh_atasan?: boolean;
  status_presensi?: "cuti" | "izin" | "sakit" | "dinas";
  aktif?: boolean;
  urut?: number | null;
  [key: string]: any;
};

/** Skala gaji pokok per golongan dan masa kerja. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterGajiPokokInput = {
  /** ID sdm_ref_golongan */
  golongan_id: number | null;
  masa_kerja_tahun: number | null;
  gaji_pokok: number | null;
  berlaku_mulai: string | null;
  dasar?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

/** Aturan tunjangan otomatis (fungsional, profesi, per golongan). Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterTunjanganInput = {
  kode: string | null;
  nama: string | null;
  jenis: "profesi" | "fungsional" | "kehormatan" | "khusus" | "lainnya";
  dasar: "jabatan_akademik" | "serdos" | "golongan";
  dasar_id?: number | null;
  untuk?: "semua" | "dosen" | "tendik";
  nominal?: number | null;
  persen_gaji_pokok?: number | null;
  berlaku_mulai?: string | null;
  sumber_dana?: string | null;
  dasar_hukum?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

/** Hari libur. Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SdmMasterHariLiburInput = {
  tanggal: string | null;
  nama: string | null;
  jenis?: "nasional" | "cuti_bersama" | "kampus";
  [key: string]: any;
};

export type SdmSisterPengaturan = {
  /** Sandbox untuk uji coba (ws-sandbox.php/1.0), produksi untuk data sungguhan (ws.php/1.0) */
  mode?: "sandbox" | "produksi";
  /** Username dari menu Kredensial API SISTER */
  username?: string | null;
  /** Disimpan terenkripsi. "" = tidak diubah, null = hapus */
  password?: string | null;
  /** id_pengguna dari menu Kredensial API SISTER */
  id_pengguna?: string | null;
  /** id_sp perguruan tinggi (opsional, menyaring /referensi/sdm) */
  id_perguruan_tinggi?: string | null;
  /** Kosong = https://sister-api.kemdiktisaintek.go.id/ws-sandbox.php/1.0 */
  url_sandbox?: string | null;
  /** Kosong = https://sister-api.kemdiktisaintek.go.id/ws.php/1.0 */
  url_produksi?: string | null;
  /** Izinkan tarik otomatis oleh cron */
  aktif?: boolean;
  /** Kirim riwayat SDM ke SISTER. mati = tidak dicatat (bawaan); manual = masuk antrean, dikirim admin lewat POST /v1/sdm/sister/kirim/proses; otomatis = masuk antrean dan dikirim cron */
  kirim_mode?: "mati" | "manual" | "otomatis";
  [key: string]: any;
};

export type SdmSisterUji = {
  /** Opsional: NIDN untuk dicoba di /referensi/sdm */
  nidn?: string | null;
  [key: string]: any;
};

export type SdmSisterCocokkan = {
  /** ID pegawai; kosong = semua */
  pegawai_id?: Array<number> | null;
  /** Pegawai per panggilan, 1-500 (bawaan 50) */
  batas?: number | null;
  [key: string]: any;
};

export type SdmSisterTarikBanyak = {
  /** ID pegawai; kosong = semua */
  pegawai_id?: Array<number> | null;
  /** Kunci jenis (GET /v1/sdm/sister/jenis), nama kelompok (kepegawaian, tridharma, penunjang, dokumen), atau data_pribadi. Kosong = semua. */
  jenis?: Array<string> | null;
  /** Pegawai per panggilan, 1-200 (bawaan 10) */
  batas?: number | null;
  /** Hanya pegawai yang terakhir ditarik lebih dari N jam lalu */
  umur_jam?: number | null;
  /** Cocokkan pegawai yang belum terhubung lebih dulu */
  cocokkan_dulu?: boolean;
  [key: string]: any;
};

export type SdmSisterTarik = {
  /** Kunci jenis (GET /v1/sdm/sister/jenis), nama kelompok (kepegawaian, tridharma, penunjang, dokumen), atau data_pribadi. Kosong = semua. */
  jenis?: Array<string> | null;
  [key: string]: any;
};

export type SdmSisterHubungkan = {
  /** id_sdm SISTER (dari GET /v1/sdm/sister/sdm) */
  id_sdm: string | null;
  [key: string]: any;
};

export type SdmSisterKirimProses = {
  /** Baris antrean per panggilan, 1-500 (bawaan 20) */
  batas?: number | null;
  /** Hanya ID antrean ini (status menunggu/gagal); kosong = antrean yang jatuh tempo */
  id?: Array<number> | null;
  [key: string]: any;
};

export type SdmSisterKirimAntrekan = {
  /** ID pegawai; kosong = semua */
  pegawai_id?: Array<number> | null;
  /** Jenis riwayat SDM (jabatan-akademik, pangkat, pendidikan, diklat, sertifikasi, penghargaan, pekerjaan, organisasi); kosong = semua yang dipetakan */
  jenis?: Array<string> | null;
  [key: string]: any;
};

export type SdmSisterTerapkanProfil = {
  /** Kolom profil, mis. ["nip", "nuptk", "tanggal_lahir"] */
  kolom: Array<string>;
  [key: string]: any;
};

/** Tarif paling spesifik (jabatan + kategori) yang berlaku pada akhir semester yang dipakai. */
export type SdmHonorTarifInput = {
  /** mengajar, vakasi_soal, vakasi_koreksi, pengawas_ujian, bimbingan_ta, penguji_ta, remunerasi_jabatan, remunerasi_sks (GET /v1/sdm/honor/komponen), atau kode bebas */
  komponen: string | null;
  /** Nama tarif */
  nama: string | null;
  /** sks_pertemuan, kelas, lembar, sesi, mahasiswa, semester, sks */
  satuan: string | null;
  /** Rupiah per satuan */
  tarif: number | null;
  /** Kosong = semua jabatan */
  jabatan_akademik_id?: number | null;
  /** Kosong = semua kategori */
  kategori?: "tetap" | "tidak_tetap";
  berlaku_mulai?: string | null;
  berlaku_sampai?: string | null;
  aktif?: boolean;
  keterangan?: string | null;
  [key: string]: any;
};

export type SdmHonorHitung = {
  /** tahun_id SIAKAD, mis. 20251 */
  periode: string | null;
  /** Kosong = semua komponen */
  komponen?: Array<string> | null;
  /** Hanya satu dosen */
  pegawai_id?: number | null;
  /** Hanya dosen di unit ini dan turunannya */
  unit_id?: number | null;
  [key: string]: any;
};

export type SdmHonorInput = {
  /** tahun_id atau YYYY-MM */
  periode: string | null;
  pegawai_id: number | null;
  kelompok: "remunerasi" | "honor" | "vakasi" | "lainnya";
  /** Kode bebas, mis. panitia_wisuda */
  komponen: string | null;
  uraian: string | null;
  volume: number | null;
  satuan?: string | null;
  tarif: number | null;
  /** Bawaan dari pengaturan honor_pph_* */
  pajak_persen?: number | null;
  catatan?: string | null;
  [key: string]: any;
};

export type SdmHonorProses = {
  /** setujui: draft; bayar: disetujui; kembalikan: disetujui -> draft; batal: draft/disetujui */
  aksi: "setujui" | "bayar" | "kembalikan" | "batal";
  /** 1-1000 ID honor */
  id: Array<number>;
  /** Untuk bayar */
  nomor_bukti?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type SdmPemberhentianInput = {
  jenis: "mengundurkan_diri" | "pensiun" | "meninggal" | "diberhentikan" | "kontrak_berakhir" | "tugas_belajar" | "cuti_luar_tanggungan" | "pindah_instansi";
  /** Hari pertama tidak bekerja/aktif. Hari ini atau lampau = langsung diproses; tanggal depan = terjadwal (tugas sdm-pemberhentian) */
  tanggal_efektif: string | null;
  /** Rencana kembali (tugas belajar/cuti di luar tanggungan) */
  tanggal_kembali?: string | null;
  /** UUID SK registri (PilihSK). Wajib, kecuali meninggal dunia dengan bukti */
  sk_id?: string | null;
  /** Bukti lain bila tanpa SK (meninggal dunia) */
  bukti?: string | null;
  catatan?: string | null;
  /** Tugas belajar/cuti di luar tanggungan: akun tetap aktif tanpa peran (Profil/email saja) */
  pertahankan_akun?: boolean;
  [key: string]: any;
};

export type SdmPemberhentianPulih = {
  /** Wajib */
  alasan: string | null;
  /** Pemberhentian keliru dicatat: riwayat statusnya dihapus */
  keliru?: boolean;
  /** ID penugasan sebelumnya yang diberikan ulang (peran tidak dipulihkan otomatis) */
  penugasan?: Array<number>;
  /** "tabel#id" petugas sebelumnya yang diaktifkan ulang */
  petugas?: Array<string>;
  [key: string]: any;
};

export type SdmPemberhentianSapu = {
  /** Pegawai kandidat yang dipilih (1-500) */
  pegawai_id: Array<number>;
  /** true setelah memeriksa pratinjau dampak */
  konfirmasi: boolean;
  catatan?: string | null;
  [key: string]: any;
};

export type SkRegistri = {
  /** UUID SK registri */
  id: string | null;
  /** Penulisan resmi penerbit Contoh: `91.01/UNIPO-SK/VII/2026` */
  nomor: string | null;
  /** Nomor dinormalisasi untuk deteksi ganda Contoh: `91/1/UNIPO/SK/VII/2026` */
  nomor_kunci?: string | null;
  tanggal?: string | null;
  perihal?: string | null;
  /** kalender, aturan, pengangkatan, penugasan, panitia, kepegawaian, kurikulum, akreditasi, pendirian, penetapan, lainnya */
  jenis?: string | null;
  jenis_label?: string | null;
  penerbit?: {
    /** induk_unit.id; null untuk instansi luar */
    unit_id?: number | null;
    kode?: string | null;
    jenis?: string | null;
    nama?: string | null;
    luar?: boolean;
    [key: string]: any;
  };
  penandatangan?: {
    /** induk_pejabat.id */
    pejabat_id?: number | null;
    /** induk_jabatan.id */
    jabatan_id?: number | null;
    /** induk_unit.id */
    unit_id?: number | null;
    jabatan?: string | null;
    nama?: string | null;
    /** teks = diketik, belum tertaut ke data pejabat */
    tautan?: "pejabat" | "jabatan" | "teks";
    /** Path gambar tanda tangan bila ada */
    ttd?: string | null;
    [key: string]: any;
  };
  /** Ditetapkan di */
  tempat?: string | null;
  berkas?: {
    ada?: boolean;
    nama?: string | null;
    mime?: string | null;
    ukuran?: number | null;
    /** /v1/sk/{id}/berkas */
    url?: string | null;
    [key: string]: any;
  };
  /** draf = ajuan pencatatan menunggu verifikasi penerbit */
  status: "draf" | "terbit" | "ditolak" | "dicabut" | "diubah";
  keamanan?: "biasa" | "terbatas";
  /** registri, ajuan[:modul], arsip, impor:<tabel> */
  sumber?: string | null;
  catatan?: string | null;
  diverifikasi_oleh?: string | null;
  diverifikasi_at?: string | null;
  dibuat_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

export type SkDetail = SkRegistri & {
  pemakaian?: Array<{
    modul?: string | null;
    tabel?: string | null;
    baris?: string | null;
    peran?: string | null;
    label?: string | null;
    uraian?: string | null;
    oleh?: string | null;
    sejak?: string | null;
    [key: string]: any;
  }>;
  mengubah?: Array<{
    id?: string | null;
    nomor?: string | null;
    perihal?: string | null;
    jenis?: "mengubah" | "mencabut";
    /** draf = ajuan pencatatan menunggu verifikasi penerbit */
    status?: "draf" | "terbit" | "ditolak" | "dicabut" | "diubah";
    [key: string]: any;
  }>;
  diubah_oleh_sk?: Array<{
    id?: string | null;
    nomor?: string | null;
    perihal?: string | null;
    jenis?: "mengubah" | "mencabut";
    /** draf = ajuan pencatatan menunggu verifikasi penerbit */
    status?: "draf" | "terbit" | "ditolak" | "dicabut" | "diubah";
    [key: string]: any;
  }>;
  ganda?: Array<SkRegistri>;
  boleh?: {
    catat?: boolean;
    [key: string]: any;
  };
  [key: string]: any;
};

export type SkPeriksa = {
  nomor?: string | null;
  nomor_kunci?: string | null;
  sama?: Array<SkRegistri>;
  mirip?: Array<SkRegistri>;
  pesan?: string | null;
  [key: string]: any;
};

export type SkCatat = {
  /** Contoh: `91.01/UNIPO-SK/VII/2026` */
  nomor?: string | null;
  tanggal?: string | null;
  perihal?: string | null;
  jenis?: string | null;
  penerbit_unit_id?: number | null;
  /** Instansi luar, mis. BAN-PT */
  penerbit_luar?: string | null;
  /** induk_pejabat.id; jabatan dan nama diambil dari data pejabat */
  penandatangan_pejabat_id?: number | null;
  /** induk_jabatan.id (penandatangan berupa jabatan) */
  penandatangan_jabatan_id?: number | null;
  /** induk_unit.id jabatan penandatangan */
  penandatangan_unit_id?: number | null;
  /** Teks bila belum tertaut, mis. Ketua Yayasan */
  penandatangan_jabatan?: string | null;
  /** Teks bila belum tertaut */
  penandatangan_nama?: string | null;
  tempat?: string | null;
  /** UUID /v1/berkas */
  berkas_id?: string | null;
  ttd_berkas_id?: string | null;
  keamanan?: "biasa" | "terbatas";
  catatan?: string | null;
  mengubah?: Array<string>;
  mencabut?: Array<string>;
  /** Tetap catat walau nomor sama tercatat di penerbit lain */
  abaikan_mirip?: boolean;
  /** Ubah: penerbit menerbitkan draf */
  status?: "terbit";
  [key: string]: any;
};

export type SkVerifikasi = {
  keputusan: "terima" | "tolak";
  /** Wajib saat tolak */
  catatan?: string | null;
  penerbit_unit_id?: number | null;
  [key: string]: any;
};

export type SkCabut = {
  /** UUID SK pencabut */
  oleh_sk_id?: string | null;
  catatan?: string | null;
  [key: string]: any;
};

export type SkGabung = {
  /** UUID SK tujuan */
  ke: string | null;
  [key: string]: any;
};

export type SkPenerbit = {
  unit_id?: number | null;
  kode?: string | null;
  jenis?: string | null;
  nama?: string | null;
  induk_id?: number | null;
  boleh_catat?: boolean;
  [key: string]: any;
};

export type SkPenandatangan = {
  pejabat_id?: number | null;
  nama?: string | null;
  jabatan?: string | null;
  jabatan_kode?: string | null;
  unit_id?: number | null;
  unit_penerbit_id?: number | null;
  plt?: boolean;
  [key: string]: any;
};

export type SkBerkasUrl = {
  url?: string | null;
  kedaluwarsa_at?: string | null;
  [key: string]: any;
};

export type SpmiUnit = {
  id?: number;
  kode?: string;
  jenis?: "universitas" | "fakultas" | "prodi" | "lembaga" | "unit";
  /** ID unit */
  induk_id?: number | null;
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  nama?: string | null;
  singkatan?: string | null;
  email?: string | null;
  aktif?: boolean;
  urut?: number;
  /** Peran pemilik token di unit ini (termasuk warisan unit induk) */
  peran_saya?: Array<"Pengelola SPMI universitas (LPM/BPM): kelola semua data SPMI" | "Pengelola mutu unit (GKM fakultas, UJM prodi): kelola data SPMI unit dan turunannya" | "Pimpinan unit (rektor, dekan, kaprodi, kepala): kelola data SPMI unit dan turunannya, verifikasi capaian, setujui laporan AMI, pimpin RTM" | "Penanggung jawab: isi capaian dan tindak lanjut unit" | "Anggota: lihat data SPMI unit">;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiUnitInput = {
  kode: string;
  jenis: "universitas" | "fakultas" | "prodi" | "lembaga" | "unit";
  /** ID unit */
  induk_id?: number | null;
  /** Kode fakultas SIAKAD (m_fakultas) */
  kode_fakultas?: string | null;
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  nama: string | null;
  singkatan?: string | null;
  email?: string | null;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

export type SpmiPersonel = {
  id?: number;
  /** ID unit */
  unit_id?: number | null;
  /** username SIAKAD */
  username?: string | null;
  peran?: "admin" | "pengelola" | "pimpinan" | "pic" | "anggota";
  jabatan?: string | null;
  nomor_sk?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  aktif?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiPersonelInput = {
  /** ID unit */
  unit_id: number | null;
  /** username SIAKAD */
  username: string | null;
  peran: "admin" | "pengelola" | "pimpinan" | "pic" | "anggota";
  jabatan?: string | null;
  nomor_sk?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  aktif?: boolean;
  [key: string]: any;
};

export type SpmiAuditor = {
  id?: number;
  /** username SIAKAD */
  username?: string | null;
  nidn?: string | null;
  nama?: string | null;
  /** ID unit */
  unit_asal_id?: number | null;
  bidang_keahlian?: string | null;
  nomor_sertifikat?: string | null;
  penyelenggara_pelatihan?: string | null;
  tanggal_sertifikat?: string | null;
  berlaku_sampai?: string | null;
  tautan_sertifikat?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  sertifikat_berlaku?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiAuditorInput = {
  /** username SIAKAD */
  username: string | null;
  nidn?: string | null;
  nama: string | null;
  /** ID unit */
  unit_asal_id?: number | null;
  bidang_keahlian?: string | null;
  nomor_sertifikat?: string | null;
  penyelenggara_pelatihan?: string | null;
  tanggal_sertifikat?: string | null;
  berlaku_sampai?: string | null;
  tautan_sertifikat?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiPeriode = {
  id?: number;
  tahun?: number;
  nama?: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id_mulai?: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id_selesai?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  status?: "perencanaan" | "berjalan" | "evaluasi" | "selesai";
  catatan?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiPeriodeInput = {
  tahun: number;
  nama: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id_mulai?: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id_selesai?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  status?: "perencanaan" | "berjalan" | "evaluasi" | "selesai";
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiDokumen = {
  id?: number;
  /** ID unit */
  unit_id?: number | null;
  jenis?: "kebijakan" | "manual" | "standar" | "formulir" | "pedoman" | "sop" | "instruksi_kerja" | "renstra" | "renop" | "sk" | "organisasi" | "laporan" | "lainnya";
  tahap?: "penetapan" | "pelaksanaan" | "evaluasi" | "pengendalian" | "peningkatan";
  nomor?: string | null;
  judul?: string | null;
  versi?: string | null;
  ringkasan?: string | null;
  status?: "draf" | "ditinjau" | "disahkan" | "kedaluwarsa" | "dicabut";
  tanggal_penetapan?: string | null;
  berlaku_mulai?: string | null;
  tinjau_berikutnya?: string | null;
  ditetapkan_oleh?: string | null;
  nomor_penetapan?: string | null;
  tautan?: string | null;
  publik?: boolean;
  /** ID dokumen */
  menggantikan_id?: number | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiDokumenInput = {
  /** ID unit */
  unit_id?: number | null;
  jenis: "kebijakan" | "manual" | "standar" | "formulir" | "pedoman" | "sop" | "instruksi_kerja" | "renstra" | "renop" | "sk" | "organisasi" | "laporan" | "lainnya";
  tahap?: "penetapan" | "pelaksanaan" | "evaluasi" | "pengendalian" | "peningkatan";
  nomor?: string | null;
  judul: string | null;
  versi?: string | null;
  ringkasan?: string | null;
  status?: "draf" | "ditinjau" | "disahkan" | "kedaluwarsa" | "dicabut";
  tanggal_penetapan?: string | null;
  berlaku_mulai?: string | null;
  tinjau_berikutnya?: string | null;
  ditetapkan_oleh?: string | null;
  nomor_penetapan?: string | null;
  tautan?: string | null;
  publik?: boolean;
  /** ID dokumen */
  menggantikan_id?: number | null;
  [key: string]: any;
};

export type SpmiStandar = {
  id?: number;
  /** ID standar */
  induk_id?: number | null;
  kode?: string;
  nama?: string | null;
  bidang?: "pendidikan" | "penelitian" | "pkm" | "tata_kelola" | "kemahasiswaan" | "sdm" | "sarpras" | "kerja_sama" | "keuangan" | "kesejahteraan" | "lainnya";
  kelompok?: "luaran" | "proses" | "masukan" | "lainnya";
  sumber?: "sn_dikti" | "pt";
  rasional?: string | null;
  pernyataan?: string | null;
  strategi?: string | null;
  pihak_terkait?: string | null;
  definisi_istilah?: string | null;
  referensi?: string | null;
  /** ID dokumen */
  dokumen_id?: number | null;
  versi?: string | null;
  status?: "draf" | "berlaku" | "dicabut";
  berlaku_mulai?: string | null;
  urut?: number;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiStandarInput = {
  /** ID standar */
  induk_id?: number | null;
  kode: string;
  nama: string | null;
  bidang: "pendidikan" | "penelitian" | "pkm" | "tata_kelola" | "kemahasiswaan" | "sdm" | "sarpras" | "kerja_sama" | "keuangan" | "kesejahteraan" | "lainnya";
  kelompok?: "luaran" | "proses" | "masukan" | "lainnya";
  sumber?: "sn_dikti" | "pt";
  rasional?: string | null;
  pernyataan?: string | null;
  strategi?: string | null;
  pihak_terkait?: string | null;
  definisi_istilah?: string | null;
  referensi?: string | null;
  /** ID dokumen */
  dokumen_id?: number | null;
  versi?: string | null;
  status?: "draf" | "berlaku" | "dicabut";
  berlaku_mulai?: string | null;
  urut?: number;
  [key: string]: any;
};

export type SpmiIndikator = {
  id?: number;
  /** ID standar */
  standar_id?: number | null;
  kode?: string;
  pernyataan?: string | null;
  tipe?: "angka" | "persen" | "rasio" | "ya_tidak" | "teks";
  satuan?: string | null;
  arah?: "naik" | "turun" | "tepat";
  baseline?: number | null;
  minimum_sn_dikti?: number | null;
  /** Metrik otomatis dari data SIAKAD (GET /v1/spmi/referensi) */
  metrik?: "mahasiswa_aktif" | "rasio_mahasiswa_dosen" | "jumlah_lulusan" | "ipk_rata_lulusan" | "persen_lulusan_ipk_3" | "persen_lulus_tepat_waktu" | "rata_masa_studi" | "persen_putus_studi" | "persen_dosen_s3" | "persen_dosen_s2_keatas" | "persen_dosen_jabfung" | "persen_dosen_lk_gb" | "indeks_edom" | "tracer_iku1" | "tracer_waktu_tunggu" | "tracer_respons" | "survei_kepuasan";
  lingkup?: "universitas" | "fakultas" | "prodi" | "unit" | "semua";
  frekuensi?: "semester" | "tahunan";
  cara_ukur?: string | null;
  sumber_data?: string | null;
  aktif?: boolean;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiIndikatorInput = {
  /** ID standar */
  standar_id: number | null;
  kode: string;
  pernyataan: string | null;
  tipe?: "angka" | "persen" | "rasio" | "ya_tidak" | "teks";
  satuan?: string | null;
  arah?: "naik" | "turun" | "tepat";
  baseline?: number | null;
  minimum_sn_dikti?: number | null;
  /** Metrik otomatis dari data SIAKAD (GET /v1/spmi/referensi) */
  metrik?: "mahasiswa_aktif" | "rasio_mahasiswa_dosen" | "jumlah_lulusan" | "ipk_rata_lulusan" | "persen_lulusan_ipk_3" | "persen_lulus_tepat_waktu" | "rata_masa_studi" | "persen_putus_studi" | "persen_dosen_s3" | "persen_dosen_s2_keatas" | "persen_dosen_jabfung" | "persen_dosen_lk_gb" | "indeks_edom" | "tracer_iku1" | "tracer_waktu_tunggu" | "tracer_respons" | "survei_kepuasan";
  lingkup?: "universitas" | "fakultas" | "prodi" | "unit" | "semua";
  frekuensi?: "semester" | "tahunan";
  cara_ukur?: string | null;
  sumber_data?: string | null;
  aktif?: boolean;
  urut?: number;
  [key: string]: any;
};

export type SpmiTarget = {
  id?: number;
  /** ID indikator */
  indikator_id?: number | null;
  /** ID periode */
  periode_id?: number | null;
  /** ID unit */
  unit_id?: number | null;
  target?: number | null;
  target_teks?: string | null;
  keterangan?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiTargetInput = {
  /** ID indikator */
  indikator_id: number | null;
  /** ID periode */
  periode_id: number | null;
  /** ID unit */
  unit_id?: number | null;
  target?: number | null;
  target_teks?: string | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type SpmiKegiatan = {
  id?: number;
  /** ID periode */
  periode_id?: number | null;
  /** ID unit */
  unit_id?: number | null;
  tahap?: "penetapan" | "pelaksanaan" | "evaluasi" | "pengendalian" | "peningkatan";
  jenis?: "pemantauan" | "evaluasi_diri" | "audit" | "asesmen" | "rtm" | "sosialisasi" | "pelatihan" | "penyusunan_dokumen" | "survei" | "lainnya";
  nama?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  tempat?: string | null;
  pelaksana?: string | null;
  metode?: string | null;
  hasil?: string | null;
  tautan_bukti?: string | null;
  status?: "rencana" | "berjalan" | "selesai" | "batal";
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiKegiatanInput = {
  /** ID periode */
  periode_id: number | null;
  /** ID unit */
  unit_id?: number | null;
  tahap: "penetapan" | "pelaksanaan" | "evaluasi" | "pengendalian" | "peningkatan";
  jenis: "pemantauan" | "evaluasi_diri" | "audit" | "asesmen" | "rtm" | "sosialisasi" | "pelatihan" | "penyusunan_dokumen" | "survei" | "lainnya";
  nama: string | null;
  mulai?: string | null;
  selesai?: string | null;
  tempat?: string | null;
  pelaksana?: string | null;
  metode?: string | null;
  hasil?: string | null;
  tautan_bukti?: string | null;
  status?: "rencana" | "berjalan" | "selesai" | "batal";
  [key: string]: any;
};

export type SpmiAudit = {
  id?: number;
  /** ID periode */
  periode_id?: number | null;
  kode?: string;
  nama?: string | null;
  jenis?: "reguler" | "khusus" | "tindak_lanjut";
  tujuan?: string | null;
  lingkup?: string | null;
  acuan?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  status?: "rencana" | "persiapan" | "pelaksanaan" | "pelaporan" | "selesai" | "batal";
  ringkasan?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiAuditInput = {
  /** ID periode */
  periode_id: number | null;
  kode: string;
  nama: string | null;
  jenis?: "reguler" | "khusus" | "tindak_lanjut";
  tujuan?: string | null;
  lingkup?: string | null;
  acuan?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  status?: "rencana" | "persiapan" | "pelaksanaan" | "pelaporan" | "selesai" | "batal";
  ringkasan?: string | null;
  [key: string]: any;
};

export type SpmiRtm = {
  id?: number;
  /** ID periode */
  periode_id?: number | null;
  /** ID unit */
  unit_id?: number | null;
  judul?: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  tanggal?: string | null;
  tempat?: string | null;
  pimpinan_rapat?: string | null;
  notulis?: string | null;
  peserta?: string | null;
  agenda?: string | null;
  /** Objek/daftar JSON */
  masukan?: any;
  notulen?: string | null;
  kesimpulan?: string | null;
  tautan_bukti?: string | null;
  status?: "rencana" | "terlaksana" | "disahkan";
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiRtmInput = {
  /** ID periode */
  periode_id: number | null;
  /** ID unit */
  unit_id: number | null;
  judul: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  tanggal?: string | null;
  tempat?: string | null;
  pimpinan_rapat?: string | null;
  notulis?: string | null;
  peserta?: string | null;
  agenda?: string | null;
  /** Objek/daftar JSON */
  masukan?: any;
  notulen?: string | null;
  kesimpulan?: string | null;
  tautan_bukti?: string | null;
  status?: "rencana" | "terlaksana" | "disahkan";
  [key: string]: any;
};

export type SpmiKeputusan = {
  id?: number;
  /** ID rtm */
  rtm_id?: number | null;
  uraian?: string | null;
  jenis?: "perbaikan" | "peningkatan_standar" | "sumber_daya" | "kebijakan" | "lainnya";
  /** ID temuan */
  temuan_id?: number | null;
  /** ID standar */
  standar_id?: number | null;
  /** username SIAKAD */
  pic_username?: string | null;
  penanggung_jawab?: string | null;
  batas_waktu?: string | null;
  status?: "terbuka" | "proses" | "selesai" | "batal";
  hasil?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiKeputusanInput = {
  /** ID rtm */
  rtm_id: number | null;
  uraian: string | null;
  jenis?: "perbaikan" | "peningkatan_standar" | "sumber_daya" | "kebijakan" | "lainnya";
  /** ID temuan */
  temuan_id?: number | null;
  /** ID standar */
  standar_id?: number | null;
  /** username SIAKAD */
  pic_username?: string | null;
  penanggung_jawab?: string | null;
  batas_waktu?: string | null;
  status?: "terbuka" | "proses" | "selesai" | "batal";
  hasil?: string | null;
  [key: string]: any;
};

export type SpmiRisiko = {
  id?: number;
  /** ID periode */
  periode_id?: number | null;
  /** ID unit */
  unit_id?: number | null;
  /** ID standar */
  standar_id?: number | null;
  kode?: string | null;
  uraian?: string | null;
  penyebab?: string | null;
  dampak_uraian?: string | null;
  kemungkinan?: number;
  dampak?: number;
  pengendalian_ada?: string | null;
  mitigasi?: string | null;
  /** username SIAKAD */
  pic_username?: string | null;
  batas_waktu?: string | null;
  kemungkinan_sisa?: number;
  dampak_sisa?: number;
  status?: "terbuka" | "dimitigasi" | "ditutup";
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  /** kemungkinan × dampak */
  skor?: number;
  level?: "rendah" | "sedang" | "tinggi" | "sangat_tinggi";
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiRisikoInput = {
  /** ID periode */
  periode_id: number | null;
  /** ID unit */
  unit_id: number | null;
  /** ID standar */
  standar_id?: number | null;
  kode?: string | null;
  uraian: string | null;
  penyebab?: string | null;
  dampak_uraian?: string | null;
  kemungkinan: number;
  dampak: number;
  pengendalian_ada?: string | null;
  mitigasi?: string | null;
  /** username SIAKAD */
  pic_username?: string | null;
  batas_waktu?: string | null;
  kemungkinan_sisa?: number;
  dampak_sisa?: number;
  status?: "terbuka" | "dimitigasi" | "ditutup";
  [key: string]: any;
};

export type SpmiSurvei = {
  id?: number;
  /** ID periode */
  periode_id?: number | null;
  /** ID unit */
  unit_id?: number | null;
  kode?: string;
  judul?: string | null;
  pengantar?: string | null;
  sasaran?: "mahasiswa" | "dosen" | "tendik" | "mitra" | "orang_tua" | "umum";
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id?: string | null;
  skala?: number;
  anonim?: boolean;
  /** YYYY-MM-DD HH:MM:SS */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  selesai?: string | null;
  /** ID indikator */
  indikator_id?: number | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  status?: "draf" | "terbit" | "ditutup";
  /** Hanya untuk pengelola; sasaran luar mengisi lewat /publik/survei/{token} */
  token_publik?: string | null;
  jumlah_pertanyaan?: number;
  jumlah_respon?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiSurveiInput = {
  /** ID periode */
  periode_id: number | null;
  /** ID unit */
  unit_id?: number | null;
  kode: string;
  judul: string | null;
  pengantar?: string | null;
  sasaran: "mahasiswa" | "dosen" | "tendik" | "mitra" | "orang_tua" | "umum";
  /** Kode prodi SIAKAD (m_program_studi) */
  kode_prodi?: string | null;
  /** Tahun akademik SIAKAD, mis. 20251 */
  tahun_id?: string | null;
  skala?: number;
  anonim?: boolean;
  /** YYYY-MM-DD HH:MM:SS */
  mulai?: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  selesai?: string | null;
  /** ID indikator */
  indikator_id?: number | null;
  [key: string]: any;
};

export type SpmiPertanyaan = {
  id?: number;
  /** ID survei */
  survei_id?: number | null;
  urut?: number;
  bagian?: string | null;
  dimensi?: "tangible" | "reliability" | "responsiveness" | "assurance" | "empathy" | "lainnya";
  tipe?: "likert" | "pilihan" | "pilihan_ganda" | "teks" | "angka";
  teks?: string | null;
  /** Objek/daftar JSON */
  pilihan?: any;
  wajib?: boolean;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiPertanyaanInput = {
  /** ID survei */
  survei_id: number | null;
  urut?: number;
  bagian?: string | null;
  dimensi?: "tangible" | "reliability" | "responsiveness" | "assurance" | "empathy" | "lainnya";
  tipe?: "likert" | "pilihan" | "pilihan_ganda" | "teks" | "angka";
  teks: string | null;
  /** Objek/daftar JSON */
  pilihan?: any;
  wajib?: boolean;
  [key: string]: any;
};

export type SpmiAkreditasi = {
  id?: number;
  /** ID unit */
  unit_id?: number | null;
  lingkup?: "institusi" | "prodi";
  lembaga?: string;
  status?: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi" | "dalam_proses";
  peringkat?: string | null;
  instrumen?: string | null;
  nilai?: number | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  berlaku_mulai?: string | null;
  berlaku_sampai?: string | null;
  tautan_sk?: string | null;
  terkini?: boolean;
  catatan?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  /** Hari sampai berlaku_sampai */
  sisa_hari?: number | null;
  /** kedaluwarsa | segera_berakhir | null */
  peringatan?: string | null;
  /** siakad | manual */
  sumber?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiAkreditasiInput = {
  /** ID unit */
  unit_id: number | null;
  lingkup: "institusi" | "prodi";
  lembaga: string;
  status: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi" | "dalam_proses";
  peringkat?: string | null;
  instrumen?: string | null;
  nilai?: number | null;
  nomor_sk?: string | null;
  tanggal_sk?: string | null;
  berlaku_mulai?: string | null;
  berlaku_sampai?: string | null;
  tautan_sk?: string | null;
  terkini?: boolean;
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiLembaga = {
  id?: number;
  kode?: string;
  nama?: string | null;
  singkatan?: string | null;
  lingkup?: "prodi" | "institusi" | "semua";
  situs?: string | null;
  aktif?: boolean;
  urut?: number;
  catatan?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiLembagaInput = {
  kode: string;
  nama: string | null;
  singkatan?: string | null;
  lingkup?: "prodi" | "institusi" | "semua";
  situs?: string | null;
  aktif?: boolean;
  urut?: number;
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiPeringkat = {
  id?: number;
  kode?: string;
  nama?: string | null;
  status?: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi";
  kode_siakad?: "A" | "B" | "C" | "L" | "U";
  aktif?: boolean;
  urut?: number;
  keterangan?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiPeringkatInput = {
  kode: string;
  nama: string | null;
  status: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi";
  kode_siakad?: "A" | "B" | "C" | "L" | "U";
  aktif?: boolean;
  urut?: number;
  keterangan?: string | null;
  [key: string]: any;
};

export type SpmiInstrumen = {
  id?: number;
  kode?: string;
  nama?: string | null;
  lembaga?: string;
  lingkup?: "institusi" | "prodi";
  dasar?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiInstrumenInput = {
  kode: string;
  nama: string | null;
  lembaga: string;
  lingkup: "institusi" | "prodi";
  dasar?: string | null;
  aktif?: boolean;
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiKriteria = {
  id?: number;
  /** ID instrumen */
  instrumen_id?: number | null;
  kode?: string;
  nama?: string | null;
  deskripsi?: string | null;
  bobot?: number | null;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiKriteriaInput = {
  /** ID instrumen */
  instrumen_id: number | null;
  kode: string;
  nama: string | null;
  deskripsi?: string | null;
  bobot?: number | null;
  urut?: number;
  [key: string]: any;
};

export type SpmiDokumenAkreditasi = {
  id?: number;
  /** ID instrumen */
  instrumen_id?: number | null;
  /** ID kriteria */
  kriteria_id?: number | null;
  kode?: string;
  nama?: string | null;
  jenis?: "led" | "lkps" | "tabel" | "pendukung" | "lainnya";
  keterangan?: string | null;
  wajib?: boolean;
  sumber_data?: string | null;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiDokumenAkreditasiInput = {
  /** ID instrumen */
  instrumen_id: number | null;
  /** ID kriteria */
  kriteria_id?: number | null;
  kode: string;
  nama: string | null;
  jenis: "led" | "lkps" | "tabel" | "pendukung" | "lainnya";
  keterangan?: string | null;
  wajib?: boolean;
  sumber_data?: string | null;
  urut?: number;
  [key: string]: any;
};

export type SpmiPersiapan = {
  id?: number;
  /** ID unit */
  unit_id?: number | null;
  /** ID instrumen */
  instrumen_id?: number | null;
  jenis?: "baru" | "reakreditasi" | "peningkatan" | "perpanjangan";
  target_status?: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi" | "dalam_proses";
  target_pengajuan?: string | null;
  tanggal_pengajuan?: string | null;
  /** username SIAKAD */
  ketua_username?: string | null;
  tim?: string | null;
  status?: "persiapan" | "penyusunan" | "diajukan" | "asesmen_kecukupan" | "asesmen_lapangan" | "keputusan" | "selesai" | "batal";
  /** ID akreditasi */
  akreditasi_id?: number | null;
  catatan?: string | null;
  dibuat_oleh?: string | null;
  diubah_oleh?: string | null;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiPersiapanInput = {
  /** ID unit */
  unit_id: number | null;
  /** ID instrumen */
  instrumen_id?: number | null;
  jenis?: "baru" | "reakreditasi" | "peningkatan" | "perpanjangan";
  target_status?: "terakreditasi_unggul" | "terakreditasi" | "terakreditasi_pertama" | "tidak_terakreditasi" | "dalam_proses";
  target_pengajuan?: string | null;
  tanggal_pengajuan?: string | null;
  /** username SIAKAD */
  ketua_username?: string | null;
  tim?: string | null;
  status?: "persiapan" | "penyusunan" | "diajukan" | "asesmen_kecukupan" | "asesmen_lapangan" | "keputusan" | "selesai" | "batal";
  /** ID akreditasi */
  akreditasi_id?: number | null;
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiButir = {
  id?: number;
  /** ID persiapan */
  persiapan_id?: number | null;
  /** ID kriteria */
  kriteria_id?: number | null;
  kode?: string;
  nama?: string | null;
  narasi?: string | null;
  skor_simulasi?: number | null;
  bobot?: number | null;
  /** username SIAKAD */
  pic_username?: string | null;
  tautan_bukti?: string | null;
  status?: "belum" | "proses" | "selesai" | "ditinjau";
  catatan?: string | null;
  urut?: number;
  created_at?: string | null;
  updated_at?: string | null;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiButirInput = {
  /** ID persiapan */
  persiapan_id: number | null;
  /** ID kriteria */
  kriteria_id?: number | null;
  kode: string;
  nama: string | null;
  narasi?: string | null;
  skor_simulasi?: number | null;
  bobot?: number | null;
  /** username SIAKAD */
  pic_username?: string | null;
  tautan_bukti?: string | null;
  status?: "belum" | "proses" | "selesai" | "ditinjau";
  catatan?: string | null;
  urut?: number;
  [key: string]: any;
};

export type SpmiPeriodeUnit = {
  periode_id: number;
  /** Kosong = semua unit (untuk siapkan/hitung) */
  unit_id?: number | null;
  [key: string]: any;
};

export type SpmiCapaian = {
  id?: number;
  indikator_id?: number;
  periode_id?: number;
  unit_id?: number;
  target?: number | null;
  nilai?: number | null;
  nilai_teks?: string | null;
  /** Hasil metrik SIAKAD */
  nilai_otomatis?: number | null;
  /** Rincian hitungan metrik (JSON) */
  rincian_otomatis?: any;
  dihitung_pada?: string | null;
  pemenuhan?: "belum" | "tercapai" | "melampaui" | "tidak_tercapai";
  analisis?: string | null;
  kendala?: string | null;
  rencana_perbaikan?: string | null;
  tautan_bukti?: string | null;
  status?: "draf" | "diajukan" | "diverifikasi" | "dikembalikan";
  diajukan_pada?: string | null;
  diverifikasi_pada?: string | null;
  catatan_verifikasi?: string | null;
  standar_kode?: string | null;
  indikator_kode?: string | null;
  pernyataan?: string | null;
  satuan?: string | null;
  metrik?: string | null;
  unit?: string | null;
  [key: string]: any;
};

export type SpmiCapaianIsi = {
  /** Untuk indikator angka/persen/rasio; pemenuhan dihitung dari target */
  nilai?: number | null;
  nilai_teks?: string | null;
  /** Hanya untuk indikator teks/ya_tidak atau tanpa target */
  pemenuhan?: "belum" | "tercapai" | "melampaui" | "tidak_tercapai";
  analisis?: string | null;
  kendala?: string | null;
  rencana_perbaikan?: string | null;
  tautan_bukti?: string | null;
  [key: string]: any;
};

export type SpmiVerifikasi = {
  setuju: boolean;
  /** Wajib bila dikembalikan */
  catatan?: string | null;
  [key: string]: any;
};

export type SpmiAuditee = {
  id?: number;
  audit_id?: number;
  unit_id?: number;
  unit?: string | null;
  jadwal_desk?: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  jadwal_visitasi?: string | null;
  tempat?: string | null;
  status?: "dijadwalkan" | "evaluasi_diri" | "desk" | "visitasi" | "pelaporan" | "disetujui" | "selesai";
  kekuatan?: string | null;
  peluang_peningkatan?: string | null;
  kesimpulan?: string | null;
  /** Rata-rata skor daftar tilik 0-4 */
  skor?: number | null;
  disetujui_auditee_pada?: string | null;
  tanggapan_auditee?: string | null;
  disahkan_pada?: string | null;
  tim?: Array<JsonObject>;
  /** ketua | anggota | auditee | admin | null */
  peran_saya?: string | null;
  [key: string]: any;
};

export type SpmiAuditeeInput = {
  unit_id: number;
  jadwal_desk?: string | null;
  /** YYYY-MM-DD HH:MM:SS */
  jadwal_visitasi?: string | null;
  tempat?: string | null;
  [key: string]: any;
};

export type SpmiTilik = {
  id?: number;
  auditee_id?: number;
  standar_id?: number | null;
  indikator_id?: number | null;
  urut?: number;
  pertanyaan?: string;
  jawaban_auditee?: string | null;
  tautan_bukti?: string | null;
  capaian?: number | null;
  /** 0-4 */
  skor?: number | null;
  hasil?: "belum" | "melampaui" | "sesuai" | "observasi" | "kts_minor" | "kts_mayor";
  catatan_auditor?: string | null;
  [key: string]: any;
};

/** Kolom auditee diisi unit yang diaudit, kolom auditor diisi tim auditor yang ditugaskan. */
export type SpmiTilikIsi = {
  /** Unit yang diaudit */
  jawaban_auditee?: string | null;
  tautan_bukti?: string | null;
  /** Unit yang diaudit */
  capaian?: number | null;
  /** Auditor */
  skor?: number;
  /** Auditor */
  hasil?: "belum" | "melampaui" | "sesuai" | "observasi" | "kts_minor" | "kts_mayor";
  /** Auditor */
  catatan_auditor?: string | null;
  /** Auditor */
  pertanyaan?: string | null;
  [key: string]: any;
};

export type SpmiTemuan = {
  id?: number;
  /** TM-<tahun>-<urut> */
  kode?: string;
  periode_id?: number;
  unit_id?: number;
  sumber?: "ami" | "pemantauan" | "survei" | "rtm" | "eksternal" | "lainnya";
  auditee_id?: number | null;
  daftar_tilik_id?: number | null;
  standar_id?: number | null;
  indikator_id?: number | null;
  kategori?: "kts_mayor" | "kts_minor" | "observasi" | "peluang_peningkatan" | "praktik_baik";
  uraian?: string;
  kriteria?: string | null;
  akar_masalah?: string | null;
  akibat?: string | null;
  rekomendasi?: string | null;
  pic_username?: string | null;
  batas_waktu?: string | null;
  status?: "terbuka" | "rencana" | "proses" | "verifikasi" | "ditutup" | "dibatalkan";
  ditutup_pada?: string | null;
  catatan_penutupan?: string | null;
  terlambat?: boolean;
  tindak_lanjut?: Array<JsonObject>;
  [key: string]: any;
};

/** Saat ubah (PUT), kirim hanya kolom yang berubah. */
export type SpmiTemuanInput = {
  periode_id: number;
  unit_id: number;
  sumber?: "ami" | "pemantauan" | "survei" | "rtm" | "eksternal" | "lainnya";
  auditee_id?: number | null;
  daftar_tilik_id?: number | null;
  standar_id?: number | null;
  indikator_id?: number | null;
  kategori: "kts_mayor" | "kts_minor" | "observasi" | "peluang_peningkatan" | "praktik_baik";
  uraian: string;
  kriteria?: string | null;
  akar_masalah?: string | null;
  akibat?: string | null;
  rekomendasi?: string | null;
  /** username SIAKAD */
  pic_username?: string | null;
  batas_waktu?: string | null;
  [key: string]: any;
};

export type SpmiTindakLanjutInput = {
  jenis?: "koreksi" | "korektif" | "pencegahan" | "peningkatan";
  rencana: string;
  penanggung_jawab?: string | null;
  target_tanggal?: string | null;
  realisasi?: string | null;
  tanggal_realisasi?: string | null;
  tautan_bukti?: string | null;
  /** diterima/ditolak hanya lewat verifikasi auditor */
  status?: "rencana" | "proses" | "selesai";
  [key: string]: any;
};

export type SpmiJawabanSurvei = {
  jawaban: Array<{
    pertanyaan_id: number;
    /** likert (1..skala) atau angka */
    nilai?: number;
    /** tipe teks */
    teks?: string;
    /** tipe pilihan / pilihan_ganda */
    pilihan?: Array<string>;
    [key: string]: any;
  }>;
  /** Hanya survei publik non-anonim */
  nama?: string | null;
  /** Hanya survei publik */
  instansi?: string | null;
  [key: string]: any;
};

export type SpmiPelaporanIsi = {
  ada?: boolean;
  /** spmi_dokumen */
  dokumen_id?: number | null;
  tautan?: string | null;
  tanggal_penetapan?: string | null;
  /** Deskripsi bukti yang disalin ke situs kementerian */
  catatan?: string | null;
  status?: "draf" | "siap" | "dilaporkan";
  status_verifikasi?: "belum" | "diverifikasi";
  status_valid?: "belum" | "valid" | "tidak_valid";
  catatan_verifikator?: string | null;
  [key: string]: any;
};

export type SpmiFile = {
  id?: string;
  entitas?: "dokumen" | "capaian" | "kegiatan" | "tilik" | "auditee" | "temuan" | "tindak_lanjut" | "rtm" | "akreditasi" | "butir" | "pelaporan" | "risiko";
  entitas_id?: number;
  nama?: string;
  mime?: string;
  ukuran?: number;
  sha256?: string | null;
  keterangan?: string | null;
  diunggah_oleh?: string | null;
  diunggah_pada?: string | null;
  /** Path unduh (GET, dengan token) */
  unduh?: string;
  [key: string]: any;
};

export type SpmiFileUpload = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  /** multipart/form-data */
  berkas?: Uploadable;
  /** Alternatif JSON: isi file base64 */
  berkas_base64?: string;
  /** Wajib bersama berkas_base64 */
  nama_file?: string;
  keterangan?: string;
  [key: string]: any;
};

/** Pilihan buatTema unipo-ui; kunci yang tidak diisi mengikuti lapis di atasnya atau bawaan */
export type TemaOpsi = {
  /** Warna utama (hex) Contoh: `#0f766e` */
  primary?: string;
  /** Warna aksen (hex) Contoh: `#f59e0b` */
  secondary?: string;
  /** Primer mode gelap (hex) */
  primaryGelap?: string;
  success?: string;
  warning?: string;
  danger?: string;
  info?: string;
  /** Latar mode terang */
  latar?: string;
  /** Latar mode gelap */
  latarGelap?: string;
  /** unipo | slate | abu | hangat | zaitun */
  netral?: string;
  /** Sudut dasar 0-28 px Contoh: `10` */
  radius?: number;
  /** jakarta | inter | poppins | dmsans | sistem | serif */
  font?: string;
  /** Sama dengan font, atau sama */
  fontJudul?: string;
  /** jetbrains | sistem */
  fontMono?: string;
  /** Ukuran teks isi 12-18 px Contoh: `14` */
  teks?: number;
  /** tanpa | halus | normal | tegas */
  bayangan?: string;
  /** normal | cepat | lambat | tanpa */
  gerak?: string;
  muatFont?: boolean;
  [key: string]: any;
};

export type TemaInput = {
  tema?: TemaOpsi;
  /** Tata letak milik aplikasi (kunci huruf kecil, teks tanpa HTML) */
  tata?: JsonObject;
  /** Catatan perubahan (maks. 255) */
  catatan?: string;
  [key: string]: any;
};

export type TracerKuesioner = {
  id?: number | null;
  /** Contoh: `KEMDIKBUD-2021` */
  kode?: string | null;
  /** Contoh: `2021` */
  versi?: string | null;
  nama?: string | null;
  /** alumni atau pengguna */
  jenis?: string | null;
  /** kemdikbud atau kustom */
  sumber?: string | null;
  deskripsi?: string | null;
  aktif?: boolean;
  /** Sudah punya jawaban; struktur tidak bisa diubah */
  terkunci?: boolean;
  jumlah_pertanyaan?: number | null;
  [key: string]: any;
};

export type TracerKuesionerStruktur = {
  id?: number | null;
  kode?: string | null;
  versi?: string | null;
  nama?: string | null;
  jenis?: string | null;
  sumber?: string | null;
  aktif?: boolean;
  terkunci?: boolean;
  bagian?: Array<{
    id?: number | null;
    judul?: string | null;
    deskripsi?: string | null;
    urutan?: number | null;
    kondisi?: Array<{
      /** Kode pertanyaan Contoh: `f8` */
      kode?: string | null;
      in?: Array<string>;
      [key: string]: any;
    }>;
    pertanyaan?: Array<{
      id?: number | null;
      /** Kode variabel (unik per kuesioner) Contoh: `f8` */
      kode?: string | null;
      teks?: string | null;
      bantuan?: string | null;
      tipe?: "pilihan_tunggal" | "pilihan_ganda" | "skala" | "teks" | "teks_panjang" | "angka" | "tanggal" | "email" | "telepon" | "propinsi" | "kabupaten";
      /** Wajib bila pertanyaan tampil */
      wajib?: boolean;
      /** Kelompok tampilan, mis. matriks F17 */
      grup?: string | null;
      /** Tampil bila semua syarat terpenuhi; null = selalu tampil */
      kondisi?: Array<{
        /** Kode pertanyaan Contoh: `f8` */
        kode?: string | null;
        in?: Array<string>;
        [key: string]: any;
      }>;
      validasi?: {
        min?: number | null;
        max?: number | null;
        /** Regex untuk teks */
        pola?: string | null;
        maks_pilihan?: number | null;
        [key: string]: any;
      };
      skala_min?: number | null;
      skala_maks?: number | null;
      label_min?: string | null;
      label_maks?: string | null;
      /** Jawaban memperbarui profil/karir alumni: status, waktu_tunggu, pendapatan, nama_instansi, ... */
      peta_profil?: string | null;
      opsi?: Array<{
        /** Nilai yang disimpan Contoh: `1` */
        nilai?: string | null;
        /** Contoh: `Bekerja (full time/part time)` */
        label?: string | null;
        /** Pilihan ganda: kolom ekspor 0/1 Contoh: `f401` */
        kode_ekspor?: string | null;
        /** Opsi "Lainnya" yang meminta isian teks */
        isian_lain?: boolean;
        /** Kolom ekspor isian "Lainnya" Contoh: `f1102` */
        kode_isian?: string | null;
        [key: string]: any;
      }>;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type TracerKuesionerInput = {
  /** Contoh: `TS-PRODI-TI` */
  kode: string | null;
  /** Contoh: `1` */
  versi?: string | null;
  nama: string | null;
  /** alumni atau pengguna */
  jenis?: string | null;
  deskripsi?: string | null;
  aktif?: boolean;
  bagian?: Array<{
    judul?: string | null;
    deskripsi?: string | null;
    kondisi?: Array<{
      /** Kode pertanyaan Contoh: `f8` */
      kode?: string | null;
      in?: Array<string>;
      [key: string]: any;
    }>;
    pertanyaan?: Array<{
      id?: number | null;
      /** Kode variabel (unik per kuesioner) Contoh: `f8` */
      kode?: string | null;
      teks?: string | null;
      bantuan?: string | null;
      tipe?: "pilihan_tunggal" | "pilihan_ganda" | "skala" | "teks" | "teks_panjang" | "angka" | "tanggal" | "email" | "telepon" | "propinsi" | "kabupaten";
      /** Wajib bila pertanyaan tampil */
      wajib?: boolean;
      /** Kelompok tampilan, mis. matriks F17 */
      grup?: string | null;
      /** Tampil bila semua syarat terpenuhi; null = selalu tampil */
      kondisi?: Array<{
        /** Kode pertanyaan Contoh: `f8` */
        kode?: string | null;
        in?: Array<string>;
        [key: string]: any;
      }>;
      validasi?: {
        min?: number | null;
        max?: number | null;
        /** Regex untuk teks */
        pola?: string | null;
        maks_pilihan?: number | null;
        [key: string]: any;
      };
      skala_min?: number | null;
      skala_maks?: number | null;
      label_min?: string | null;
      label_maks?: string | null;
      /** Jawaban memperbarui profil/karir alumni: status, waktu_tunggu, pendapatan, nama_instansi, ... */
      peta_profil?: string | null;
      opsi?: Array<{
        /** Nilai yang disimpan Contoh: `1` */
        nilai?: string | null;
        /** Contoh: `Bekerja (full time/part time)` */
        label?: string | null;
        /** Pilihan ganda: kolom ekspor 0/1 Contoh: `f401` */
        kode_ekspor?: string | null;
        /** Opsi "Lainnya" yang meminta isian teks */
        isian_lain?: boolean;
        /** Kolom ekspor isian "Lainnya" Contoh: `f1102` */
        kode_isian?: string | null;
        [key: string]: any;
      }>;
      [key: string]: any;
    }>;
    [key: string]: any;
  }>;
  [key: string]: any;
};

export type TracerPeriode = {
  id?: number | null;
  /** Contoh: `TS2026` */
  kode?: string | null;
  nama?: string | null;
  jenis?: string | null;
  kuesioner_id?: number | null;
  nama_kuesioner?: string | null;
  tahun_pelaporan?: number | null;
  lulus_dari?: string | null;
  lulus_sampai?: string | null;
  prodi?: Array<string>;
  /** Tahun masuk sasaran; null = semua */
  sasaran_angkatan?: Array<number>;
  /** Tahun lulus sasaran; null = semua */
  sasaran_tahun_lulus?: Array<number>;
  mulai?: string | null;
  selesai?: string | null;
  status?: "draf" | "aktif" | "ditutup";
  target_persen?: number | null;
  keterangan?: string | null;
  jumlah_responden?: number | null;
  jumlah_selesai?: number | null;
  /** % */
  tingkat_respons?: number | null;
  [key: string]: any;
};

export type TracerPeriodeInput = {
  /** Contoh: `TS2026` */
  kode: string | null;
  /** Contoh: `Tracer Study 2026 (lulusan 2025)` */
  nama: string | null;
  kuesioner_id: number | null;
  tahun_pelaporan?: number | null;
  /** Sasaran: tanggal lulus mulai */
  lulus_dari?: string | null;
  lulus_sampai?: string | null;
  /** null = semua prodi */
  prodi?: Array<string>;
  /** Sasaran per angkatan (tahun masuk), mis. [2019, 2020]; null = semua */
  sasaran_angkatan?: Array<number>;
  /** Sasaran per tahun lulus, mis. [2024]; null = semua */
  sasaran_tahun_lulus?: Array<number>;
  /** YYYY-MM-DD HH:MM:SS */
  mulai?: string | null;
  selesai?: string | null;
  /** draf, aktif, ditutup */
  status?: string | null;
  target_persen?: number | null;
  keterangan?: string | null;
  [key: string]: any;
};

export type TracerResponden = {
  id?: number | null;
  periode_id?: number | null;
  /** alumni atau pengguna */
  jenis?: string | null;
  /** Alumni (atau alumni yang dinilai pengguna) */
  nim?: string | null;
  nama_alumni?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  tahun_lulus?: number | null;
  instansi_id?: number | null;
  nama_instansi?: string | null;
  nama_penilai?: string | null;
  jabatan_penilai?: string | null;
  status?: "belum" | "diundang" | "dibuka" | "draf" | "selesai" | "menolak";
  dibuka_at?: string | null;
  selesai_at?: string | null;
  /** Hanya dengan tracer:pii */
  email?: string | null;
  /** Hanya dengan tracer:pii */
  hp?: string | null;
  [key: string]: any;
};

export type TracerRespondenInput = {
  /** Alumni (periode alumni) atau alumni yang dinilai (periode pengguna) */
  nim?: string | null;
  /** Periode pengguna */
  instansi_id?: number | null;
  /** Periode pengguna: pekerjaan alumni yang dinilai */
  pekerjaan_id?: number | null;
  /** Nama penilai */
  nama?: string | null;
  jabatan?: string | null;
  email?: string | null;
  hp?: string | null;
  [key: string]: any;
};

export type TracerUsulanPenilai = {
  /** Pekerjaan alumni (tracer_pekerjaan.id) di instansi yang menilai */
  pekerjaan_id: number | null;
  /** Nama atasan/HRD */
  nama: string | null;
  jabatan?: string | null;
  email: string | null;
  /** Nomor WhatsApp atasan, opsional */
  hp?: string | null;
  [key: string]: any;
};

export type TracerRespondenDetail = {
  id?: number | null;
  periode_id?: number | null;
  /** alumni atau pengguna */
  jenis?: string | null;
  /** Alumni (atau alumni yang dinilai pengguna) */
  nim?: string | null;
  nama_alumni?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  tahun_lulus?: number | null;
  instansi_id?: number | null;
  nama_instansi?: string | null;
  nama_penilai?: string | null;
  jabatan_penilai?: string | null;
  status?: "belum" | "diundang" | "dibuka" | "draf" | "selesai" | "menolak";
  dibuka_at?: string | null;
  selesai_at?: string | null;
  /** Hanya dengan tracer:pii */
  email?: string | null;
  /** Hanya dengan tracer:pii */
  hp?: string | null;
  [key: string]: any;
} & {
  /** kode => nilai. Pilihan tunggal/skala/teks/angka/tanggal: string atau angka. Pilihan ganda: daftar nilai opsi. */
  jawaban?: JsonObject;
  /** kode => isian teks untuk opsi "Lainnya" */
  teks_lain?: Record<string, string>;
  riwayat_kirim?: Array<JsonObject>;
  [key: string]: any;
};

export type TracerJawabanInput = {
  /** kode => nilai. Pilihan tunggal/skala/teks/angka/tanggal: string atau angka. Pilihan ganda: daftar nilai opsi. */
  jawaban: JsonObject;
  /** kode => isian teks untuk opsi "Lainnya" */
  teks_lain?: Record<string, string>;
  /** Hanya PUT /responden/{id}/jawaban: tandai selesai */
  kirim?: boolean;
  [key: string]: any;
};

export type TracerFotoInput = {
  /** JPG/PNG/WEBP maks 2 MB */
  berkas?: Uploadable;
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  [key: string]: any;
};

export type TracerBerkasInput = {
  /** Alternatif file: UUID berkas dari /v1/berkas (mis. hasil unggah bertahap) */
  berkas_id?: string;
  /** PDF/gambar/dokumen, batas ukuran ARSIP_MAKS_MB */
  berkas?: Uploadable;
  /** CV, SERTIFIKAT, PRESTASI, KARYA, IDENTITAS, SKPI, IJAZAH, TRANSKRIP */
  jenis: string | null;
  /** Opsional */
  judul?: string | null;
  [key: string]: any;
};

export type TracerImporInput = {
  /** CSV hasil unduhan tracerstudy.kemdiktisaintek.go.id */
  file: Uploadable;
  [key: string]: any;
};

export type TracerFormulir = {
  responden?: {
    id?: number | null;
    periode_id?: number | null;
    /** alumni atau pengguna */
    jenis?: string | null;
    /** Alumni (atau alumni yang dinilai pengguna) */
    nim?: string | null;
    nama_alumni?: string | null;
    kode_prodi?: string | null;
    nama_prodi?: string | null;
    tahun_lulus?: number | null;
    instansi_id?: number | null;
    nama_instansi?: string | null;
    nama_penilai?: string | null;
    jabatan_penilai?: string | null;
    status?: "belum" | "diundang" | "dibuka" | "draf" | "selesai" | "menolak";
    dibuka_at?: string | null;
    selesai_at?: string | null;
    /** Hanya dengan tracer:pii */
    email?: string | null;
    /** Hanya dengan tracer:pii */
    hp?: string | null;
    [key: string]: any;
  };
  periode?: {
    id?: number | null;
    nama?: string | null;
    jenis?: string | null;
    status?: string | null;
    mulai?: string | null;
    selesai?: string | null;
    bisa_diisi?: boolean;
    [key: string]: any;
  };
  kuesioner?: TracerKuesionerStruktur;
  /** kode => nilai. Pilihan tunggal/skala/teks/angka/tanggal: string atau angka. Pilihan ganda: daftar nilai opsi. */
  jawaban?: JsonObject;
  /** kode => isian teks untuk opsi "Lainnya" */
  teks_lain?: Record<string, string>;
  /** Kode pertanyaan yang tampil menurut kondisi dan jawaban saat ini */
  terlihat?: Array<string>;
  [key: string]: any;
};

export type TracerHasilSimpan = {
  responden?: {
    id?: number | null;
    periode_id?: number | null;
    /** alumni atau pengguna */
    jenis?: string | null;
    /** Alumni (atau alumni yang dinilai pengguna) */
    nim?: string | null;
    nama_alumni?: string | null;
    kode_prodi?: string | null;
    nama_prodi?: string | null;
    tahun_lulus?: number | null;
    instansi_id?: number | null;
    nama_instansi?: string | null;
    nama_penilai?: string | null;
    jabatan_penilai?: string | null;
    status?: "belum" | "diundang" | "dibuka" | "draf" | "selesai" | "menolak";
    dibuka_at?: string | null;
    selesai_at?: string | null;
    /** Hanya dengan tracer:pii */
    email?: string | null;
    /** Hanya dengan tracer:pii */
    hp?: string | null;
    [key: string]: any;
  };
  /** kode => nilai. Pilihan tunggal/skala/teks/angka/tanggal: string atau angka. Pilihan ganda: daftar nilai opsi. */
  jawaban?: JsonObject;
  /** kode => isian teks untuk opsi "Lainnya" */
  teks_lain?: Record<string, string>;
  terlihat?: Array<string>;
  [key: string]: any;
};

export type TracerAlumni = {
  nim?: string | null;
  nama?: string | null;
  kode_prodi?: string | null;
  nama_prodi?: string | null;
  jenis_kelamin?: string | null;
  tahun_masuk?: string | null;
  tanggal_lulus?: string | null;
  tahun_lulus?: number | null;
  ipk?: string | null;
  no_ijazah?: string | null;
  /** Kode F8 terakhir */
  status_terkini?: string | null;
  status_tanggal?: string | null;
  bersedia_dihubungi?: boolean;
  tampil_direktori?: boolean;
  linkedin?: string | null;
  [key: string]: any;
};

export type TracerAlumniDetail = TracerAlumni & {
  /** Email aktif (tracer_alumni) */
  email?: string | null;
  hp?: string | null;
  email_siakad?: string | null;
  hp_siakad?: string | null;
  alamat?: string | null;
  kode_propinsi?: string | null;
  kode_kabupaten?: string | null;
  situs?: string | null;
  persetujuan_at?: string | null;
  pekerjaan?: Array<TracerPekerjaan>;
  studi_lanjut?: Array<TracerStudiLanjut>;
  survei?: Array<JsonObject>;
  [key: string]: any;
};

export type TracerProfilInput = {
  email?: string | null;
  hp?: string | null;
  alamat?: string | null;
  kode_propinsi?: string | null;
  kode_kabupaten?: string | null;
  linkedin?: string | null;
  situs?: string | null;
  bersedia_dihubungi?: boolean;
  tampil_direktori?: boolean;
  /** Alumni sendiri: setuju pemrosesan data pribadi */
  persetujuan?: boolean;
  /** 16 digit */
  nik?: string | null;
  /** 15/16 digit */
  npwp?: string | null;
  /** 5 digit */
  kode_pos?: string | null;
  /** Permohonan koreksi data SIAKAD, maks 2000 karakter */
  koreksi_data?: string | null;
  [key: string]: any;
};

export type TracerPekerjaan = {
  id?: number | null;
  nim?: string | null;
  instansi_id?: number | null;
  nama_instansi?: string | null;
  /** Kode F11: 1 pemerintah, 2 non-profit, 3 swasta, 4 wiraswasta, 5 lainnya, 6 BUMN/BUMD, 7 multilateral */
  jenis_instansi?: string | null;
  /** Kode F5d: 1 lokal, 2 nasional, 3 multinasional */
  tingkat?: string | null;
  jabatan?: string | null;
  /** Kode F5c */
  posisi_wirausaha?: string | null;
  /** tetap, kontrak, paruh_waktu, lepas, wirausaha, lainnya */
  status_kerja?: string | null;
  mulai?: string | null;
  selesai?: string | null;
  saat_ini?: boolean;
  /** Take home pay per bulan */
  pendapatan?: number | null;
  /** Bulan */
  waktu_tunggu?: number | null;
  sebelum_lulus?: boolean;
  kode_propinsi?: string | null;
  kode_kabupaten?: string | null;
  /** Kode F14 */
  keselarasan_horizontal?: string | null;
  /** Kode F15 */
  keselarasan_vertikal?: string | null;
  /** Diisi bila berasal dari kuesioner */
  responden_id?: number | null;
  instansi?: {
    bidang_usaha?: string | null;
    alamat?: string | null;
    telepon?: string | null;
    email?: string | null;
    situs?: string | null;
    [key: string]: any;
  };
  [key: string]: any;
};

export type TracerStudiLanjut = {
  id?: number | null;
  nim?: string | null;
  /** S1, S2, S3, Profesi, Spesialis, D4, Lainnya */
  jenjang?: string | null;
  perguruan_tinggi?: string | null;
  program_studi?: string | null;
  negara?: string | null;
  /** Kode F18a: 1 sendiri, 2 beasiswa */
  sumber_biaya?: string | null;
  tanggal_masuk?: string | null;
  tanggal_lulus?: string | null;
  [key: string]: any;
};

export type TracerInstansi = {
  id?: number | null;
  nama?: string | null;
  /** Kode F11 */
  jenis?: string | null;
  /** Kode F5d */
  tingkat?: string | null;
  bidang_usaha?: string | null;
  alamat?: string | null;
  kode_propinsi?: string | null;
  kode_kabupaten?: string | null;
  telepon?: string | null;
  email?: string | null;
  situs?: string | null;
  kontak_nama?: string | null;
  kontak_jabatan?: string | null;
  /** Hanya dengan tracer:pii */
  kontak_email?: string | null;
  /** Hanya dengan tracer:pii */
  kontak_hp?: string | null;
  terverifikasi?: boolean;
  jumlah_alumni?: number | null;
  [key: string]: any;
};

export type TracerLowongan = {
  id?: number | null;
  instansi_id?: number | null;
  nama_instansi?: string | null;
  judul?: string | null;
  deskripsi?: string | null;
  kualifikasi?: string | null;
  /** penuh_waktu, paruh_waktu, kontrak, magang, lepas */
  tipe?: string | null;
  lokasi?: string | null;
  kode_propinsi?: string | null;
  kode_kabupaten?: string | null;
  prodi?: Array<string>;
  gaji_min?: number | null;
  gaji_maks?: number | null;
  tautan?: string | null;
  kontak?: string | null;
  batas_lamar?: string | null;
  /** draf, terbit, ditutup */
  status?: string | null;
  [key: string]: any;
};

