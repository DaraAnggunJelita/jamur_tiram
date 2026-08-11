### 3.5 Perancangan Basis Data
Berikut rancangan database yang akan digunakan pada sistem Monitoring dan Traceability Budidaya Jamur Tiram (KUPS Jamur Tiram):

---

#### 1. Tabel User
Rancangan basis data tabel **users** berfungsi untuk menyimpan informasi otentikasi akun dan membedakan tingkat hak akses dari setiap pengguna yang menggunakan sistem.

- **Nama Tabel** : `users`
- **Primary key** : `id`
- **Foreign key** : `-`

##### Table 3.1 Tabel Users
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | name | varchar | 255 | Nama pengguna |
| 3. | email | varchar | 255 | Email untuk login (Unique) |
| 4. | email_verified_at | timestamp | - | Waktu verifikasi email |
| 5. | password | varchar | 255 | Kata sandi terenkripsi |
| 6. | role | enum | - | Hak akses ('admin', 'petugas', 'ketua') |
| 7. | remember_token | varchar | 100 | Token untuk sesi login |
| 8. | created_at | timestamp | - | Waktu data dibuat |
| 9. | updated_at | timestamp | - | Waktu data diubah |

---

#### 2. Tabel Katalog
Rancangan basis data tabel **catalogs** berfungsi untuk menyimpan informasi daftar produk olahan atau hasil budidaya jamur tiram yang ditampilkan pada halaman katalog utama sistem untuk publik.

- **Nama Tabel** : `catalogs`
- **Primary key** : `id`
- **Foreign key** : `-`

##### Table 3.2 Tabel Catalogs
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | name | varchar | 255 | Nama produk olahan / jamur |
| 3. | description | text | - | Deskripsi detail spesifikasi produk |
| 4. | price | decimal | 12,2 | Harga jual produk |
| 5. | image | varchar | 255 | Nama file gambar/foto produk |
| 6. | created_at | timestamp | - | Waktu data dibuat |
| 7. | updated_at | timestamp | - | Waktu data diubah |

---

#### 3. Tabel Bibit
Rancangan basis data tabel **bibits** berfungsi untuk mencatat penerimaan stok bibit indukan jamur tiram, melacak sisa stok yang tersedia, dan mengelola konfirmasi persediaannya di dalam sistem.

- **Nama Tabel** : `bibits`
- **Primary key** : `id`
- **Foreign key** : `user_id`

##### Table 3.3 Tabel Bibits
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | user_id | int | 11 | Foreign Key (Merujuk ke users.id) |
| 3. | kode_bibit | varchar | 255 | Kode unik identifikasi stok bibit |
| 4. | asal_bibit | varchar | 255 | Asal/sumber produsen bibit |
| 5. | tanggal_masuk | date | - | Tanggal penerimaan bibit |
| 6. | jumlah | float | - | Jumlah total bibit diterima (bungkus) |
| 7. | sisa_stok | float | - | Sisa stok bibit yang tersedia |
| 8. | banyak_baglog | int | 11 | Kapasitas pembuatan baglog |
| 9. | status | enum | - | Status persediaan ('Tersedia', 'Menipis', 'Habis') |
| 10. | created_at | timestamp | - | Waktu data dibuat |
| 11. | updated_at | timestamp | - | Waktu data diubah |

---

#### 4. Tabel Distribusi Bibit
Rancangan basis data tabel **distribusi_bibits** berfungsi untuk mencatat riwayat alokasi dan pembagian stok bibit dari Admin kepada Petugas Harian kumbung.

- **Nama Tabel** : `distribusi_bibits`
- **Primary key** : `id`
- **Foreign key** : `bibit_id, user_id, admin_id`

##### Table 3.4 Tabel Distribusi Bibits
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | bibit_id | int | 11 | Foreign Key (Merujuk ke bibits.id) |
| 3. | user_id | int | 11 | Foreign Key (Petugas penerima) |
| 4. | admin_id | int | 11 | Foreign Key (Admin yang membagikan) |
| 5. | tanggal_distribusi | date | - | Tanggal pembagian bibit |
| 6. | jumlah_dibagikan | int | 11 | Jumlah bibit yang dialokasikan |
| 7. | sisa_stok | int | 11 | Sisa stok alokasi pada petugas |
| 8. | catatan | text | - | Catatan alokasi distribusi |
| 9. | created_at | timestamp | - | Waktu data dibuat |
| 10. | updated_at | timestamp | - | Waktu data diubah |

---

#### 5. Tabel Sterilisasi
Rancangan basis data tabel **sterilisasis** berfungsi untuk mencatat proses pengukusan/sterilisasi baglog jamur tiram, menyimpan durasi pengukusan, parameter pendukung, serta status kelayakan sterilisasi.

- **Nama Tabel** : `sterilisasis`
- **Primary key** : `id`
- **Foreign key** : `bibit_id, user_id`

