<?php
session_start();

include "../config/koneksi.php";

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
    exit;
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM users
WHERE username='$username'
AND password='$password'");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];

    header("Location: ../dashboard/index.php");
    exit;

} else {

    echo "<script>
    alert('Username atau Password salah!');
    window.location='login.php';
    </script>";
    exit;

}
?>