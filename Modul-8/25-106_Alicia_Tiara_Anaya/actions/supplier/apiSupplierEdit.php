<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $nama = $_POST['nama'] ?? '';
    $telp = $_POST['telp'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    $sql = "UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
        $stmt->execute();
        header('Location: ?url=/supplier');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>