<?php
$sql = "SELECT * FROM pelanggan ORDER BY id DESC";
$pelanggan = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<h2>Daftar Pelanggan</h2>
<a href="?url=/pelanggan/add">Tambah</a>
<?php if (empty($pelanggan)): ?>
    <p style="margin-top: 1rem; color: #64748b;">Belum ada data pelanggan.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($pelanggan as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= $row['jenis_kelamin']; ?></td>
                    <td><?= htmlspecialchars($row['telp']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="?url=/pelanggan/edit&id=<?= $row['id']; ?>">Edit</a>
                        <a href="?url=/api/pelanggan/delete&id=<?= $row['id']; ?>" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>