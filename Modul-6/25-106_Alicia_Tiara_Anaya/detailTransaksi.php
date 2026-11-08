<h2>Data Detail transaksi dari ID : <?= $id_terpilih ?></h2>
<form method="POST">
    <input type="hidden" name="transaksi_id" value="<?= (int)$id_terpilih; ?>">

<?php if ($aksi === "editDetail"): ?>
    <input type="hidden" name="detail_id" value="<?= (int)$id_detail_terpilih; ?>">
    <input type="hidden" name="old_barang_id" value="<?= (int)$old_barang_id; ?>">
<?php endif; ?>

<table cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($resultDetail)) :?>
            <tr><td colspan="6" align="center">Belum ada detail barang untuk transaksi ini.</td></tr>
        <?php else: ?>
            <?php $no=1; $grandTotal = 0; ?>
            <?php foreach ($resultDetail as $data): 
                $subtotal = $data['harga'] * $data['qty'];
                $grandTotal += $subtotal;
            ?>
                <tr>
                    <?php if ($data["barang_id"] == $id_detail_terpilih && $aksi=="editDetail"): ?>
                        <td><?= $no++; ?></td>
                        <td>
                            <select name="barang_id" required>
                                <?php foreach ($resultBarang as $dataBarang): ?>
                                    <option value="<?= (int)$dataBarang["id"]; ?>" <?= (int)$dataBarang["id"] === (int)$data["barang_id"] ? "selected" : ""; ?>>
                                        <?= htmlspecialchars((string)$dataBarang["nama_barang"]); ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                        <td><input type="number" name="qty" min="1" value="<?= (int)$data["qty"]; ?>" required style="width: 60px;"></td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td>
                            <button type="submit">Simpan</button>
                            <a href="index.php?id=<?= (int)$id_terpilih; ?>&aksi=detailTransaksi">Batal</a>
                        </td>
                    <?php else: ?>
                        <!-- TAMPILAN NORMAL (TIDAK EDIT) -->
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($data['nama_barang']);?></td>
                        <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                        <td><?= $data['qty'];?></td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td align="center">
                            <a href="index.php?id=<?= (int)$id_terpilih; ?>&id_detail=<?= (int)$data['barang_id']; ?>&aksi=editDetail">edit</a>
                            
                            <button type="submit" name="hapus_detail_id" value="<?= (int)$data['barang_id']; ?>" onclick="return confirm('Hapus barang ini dari detail transaksi?')">Hapus</button>
                        </td>
                    <?php endif ?>
                </tr>    
            <?php endforeach ;?>

            <tr>
                <td colspan="4" align="right"><strong>Grand Total</strong></td>
                <td colspan="2"><strong>Rp <?= number_format($grandTotal, 0, ',', '.') ?></strong></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</form>

<h3>Tambah Barang untuk transaksi ID: <?= $id_terpilih ?></h3>
<form action="index.php?aksi=tambahDetail" method="post">
    <input type="hidden" name="transaksi_id" value="<?= (int)$id_terpilih; ?>">
    <label for="barang_id">Barang :</label>
    <select name="barang_id" id="barang_id" required>
        <option value="">Pilih barang</option>
        <?php 

        $barangTerpakai = array_column($resultDetail, 'barang_id');
        
        foreach ($resultBarang as $dataBarang): 
            $isDisabled = in_array($dataBarang['id'], $barangTerpakai);
        ?>
            <option value="<?= (int)$dataBarang['id'];?>" <?= $isDisabled ? 'disabled' : ''; ?>>
                <?= htmlspecialchars((string)$dataBarang['nama_barang']);?>
                <?= $isDisabled ? '(Sudah dipilih)' : ''; ?>
            </option>    
        <?php endforeach ?>
    </select>
    <label for="qty">Qty :</label>
    <input type="number" id="qty" name="qty" min="1" value="1" required style="width: 60px;">
    <button type="submit">Tambah</button>
</form>