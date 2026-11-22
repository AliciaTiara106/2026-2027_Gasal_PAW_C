<?php
$tglAwal = $_POST['tglAwal'] ?? '';
$tglAkhir = $_POST['tglAkhir'] ?? '';

$transaksi = [];
$total_pendapatan = 0;
$pelanggan_unik = 0;
$labels = [];
$dataTotal = [];

if (!empty($tglAwal) && !empty($tglAkhir)) {
    
    $sql = "SELECT tanggal, 
                   SUM(total) as total_pendapatan,
                   COUNT(DISTINCT pelanggan) as pelanggan_unik
            FROM transaksi 
            WHERE tanggal BETWEEN ? AND ?
            GROUP BY tanggal
            ORDER BY tanggal ASC"; 
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tglAwal, $tglAkhir);
        $stmt->execute();
        $transaksi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($transaksi as $row) {
            $total_pendapatan += $row['total_pendapatan'];
            $labels[] = $row['tanggal']; // Sumbu X: Tanggal
            $dataTotal[] = (int)$row['total_pendapatan']; // Sumbu Y: Total
        }

        $sqlPelanggan = "SELECT COUNT(DISTINCT pelanggan) as total_unik 
                         FROM transaksi 
                         WHERE tanggal BETWEEN ? AND ?";
        $stmtPel = $conn->prepare($sqlPelanggan);
        $stmtPel->bind_param("ss", $tglAwal, $tglAkhir);
        $stmtPel->execute();
        $resPel = $stmtPel->get_result()->fetch_assoc();
        $pelanggan_unik = $resPel['total_unik'];

    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>

<style>
    @media print {
        nav, form, button, a[href*="excel"], .no-print {
            display: none !important;
        }
        body {
            margin: 0;
            padding: 0;
            background: white;
        }
        main {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

<h2>Laporan Transaksi</h2>

<form method="POST" action="?url=/transaksi/laporan" style="margin-bottom: 20px;">
    <label>Dari Tanggal :
        <input type="date" name="tglAwal" value="<?= $tglAwal ?>" required>
    </label>
    <label>Sampai Tanggal :
        <input type="date" name="tglAkhir" value="<?= $tglAkhir ?>" required>
    </label>
    <button type="submit">Tampilkan</button>
</form>

<?php if (!empty($tglAwal) && !empty($tglAkhir)): ?>

    <div class="no-print" style="margin-bottom: 20px;">
        <button type="button" onclick="window.print()">Print</button>
        <a href="views/transaksi/transaksiLaporanExcel.php?tglAwal=<?= $tglAwal ?>&tglAkhir=<?= $tglAkhir ?>" target="_blank" style="background-color: #10b981;">Ekspor Excel</a>
    </div>

    <?php if (!empty($transaksi)): ?>
    <div style="width: 100%; max-width: 900px; margin: 0 auto 30px auto;">
        <canvas id="myChart"></canvas>
    </div>
    <?php endif; ?>

    <?php if (empty($transaksi)): ?>
        <p style="margin-top: 1rem; color: #64748b;">Tidak ada data transaksi pada periode ini.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($transaksi as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars((string)$row['tanggal']); ?></td>
                        <td>Rp <?= number_format((float)$row['total_pendapatan'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="flex: 1; padding: 15px; border: 1px solid #cbd5e1; border-radius: 8px; background-color: #f8fafc;">
            <h4 style="margin: 0 0 10px 0; color: #475569;">Jumlah Pelanggan Unik</h4>
            <h2 style="margin: 0; color: #0f172a;"><?= number_format($pelanggan_unik, 0, ',', '.') ?> Orang</h2>
        </div>
        <div style="flex: 1; padding: 15px; border: 1px solid #cbd5e1; border-radius: 8px; background-color: #f8fafc;">
            <h4 style="margin: 0 0 10px 0; color: #475569;">Total Pendapatan Keseluruhan</h4>
            <h2 style="margin: 0; color: #0f172a;">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></h2>
        </div>
    </div>

    <?php if (!empty($transaksi)): ?>
    <script>
        const ctx = document.getElementById('myChart');
        const labelTanggal = <?= json_encode($labels); ?>;
        const dataTotal = <?= json_encode($dataTotal); ?>;
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelTanggal,
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: dataTotal,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
    <?php endif; ?>

<?php else: ?>
    <p style="margin-top: 1rem; color: #64748b; text-align: center; padding: 40px; border: 2px dashed #cbd5e1; border-radius: 8px;">
        Silakan pilih rentang tanggal dan klik tombol <strong>Tampilkan</strong> untuk melihat laporan.
    </p>
<?php endif; ?>