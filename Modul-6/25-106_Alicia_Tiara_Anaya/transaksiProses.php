<?php 
function ambilTransaksi($conn){

    $sql = "SELECT t.*, p.nama AS nama_pelanggan 
            FROM transaksi t 
            JOIN pelanggan p ON t.pelanggan_id = p.id
            ORDER BY t.id ASC";
    try {
        return $conn->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "ERROR :" . $e->getMessage();
        return [];
    }
}

function ambilPelanggan($conn) {
    $sql = "SELECT * FROM pelanggan ORDER BY nama ASC";
    try {
        return $conn->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function editTransaksi($conn, $data) {
    $sqlUpdate = "UPDATE transaksi SET waktu_transaksi = ?, keterangan = ?, pelanggan_id = ? WHERE id = ?";
    $conn->begin_transaction();
    try {
        $conn->execute_query($sqlUpdate, [
            $data["tanggal"], 
            $data["keterangan"], 
            $data["pelanggan_id"],
            $data["id"]
        ]);
        $conn->commit();
        return "Data transaksi berhasil di update dengan ID: " . $data["id"];
    } catch (Throwable $e) {
        $conn->rollback();
        return "ERROR :" . $e->getMessage();
    }
}

function tambahTransaksi($conn, $data) {
    $tanggal = trim($data["tanggal"] ?? "");
    $keterangan = trim($data["keterangan"] ?? "");
    $pelanggan_id = trim($data["pelanggan_id"] ?? "");
    
    $sqlInsert = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)";
    try {
        $conn->execute_query($sqlInsert, [$tanggal, $keterangan, $pelanggan_id]);
        return "Transaksi berhasil ditambahkan";
    } catch (Throwable $e) {
        return "ERROR :" . $e->getMessage();
    }
}

function hapusTransaksi($conn, $id) {
    $id = (int)$id;
    try {
        $conn->begin_transaction();
        
        $conn->execute_query("DELETE FROM transaksi WHERE id = ?", [$id]);
        $conn->commit();
        return "Transaksi beserta detailnya berhasil dihapus.";
    } catch (Throwable $e) {
        $conn->rollback();
        return "ERROR :" . $e->getMessage();
    }
}
?>