<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = md5($_POST['password'] ?? ''); // Hash MD5
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $hp = $_POST['hp'] ?? '';
    $level = (int)($_POST['level'] ?? 2);

    $sql = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES (?, ?, ?, ?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $password, $nama, $alamat, $hp, $level);
        $stmt->execute();
        header('Location: ?url=/user');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>