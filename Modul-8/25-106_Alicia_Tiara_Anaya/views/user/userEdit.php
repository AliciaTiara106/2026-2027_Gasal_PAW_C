<?php
$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
?>
<h2>Edit User</h2>
<form method="post" action="?url=/api/user/edit">
    <input type="hidden" name="id_user" value="<?= $result['id_user'] ?? ''; ?>">
    <label>Username :
        <input type="text" name="username" value="<?= htmlspecialchars($result['username'] ?? ''); ?>" required>
    </label>
    <label>Password (Kosongkan jika tidak diubah) :
        <input type="password" name="password">
    </label>
    <label>Nama Lengkap :
        <input type="text" name="nama" value="<?= htmlspecialchars($result['nama'] ?? ''); ?>" required>
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="2"><?= htmlspecialchars($result['alamat'] ?? ''); ?></textarea>
    </label>
    <label>No. HP :
        <input type="text" name="hp" value="<?= htmlspecialchars($result['hp'] ?? ''); ?>">
    </label>
    <label>Level :
        <select name="level">
            <option value="1" <?= ($result['level'] ?? '') == 1 ? 'selected' : ''; ?>>Owner (Level 1)</option>
            <option value="2" <?= ($result['level'] ?? '') == 2 ? 'selected' : ''; ?>>Kasir (Level 2)</option>
        </select>
    </label>
    <button type="submit">Simpan</button>
</form>