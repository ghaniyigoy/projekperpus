<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$data = mysqli_query($koneksi, "SELECT judul_buku FROM transaksi WHERE id_transaksi='$id' AND status='Dipinjam'");
$transaksi = mysqli_fetch_array($data);

if (!$transaksi) {
    echo "<script>alert('Transaksi tidak ditemukan atau sudah dikembalikan!'); window.location='index.php';</script>";
    exit;
}

$judul = $transaksi['judul_buku'];

mysqli_begin_transaction($koneksi);

$sukses = true;

$q1 = mysqli_query($koneksi, "UPDATE transaksi SET status='Dikembalikan', tanggal_dikembalikan=CURDATE() WHERE id_transaksi='$id'");
if (!$q1) $sukses = false;

$q2 = mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE judul='$judul'");
if (!$q2) $sukses = false;

if ($sukses) {
    mysqli_commit($koneksi);
} else {
    mysqli_rollback($koneksi);
    echo "<script>alert('Gagal mengembalikan buku!');</script>";
}

header("Location:index.php");
exit;

?>