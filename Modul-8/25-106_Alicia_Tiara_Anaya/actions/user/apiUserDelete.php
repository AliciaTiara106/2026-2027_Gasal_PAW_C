<?php 
$id = (int)($_GET['id'] ?? 0);
$sql = "DELETE FROM user WHERE id_user = ?";
try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: ?url=/user');
    exit;
} catch (Exception $e) {
    echo "ERROR : " . $e->getMessage();
}
?>