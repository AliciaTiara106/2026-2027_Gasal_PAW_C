<?php 
function ambilDetailTransaksi($conn, $id_terpilih){
    $sql = "SELECT td.*, b.nama_barang 
            FROM transaksi_detail td 
            JOIN barang b ON b.id = td.barang_id 
            WHERE td.transaksi_id = ?";
    try {
        return $conn->execute_query($sql, [$id_terpilih])->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "ERROR :" . $e->getMessage();
        return [];
    }
}

function ambilBarang($conn){
    $sql = "SELECT * FROM barang ORDER BY nama_barang ASC;";
    try {
        return $conn->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "ERROR :" . $e->getMessage();
        return [];
    }
}

// No. 4
function hitungTotal($conn, $id_terpilih){
    // Menghitung total dari (harga * qty) di tabel detail
    $sql = "SELECT COALESCE(SUM(harga * qty), 0) AS total 
            FROM transaksi_detail 
            WHERE transaksi_id = ?";
    $sqlUpdate = "UPDATE transaksi SET total = ? WHERE id = ?";
    
    try {
        $result = $conn->execute_query($sql, [$id_terpilih])->fetch_assoc();
        $total = $result['total'];
        $conn->execute_query($sqlUpdate, [$total, $id_terpilih]);
    } catch (Exception $e) {
        echo "ERROR :" . $e->getMessage();
    }
}

function tambahDetailTransaksi($conn, $data){
    $sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)";
    try {
        $stmtHarga = $conn->execute_query("SELECT harga FROM barang WHERE id = ?", [$data['barang_id']]);
        $harga = $stmtHarga->fetch_assoc()['harga'];

        $conn->begin_transaction();
        $conn->execute_query($sql, [
            $data['transaksi_id'], 
            $data['barang_id'], 
            $harga, 
            $data['qty']
        ]);
        hitungTotal($conn, $data['transaksi_id']);
        $conn->commit();
        return "Detail transaksi berhasil ditambahkan.";
    } catch (Exception $e) {
        $conn->rollback();

        if ($conn->errno == 1062) {
            return "ERROR: Barang tersebut sudah ada dalam transaksi ini.";
        }
        return "ERROR :" . $e->getMessage();
    }
}

function editDetailTransaksi($conn, $data){
    $barang_id = $data['barang_id'] ?? null;
    $qty = $data['qty'] ?? null;
    $detail_id = $data['detail_id'] ?? null;
    $transaksi_id = $data['transaksi_id'] ?? null;
    $old_barang_id = $data['old_barang_id'] ?? null;

    try {
        $conn->begin_transaction();

        $stmtHarga = $conn->execute_query("SELECT harga FROM barang WHERE id = ?", [$barang_id]);
        $harga = $stmtHarga->fetch_assoc()['harga'];
        $sql = "UPDATE transaksi_detail SET barang_id = ?, harga = ?, qty = ? WHERE transaksi_id = ? AND barang_id = ?";
        $conn->execute_query($sql, [$barang_id, $harga, $qty, $transaksi_id, $old_barang_id]);
        
        hitungTotal($conn, $transaksi_id);
        $conn->commit();
        return "Detail transaksi berhasil diperbarui.";
    } catch (Exception $e) {
        $conn->rollback();
        return "ERROR :" . $e->getMessage();
    }
}

function hapusDetailTransaksi($conn, $data){
    $barang_id = $data['hapus_detail_id'] ?? null;
    $transaksi_id = $data['transaksi_id'] ?? null;

    if (!$barang_id || !$transaksi_id) {
        return "ERROR: Data tidak lengkap (barang_id atau transaksi_id kosong).";
    }

    $sql = "DELETE FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?";
    
    try {
        $conn->begin_transaction();
        $conn->execute_query($sql, [$transaksi_id, $barang_id]);
        hitungTotal($conn, $transaksi_id);
        
        $conn->commit();
        return "Sukses: Detail transaksi berhasil dihapus.";
    } catch (Exception $e) {
        $conn->rollback();
        return "ERROR :" . $e->getMessage();
    }
}

// No.3
function hapusBarang($conn, $barang_id) {
    try {
        $cek = $conn->execute_query("
            SELECT t.id as transaksi_id, t.waktu_transaksi 
            FROM transaksi_detail td 
            JOIN transaksi t ON td.transaksi_id = t.id 
            WHERE td.barang_id = ?
        ", [$barang_id]);
        $pemakaian = $cek->fetch_all(MYSQLI_ASSOC);

        if (count($pemakaian) > 0) {
            $id_transaksi = array_column($pemakaian, 'transaksi_id');
            $daftar_id = implode(", ", $id_transaksi);
            return "Gagal: Barang ini masih digunakan pada Transaksi ID: $daftar_id. Hapus barang dari detail transaksi terlebih dahulu!";
        }

        $conn->execute_query("DELETE FROM barang WHERE id = ?", [$barang_id]);
        return "Sukses: Barang berhasil dihapus dari database.";
        
    } catch (Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
}
?>