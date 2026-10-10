<?php 
// array push
$a = ["A"];
echo 'Array awal: "A"<br>';
array_push($a, 'B');
echo 'Hasil array_push: ' . $a[0] . ' ' . $a[1] . '<br><br>';

// array merge
$b = ['A', 'B'];
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$b1 = ['C'];
$hasil = array_merge($b, $b1);
echo 'Hasil array_merge: ' . $hasil[0] . ' ' . $hasil[1] . ' ' . $hasil[2] . '<br><br>';

// array values
$v = ["x" => 1, "y" => 2];
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$hasil1 = array_values($v);
echo 'Hasil array_values: ' . $hasil1[0] . ' ' . $hasil1[1] . '<br><br>';

// array search
$c = ["A", "B", "C"];
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
$cari = array_search("B", $c);
echo 'Hasil array_search: ' . $cari . "<br><br>";

// array filter
$d = [0, 1, false, 2, "", 3, "array"];
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$hasil2 = array_filter($d);
echo 'Hasil array_filter: ';
foreach($hasil2 as $pe) {
	echo $pe . ' ';
}

// sorting
$e = [3, 1, 2];
echo 'Array awal: (3, 1, 2)<br>';
$pendek = $e;
sort($pendek);
echo 'Hasil sort: ' . $pendek[0] . ' '. $pendek[1] . ' ' . $pendek[2] . '<br>';

$rpendek = $e;
rsort($rpendek);
echo 'Hasil rsort: ' . $rpendek[0] . ' '. $rpendek[1] . ' ' . $rpendek[2] . '<br>';

// 4 sort
$umur = ["Peter"=>35, "Ben"=>37, "Joe"=>43];
echo '<br>Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)';

// asort
$as = $umur;
asort($as);
echo '<br>Hasil asort: ';
$itung = 0;
foreach($as as $a1 => $a2) {
	echo $a1 . '=>' . $a2;
	$itung++;
	if($itung < count($as)) echo ', ';
}

// ksort
$k = $umur;
ksort($k);
echo '<br>Hasil ksort: ';
$itung = 0;
foreach($k as $a1 => $a2) {
	echo $a1 . '=>' . $a2;
	$itung++;
	if($itung < count($k)) echo ', ';
}

// arsort
$ar = $umur;
arsort($ar);
echo '<br>Hasil ksort: ';
$itung = 0;
foreach($ar as $a1 => $a2) {
	echo $a1 . '=>' . $a2;
	$itung++;
	if($itung < count($ar)) echo ', ';
}

// krsort
$kr = $umur;
krsort($kr);
echo '<br>Hasil ksort: ';
$itung = 0;
foreach($kr as $a1 => $a2) {
	echo $a1 . '=>' . $a2;
	$itung++;
	if($itung < count($kr)) echo ', ';
}
 ?>