<?php

include "../config/koneksi.php";

$nama=$_POST['nama_anggota'];

$buku=$_POST['judul_buku'];

$pinjam=$_POST['pinjam'];

$kembali=$_POST['kembali'];

mysqli_query($koneksi,"
INSERT INTO transaksi
(
nama_anggota,
judul_buku,
tanggal_pinjam,
tanggal_kembali,
status
)

VALUES
(
'$nama',
'$buku',
'$pinjam',
'$kembali',
'Dipinjam'
)
");

header("Location:index.php");
exit;

?>