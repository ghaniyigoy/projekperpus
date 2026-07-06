<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-book"></i> Sistem Perpustakaan</a>
            <div class="navbar-nav ms-auto">
                <a href="index.php" class="btn btn-light btn-sm me-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="../login/logout.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2><i class="bi bi-file-earmark-pdf"></i> Laporan Perpustakaan</h2>
        
        <div class="row mt-4">
            <!-- Laporan Buku -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-book fs-1 text-primary"></i>
                        <h5>Laporan Buku</h5>
                        <p class="text-muted">Data semua buku yang tersedia</p>
                        <a href="cetak_buku.php" class="btn btn-primary">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Anggota -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-success"></i>
                        <h5>Laporan Anggota</h5>
                        <p class="text-muted">Data semua anggota perpustakaan</p>
                        <a href="cetak_anggota.php" class="btn btn-success">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Transaksi -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-clock-history fs-1 text-warning"></i>
                        <h5>Laporan Transaksi</h5>
                        <p class="text-muted">Riwayat peminjaman dan pengembalian</p>
                        <a href="cetak_transaksi.php" class="btn btn-warning">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>