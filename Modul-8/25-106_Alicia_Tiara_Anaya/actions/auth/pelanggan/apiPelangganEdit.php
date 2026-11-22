<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jk = $_POST['jenis_kelamin'] ?? 'L';
    $telp = $_POST['telp'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    $sql = "UPDATE pelanggan SET nama = ?, jenis_kelamin = ?, telp = ?, alamat = ? WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nama, $jk, $telp, $alamat, $id);
        $stmt->execute();
        header('Location: ?url=/pelanggan');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>