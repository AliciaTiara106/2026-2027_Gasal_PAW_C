-- tabel supplier
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Makmur', '08123456', 'Surabaya'),
('PT. Indo Sehat', '081515563', 'Bogor'),
('PT. Segar Kuat', '0845454663', 'Surabaya'),
('CV. Sumber Rejeki', '0811111111', 'Jakarta'),
('Toko Makmur Jaya', '0822222222', 'Bandung'),
('PT. Elektronik Sejahtera', '0833333333', 'Bali'),
('UD. Makmur Abadi', '0844444444', 'Malang'),
('CV. Karya Mandiri', '0855555555', 'Gresik'),
('PT. Bagus Sejahtera', '0866666666', 'Yokyakarta'),
('Toko Sembako Hebat', '0877777777', 'Surabaya');

-- tabel pelanggan
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('1', 'Keng Harit', 'L', '081234567890', 'Bandung'),
('2', 'Abraham Khaisan', 'L', '081234567891', 'Bandung'),
('3', 'Davikah Lee', 'P', '081234567892', 'Bogor'),
('4', 'Dhasa Taran', 'P', '081234567893', 'Jakarta'),
('5', 'Samantha Melani', 'P', '081234567894', 'Bali'),
('6', 'Nut Danjesda', 'L', '081234567895', 'Surabaya'),
('7', 'Hongshi', 'L', '081234567896', 'Surabaya'),
('8', 'Jeff Satur', 'L', '081234567897', 'Jakarta'),
('9', 'Alicia Tiara', 'P', '081234567898', 'Jakarta'),
('10', 'Louisa Amalia', 'P', '081234567899', 'Yokyakarta');

-- tabel barang
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG1', 'Kertas HVS A4', 45000, 100, 1),
('BRG2', 'Pulpen Hitam', 3000, 200, 2),
('BRG3', 'Map Plastik', 2500, 150, 3),
('BRG4', 'Tinta Printer', 65000, 30, 4),
('BRG5', 'Stapler Besar', 25000, 40, 5),
('BRG6', 'Spidol Whiteboard', 12000, 80, 6),
('BRG7', 'Buku Tulis 50 Lembar', 5000, 300, 7),
('BRG8', 'Penghapus Karet', 2000, 100, 8),
('BRG9', 'Lem Kertas', 8000, 50, 9),
('BRG10', 'Gunting Kertas', 15000, 25, 10);

-- tabel transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Pembelian Alat Tulis Kantor', 150000, 1),
('2026-10-02', 'Beli Kertas dan Tinta', 200000, 2),
('2026-10-03', 'Kebutuhan Sekolah', 75000, 3),
('2026-10-04', 'Beli Map dan Spidol', 50000, 4),
('2026-10-05', 'Restock Alat Tulis', 300000, 5),
('2026-10-06', 'Pembelian Gunting', 45000, 6),
('2026-10-07', 'Beli Buku Tulis', 100000, 7),
('2026-10-08', 'Beli Lem dan Penghapus', 30000, 8),
('2026-10-09', 'Pembelian Stapler', 80000, 9),
('2026-10-10', 'Belanja Bulanan ATK', 250000, 10);

-- tabel transaksi detail
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 45000, 2),
(10, 2, 3000, 20),
(2, 4, 65000, 3),
(3, 7, 5000, 15),
(4, 3, 2500, 20),
(5, 6, 45000, 5),
(6, 10, 15000, 3),
(7, 9, 5000, 20),
(8, 8, 2000, 10),
(9, 5, 25000, 2);

-- tabel pembayaran
INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 150000, 'TUNAI', 1),
('2026-10-02 11:30:00', 200000, 'TRANSFER', 2),
('2026-10-03 09:15:00', 75000, 'EDC', 3),
('2026-10-04 14:00:00', 50000, 'TUNAI', 4),
('2026-10-05 13:45:00', 300000, 'TRANSFER', 5),
('2026-10-06 15:20:00', 45000, 'TUNAI', 6),
('2026-10-07 10:10:00', 100000, 'EDC', 7),
('2026-10-08 16:30:00', 30000, 'TUNAI', 8),
('2026-10-09 12:00:00', 80000, 'TRANSFER', 9),
('2026-10-10 09:00:00', 250000, 'TUNAI', 10);

-- tabel user
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin1', '123456', 'Galih Hutani', 'Maluku', '08123456', 3),
('admin2', '123457', 'Indah Mayang', 'Sidoarjo', '08123457', 2),
('admingudang', '123458', 'Indri Ramone', 'Makasar', '08123458', 1),
('admin123', '123459', 'William Manupi', 'Padang', '08123459', 4),
('aron1', '123452', 'Yulis Parden', 'Surabaya', '08123452', 2),
('admin5', '123453', 'Putri Tagaga', 'Borneo', '08123453', 5),
('aku2', '123454', 'Abraham Nitijana', 'Jakarta', '08123454', 1),
('admin7', '123455', 'Dinda Mayangsari', 'Bogor', '08123455', 5),
('admin8', '123451', 'Shammy Indriani', 'Bandung', '08123451', 2),
('admin9', '123469', 'Aliv Levin', 'Bali', '08123469', 5);