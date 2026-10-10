<?php 
// point 2.1
$fruits = array("Avocado", "Blueberry", "Cherry");
for($x=1; $x<=5; $x++) {
	$fruits[] = "Buah tambahan " . $x;
}
echo "Panjang array saat ini: " . count($fruits) . "<br><br>";
$arrlenght = count($fruits);

for($x=0; $x<$arrlenght; $x++) {
	echo $fruits[$x];
	echo "<br>";
}

// 2.2
echo "<br>";
$vegies = array("Carrot", "Broccoli", "Spinach");
$arrlenght = count($vegies);
for($x=0; $x<$arrlenght; $x++) {
	echo $vegies[$x];
	echo "<br>";
}
 ?>