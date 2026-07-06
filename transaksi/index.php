<?php
include "../config/koneksi.php";

$data=mysqli_query($conn,"
SELECT
transaksi.*,
buku.judul,
anggota.nama

FROM transaksi

JOIN buku
ON transaksi.id_buku=buku.id_buku

JOIN anggota
ON transaksi.id_anggota=anggota.id_anggota
");

?>

<h2>Data Transaksi</h2>

<a href="tambah.php">Tambah Transaksi</a>

<table border="1" cellpadding="8">

<tr>

<th>No</th>
<th>Nama</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php
$no=1;

while($d=mysqli_fetch_array($data)){
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['judul'] ?></td>

<td><?= $d['tanggal_pinjam'] ?></td>

<td><?= $d['tanggal_kembali'] ?></td>

<td><?= $d['status'] ?></td>

<td>

<a href="kembali.php?id=<?= $d['id_transaksi']?>">Kembalikan</a>

|

<a href="hapus.php?id=<?= $d['id_transaksi']?>">Hapus</a>

</td>

</tr>

<?php } ?>

</table>