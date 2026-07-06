<?php
include "../config/koneksi.php";

// Cek apakah parameter id ada
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Hapus data berdasarkan id_buku
    $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");

    if ($hapus) {
        echo "
        <script>
            alert('Data buku berhasil dihapus!');
            window.location='index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data buku gagal dihapus!');
            window.location='index.php';
        </script>";
    }

} else {
    echo "
    <script>
        alert('ID buku tidak ditemukan!');
        window.location='index.php';
    </script>";
}
?>
