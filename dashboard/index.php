<?php
<<<<<<< HEAD
include "../login/cek_login.php";
=======
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
include '../config/koneksi.php';

// Query statistik
$total_buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku"))['total'] ?? 0;
$total_anggota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM anggota"))['total'] ?? 0;
$total_dipinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status='dipinjam'"))['total'] ?? 0;
$total_kembali = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE status='kembali'"))['total'] ?? 0;

// Data untuk grafik (peminjaman per bulan)
$grafik_data = [];
$query_grafik = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_pinjam) as bulan, COUNT(*) as jumlah 
    FROM peminjaman 
    WHERE YEAR(tanggal_pinjam) = YEAR(NOW())
    GROUP BY MONTH(tanggal_pinjam)
    ORDER BY bulan ASC
");
while($row = mysqli_fetch_assoc($query_grafik)) {
    $grafik_data[$row['bulan']] = $row['jumlah'];
}

// Peminjaman terbaru
$query_terbaru = mysqli_query($koneksi, "
    SELECT a.nama, b.judul, p.tanggal_pinjam, p.status 
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN detail_pinjam d ON p.id_pinjam = d.id_pinjam
    JOIN buku b ON d.id_buku = b.id_buku
    ORDER BY p.tanggal_pinjam DESC 
    LIMIT 5
");
>>>>>>> 506ffaaa2e6818a1d0a4d21fa3fb414759f7e955
?>

<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
>>>>>>> 506ffaaa2e6818a1d0a4d21fa3fb414759f7e955
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book"></i> Sistem Perpustakaan
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">
                    <i class="bi bi-person-circle"></i> Halo, <?= $_SESSION['username'] ?>
                </span>
                <a href="../login/logout.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>📊 Dashboard</h2>
        <p class="text-muted">Selamat datang di sistem informasi perpustakaan</p>

<<<<<<< HEAD
    <div class="card">

        <div class="card-body">

            <h2>Dashboard Admin</h2>

            <hr>

            <h4>
                Selamat Datang,
                <?php echo $_SESSION['nama']; ?>
            </h4>

            <a href="../login/logout.php" class="btn btn-danger mt-3">
                Logout
            </a>

        </div>

    </div>

</div>
=======
        <!-- Kartu Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Buku</h6>
                                <h2 class="mb-0"><?= $total_buku ?></h2>
                            </div>
                            <i class="bi bi-book fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Anggota</h6>
                                <h2 class="mb-0"><?= $total_anggota ?></h2>
                            </div>
                            <i class="bi bi-people fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Sedang Dipinjam</h6>
                                <h2 class="mb-0"><?= $total_dipinjam ?></h2>
                            </div>
                            <i class="bi bi-bookmark-check fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Sudah Kembali</h6>
                                <h2 class="mb-0"><?= $total_kembali ?></h2>
                            </div>
                            <i class="bi bi-check-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Grafik -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5><i class="bi bi-bar-chart"></i> Grafik Peminjaman Per Bulan</h5>
                    </div>
                    <div class="card-body">
                        <?php if(empty($grafik_data)): ?>
                            <div class="alert alert-info">Belum ada data peminjaman</div>
                        <?php else: ?>
                            <?php 
                            $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            $max = max($grafik_data) ?: 1;
                            foreach($grafik_data as $bulan_ke => $jumlah): 
                                $persen = ($jumlah / $max) * 100;
                            ?>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <span><strong><?= $bulan[$bulan_ke-1] ?></strong></span>
                                    <span><?= $jumlah ?> peminjaman</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-primary" style="width: <?= $persen ?>%;">
                                        <?= $jumlah ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Peminjaman Terbaru -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5><i class="bi bi-clock-history"></i> Peminjaman Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <?php if(mysqli_num_rows($query_terbaru) == 0): ?>
                            <div class="alert alert-info">Belum ada peminjaman</div>
                        <?php else: ?>
                            <?php while($row = mysqli_fetch_assoc($query_terbaru)): ?>
                            <div class="border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <strong><?= $row['nama'] ?></strong>
                                    <span class="badge <?= $row['status'] == 'dipinjam' ? 'bg-warning' : 'bg-success' ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-book"></i> <?= $row['judul'] ?><br>
                                    <i class="bi bi-calendar"></i> <?= $row['tanggal_pinjam'] ?>
                                </small>
                            </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Cepat -->
        <div class="row mt-4">
            <div class="col-md-3">
                <a href="../buku/index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-card">
                        <div class="card-body">
                            <i class="bi bi-book fs-1 text-primary"></i>
                            <h6>Data Buku</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="../anggota/index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-card">
                        <div class="card-body">
                            <i class="bi bi-people fs-1 text-success"></i>
                            <h6>Data Anggota</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="../transaksi/index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-card">
                        <div class="card-body">
                            <i class="bi bi-arrow-left-right fs-1 text-warning"></i>
                            <h6>Transaksi</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="laporan.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-card">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                            <h6>Laporan PDF</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
>>>>>>> 506ffaaa2e6818a1d0a4d21fa3fb414759f7e955

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
    </style>
</body>
</html>