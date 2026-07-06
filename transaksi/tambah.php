<!DOCTYPE html>
<html>
<head>

<title>Tambah Transaksi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Tambah Transaksi</h2>

<form action="simpan.php" method="POST">

<div class="mb-3">

<label>Nama Anggota</label>

<input
type="text"
name="nama_anggota"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Judul Buku</label>

<input
type="text"
name="judul_buku"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal Pinjam</label>

<input
type="date"
name="pinjam"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal Kembali</label>

<input
type="date"
name="kembali"
class="form-control"
required>

</div>

<button class="btn btn-primary">

Simpan

</button>

<a href="index.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>
</html>