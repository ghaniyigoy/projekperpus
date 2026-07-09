<?php
include "../login/cek_login.php";
include "../config/koneksi.php";

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'peminjaman';
$tgl_dari = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$tgl_sampai = isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - <?= ucfirst($jenis) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; margin-bottom: 5px; }
        h4 { text-align: center; color: #666; margin-bottom: 30px; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        table th { background: #0d6efd; color: white; padding: 8px; text-align: left; }
        table td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
        table tr:nth-child(even) { background: #f8f9fa; }
        .tgl-cetak { text-align: right; margin-bottom: 20px; font-size: 12px; color: #666; }
        @media print {
            button { display: none !important; }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn btn-primary mb-3">Cetak / Print</button>
    <button onclick="window.close()" class="btn btn-secondary mb-3">Tutup</button>

    <h2><?= isset($_GET['judul']) ? htmlspecialchars($_GET['judul']) : 'LAPORAN ' . strtoupper($jenis) ?></h2>
    <h4>Sistem Informasi Perpustakaan</h4>

    <div class="tgl-cetak">Dicetak pada: <?= date('d/m/Y H:i:s') ?></div>

    <?php if ($tgl_dari && $tgl_sampai) { ?>
    <p>Periode: <?= date('d/m/Y', strtotime($tgl_dari)) ?> - <?= date('d/m/Y', strtotime($tgl_sampai)) ?></p>
    <?php } ?>
    <?php if ($status) { ?>
    <p>Status: <?= $status ?></p>
    <?php } ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $where = "WHERE 1=1";
            if ($tgl_dari && $tgl_sampai) {
                $where .= " AND tanggal_pinjam >= '$tgl_dari' AND tanggal_pinjam <= '$tgl_sampai'";
            }
            if ($status != '') {
                $where .= " AND status = '$status'";
            }
            $data = mysqli_query($koneksi, "SELECT * FROM transaksi $where ORDER BY tanggal_pinjam DESC");
            if (mysqli_num_rows($data) == 0) {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
            }
            $no = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($d['nama_anggota']) ?></td>
                <td><?= htmlspecialchars($d['judul_buku']) ?></td>
                <td><?= date('d/m/Y', strtotime($d['tanggal_pinjam'])) ?></td>
                <td><?= date('d/m/Y', strtotime($d['tanggal_kembali'])) ?></td>
                <td><?= $d['status'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>window.print();</script>
</body>
</html>