<?php 
// point 1.1
$fruits = array("Avocado", "Blueberry", "Cherry");
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "fruits = ( ";
for($i=0; $i<count($fruits); $i++) {
	echo '"' . $fruits[$i] . '"';
	if($i<count($fruits)-1) {
		echo ", ";
	}
}
echo " )<br>";
$indeksT = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeksT] . "<br>";

// 1.2
echo "<br>";
echo "Data ". $fruits[1] . " dihapus <br>";
unset($fruits[1]);

$fruits = array_values($fruits);
echo "fruits = ( ";
for($i=0; $i<count($fruits); $i++) {
	echo '"' . $fruits[$i] . '"';
	if($i<count($fruits)-1) {
		echo ", ";
	}
}
echo " )<br>";
$indeksT = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeksT];
 ?>