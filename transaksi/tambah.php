<?php
include "../login/cek_login.php";
?>
<!DOCTYPE html>
<html>
<head>

    <title>Tambah Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include "../config/koneksi.php"; ?>

<div class="container mt-5">

    <h2>Tambah Transaksi</h2>

    <form action="simpan.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <select name="id_anggota" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php
                $anggota = mysqli_query($koneksi, "SELECT id_anggota, nim, nama FROM anggota ORDER BY nama ASC");
                while($a = mysqli_fetch_array($anggota)) {
                    echo "<option value='{$a['id_anggota']}'>{$a['nama']} ({$a['nim']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <select name="id_buku" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                <?php
                $buku = mysqli_query($koneksi, "SELECT id_buku, judul, stok FROM buku WHERE stok > 0 ORDER BY judul ASC");
                while($b = mysqli_fetch_array($buku)) {
                    echo "<option value='{$b['id_buku']}'>{$b['judul']} (Stok: {$b['stok']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input
                type="date"
                name="pinjam"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kembali</label>
            <input
                type="date"
                name="kembali"
                class="form-control"
                required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>