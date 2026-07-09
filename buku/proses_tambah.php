<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$kode_buku = $_POST['kode_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];

$sql = "INSERT INTO buku
(kode_buku, judul, penulis, penerbit, tahun, kategori, stok)
VALUES
('$kode_buku', '$judul', '$penulis', '$penerbit', '$tahun', '$kategori', '$stok')";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>
        alert('Data berhasil ditambahkan');
        window.location='index.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>