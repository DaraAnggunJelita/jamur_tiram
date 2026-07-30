# 3.5 Perancangan Basisdata

Berikut rancangan database yang akan digunakan pada sistem *Monitoring dan Traceability Budidaya Jamur Tiram (KUPS Jamur Tiram)*:

---

### 1. Tabel Users
Rancangan basis data tabel **users** berfungsi untuk menyimpan informasi autentikasi akun dan membedakan tingkat hak akses (*role*) dari setiap pengguna yang menggunakan sistem (Admin, Petugas, dan Ketua KUPS).

| Nama Tabel | : | users |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | - |

*Table 3. 1 Tabel Users*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | name | varchar | 255 | Nama pengguna / akun |
| 3. | email | varchar | 255 | Email untuk login (Unique) |
| 4. | email_verified_at | timestamp | - | Waktu verifikasi email (Nullable) |
| 5. | password | varchar | 255 | Kata sandi terenkripsi (*hash*) |
| 6. | role | enum | - | Hak akses ('admin', 'petugas', 'ketua') |
| 7. | remember_token | varchar | 100 | Token untuk fitur *remember me* (Nullable) |
| 8. | created_at | timestamp | - | Waktu data dibuat |
| 9. | updated_at | timestamp | - | Waktu data diubah |

---

### 2. Tabel Katalog (`catalogs`)
Rancangan basis data tabel **catalogs** berfungsi untuk menyimpan informasi daftar produk olahan atau baglog jamur tiram yang ditampilkan pada halaman katalog utama (publik/umum).

| Nama Tabel | : | catalogs |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | - |

*Table 3. 2 Tabel Catalogs*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | name | varchar | 255 | Nama produk jamur / olahan |
| 3. | description | text | - | Deskripsi lengkap spesifikasi produk |
| 4. | price | decimal | 12,2 | Harga jual produk |
| 5. | image | varchar | 255 | Nama file foto/gambar produk (Nullable) |
| 6. | created_at | timestamp | - | Waktu data dibuat |
| 7. | updated_at | timestamp | - | Waktu data diubah |

---

### 3. Tabel Bibit (`bibits`)
Rancangan basis data tabel **bibits** berfungsi untuk mencatat penerimaan stok bibit indukan, asal usul bibit, serta melacak sisa ketersediaan stok bibit jamur tiram yang siap diinokulasi ke baglog.

| Nama Tabel | : | bibits |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | user_id |

*Table 3. 3 Tabel Bibit*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | user_id | int | 11 | Foreign Key (ID Akun yang mencatat/admin) |
| 3. | kode_bibit | varchar | 255 | Kode unik batch bibit (Unique) |
| 4. | asal_bibit | varchar | 255 | Sumber atau supplier bibit (Nullable) |
| 5. | tanggal_masuk | date | - | Tanggal pengiriman/penerimaan bibit |
| 6. | jumlah | int | 11 | Jumlah awal botol/kantung bibit yang masuk |
| 7. | sisa_stok | int | 11 | Jumlah sisa stok bibit saat ini |
| 8. | status | enum | - | Status ketersediaan ('Pending Konfirmasi Admin', 'Aktif/Siap Pakai', 'Habis') |
| 9. | created_at | timestamp | - | Waktu data dicatat |
| 10. | updated_at | timestamp | - | Waktu data diperbarui |

---

### 4. Tabel Baglog (`baglogs`)
Rancangan basis data tabel **baglogs** berfungsi untuk mencatat pencatatan awal produksi media tanam jamur (baglog) pada tahap hulu, jumlah produksi, dan konfirmasi validasi tahapan produksi.

| Nama Tabel | : | baglogs |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | user_id |

