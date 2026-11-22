<?php
$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
?>
<h2>Edit Supplier</h2>
<form method="post" action="?url=/api/supplier/edit">
    <input type="hidden" name="id" value="<?= $result['id'] ?? ''; ?>">
    <label>Nama Supplier :
        <input type="text" name="nama" value="<?= htmlspecialchars($result['nama'] ?? ''); ?>" required>
    </label>
    <label>Telepon :
        <input type="text" name="telp" value="<?= htmlspecialchars($result['telp'] ?? ''); ?>">
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="3"><?= htmlspecialchars($result['alamat'] ?? ''); ?></textarea>
    </label>
    <button type="submit">Simpan</button>
</form>