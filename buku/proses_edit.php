<?php
include "../login/cek_login.php";

include "../config/koneksi.php";

$id = $_POST['id_buku'];
$kode_buku = $_POST['kode_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];

$sql = "UPDATE buku SET

kode_buku='$kode_buku',
judul='$judul',
penulis='$penulis',
penerbit='$penerbit',
tahun='$tahun',
kategori='$kategori',
stok='$stok'

WHERE id_buku='$id'
";

$query = mysqli_query($koneksi,$sql);

if($query){

echo "<script>

alert('Data berhasil diubah');

window.location='index.php';

</script>";

}else{

echo "<script>

alert('Data gagal diubah');

history.back();

</script>";

}
?>