*Table 3. 4 Tabel Baglog*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | user_id | int | 11 | Foreign Key (ID Petugas yang membuat baglog) |
| 3. | kode_batch | varchar | 255 | Kode unik produksi batch baglog (Unique) |
| 4. | tanggal_pembuatan | date | - | Tanggal pembuatan media tanam baglog |
| 5. | jumlah_baglog | int | 11 | Total jumlah baglog yang diproduksi |
| 6. | status_validasi | enum | - | Status verifikasi produksi ('pending', 'valid') |
| 7. | created_at | timestamp | - | Waktu data dibuat |
| 8. | updated_at | timestamp | - | Waktu data diubah |

---

### 5. Tabel Sterilisasi (`sterilisasis`)
Rancangan basis data tabel **sterilisasis** berfungsi untuk mencatat proses sterilisasi/pengukusan baglog serta memanajemen variabel kritis seperti durasi pengukusan, kestabilan api, dan kondisi air yang berkaitan dengan Sistem Peringatan Dini (EWS).

| Nama Tabel | : | sterilisasis |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | baglog_id, user_id |

*Table 3. 5 Tabel Sterilisasi*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | baglog_id | int | 11 | Foreign Key ke tabel baglogs (Batch yang dikukus) |
| 3. | user_id | int | 11 | Foreign Key ke tabel users (Petugas sterilisasi) |
| 4. | tanggal | date | - | Tanggal proses sterilisasi dilakukan |
| 5. | durasi_pengukusan | int | 11 | Durasi pengukusan dalam satuan jam |
| 6. | kondisi_air | enum | - | Kondisi air dalam boiler ('Aman', 'Menipis', 'Habis') |
| 7. | kestabilan_api | enum | - | Kondisi nyala api ('Stabil-Besar', 'Mengecil', 'Padam') |
| 8. | status_sterilisasi | enum | - | Hasil asesmen risiko EWS ('aman', 'berisiko') |
| 9. | created_at | timestamp | - | Waktu pencatatan data |
| 10. | updated_at | timestamp | - | Waktu pemutakhiran data |

---

### 6. Tabel Inokulasi (`inokulasis`)
Rancangan basis data tabel **inokulasis** berfungsi untuk mencatat tahap penanaman bibit jamur ke dalam baglog yang telah sterilisasi, melacak penggunaan bibit, angka keberhasilan, jumlah yang kontaminasi (gagal), serta status buka kapas pembungkus.

| Nama Tabel | : | inokulasis |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | sterilisasi_id, bibit_id, user_id |

*Table 3. 6 Tabel Inokulasi*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | sterilisasi_id | int | 11 | Foreign Key (ID Baglog yang telah disterilisasi) |
| 3. | bibit_id | int | 11 | Foreign Key (ID Bibit induk yang digunakan) |
| 4. | user_id | int | 11 | Foreign Key (Petugas yang melakukan inokulasi) |
| 5. | tanggal | date | - | Tanggal pelaksanaan inokulasi |
| 6. | jumlah_berhasil | int | 11 | Jumlah baglog inokulasi yang berhasil |
| 7. | jumlah_kontaminasi | int | 11 | Jumlah baglog yang rusak / mengalami kontaminasi |
| 8. | jumlah_bibit_terpakai| int | 11 | Jumlah satuan bibit yang terpakai |
| 9. | status_buka_kapas | boolean / tinyint | 1 | Status penanda buka kapas (0 = Belum, 1 = Sudah) |
| 10. | created_at | timestamp | - | Waktu data dicatat |
| 11. | updated_at | timestamp | - | Waktu data diperbarui |

---

### 7. Tabel Log Inkubasi (`log_inkubasis`)
Rancangan basis data tabel **log_inkubasis** berfungsi untuk mencatat riwayat pemantauan dan persentase perkembangan masa tumbuh miselium pada baglog dari hari ke hari sebelum masa panen di mulai.

| Nama Tabel | : | log_inkubasis |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | inokulasi_id, user_id |

