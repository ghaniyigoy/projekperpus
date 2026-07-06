<?php
<<<<<<< HEAD
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "perpustakaan";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
=======
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
>>>>>>> c4571b7cace2a2a04744fc73d35671a859cd8af4
