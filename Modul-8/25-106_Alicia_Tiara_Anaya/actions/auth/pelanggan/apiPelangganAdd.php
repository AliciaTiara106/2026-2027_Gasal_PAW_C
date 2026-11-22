<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jk = $_POST['jenis_kelamin'] ?? 'L';
    $telp = $_POST['telp'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    $sql = "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES (?, ?, ?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $id, $nama, $jk, $telp, $alamat);
        $stmt->execute();
        header('Location: ?url=/pelanggan');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>