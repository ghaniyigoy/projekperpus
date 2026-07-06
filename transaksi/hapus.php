<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi,"
DELETE FROM transaksi
WHERE id_transaksi='$id'
");

header("Location:index.php");
exit;

?>