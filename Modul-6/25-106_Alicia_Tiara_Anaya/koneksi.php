<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "penjualan";

try {
    $conn = mysqli_connect($servername, $username, $password, $db);
    if (!$conn) {
        throw new Exception(mysqli_connect_error());
    }
} catch (Exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>