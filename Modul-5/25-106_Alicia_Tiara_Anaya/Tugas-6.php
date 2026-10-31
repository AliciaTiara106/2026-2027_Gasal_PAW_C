<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM supplier WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: Tugas-3.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>