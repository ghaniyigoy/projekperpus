<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id=$_POST['id'];

$nim=$_POST['nim'];

$nama=$_POST['nama'];

$jurusan=$_POST['jurusan'];

$alamat=$_POST['alamat'];

$no_hp=$_POST['no_hp'];

mysqli_query($koneksi,"UPDATE anggota SET

nim='$nim',

nama='$nama',

jurusan='$jurusan',

alamat='$alamat',

no_hp='$no_hp'

WHERE id_anggota='$id'");

header("location:index.php");

?>