##### Table 3.5 Tabel Sterilisasis
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | bibit_id | int | 11 | Foreign Key (Merujuk ke bibits.id) |
| 3. | user_id | int | 11 | Foreign Key (Petugas pelaksana) |
| 4. | tanggal | date | - | Tanggal pelaksanaan sterilisasi |
| 5. | durasi_pengukusan | int | 11 | Durasi pengukusan dalam jam (Default 8 jam otomatis) |
| 6. | kondisi_air | enum | - | Kondisi air drum ('Aman', 'Menipis', 'Habis') |
| 7. | kestabilan_api | enum | - | Kestabilan nyala api ('Stabil-Besar', 'Mengecil', 'Padam') |
| 8. | status_sterilisasi | enum | - | Status kelayakan ('aman', 'berisiko') |
| 9. | created_at | timestamp | - | Waktu data dibuat |
| 10. | updated_at | timestamp | - | Waktu data diubah |

---

#### 6. Tabel Inokulasi
Rancangan basis data tabel **inokulasis** berfungsi untuk mencatat pelaksanaan penanaman bibit jamur ke dalam baglog steril (dengan validasi jeda 1-2 hari pasca sterilisasi) serta merekam tingkat keberhasilan dan kontaminasi.

- **Nama Tabel** : `inokulasis`
- **Primary key** : `id`
- **Foreign key** : `sterilisasi_id, bibit_id, distribusi_bibit_id, user_id`

##### Table 3.6 Tabel Inokulasis
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | sterilisasi_id | int | 11 | Foreign Key (Merujuk ke sterilisasis.id) |
| 3. | bibit_id | int | 11 | Foreign Key (Merujuk ke bibits.id) |
| 4. | distribusi_bibit_id | int | 11 | Foreign Key (Merujuk ke distribusi_bibits.id) |
| 5. | user_id | int | 11 | Foreign Key (Petugas inokulasi) |
| 6. | tanggal | date | - | Tanggal penanaman bibit (Jeda 1-2 hari pasca sterilisasi) |
| 7. | jumlah_berhasil | int | 11 | Jumlah baglog tumbuh steril/berhasil |
| 8. | jumlah_kontaminasi | int | 11 | Jumlah baglog terkontaminasi/gagal |
| 9. | jumlah_bibit_terpakai | int | 11 | Jumlah botol/bungkus bibit digunakan |
| 10. | created_at | timestamp | - | Waktu data dibuat |
| 11. | updated_at | timestamp | - | Waktu data diubah |

---

#### 7. Tabel Log Inkubasi
Rancangan basis data tabel **log_inkubasis** berfungsi untuk mencatat perkembangan persentase pertumbuhan miselium jamur secara berkala pada ruang inkubasi.

- **Nama Tabel** : `log_inkubasis`
- **Primary key** : `id`
- **Foreign key** : `inokulasi_id, user_id`

##### Table 3.7 Tabel Log Inkubasis
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Merujuk ke inokulasis.id) |
| 3. | user_id | int | 11 | Foreign Key (Petugas pengamat) |
| 4. | persentase_tumbuh | decimal | 5,2 | Persentase pertumbuhan miselium (0-100%) |
| 5. | catatan | text | - | Catatan perkembangan fisik miselium |
| 6. | tanggal_catat | date | - | Tanggal pencatatan pengamatan |
| 7. | created_at | timestamp | - | Waktu data dibuat |
| 8. | updated_at | timestamp | - | Waktu data diubah |

---

#### 8. Tabel Monitoring Kumbung
Rancangan basis data tabel **monitoring_kumbungs** berfungsi untuk mencatat hasil pengawasan kondisi lingkungan ruang kumbung seperti kelembapan udara, kelembapan lantai, dan frekuensi penyiraman.

- **Nama Tabel** : `monitoring_kumbungs`
- **Primary key** : `id`
- **Foreign key** : `inokulasi_id, user_id`

##### Table 3.8 Tabel Monitoring Kumbungs
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Merujuk ke inokulasis.id) |
| 3. | user_id | int | 11 | Foreign Key (Petugas pemantau) |
| 4. | tanggal | date | - | Tanggal pemantauan kumbung |
| 5. | kondisi_udara | enum | - | Kelembapan udara ('Lembab', 'Normal', 'Kering') |
| 6. | kondisi_lantai | enum | - | Kelembapan lantai ('Basah', 'Lembab', 'Kering') |
| 7. | jumlah_penyiraman | int | 11 | Frekuensi penyiraman harian (kali) |
| 8. | created_at | timestamp | - | Waktu data dibuat |
| 9. | updated_at | timestamp | - | Waktu data diubah |

---

#### 9. Tabel Laporan Produksi (Panen)
Rancangan basis data tabel **production_reports** berfungsi untuk mencatat hasil panen jamur tiram per siklus, memisahkan penimbangan Grade A dan Grade B, serta mengelola status validasi laporan oleh Ketua/Admin.

