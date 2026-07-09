<?php
include "../login/cek_login.php";
include "../config/koneksi.php";

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$where = "WHERE 1=1";
if ($kategori != '') {
    $where .= " AND kategori = '$kategori'";
}

$data = mysqli_query($koneksi, "SELECT * FROM buku $where ORDER BY kode_buku ASC");
$kategori_list = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM buku WHERE kategori IS NOT NULL AND kategori != '' ORDER BY kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .navbar { background: #0d6efd; }
        .navbar-brand { color: white; font-weight: bold; }
        .navbar-brand:hover { color: white; }
        .sidebar { width: 250px; min-height: 100vh; background: #212529; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 15px; transition: .3s; }
        .sidebar a:hover { background: #0d6efd; padding-left: 25px; }
        .sidebar a.active { background: #0d6efd; }
        .content { padding: 30px; }
        @media print {
            .navbar, .sidebar, .btn, .filter-form, .no-print { display: none !important; }
            .content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container-fluid">
        <span class="navbar-brand">📚 Sistem Perpustakaan</span>
        <span class="text-white">Halo, <b><?= htmlspecialchars($_SESSION['nama']) ?></b></span>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar">
        <h4 class="text-center text-white mt-4">MENU</h4>
        <hr class="text-white">
        <a href="../dashboard/index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="../buku/index.php"><i class="fa-solid fa-book"></i> Data Buku</a>
        <a href="../anggota/index.php"><i class="fa-solid fa-users"></i> Data Anggota</a>
        <a href="../transaksi/index.php"><i class="fa-solid fa-right-left"></i> Peminjaman</a>
        <a href="../laporan/index.php" class="active"><i class="fa-solid fa-chart-column"></i> Laporan</a>
        <a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2>Laporan Buku</h2>
                <p class="text-muted">Data inventaris buku perpustakaan.</p>
            </div>
            <div>
                <a href="index.php" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <button onclick="window.print()" class="btn btn-dark btn-sm"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
        </div>

        <div class="card mb-4 filter-form">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Filter Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php while ($k = mysqli_fetch_array($kategori_list)) { ?>
                            <option value="<?= htmlspecialchars($k['kategori']) ?>" <?= $kategori == $k['kategori'] ? 'selected' : '' ?>><?= htmlspecialchars($k['kategori']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-filter"></i> Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($data) == 0) { ?>
                            <tr><td colspan="8" class="text-center text-muted">Tidak ada data</td></tr>
                            <?php } ?>
                            <?php $no = 1; while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($d['kode_buku']) ?></td>
                                <td><?= htmlspecialchars($d['judul']) ?></td>
                                <td><?= htmlspecialchars($d['penulis']) ?></td>
                                <td><?= htmlspecialchars($d['penerbit']) ?></td>
                                <td><?= htmlspecialchars($d['tahun']) ?></td>
                                <td><?= htmlspecialchars($d['kategori']) ?></td>
                                <td><span class="badge bg-primary"><?= (int)$d['stok'] ?></span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>