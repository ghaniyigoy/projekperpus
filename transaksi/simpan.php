<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id_anggota = mysqli_real_escape_string($koneksi, $_POST['id_anggota']);
$id_buku    = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
$pinjam     = mysqli_real_escape_string($koneksi, $_POST['pinjam']);
$kembali    = mysqli_real_escape_string($koneksi, $_POST['kembali']);

$data_anggota = mysqli_query($koneksi, "SELECT nama FROM anggota WHERE id_anggota='$id_anggota'");
$anggota = mysqli_fetch_array($data_anggota);

$data_buku = mysqli_query($koneksi, "SELECT judul, stok FROM buku WHERE id_buku='$id_buku'");
$buku = mysqli_fetch_array($data_buku);

if (!$anggota || !$buku) {
    echo "<script>alert('Anggota atau Buku tidak ditemukan!'); window.location='tambah.php';</script>";
    exit;
}

if ($buku['stok'] <= 0) {
    echo "<script>alert('Stok buku habis!'); window.location='tambah.php';</script>";
    exit;
}

$nama = $anggota['nama'];
$judul = $buku['judul'];

mysqli_begin_transaction($koneksi);

$sukses = true;

$q1 = mysqli_query($koneksi, "
    INSERT INTO transaksi (nama_anggota, judul_buku, tanggal_pinjam, tanggal_kembali, status)
    VALUES ('$nama', '$judul', '$pinjam', '$kembali', 'Dipinjam')
");
if (!$q1) $sukses = false;

$q2 = mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku' AND stok > 0");
if (!$q2) $sukses = false;

if ($sukses) {
    mysqli_commit($koneksi);
    header("Location:index.php");
} else {
    mysqli_rollback($koneksi);
    echo "<script>alert('Gagal menyimpan transaksi!'); window.location='tambah.php';</script>";
}
exit;

?>