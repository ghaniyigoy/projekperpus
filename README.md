# Sistem Informasi Perpustakaan

Aplikasi web manajemen perpustakaan berbasis PHP dan MySQL.

## Fitur

- **Dashboard** — Halaman utama dengan ringkasan menu
- **Data Buku** — CRUD buku, pencarian, dan manajemen stok
- **Data Anggota** — CRUD data anggota perpustakaan
- **Transaksi Peminjaman** — Peminjaman dan pengembalian buku dengan update stok otomatis
- **Laporan & Statistik** — Dashboard statistik dengan grafik (Chart.js), laporan peminjaman (filter tanggal/status), laporan buku (filter kategori), laporan anggota (filter jurusan), cetak print

## Teknologi

- PHP (procedural)
- Bootstrap 5.3
- Chart.js 4.4
- Font Awesome 6.5
- MySQL / MariaDB

## Database

**Nama database:** `perpustakaan`

### Tabel

| Tabel | Keterangan |
|---|---|
| `users` | Akun admin (username, password MD5, nama) |
| `anggota` | Data anggota (nim, nama, jurusan, alamat, no_hp) |
| `buku` | Data buku (kode_buku, judul, penulis, penerbit, tahun, kategori, stok) |
| `transaksi` | Transaksi peminjaman (nama_anggota, judul_buku, tanggal_pinjam, tanggal_kembali, tanggal_dikembalikan, status) |

## Instalasi

1. Import `database.sql/perpustakaan.sql` ke phpMyAdmin atau MySQL
2. Letakkan folder projek di `htdocs`
3. Akses `http://localhost/perpustakaan/projekperpus/`
4. Login dengan username dan password yang ada di tabel `users`

## Login Default

- Username: `admin`
- Password: `admin123`