<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
    if (mysqli_query($koneksi, $update)) {
        header("Location: Tugas-3.php");
    } else {
        echo "Error: " . $update . "<br>" . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Master Supplier</title>
</head>
<body>
    <h2>Edit Data Master Supplier</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= $data['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?= $data['telp']; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?= $data['alamat']; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="update" style="background-color: #5cb85c; color: white; padding: 8px 12px; border: none; border-radius: 4px;">Update</button>
                    <a href="Tugas-3.php" style="background-color: #d9534f; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>