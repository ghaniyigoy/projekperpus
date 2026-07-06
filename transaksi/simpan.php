<?php

include "../config/koneksi.php";

$buku=$_POST['buku'];
$anggota=$_POST['anggota'];
$pinjam=$_POST['pinjam'];
$kembali=$_POST['kembali'];

mysqli_query($conn,"
INSERT INTO transaksi
(id_buku,id_anggota,tanggal_pinjam,tanggal_kembali,status)

VALUES
('$buku','$anggota','$pinjam','$kembali','Dipinjam')
");

header("Location:index.php");

?>