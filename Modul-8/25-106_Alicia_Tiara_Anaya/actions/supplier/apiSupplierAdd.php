<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $telp = $_POST['telp'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nama, $telp, $alamat);
        $stmt->execute();
        header('Location: ?url=/supplier');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>