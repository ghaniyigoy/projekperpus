<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengatur timezone Indonesia
date_default_timezone_set("Asia/Jakarta");
?>