*Table 3. 7 Tabel Log Inkubasi*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Batch inokulasi yang dipantau) |
| 3. | user_id | int | 11 | Foreign Key (Petugas yang memantau) |
| 4. | persentase_tumbuh| int | 11 | Tingkat perkembangan miselium (25, 50, 75, atau 100%) |
| 5. | catatan | text | - | Catatan kondisi miselium / baglog (Nullable) |
| 6. | tanggal_catat | date | - | Tanggal pencatatan perkembangan miselium |
| 7. | created_at | timestamp | - | Waktu data dibuat |
| 8. | updated_at | timestamp | - | Waktu data diubah |

---

### 8. Tabel Monitoring Kumbung (`monitoring_kumbungs`)
Rancangan basis data tabel **monitoring_kumbungs** berfungsi untuk mencatat pemantauan harian kondisi lingkungan rumah jamur (kumbung) seperti suhu, kelembapan lantai, dan frekuensi penyiraman harian yang terhubung ke sistem EWS.

| Nama Tabel | : | monitoring_kumbungs |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | inokulasi_id, user_id |

*Table 3. 8 Tabel Monitoring Kumbung*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Batch inokulasi yang dipantau) |
| 3. | user_id | int | 11 | Foreign Key (Petugas pencatat kumbung) |
| 4. | tanggal | date | - | Tanggal pemantauan dilakukan |
| 5. | kondisi_udara | enum | - | Kondisi suhu/udara kumbung ('Sejuk', 'Hangat', 'Panas/Gersang') |
| 6. | kondisi_lantai | enum | - | Kondisi kelembaban lantai ('Basah/Lembab', 'Kering') |
| 7. | jumlah_penyiraman | int | 11 | Frekuensi / jumlah penyiraman pada hari tersebut |
| 8. | created_at | timestamp | - | Waktu data dicatat |
| 9. | updated_at | timestamp | - | Waktu data diubah |

---

### 9. Tabel Laporan Produksi & Panen (`production_reports`)
Rancangan basis data tabel **production_reports** berfungsi untuk mencatat hasil panen harian baglog jamur berdasarkan siklus panen ke-n, pemilahan grade (mutu A dan mutu B/buruk), serta menyimpan rekam verifikasi pelaporan dari pimpinan KUPS.

| Nama Tabel | : | production_reports |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | inokulasi_id, user_id, validated_by |

*Table 3. 9 Tabel Production Reports*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | inokulasi_id | int | 11 | Foreign Key (Batch inokulasi yang dipanen) |
| 3. | user_id | int | 11 | Foreign Key (Petugas yang mencatat panen) |
| 4. | tanggal | date | - | Tanggal panen dilakukan |
| 5. | siklus_panen | int | 11 | Putaran atau siklus panen ke-n (Default 1) |
| 6. | berat_grade_a | double | - | Hasil panen jamur bermutu bagus/Grade A (kg) |
| 7. | berat_grade_b | double | - | Hasil panen jamur bermutu kurang/Grade B/rusak (kg) |
| 8. | jumlah_panen | double | - | Total kumulatif panen (Grade A + Grade B) |
| 9. | status_validasi| enum | - | Status verifikasi ('pending', 'valid', 'invalid', 'dibatalkan') |
| 10. | catatan | text | - | Catatan evaluasi panen / alasan penolakan (Nullable) |
| 11. | validated_by | int | 11 | Foreign Key ke tabel users (ID Admin/Ketua pemvalidasi) |
| 12. | created_at | timestamp | - | Waktu pelaporan dibuat |
| 13. | updated_at | timestamp | - | Waktu pelaporan diubah / divalidasi |

---

### 10. Tabel Peringatan EWS (`peringatans`)
Rancangan basis data tabel **peringatans** berfungsi untuk menyimpan log notifikasi peringatan dini (*Early Warning System*) yang dihasilkan otomatis oleh sistem saat terjadi anomali kritis pada tahap sterilisasi, kumbung, atau jadwal panen.

| Nama Tabel | : | peringatans |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | referensi_id *(Polymorphic Relation)* |

