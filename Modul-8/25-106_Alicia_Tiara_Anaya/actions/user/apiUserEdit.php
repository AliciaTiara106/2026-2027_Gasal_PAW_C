<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = (int)($_POST['id_user'] ?? 0);
    $username = $_POST['username'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $hp = $_POST['hp'] ?? '';
    $level = (int)($_POST['level'] ?? 2);

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $sql = "UPDATE user SET username=?, password=?, nama=?, alamat=?, hp=?, level=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii", $username, $password, $nama, $alamat, $hp, $level, $id_user);
    } else {
        $sql = "UPDATE user SET username=?, nama=?, alamat=?, hp=?, level=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $username, $nama, $alamat, $hp, $level, $id_user);
    }

    try {
        $stmt->execute();
        header('Location: ?url=/user');
        exit;
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>