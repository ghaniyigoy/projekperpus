<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$data = mysqli_query($koneksi,"SELECT * FROM transaksi");
?>

<!DOCTYPE html>
<html>
<head>

<title>Data Transaksi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Data Transaksi</h2>

<a href="tambah.php" class="btn btn-primary mb-3">
Tambah Transaksi
</a>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Nama Anggota</th>
<th>Judul Buku</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_array($data))
{

?>

<tr>

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($d['nama_anggota']); ?></td>

<td><?= htmlspecialchars($d['judul_buku']); ?></td>

<td><?= htmlspecialchars($d['tanggal_pinjam']); ?></td>

<td><?= htmlspecialchars($d['tanggal_kembali']); ?></td>

<td>

<?php
if($d['status']=="Dipinjam") {
    echo "<span class='badge bg-warning text-dark'>Dipinjam</span>";
} else {
    echo "<span class='badge bg-success'>Dikembalikan</span>";
}
?>

</td>

<td>

<?php if($d['status']=="Dipinjam") { ?>
<a href="kembali.php?id=<?= (int)$d['id_transaksi']; ?>"
class="btn btn-success btn-sm">
Kembalikan
</a>
<?php } else { ?>
<span class="text-muted">-</span>
<?php } ?>

<a href="hapus.php?id=<?= (int)$d['id_transaksi']; ?>"
onclick="return confirm('Yakin ingin menghapus?')"
class="btn btn-danger btn-sm">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>