*Table 3. 10 Tabel Peringatans*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | kategori | enum | - | Kategori modul EWS ('Sterilisasi', 'Kumbung', 'Panen') |
| 3. | referensi_id | int | 11 | ID referensi dari tabel sterilisasi, kumbung, atau inokulasi |
| 4. | level | enum | - | Urgensi peringatan ('Waspada', 'Kritis') |
| 5. | pesan | text | - | Isi pesan informasi/instruksi penanganan peringatan |
| 6. | is_read | boolean / tinyint | 1 | Penanda apakah peringatan sudah ditangani (0 = Belum, 1 = Sudah) |
| 7. | created_at | timestamp | - | Waktu peringatan dibangkitkan |
| 8. | updated_at | timestamp | - | Waktu peringatan ditandai selesai/dibaca |

---

### 11. Tabel Pengaturan EWS (`ews_settings`)
Rancangan basis data tabel **ews_settings** berfungsi untuk menyimpan variabel dan standar nilai parameter batas ambang kritis (*threshold*) yang memicu sistem Early Warning System (EWS), yang dapat dikonfigurasi secara dinamis oleh Admin.

| Nama Tabel | : | ews_settings |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | - |

*Table 3. 11 Tabel EWS Settings*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | min_durasi_sterilisasi| int | 11 | Batas minimum jam sterilisasi berisiko (Default 7 jam) |
| 3. | maks_hari_panen | int | 11 | Batas hari toleransi keterlambatan masa panen (Default 4 hari) |
| 4. | kondisi_udara_kritis | varchar | 255 | Kondisi suhu/udara yang diangap kritis (Default 'Panas/Gersang') |
| 5. | created_at | timestamp | - | Waktu konfigurasi disimpan |
| 6. | updated_at | timestamp | - | Waktu konfigurasi diperbarui |

---

### 12. Tabel Profile KUPS (`profile_kups`)
Rancangan basis data tabel **profile_kups** berfungsi untuk menyimpan informasi lembaga, sejarah, visi, misi, data statistik, serta informasi kontak KUPS Jamur Tiram yang diekspos pada halaman umum dan dikelola secara dinamis oleh Admin (*Singleton pattern*).

| Nama Tabel | : | profile_kups |
| :--- | :--- | :--- |
| **Primary key** | : | id |
| **Foreign key** | : | - |

*Table 3. 12 Tabel Profile KUPS*

| No | Nama Field | Tipe Data | Size | Keterangan |
|---|---|---|---|---|
| 1. | id | int | 11 | Primary Key |
| 2. | nama_kups | varchar | 255 | Nama utama lembaga KUPS (Default: 'KUPS Harapan Asri') |
| 3. | sub_judul | varchar | 255 | Sub judul atau nama wilayah/nagari (Default: 'Nagari Sijunjung') |
| 4. | deskripsi_singkat | text | - | Deskripsi singkat untuk beranda / hero banner |
| 5. | tentang_kami | text | - | Deskripsi lengkap sejarah dan profil lembaga |
| 6. | visi | text | - | Pernyataan visi usaha perhutanan sosial |
| 7. | misi | text | - | Pernyataan misi dan langkah strategis (Daftar berpoin) |
| 8. | jumlah_anggota | int | 11 | Jumlah anggota aktif (Default 15) |
| 9. | siklus_panen | int | 11 | Jumlah putaran / siklus panen per musim (Default 5) |
| 10. | tahun_berdiri | int | 11 | Tahun mulai beroperasinya usaha (Default 2021) |
| 11. | alamat | varchar | 255 | Alamat lengkap sekretariat / rumah kumbung |
| 12. | nomor_telepon | varchar | 50 | Nomor WhatsApp atau telepon kontak (Nullable) |
| 13. | email | varchar | 255 | Alamat email resmi lembaga (Nullable) |
| 14. | created_at | timestamp | - | Waktu data dicatat |
| 15. | updated_at | timestamp | - | Waktu profil terakhir dimutakhirkan oleh Admin |

