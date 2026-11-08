<?php 
require "koneksi.php";
require "transaksiDetailProses.php";
require "transaksiProses.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi_post = isset($_GET['aksi']) ? $_GET['aksi'] : '';
    $notif = '';

    if (isset($_POST["hapus_id"])) {
        $notif = hapusTransaksi($conn, $_POST["hapus_id"]);
        header("Location: index.php?notif=" . urlencode($notif));
        exit;
    }
    elseif ($aksi_post == "tambahTransaksi") {
        $notif = tambahTransaksi($conn, $_POST);
        header("Location: index.php?notif=" . urlencode($notif));
        exit;
    }
    elseif ($aksi_post == "editTransaksi") {
        $notif = editTransaksi($conn, $_POST);
        header("Location: index.php?notif=" . urlencode($notif));
        exit;
    }
    elseif ($aksi_post == "tambahDetail") {
        $id_terpilih = (int)($_POST["transaksi_id"] ?? 0);
        $notif = tambahDetailTransaksi($conn, $_POST);
        header("Location: index.php?id={$id_terpilih}&aksi=detailTransaksi&notif=" . urlencode($notif));
        exit;
    }
    elseif ($aksi_post == "editDetail") {
        $id_terpilih = (int)($_POST["transaksi_id"] ?? 0);
        $notif = editDetailTransaksi($conn, $_POST);
        header("Location: index.php?id={$id_terpilih}&aksi=detailTransaksi&notif=" . urlencode($notif));
        exit;
    }
    elseif (isset($_POST['hapus_detail_id'])) {
        $id_terpilih = (int)($_POST["transaksi_id"] ?? 0);
        $notif = hapusDetailTransaksi($conn, $_POST);
        header("Location: index.php?id={$id_terpilih}&aksi=detailTransaksi&notif=" . urlencode($notif));
        exit;
    }
    elseif (isset($_POST['hapus_barang_id'])) {
        $notif = hapusBarang($conn, $_POST['hapus_barang_id']);
        // Redirect kembali ke tampilan master barang
        header("Location: index.php?aksi=masterBarang&notif=" . urlencode($notif));
        exit;
    }
}

$id_terpilih        = isset($_GET['id'])        ? (int)$_GET['id'] : null;
$id_detail_terpilih = isset($_GET['id_detail']) ? (int)$_GET['id_detail'] : null;
$old_barang_id      = isset($_GET['id_detail']) ? (int)$_GET['id_detail'] : null;
$aksi               = isset($_GET['aksi'])      ? $_GET['aksi'] : null;

$notifikasi = isset($_GET['notif']) ? $_GET['notif'] : "";

$resultDetail = [];
$resultBarang = [];

if ($id_terpilih && in_array($aksi, ["detailTransaksi", "editDetail"], true)) {
    $resultDetail = ambilDetailTransaksi($conn, $id_terpilih);
    $resultBarang = ambilBarang($conn);
}    

$result           = ambilTransaksi($conn);
$dataPelanggan    = ambilPelanggan($conn); 

$dataBarangMaster = [];
if ($aksi === 'masterBarang') {
    $dataBarangMaster = ambilBarang($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (!empty($notifikasi)): ?>
        <p style="padding: 10px; background: #e0f7fa; border: 1px solid #00bcd4;">
            <strong><?= htmlspecialchars($notifikasi); ?></strong>
        </p>
    <?php endif; ?>
    <?php if ($aksi === 'masterBarang'): ?>
        <div class="container">
            <h1>List Barang</h1>
            <a href="index.php">&larr; Kembali ke Data Transaksi</a>
            <br><br>
            <form method="post">
                <table cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($dataBarangMaster as $brg): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($brg['kode_barang']) ?></td>
                            <td><?= htmlspecialchars($brg['nama_barang']) ?></td>
                            <td>Rp <?= number_format($brg['harga'], 0, ',', '.') ?></td>
                            <td><?= (int)$brg['stok'] ?></td>
                            <td>
                                <button type="submit" name="hapus_barang_id" value="<?= (int)$brg['id'] ?>" 
                                        onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    <?php else: ?>
        <?php if($aksi == "tambahTransaksi"):?>
            <div style="margin-bottom: 20px;">
                <h2>Tambah Transaksi</h2>
                <form method="post">
                    <label>Tanggal:
                        <input type="date" name="tanggal" required>
                    </label>
                    <label>Pelanggan:
                        <select name="pelanggan_id" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php foreach ($dataPelanggan as $pel): ?>
                                <option value="<?= htmlspecialchars($pel['id']) ?>"><?= htmlspecialchars($pel['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>Keterangan:
                        <input type="text" name="keterangan">
                    </label>
                    <button type="submit">Simpan Transaksi</button>
                    <a href="index.php">Batal</a>
                </form>
            </div>
        <?php endif; ?>

        <div class="container">
            <h1>Data Transaksi</h1>
            <a href="?aksi=tambahTransaksi">Tambah Transaksi</a>
            <a href="?aksi=masterBarang">Tabel Barang</a>
            <br><br>
            <form method="post">
            <table cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($result as $data) : ?>
                        <tr>
                            <?php if ($aksi === 'editTransaksi' && $id_terpilih === (int)$data["id"]) : ?>
                                <td><?= $no++; ?></td>
                                <td><input type="text" value="<?= htmlspecialchars((string)$data["id"]); ?>" readonly style="width: 40px;"></td>
                                <td><input type="date" name="tanggal" value="<?= htmlspecialchars((string)$data["waktu_transaksi"]); ?>" required></td>
                                <td>
                                    <select name="pelanggan_id" required>
                                        <?php foreach ($dataPelanggan as $pel): ?>
                                            <option value="<?= htmlspecialchars($pel['id']) ?>" <?= $pel['id'] == $data['pelanggan_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($pel['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="text" name="keterangan" value="<?= htmlspecialchars((string)$data["keterangan"]); ?>"></td>
                                <td>Rp <?= number_format($data["total"], 0, ',', '.'); ?></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= (int)$data["id"]; ?>">
                                    <button type="submit">Simpan</button>
                                    <a href="index.php">Batal</a>
                                </td>
                            <?php else : ?>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars((string)$data["id"]); ?></td>
                                <td><?= htmlspecialchars((string)$data["waktu_transaksi"]); ?></td>
                                <td><?= htmlspecialchars((string)$data["nama_pelanggan"]); ?></td>
                                <td><?= htmlspecialchars((string)$data["keterangan"]); ?></td>
                                <td>Rp <?= number_format($data["total"], 0, ',', '.'); ?></td>
                                <td align="center">
                                    <a href="?id=<?=(int)$data['id']; ?>&aksi=detailTransaksi">Detail</a>
                                    <button type="submit" name="hapus_id" value="<?= (int)$data["id"]; ?>" onclick="return confirm('Hapus transaksi ini beserta semua detailnya?')">Hapus</button>
                                    <a href="?id=<?= (int)$data["id"]; ?>&aksi=editTransaksi">Edit</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </form>
        </div>
        <?php if ($id_terpilih && in_array($aksi, ["detailTransaksi", "editDetail"], true)): ?>
            <?php require "detailTransaksi.php"; ?>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>