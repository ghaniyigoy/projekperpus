<?php
include "../login/cek_login.php";
include "../config/koneksi.php";

$tgl_dari = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$tgl_sampai = isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$where = "WHERE 1=1";
$params = [];
if ($tgl_dari && $tgl_sampai) {
    $where .= " AND t.tanggal_pinjam >= '$tgl_dari' AND t.tanggal_pinjam <= '$tgl_sampai'";
}
if ($status != '') {
    $where .= " AND t.status = '$status'";
}

$data = mysqli_query($koneksi, "SELECT t.* FROM transaksi t $where ORDER BY t.tanggal_pinjam DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
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
            .table { font-size: 12px; }
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
                <h2>Laporan Peminjaman</h2>
                <p class="text-muted">Data transaksi peminjaman dan pengembalian buku.</p>
            </div>
            <div>
                <a href="index.php" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <button onclick="window.print()" class="btn btn-dark btn-sm"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
        </div>

        <div class="card mb-4 filter-form">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Dari</label>
                        <input type="date" name="tgl_dari" class="form-control" value="<?= $tgl_dari ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Sampai</label>
                        <input type="date" name="tgl_sampai" class="form-control" value="<?= $tgl_sampai ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Dipinjam" <?= $status == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                            <option value="Dikembalikan" <?= $status == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
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
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali (Estimasi)</th>
                                <th>Tanggal Dikembalikan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($data) == 0) { ?>
                            <tr><td colspan="7" class="text-center text-muted">Tidak ada data</td></tr>
                            <?php } ?>
                            <?php $no = 1; while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($d['nama_anggota']) ?></td>
                                <td><?= htmlspecialchars($d['judul_buku']) ?></td>
                                <td><?= htmlspecialchars($d['tanggal_pinjam']) ?></td>
                                <td><?= htmlspecialchars($d['tanggal_kembali']) ?></td>
                                <td><?= $d['tanggal_dikembalikan'] ? htmlspecialchars($d['tanggal_dikembalikan']) : '-' ?></td>
                                <td>
                                    <?php if ($d['status'] == 'Dipinjam') { ?>
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                    <?php } else { ?>
                                    <span class="badge bg-success">Dikembalikan</span>
                                    <?php } ?>
                                </td>
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