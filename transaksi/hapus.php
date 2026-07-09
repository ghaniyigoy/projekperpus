<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$data = mysqli_query($koneksi, "SELECT judul_buku, status FROM transaksi WHERE id_transaksi='$id'");
$transaksi = mysqli_fetch_array($data);

if ($transaksi && $transaksi['status'] == 'Dipinjam') {
    mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE judul='{$transaksi['judul_buku']}'");
}

mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id'");

header("Location:index.php");
exit;

?>