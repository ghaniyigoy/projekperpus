<?php
session_start();

include "../config/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users
WHERE username='$username'
AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['login']=true;
    $_SESSION['id_user']=$data['id_user'];
    $_SESSION['nama']=$data['nama'];

    header("Location: ../dashboard/index.php");

}else{

    echo "<script>
    alert('Username atau Password salah!');
    window.location='login.php';
    </script>";

}
?>