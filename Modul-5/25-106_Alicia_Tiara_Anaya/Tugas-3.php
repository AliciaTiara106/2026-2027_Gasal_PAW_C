<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; border-radius: 4px; }
        .btn-tambah { background-color: #5cb85c; margin-bottom: 10px; display: inline-block; }
        .btn-edit { background-color: #f0ad4e; }
        .btn-hapus { background-color: #d9534f; }
    </style>
</head>
<body>

    <h2>Data Master Supplier</h2>
    <a href="Tugas-4.php" class="btn btn-tambah">Tambah Data</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['telp']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td>
                <a href="Tugas-5.php?id=<?= $data['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="Tugas-6.php?id=<?= $data['id']; ?>" class="btn btn-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>