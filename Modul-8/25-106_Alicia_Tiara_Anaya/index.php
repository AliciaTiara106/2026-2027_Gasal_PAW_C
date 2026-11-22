<?php
ob_start();
session_start();
require_once __DIR__ . '/conn.php';

$url = isset($_GET['url']) && $_GET['url'] !== '' ? $_GET['url'] : '/';

// Proteksi Halaman
if (isset($_SESSION['login']) && $url == '/login') {
    header("Location: ?url=/");
    exit;
}
if (!isset($_SESSION['login']) && $url != '/login' && $url != '/prosesLogin') {
    header("Location: ?url=/login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" href="style.css?v=2">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.6.1/dist/chart.umd.min.js"></script>
</head>
<body>
    <?php if (isset($_SESSION['login'])): ?>
    <nav class="navbar">
        <div class="nav-left">
            <span class="brand">💻 Sistem Penjualan</span>
            <a href="?url=/">Home</a> 
            
            <?php if ($_SESSION['level'] == 1): ?>
                <div class="dropdown">
                    <a href="#" class="dropbtn">Data Master ▾</a>
                    <div class="dropdown-content">
                        <a href="?url=/barang">Data Barang</a>
                        <a href="?url=/supplier">Data Supplier</a>
                        <a href="?url=/pelanggan">Data Pelanggan</a>
                        <a href="?url=/user">Data User</a>
                    </div>
                </div>
                <a href="?url=/transaksi">Transaksi</a>
                <a href="?url=/transaksi/laporan">Laporan</a> 
            <?php elseif ($_SESSION['level'] == 2): ?>
                <a href="?url=/transaksi">Transaksi</a>
                <a href="?url=/transaksi/laporan">Laporan</a>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <span class="user-info">Halo, <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong></span>
            <a href="?url=/logout" class="btn-logout" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </nav>
    <?php endif; ?>

    <main>
        <?php require __DIR__ . '/proses.php'; ?>
    </main>
</body>
</html>