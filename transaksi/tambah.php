<?php
include "../config/koneksi.php";

$buku=mysqli_query($conn,"SELECT * FROM buku");
$anggota=mysqli_query($conn,"SELECT * FROM anggota");

?>

<h2>Tambah Transaksi</h2>

<form action="simpan.php" method="POST">

Nama

<select name="anggota">

<?php

while($a=mysqli_fetch_array($anggota)){

?>

<option value="<?= $a['id_anggota']?>">

<?= $a['nama']?>

</option>

<?php } ?>

</select>

<br><br>

Buku

<select name="buku">

<?php

while($b=mysqli_fetch_array($buku)){

?>

<option value="<?= $b['id_buku']?>">

<?= $b['judul']?>

</option>

<?php } ?>

</select>

<br><br>

Tanggal Pinjam

<input type="date" name="pinjam">

<br><br>

Tanggal Kembali

<input type="date" name="kembali">

<br><br>

<input type="submit" value="Simpan">

</form>