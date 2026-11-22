<?php
$sql = "SELECT * FROM supplier ORDER BY id DESC";
$supplier = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<h2>Daftar Supplier</h2>
<a href="?url=/supplier/add">Tambah</a>
<?php if (empty($supplier)): ?>
    <p style="margin-top: 1rem; color: #64748b;">Belum ada data supplier.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($supplier as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['telp']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="?url=/supplier/edit&id=<?= $row['id']; ?>">Edit</a>
                        <a href="?url=/api/supplier/delete&id=<?= $row['id']; ?>" onclick="return confirm('Hapus supplier ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>