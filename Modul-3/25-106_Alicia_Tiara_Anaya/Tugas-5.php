<?php 
$mhs = [['Alex', 220401, '0812345678'], ['Bianca', 220402, '0812345687'], ['Candice', 220403, '0812345665']];
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>NIM</th>';
echo '<th>Mobile</th>';
echo '</tr>';

for ($i=0; $i<count($mhs); $i++) {
	echo '<tr>';
	echo '<td>' . $mhs[$i][0] . '</td>';
	echo '<td>' . $mhs[$i][1] . '</td>';
	echo '<td>' . $mhs[$i][2] . '</td>';
	echo '</tr>';
}
echo '</table>';
echo "Data awal: <br>";
echo 'students = (<br>';
for($i=0; $i<count($mhs); $i++) {
	echo '("' . $mhs[$i][0] . '", "' . $mhs[$i][1] . '", "' . $mhs[$i][2] . '")';
	if ($i<count($mhs)-1) {
		echo ", <br>";
	} 
}
echo "<br>)<br><br>";
$mhs[] = ['Daniel', 220404, '0812345611'];
$mhs[] = ['Elena', 220405, '0812345622'];
$mhs[] = ['Fiona', 220406, '0812345633'];
$mhs[] = ['Gabe', 220407, '0812345644'];
$mhs[] = ['Hannah', 220408, '0812345655'];
echo "Data setelah ditambah 5 data lain:<br>";
echo 'students = (<br>';
for($i=0; $i<count($mhs); $i++) {
	echo '("' . $mhs[$i][0] . '", "' . $mhs[$i][1] . '", "' . $mhs[$i][2] . '")';
	if ($i<count($mhs)-1) {
		echo ", <br>";
	} 
}
echo "<br>)<br>";

echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>NIM</th>';
echo '<th>Mobile</th>';
echo '</tr>';

for ($i=0; $i<count($mhs); $i++) {
	echo '<tr>';
	echo '<td>' . $mhs[$i][0] . '</td>';
	echo '<td>' . $mhs[$i][1] . '</td>';
	echo '<td>' . $mhs[$i][2] . '</td>';
	echo '</tr>';
}
echo '</table>';
 ?>