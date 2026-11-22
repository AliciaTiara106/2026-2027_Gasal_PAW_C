<?php 
$id = $_GET['id'] ?? '';
$sql = "DELETE FROM pelanggan WHERE id = ?";
try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    header('Location: ?url=/pelanggan');
    exit;
} catch (Exception $e) {
    echo "ERROR : " . $e->getMessage();
}
?>