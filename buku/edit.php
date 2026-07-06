<?php
include "../config/koneksi.php";

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data buku berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='index.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">
    <h3>Edit Data Buku</h3>
</div>

<div class="card-body">

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">

<div class="mb-3">
<label>Kode Buku</label>
<input type="text"
name="kode_buku"
class="form-control"
value="<?= $data['kode_buku']; ?>"
required>
</div>

<div class="mb-3">
<label>Judul Buku</label>
<input type="text"
name="judul"
class="form-control"
value="<?= $data['judul']; ?>"
required>
</div>

<div class="mb-3">
<label>Penulis</label>
<input type="text"
name="penulis"
class="form-control"
value="<?= $data['penulis']; ?>"
required>
</div>

<div class="mb-3">
<label>Penerbit</label>
<input type="text"
name="penerbit"
class="form-control"
value="<?= $data['penerbit']; ?>"
required>
</div>

<div class="mb-3">
<label>Tahun</label>
<input type="number"
name="tahun"
class="form-control"
value="<?= $data['tahun']; ?>"
required>
</div>

<div class="mb-3">
<label>Kategori</label>

<select name="kategori" class="form-select">

<option value="Teknologi"
<?= ($data['kategori']=="Teknologi")?"selected":""; ?>>
Teknologi
</option>

<option value="Novel"
<?= ($data['kategori']=="Novel")?"selected":""; ?>>
Novel
</option>

<option value="Pendidikan"
<?= ($data['kategori']=="Pendidikan")?"selected":""; ?>>
Pendidikan
</option>

<option value="Sejarah"
<?= ($data['kategori']=="Sejarah")?"selected":""; ?>>
Sejarah
</option>

<option value="Agama"
<?= ($data['kategori']=="Agama")?"selected":""; ?>>
Agama
</option>

</select>

</div>

<div class="mb-3">
<label>Stok</label>

<input type="number"
name="stok"
class="form-control"
value="<?= $data['stok']; ?>"
required>

</div>

<button class="btn btn-success">
Update
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</div>

</body>
</html>