<?php
include "../login/cek_login.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body{
            background:#f4f6f9;
        }

        .navbar{
            background:#0d6efd;
        }

        .navbar-brand{
            color:white;
            font-weight:bold;
        }

        .navbar-brand:hover{
            color:white;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#212529;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:15px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#0d6efd;
            padding-left:25px;
        }

        .content{
            padding:30px;
        }

        .card-menu{
            border:none;
            border-radius:15px;
            transition:.3s;
            cursor:pointer;
        }

        .card-menu:hover{
            transform:translateY(-5px);
            box-shadow:0px 10px 20px rgba(0,0,0,.15);
        }

        .icon{
            font-size:45px;
            margin-bottom:15px;
        }
    </style>

</head>

<body>

<nav class="navbar">
    <div class="container-fluid">
        <span class="navbar-brand">
            📚 Sistem Perpustakaan
        </span>

        <span class="text-white">
            Halo,
            <b><?php echo $_SESSION['nama']; ?></b>
        </span>
    </div>
</nav>

<div class="d-flex">

    <div class="sidebar">

        <h4 class="text-center text-white mt-4">
            MENU
        </h4>

        <hr class="text-white">

        <a href="../dashboard/index.php">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="../buku/index.php">
            <i class="fa-solid fa-book"></i>
            Data Buku
        </a>

        <a href="../anggota/index.php">
            <i class="fa-solid fa-users"></i>
            Data Anggota
        </a>

        <a href="../transaksi/index.php">
            <i class="fa-solid fa-right-left"></i>
            Peminjaman
        </a>

        <a href="../laporan/index.php">
            <i class="fa-solid fa-chart-column"></i>
            Laporan
        </a>

        <a href="../login/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

    <div class="content flex-grow-1">

        <h2>Dashboard</h2>

        <p class="text-muted">
            Selamat datang di Sistem Informasi Perpustakaan.
        </p>

        <div class="row mt-4">

            <div class="col-md-3 mb-4">
                <div class="card card-menu bg-primary text-white">
                    <div class="card-body text-center">
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                        </div>

                        <h4>Data Buku</h4>

                        <p>Kelola buku perpustakaan</p>

                        <a href="../buku/index.php" class="btn btn-light">
                            Buka
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-menu bg-success text-white">
                    <div class="card-body text-center">

                        <div class="icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <h4>Anggota</h4>

                        <p>Kelola data anggota</p>

                        <a href="../anggota/index.php" class="btn btn-light">
                            Buka
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-menu bg-warning text-dark">
                    <div class="card-body text-center">

                        <div class="icon">
                            <i class="fa-solid fa-right-left"></i>
                        </div>

                        <h4>Peminjaman</h4>

                        <p>Transaksi Buku</p>

                        <a href="../transaksi/index.php" class="btn btn-dark">
                            Buka
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card card-menu bg-danger text-white">
                    <div class="card-body text-center">

                        <div class="icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>

                        <h4>Laporan</h4>

                        <p>Statistik Perpustakaan</p>

                        <a href="../laporan/index.php" class="btn btn-light">
                            Buka
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>
</html>