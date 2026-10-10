<?php 
// 3.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is " . $height['Andy']. " cm tall";
echo "<br>";
$height['David'] = "180";
$height['Ethan'] = "172";
$height['Frank'] = "168";
$height['George'] = "175";
$height['Harry'] = "182";

echo "height = ( ";
$count = 0;
$total = count($height);
foreach($height as $nama => $tinggi) {
	echo '"' . $nama . '"=>"' . $tinggi . '"';
	$count++;
	if($count < $total) {
		echo ", ";
	}
}
echo " )<br>";
$nilait = "";
foreach($height as $nama => $tinggi) {
	$nilait = $tinggi;
}
echo "Nilai dengan indeks terakhir: " . $nilait . "<br><br>";

unset($height['Barry']);
echo "height = ( ";
$count = 0;
$total = count($height);
foreach($height as $nama => $tinggi) {
	echo '"' . $nama . '"=>"' . $tinggi . '"';
	$count++;
	if($count < $total) {
		echo ", ";
	}
}
echo " )<br>";
$nilait = "";
foreach($height as $nama => $tinggi) {
	$nilait = $tinggi;
}
echo "Nilai dengan indeks terakhir setelah dihapus: " . $nilait . "<br><br>";

// 3.2
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo "weight = ( ";
$count = 0;
$total = count($weight);
foreach($weight as $nama => $tinggi) {
	echo '"' . $nama . '"=>"' . $tinggi . '"';
	$count++;
	if($count < $total) {
		echo ", ";
	}
}
echo " )<br>";
echo "Data kedua: " . $weight['Barry'];
 ?>