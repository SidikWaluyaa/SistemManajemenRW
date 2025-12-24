# Sistem Informasi Manajemen RW 10

Sistem Informasi Manajemen RW 10 adalah aplikasi berbasis web yang dirancang untuk mempermudah pengelolaan data dan administrasi di lingkungan RW 10. Aplikasi ini menyediakan fitur lengkap untuk manajemen warga, keuangan, surat pengantar, bantuan sosial, dan inventaris aset.

<p align="center"><img src="public/images/logo-rw10-v2.jpg" width="150" alt="RW 10 Logo"></p>

## Fitur Utama

-   **Manajemen Warga & KK**: Pencatatan lengkap data penduduk dan kartu keluarga.
-   **Keuangan & Transaksi**: Laporan keuangan transparan, pencatatan pemasukan/pengeluaran, dan kategori transaksi.
-   **Layanan Surat**: Pembuatan dan pencetakan surat pengantar otomatis.
-   **Tagihan & Tunggakan**: Manajemen iuran bulanan warga.
-   **Bantuan Sosial (Bansos)**: Pendataan program dan penerima bantuan sosial.
-   **Inventaris & Aset**: Peminjaman dan pendataan aset milik RW.
-   **Manajemen User**: Kontrol akses untuk Admin dan Pengurus RT.

---

## Galeri Aplikasi

### Halaman Utama (Homepage)
Talaman depan yang informatif dan modern untuk warga.
![Homepage](screenshoot/Home/127.0.0.1_8000_%20(1).png)

### Halaman Login
Halaman akses yang aman untuk administrator dan pengurus RW/RT.
![Login Page](screenshoot/Login/127.0.0.1_8000_login.png)

---

### Tampilan Admin (Dashboard & Fitur)

#### 1. Dashboard Utama
Ringkasan statistik warga, keuangan, dan aktivitas terbaru dalam satu pandangan.
![Dashboard](screenshoot/Admin/127.0.0.1_8000_dashboard.png)

#### 2. Manajemen Kependudukan
**Data Warga**: Pencatatan lengkap data penduduk.
![Data Warga](screenshoot/Admin/127.0.0.1_8000_warga.png)

**Data Kartu Keluarga**: Daftar kepala keluarga dan anggotanya.
![Kartu Keluarga](screenshoot/Admin/127.0.0.1_8000_kk.png)

**Detail Kartu Keluarga**: Tampilan detail anggota keluarga dalam satu KK.
![Detail KK](screenshoot/Admin/127.0.0.1_8000_Show_kk.png)

**Mutasi Warga**: Pencatatan warga pindah datang/keluar atau meninggal.
![Mutasi Warga](screenshoot/Admin/127.0.0.1_8000_mutasi.png)

#### 3. Manajemen Keuangan
**Daftar Transaksi**: Pencatatan pemasukan dan pengeluaran kas RW.
![Transaksi](screenshoot/Admin/127.0.0.1_8000_transaksi.png)

**Laporan Keuangan**: Rekapitulasi keuangan yang dapat dicetak atau diekspor.
![Laporan Keuangan](screenshoot/Admin/127.0.0.1_8000_transaksi_laporan.png)

**Kategori Transaksi**: Pengaturan pos-pos anggaran keuangan.
![Kategori Transaksi](screenshoot/Admin/127.0.0.1_8000_kategori.png)

#### 4. Tagihan & Iuran
Manajemen tagihan iuran warga dan status pembayarannya.
![Tagihan](screenshoot/Admin/127.0.0.1_8000_tagihan.png)

#### 5. Layanan Surat
Fitur pembuatan surat pengantar otomatis untuk kebutuhan warga (KTP, KK, SKCK, dll).
![Layanan Surat](screenshoot/Admin/127.0.0.1_8000_surat.png)

#### 6. Bantuan Sosial (Bansos)
**Program Bansos**: Daftar program bantuan yang tersedia.
![Program Bansos](screenshoot/Admin/127.0.0.1_8000_bansos_program.png)

**Penerima Bansos**: Data warga yang menerima bantuan pada setiap program.
![Penerima Bansos](screenshoot/Admin/127.0.0.1_8000_bansos_penerima.png)

#### 7. Inventaris Barang
**Data Aset**: Daftar barang inventaris milik RW.
![Data Aset](screenshoot/Admin/127.0.0.1_8000_inventory_assets.png)

**Peminjaman Barang**: Pencatatan peminjaman barang oleh warga.
![Peminjaman Inventaris](screenshoot/Admin/127.0.0.1_8000_inventory_loans.png)

#### 8. Pengaturan Sistem
**Manajemen User**: Pengaturan akun untuk Admin dan Pengurus RT.
![Manajemen User](screenshoot/Admin/127.0.0.1_8000_users.png)

---

## Teknologi

Aplikasi ini dibangun menggunakan:
-   **Framework**: Laravel 12
-   **Database**: PostgreSQL / MySQL
-   **Frontend**: Tailwind CSS, Blade Templates, Alpine.js
-   **Server**: Apache / Nginx

## Instalasi

1.  Clone repository ini via Git.
2.  Jalankan `composer install`
3.  Jalankan `npm install && npm run dev`
4.  Copy `.env.example` ke `.env` dan konfigurasi database.
5.  Jalankan `php artisan key:generate`
6.  Jalankan `php artisan migrate --seed`
7.  Jalankan `php artisan serve`

---
&copy; 2025 RW 10 Management System.
