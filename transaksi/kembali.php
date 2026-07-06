<?php

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($conn,"
UPDATE transaksi
SET status='Dikembalikan'
WHERE id_transaksi='$id'
");

header("Location:index.php");

?>