<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: Tugas-3.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Master Supplier Baru</title>
</head>
<body>
    <h2>Tambah Data Master Supplier Baru</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="Nama" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" placeholder="telp" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" placeholder="alamat" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="simpan" style="background-color: #5cb85c; color: white; padding: 8px 12px; border: none; border-radius: 4px;">Simpan</button>
                    <a href="Tugas-3.php" style="background-color: #d9534f; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>