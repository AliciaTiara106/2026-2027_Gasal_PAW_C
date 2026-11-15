<?php
require "../../conn.php";
$tglAwal = $_POST['tglAwal'] ?? '';
$tglAkhir = $_POST['tglAkhir'] ?? '';

if (!empty($tglAwal)&&!empty($tglAkhir)) {
    $sql = "SELECT tanggal, COUNT(id) as total_transaksi, SUM(total) as total_pendapatan FROM transaksi 
        WHERE tanggal BETWEEN ? AND ?
        GROUP BY tanggal
        ORDER BY tanggal DESC";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$tglAwal,$tglAkhir);
        $stmt->execute();
        $transaksi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}else{
    $sql = "SELECT tanggal, COUNT(id) as total_transaksi, SUM(total) as total_pendapatan FROM transaksi 
        GROUP BY tanggal
        ORDER BY tanggal DESC";
    try {
        $result = $conn->query($sql);
        $transaksi = $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
$sql = "SELECT MONTH(tanggal) as bulan, SUM(total) as total_pendapatan FROM transaksi 
        GROUP BY MONTH(tanggal)
        ORDER BY MONTH(tanggal) ASC";
$result = $conn->query($sql);
$dataChart = $result->fetch_all(MYSQLI_ASSOC);
$nama=[
    1=>'januari',
    2=>'februari',
    3=>'maret',
    4=>'april',
    5=>'mei',
    6=>'juni',
    7=>'juli',
    8=>'agustus',
    9=>'september',
    10=>'oktober',
    11=>'november',
    12=>'desember',
];
$labels = [];
$dataTotal = [];
foreach ($dataChart as $row) {
   $labels[] = $nama[(int)$row['bulan']];
   $dataTotal[] = (int)($row['total_pendapatan']);
};
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporanExcel.xls");
?>
<?php if (empty($transaksi)): ?>
    <p style="margin-top: 1rem; color: #64748b;">Belum ada data transaksi.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>tanggal</th>
                <th>total transaksi</th>
                <th>total pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($transaksi as $row): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$row['tanggal']); ?></td>
                    <td><?= htmlspecialchars((string)$row['total_transaksi']); ?></td>
                    <td>Rp <?= number_format((float)$row['total_pendapatan'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