- **Nama Tabel** : `production_reports`
- **Primary key** : `id`
- **Foreign key** : `inokulasi_id, user_id, validated_by`

##### Table 3.9 Tabel Production Reports
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Merujuk ke inokulasis.id) |
| 3. | user_id | int | 11 | Foreign Key (Petugas pemanen) |
| 4. | validated_by | int | 11 | Foreign Key (Admin/Ketua penvalidasi) |
| 5. | tanggal | date | - | Tanggal pelaksanaan pemanenan |
| 6. | siklus_panen | int | 11 | Urutan gelombang/siklus panen ke-N |
| 7. | berat_grade_a | decimal | 8,2 | Berat panen Grade A (Kg) |
| 8. | berat_grade_b | decimal | 8,2 | Berat panen Grade B / olahan (Kg) |
| 9. | jumlah_panen | decimal | 8,2 | Total akumulasi hasil panen (Kg) |
| 10. | status_validasi | enum | - | Status verifikasi ('pending', 'valid', 'invalid') |
| 11. | catatan | text | - | Catatan hasil panen / evaluasi |
| 12. | created_at | timestamp | - | Waktu data dibuat |
| 13. | updated_at | timestamp | - | Waktu data diubah |

---

#### 10. Tabel Profil KUPS
Rancangan basis data tabel **profile_kups** berfungsi untuk menyimpan informasi identitas resmi, deskripsi, visi, misi, dan kontak KUPS Harapan Asri yang ditampilkan pada halaman profil publik.

- **Nama Tabel** : `profile_kups`
- **Primary key** : `id`
- **Foreign key** : `-`

##### Table 3.10 Tabel Profile Kups
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | nama_kups | varchar | 255 | Nama resmi kelompok usaha KUPS |
| 3. | sub_judul | varchar | 255 | Sub judul / slogan KUPS |
| 4. | deskripsi_singkat | text | - | Ringkasan profil KUPS |
| 5. | tentang_kami | text | - | Penjelasan lengkap tentang KUPS |
| 6. | visi | text | - | Visi organisasi KUPS |
| 7. | misi | text | - | Misi organisasi KUPS |
| 8. | jumlah_anggota | int | 11 | Total anggota petani KUPS |
| 9. | siklus_panen | varchar | 255 | Informasi durasi siklus panen |
| 10. | tahun_berdiri | varchar | 255 | Tahun berdirinya kelompok KUPS |
| 11. | alamat | text | - | Alamat fisik lokasi kumbung/KUPS |
| 12. | nomor_telepon | varchar | 255 | Nomor telepon kontak resmi |
| 13. | email | varchar | 255 | Alamat email resmi KUPS |
| 14. | created_at | timestamp | - | Waktu data dibuat |
| 15. | updated_at | timestamp | - | Waktu data diubah |

---

#### 11. Tabel Pengaturan EWS
Rancangan basis data tabel **ews_settings** berfungsi untuk menyimpan konfigurasi ambang batas kritis (*Early Warning System*) sebagai tolok ukur pemicu notifikasi bahaya otomatis.

- **Nama Tabel** : `ews_settings`
- **Primary key** : `id`
- **Foreign key** : `-`

##### Table 3.11 Tabel EWS Settings
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | maks_hari_panen | int | 11 | Batas maksimal hari inkubasi hingga panen |
| 3. | kondisi_udara_kritis | varchar | 255 | Kriteria kondisi udara berisiko ('Panas/Gersang') |
| 4. | created_at | timestamp | - | Waktu data dibuat |
| 5. | updated_at | timestamp | - | Waktu data diubah |

---

#### 12. Tabel Peringatan (EWS Logs)
Rancangan basis data tabel **peringatans** berfungsi untuk menyimpan riwayat log notifikasi peringatan dini (*Early Warning System*) yang terdeteksi secara otomatis oleh sistem.

- **Nama Tabel** : `peringatans`
- **Primary key** : `id`
- **Foreign key** : `referensi_id`

##### Table 3.12 Tabel Peringatans
| No | Nama Field | Tipe Data | Size | Keterangan |
|:--:|:---|:---|:--:|:---|
| 1. | id | int | 11 | Primary Key |
| 2. | kategori | enum | - | Kategori modul ('sterilisasi', 'monitoring', 'panen') |
| 3. | referensi_id | int | 11 | Foreign Key (ID modul pemicu anomali) |
| 4. | level | enum | - | Level bahaya ('warning', 'danger') |
| 5. | pesan | text | - | Pesan deskripsi peringatan EWS |
| 6. | is_read | tinyint | 1 | Status penyelesaian (0=Belum, 1=Selesai) |
| 7. | created_at | timestamp | - | Waktu data dibuat |
| 8. | updated_at | timestamp | - | Waktu data diubah |
