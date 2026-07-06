<?php

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($koneksi,"
UPDATE transaksi
SET status='Dikembalikan'
WHERE id_transaksi='$id'
");

header("Location:index.php");
exit;

?>