<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota='$id'");

$d=mysqli_fetch_array($data);

?>

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?=$d['id_anggota']?>">

<input type="text" name="nim" value="<?=$d['nim']?>"><br><br>

<input type="text" name="nama" value="<?=$d['nama']?>"><br><br>

<input type="text" name="jurusan" value="<?=$d['jurusan']?>"><br><br>

<textarea name="alamat"><?=$d['alamat']?></textarea><br><br>

<input type="text" name="no_hp" value="<?=$d['no_hp']?>"><br><br>

<button>Update</button>

</form>