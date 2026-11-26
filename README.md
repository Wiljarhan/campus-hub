# TalentSkripsi
### Connecting Campus Innovation to Industry

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Framework-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-blue?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Database-MySQL-orange?logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-Development-yellow" alt="Development">
</p>

## Tentang TalentSkripsi

**TalentSkripsi** merupakan sistem informasi berbasis web yang berfungsi sebagai etalase digital untuk menampilkan skripsi, penelitian, dan tugas proyek mahasiswa yang telah melalui proses verifikasi.

Platform ini dikembangkan untuk menghubungkan hasil inovasi mahasiswa dengan kebutuhan dunia industri dan UMKM. Melalui TalentSkripsi, karya mahasiswa dapat dipublikasikan sehingga lebih mudah ditemukan, dipelajari, dan berpotensi diterapkan sebagai solusi digital.

## Tujuan Pengembangan

1. Menyediakan wadah publikasi karya mahasiswa secara digital.
2. Mempermudah pencarian skripsi, penelitian, dan proyek mahasiswa.
3. Menampilkan karya yang telah melalui proses verifikasi.
4. Menghubungkan potensi mahasiswa dengan kebutuhan industri dan UMKM.
5. Mendorong pemanfaatan hasil penelitian dan inovasi mahasiswa.

## Fitur Utama

| Fitur | Deskripsi |
|---|---|
| Beranda | Menampilkan informasi dan karya terbaru. |
| Katalog Karya | Menampilkan daftar karya mahasiswa terverifikasi. |
| Pencarian | Mencari karya berdasarkan judul. |
| Filter Kategori | Menyaring karya berdasarkan kategori. |
| Detail Karya | Menampilkan informasi lengkap mengenai karya. |
| Informasi Mahasiswa | Menampilkan identitas dan program studi mahasiswa. |
| Demo dan Repository | Menyediakan tautan demonstrasi dan kode sumber karya. |
| Lampiran | Menampilkan dokumen pendukung karya. |
| Preview Karya | Menampilkan gambar pratinjau karya jika tersedia. |

## Teknologi yang Digunakan

- **Laravel** sebagai framework backend.
- **PHP** sebagai bahasa pemrograman backend.
- **MySQL** sebagai sistem manajemen basis data.
- **HTML** untuk struktur halaman.
- **CSS** untuk pengaturan tampilan.
- **JavaScript** untuk interaksi halaman.
- **Tailwind CSS** untuk membantu proses styling antarmuka.

## Struktur Halaman

1. **Beranda**  
   Halaman utama yang memperkenalkan platform TalentSkripsi dan menampilkan karya terbaru.

2. **Katalog Karya**  
   Halaman yang menyediakan daftar karya mahasiswa terverifikasi, dilengkapi pencarian dan filter kategori.

3. **Detail Karya**  
   Halaman yang menyajikan informasi lengkap karya, mahasiswa, kategori, tautan demo, repository, dan lampiran.

## Tampilan Aplikasi

Screenshot halaman aplikasi dapat ditambahkan pada bagian ini.

```text
screenshots/
├── beranda.png
├── katalog.png
└── detail-karya.png
```

## Instalasi dan Menjalankan Proyek

### 1. Clone Repository

```bash
git clone https://github.com/Wiljarhan/campus-hub.git
```

### 2. Masuk ke Direktori Proyek

```bash
cd campus-hub
```

### 3. Instal Dependensi Laravel

```bash
composer install
```

### 4. Salin File Konfigurasi

Untuk Windows PowerShell:

```powershell
copy .env.example .env
```

### 5. Buat Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env`, kemudian sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campus_hub
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database dan kredensial dengan konfigurasi lokal.

### 7. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

## Struktur Direktori

```text
campus-hub/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
│   └── migrations/
├── public/
├── resources/
│   └── views/
│       ├── layouts/
│       └── publik/
├── routes/
│   ├── web.php
│   ├── publik.php
│   ├── mahasiswa.php
│   ├── verifikator.php
│   └── eksternal.php
├── storage/
├── .env.example
├── artisan
└── composer.json
```

## Kontribusi Tim

TalentSkripsi dikembangkan secara kolaboratif melalui pembagian tanggung jawab setiap anggota tim.

Pengembangan mencakup perancangan antarmuka, implementasi fitur, pengelolaan basis data, pengujian sistem, dan dokumentasi proyek.

## Repository

Kode sumber proyek dapat diakses melalui GitHub:

**[Wiljarhan/campus-hub](https://github.com/Wiljarhan/campus-hub)**

## Lisensi

Proyek TalentSkripsi dikembangkan untuk keperluan pembelajaran dan tugas akademik.