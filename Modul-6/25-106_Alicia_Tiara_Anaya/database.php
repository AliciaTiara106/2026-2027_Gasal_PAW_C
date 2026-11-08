<?php
require 'koneksi.php';
$sql_drop = "DROP DATABASE IF EXISTS penjualan;";
mysqli_query($conn, $sql_drop);

$sql = "
CREATE DATABASE penjualan;
USE penjualan;

CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT NOT NULL DEFAULT 0,
    pelanggan_id VARCHAR(20) NOT NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
    transaksi_id INT NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
) ENGINE=InnoDB;

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Alat Tulis Jaya', '0211234567', 'Jakarta'),
('CV. Sinar Dunia', '0219876543', 'Bandung'),
('Toko Grosir Makmur', '0315558888', 'Surabaya'),
('PT. Pendidikan Cerdas', '0213334444', 'Depok'),
('UD. Kertas Nusantara', '0217779999', 'Tangerang');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Buku Tulis A5', 5000, 100, 1),
('BRG002', 'Pulpen Gel Hitam', 4000, 150, 2),
('BRG003', 'Pensil 2B', 2500, 200, 1),
('BRG004', 'Penghapus Karet', 1500, 300, 3),
('BRG005', 'Penggaris 30cm', 3000, 80, 2),
('BRG006', 'Correction Tape', 6000, 50, 4),
('BRG007', 'Spidol Whiteboard', 8500, 40, 5),
('BRG008', 'Map Folio Plastik', 2000, 120, 1),
('BRG009', 'Sticky Notes Pastel', 7500, 60, 3),
('BRG010', 'Gunting Kertas', 9000, 30, 2);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Keng Harit', 'L', '081234567890', 'Jl. Merdeka No. 1'),
('P002', 'Jeff Satur', 'L', '081298765432', 'Jl. Sudirman No. 2'),
('P003', 'Samantha Melani', 'P', '081311223344', 'Jl. Thamrin No. 3'),
('P004', 'William Jakrapart', 'L', '081455667788', 'Jl. Gatot Subroto No. 4'),
('P005', 'Est Puspa sari', 'P', '081599887766', 'Jl. Ahmad Yani No. 5'),
('P006', 'Nut Danjesda', 'L', '081599887722', 'Jl. Pondok Indah. 2'),
('P007', 'Hongshi Danjesda', 'P', '081599887723', 'Jl. Pondok Indah No. 2'),
('P008', 'Pond Naravit', 'L', '081599887712', 'Jl. Menteng No. 6'),
('P009', 'Na Jaemin', 'L', '081599887123', 'Jl. Menteng No. 1'),
('P0010', 'Park Seoham', 'L', '081599881234', 'Jl. Citraland No. 2');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Administrator', 'Kantor Pusat', '081200000001', 1),
('kasir1', 'kasir123', 'Kasir Satu', 'Cabang A', '081200000002', 2),
('kasir2', 'kasir123', 'Kasir Dua', 'Cabang B', '081200000003', 2),
('gudang', 'gudang123', 'Staff Gudang', 'Gudang Utama', '081200000004', 3),
('owner', 'owner123', 'Pemilik', 'Kediaman', '081200000005', 1);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-11-01', 'Pembelian alat tulis kantor', 0, 'P001'),
('2026-11-01', 'Beli perlengkapan sekolah', 0, 'P002'),
('2026-11-02', 'Pembelian ATK bulanan', 0, 'P003'),
('2026-11-02', 'Kebutuhan gambar teknik', 0, 'P004'),
('2026-11-03', 'Pembelian seragam dan alat', 0, 'P005'),
('2026-11-03', 'Restock alat tulis', 0, 'P001'),
('2026-11-04', 'Pembelian pribadi', 0, 'P002'),
('2026-11-04', 'Peralatan presentasi', 0, 'P003'),
('2026-11-04', 'Kebutuhan kantor cabang', 0, 'P004'),
('2026-11-05', 'Pembelian akhir pekan', 0, 'P005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 5000, 3), (1, 2, 4000, 2), (1, 4, 1500, 1),
(2, 3, 2500, 4), (2, 5, 3000, 1),
(3, 6, 6000, 2), (3, 7, 8500, 2), (3, 9, 7500, 1),
(4, 10, 9000, 1), (4, 8, 2000, 5),
(5, 1, 5000, 5), (5, 3, 2500, 2),
(6, 7, 8500, 3), (6, 4, 1500, 2),
(7, 2, 4000, 3), (7, 9, 7500, 2), (7, 5, 3000, 2),
(8, 8, 2000, 10), (8, 6, 6000, 1),
(9, 10, 9000, 2), (9, 1, 5000, 2),
(10, 2, 4000, 5), (10, 3, 2500, 4), (10, 7, 8500, 1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-11-01 10:00:00', 24500, 'TUNAI', 1),
('2026-11-01 11:30:00', 13000, 'TRANSFER', 2),
('2026-11-02 09:15:00', 36500, 'EDC', 3),
('2026-11-02 14:00:00', 19000, 'TUNAI', 4),
('2026-11-03 08:45:00', 30000, 'TRANSFER', 5),
('2026-11-03 13:20:00', 28500, 'TUNAI', 6),
('2026-11-04 10:10:00', 33000, 'EDC', 7),
('2026-11-04 15:30:00', 26000, 'TUNAI', 8),
('2026-11-04 16:00:00', 28000, 'TRANSFER', 9),
('2026-11-05 09:00:00', 38500, 'TUNAI', 10);

UPDATE transaksi t
JOIN (
    SELECT transaksi_id, SUM(harga * qty) as total_hitung
    FROM transaksi_detail
    GROUP BY transaksi_id
) d ON t.id = d.transaksi_id
SET t.total = d.total_hitung;
";

try {
    mysqli_multi_query($conn, $sql);
    while(mysqli_more_results($conn)) { mysqli_next_result($conn); }
    echo "Database 'penjualan' berhasil dibuat ulang beserta relasinya.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
mysqli_close($conn);
?>