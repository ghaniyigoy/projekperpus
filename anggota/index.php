<?php
include "../config/koneksi.php";

$data = mysqli_query($koneksi,"SELECT * FROM anggota");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Anggota</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2>Data Anggota</h2>

<a href="tambah.php" class="btn btn-primary mb-3">
Tambah Anggota
</a>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>NIM</th>
<th>Nama</th>
<th>Jurusan</th>
<th>Alamat</th>
<th>No HP</th>
<th>Aksi</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_array($data))
{

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nim']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['jurusan']; ?></td>

<td><?= $d['alamat']; ?></td>

<td><?= $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?=$d['id_anggota']?>" class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?=$d['id_anggota']?>"

onclick="return confirm('Yakin?')"

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