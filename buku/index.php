<?php
include "../config/koneksi.php";

// Pencarian
$cari = "";

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $query = mysqli_query($koneksi, "SELECT * FROM buku
        WHERE judul LIKE '%$cari%'
        OR penulis LIKE '%$cari%'
        OR kategori LIKE '%$cari%'
        ORDER BY id_buku DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="text-center mb-4">
        DATA BUKU PERPUSTAKAAN
    </h2>

    <div class="d-flex justify-content-between mb-3">

        <a href="tambah.php" class="btn btn-primary">
            + Tambah Buku
        </a>

        <form method="GET" class="d-flex">

            <input
                type="text"
                name="cari"
                class="form-control me-2"
                placeholder="Cari Buku..."
                value="<?= $cari ?>">

            <button class="btn btn-success">
                Cari
            </button>

        </form>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th width="170">Aksi</th>
            </tr>

        </thead>

        <tbody>

        <?php

        $no = 1;

        while($data = mysqli_fetch_assoc($query)){

        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td><?= $data['kode_buku'] ?></td>

            <td><?= $data['judul'] ?></td>

            <td><?= $data['penulis'] ?></td>

            <td><?= $data['penerbit'] ?></td>

            <td><?= $data['tahun'] ?></td>

            <td><?= $data['kategori'] ?></td>

            <td><?= $data['stok'] ?></td>

            <td>

                <a href="edit.php?id=<?= $data['id_buku']; ?>"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $data['id_buku']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus buku ini?')">
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>