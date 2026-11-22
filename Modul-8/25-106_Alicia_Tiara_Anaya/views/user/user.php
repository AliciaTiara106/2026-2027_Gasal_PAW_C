<?php
$sql = "SELECT * FROM user ORDER BY id_user DESC";
$users = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<h2>Daftar User</h2>
<a href="?url=/user/add">Tambah</a>
<?php if (empty($users)): ?>
    <p style="margin-top: 1rem; color: #64748b;">Belum ada data user.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($users as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= $row['level'] == 1 ? 'Owner' : 'Kasir'; ?></td>
                    <td>
                        <a href="?url=/user/edit&id=<?= $row['id_user']; ?>">Edit</a>
                        <a href="?url=/api/user/delete&id=<?= $row['id_user']; ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>