<?php
include "../login/cek_login.php";
include "../config/koneksi.php";

$total_buku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku"))['total'];
$total_anggota = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM anggota"))['total'];
$total_transaksi = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];
$dipinjam = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE status='Dipinjam'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan & Statistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        body { background: #f4f6f9; }
        .navbar { background: #0d6efd; }
        .navbar-brand { color: white; font-weight: bold; }
        .navbar-brand:hover { color: white; }
        .sidebar { width: 250px; min-height: 100vh; background: #212529; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 15px; transition: .3s; }
        .sidebar a:hover { background: #0d6efd; padding-left: 25px; }
        .content { padding: 30px; }
        .stat-card { border: none; border-radius: 15px; transition: .3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0px 10px 20px rgba(0,0,0,.15); }
        .stat-icon { font-size: 40px; }
        .chart-container { position: relative; height: 300px; width: 100%; }
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
        <a href="../laporan/index.php"><i class="fa-solid fa-chart-column"></i> Laporan</a>
        <a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="content flex-grow-1">
        <h2>Laporan & Statistik Perpustakaan</h2>
        <p class="text-muted">Ringkasan data dan analisis perpustakaan.</p>

        <div class="row mt-4">
            <div class="col-md-3 mb-4">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body text-center">
                        <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                        <h2><?= $total_buku ?></h2>
                        <p class="mb-0">Total Buku</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body text-center">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <h2><?= $total_anggota ?></h2>
                        <p class="mb-0">Total Anggota</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card bg-warning text-dark">
                    <div class="card-body text-center">
                        <div class="stat-icon"><i class="fa-solid fa-right-left"></i></div>
                        <h2><?= $total_transaksi ?></h2>
                        <p class="mb-0">Total Transaksi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card bg-danger text-white">
                    <div class="card-body text-center">
                        <div class="stat-icon"><i class="fa-solid fa-bookmark"></i></div>
                        <h2><?= $dipinjam ?></h2>
                        <p class="mb-0">Sedang Dipinjam</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa-solid fa-calendar"></i> Peminjaman per Bulan (7 Bulan Terakhir)</div>
                    <div class="card-body">
                        <div class="chart-container"><canvas id="chartBulan"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white"><i class="fa-solid fa-chart-pie"></i> Distribusi Kategori Buku</div>
                    <div class="card-body">
                        <div class="chart-container"><canvas id="chartKategori"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white"><i class="fa-solid fa-chart-bar"></i> Peminjaman per Kategori Buku</div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 350px;">
                            <canvas id="chartPinjamKategori"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white"><i class="fa-solid fa-list"></i> Menu Laporan Detail</div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="peminjaman.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa-solid fa-right-left me-3 fa-lg text-primary"></i>
                                <div><strong>Laporan Peminjaman</strong><br><small class="text-muted">Data peminjaman dan pengembalian buku</small></div>
                            </a>
                            <a href="buku.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa-solid fa-book me-3 fa-lg text-success"></i>
                                <div><strong>Laporan Buku</strong><br><small class="text-muted">Data inventaris buku perpustakaan</small></div>
                            </a>
                            <a href="anggota.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa-solid fa-users me-3 fa-lg text-warning"></i>
                                <div><strong>Laporan Anggota</strong><br><small class="text-muted">Data anggota perpustakaan</small></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-danger text-white"><i class="fa-solid fa-clock"></i> Informasi Cepat</div>
                    <div class="card-body">
                        <?php
                        $buku_populer = mysqli_query($koneksi, "SELECT judul_buku, COUNT(*) as jumlah FROM transaksi GROUP BY judul_buku ORDER BY jumlah DESC LIMIT 5");
                        $anggota_aktif = mysqli_query($koneksi, "SELECT nama_anggota, COUNT(*) as jumlah FROM transaksi GROUP BY nama_anggota ORDER BY jumlah DESC LIMIT 5");
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="fw-bold">Buku Terpopuler</h6>
                                <ol class="list-group list-group-numbered">
                                    <?php while ($b = mysqli_fetch_array($buku_populer)) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start py-1 px-2 border-0">
                                        <span><?= htmlspecialchars($b['judul_buku']) ?></span>
                                        <span class="badge bg-primary rounded-pill"><?= $b['jumlah'] ?></span>
                                    </li>
                                    <?php } ?>
                                </ol>
                            </div>
                            <div class="col-6">
                                <h6 class="fw-bold">Anggota Teraktif</h6>
                                <ol class="list-group list-group-numbered">
                                    <?php while($a = mysqli_fetch_array($anggota_aktif)) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start py-1 px-0 border-0">
                                        <span><?= htmlspecialchars($a['nama_anggota']) ?></span>
                                        <span class="badge bg-success rounded-pill"><?= $a['jumlah'] ?></span>
                                    </li>
                                    <?php } ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
<?php
$bulan_labels = [];
$bulan_data = [];
for ($i = 6; $i >= 0; $i--) {
    $m = date('m', strtotime("-$i months"));
    $y = date('Y', strtotime("-$i months"));
    $nama_bulan = date('M Y', strtotime("-$i months"));
    $bulan_labels[] = $nama_bulan;
    $q = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE MONTH(tanggal_pinjam)='$m' AND YEAR(tanggal_pinjam)='$y'"));
    $bulan_data[] = (int)$q['total'];
}

$kategori_labels = [];
$kategori_data = [];
$kat = mysqli_query($koneksi, "SELECT kategori, COUNT(*) as total FROM buku WHERE kategori IS NOT NULL AND kategori != '' GROUP BY kategori ORDER BY total DESC");
while ($k = mysqli_fetch_array($kat)) {
    $kategori_labels[] = $k['kategori'];
    $kategori_data[] = (int)$k['total'];
}

$pinjamkat_labels = [];
$pinjamkat_data = [];
$pk = mysqli_query($koneksi, "SELECT b.kategori, COUNT(t.id_transaksi) as total FROM transaksi t JOIN buku b ON t.judul_buku = b.judul WHERE b.kategori IS NOT NULL AND b.kategori != '' GROUP BY b.kategori ORDER BY total DESC");
while ($p = mysqli_fetch_array($pk)) {
    $pinjamkat_labels[] = $p['kategori'];
    $pinjamkat_data[] = (int)$p['jumlah'];
}
?>

new Chart(document.getElementById('chartBulan'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($bulan_labels) ?>,
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: <?= json_encode($bulan_data) ?>,
            backgroundColor: 'rgba(13, 110, 253, .7)',
            borderColor: '#0d6efd',
            borderWidth: 1
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById('chartKategori'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($kategori_labels) ?>,
        datasets: [{
            data: <?= json_encode($kategori_data) ?>,
            backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6f42c1', '#fd7e14']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
});

new Chart(document.getElementById('chartPinjamKategori'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($pinjamkat_labels) ?>,
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: <?= json_encode($pinjamkat_data) ?>,
            backgroundColor: 'rgba(25, 135, 84, .7)',
            borderColor: '#198754',
            borderWidth: 1
        }]
    },
    options: { responsive: true, maintainAspectRatio: false, indexAxis: 'y' }
});
</script>

</body>
</html>