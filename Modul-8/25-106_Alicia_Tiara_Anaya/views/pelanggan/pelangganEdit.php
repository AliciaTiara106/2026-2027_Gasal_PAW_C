<?php
$id = $_GET['id'] ?? '';
$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
?>
<h2>Edit Pelanggan</h2>
<form method="post" action="?url=/api/pelanggan/edit">
    <input type="hidden" name="id" value="<?= $result['id'] ?? ''; ?>">
    <label>Nama :
        <input type="text" name="nama" value="<?= htmlspecialchars($result['nama'] ?? ''); ?>" required>
    </label>
    <label>Jenis Kelamin :
        <select name="jenis_kelamin">
            <option value="L" <?= ($result['jenis_kelamin'] ?? '') == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="P" <?= ($result['jenis_kelamin'] ?? '') == 'P' ? 'selected' : ''; ?>>Perempuan</option>
        </select>
    </label>
    <label>Telepon :
        <input type="text" name="telp" value="<?= htmlspecialchars($result['telp'] ?? ''); ?>">
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="3"><?= htmlspecialchars($result['alamat'] ?? ''); ?></textarea>
    </label>
    <button type="submit">Simpan</button>
</form>