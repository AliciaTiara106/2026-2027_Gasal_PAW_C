<?php 
// 4.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
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
echo " )<br><br>";

echo "Andy is " . $height['Andy']. " cm tall<br>";
echo "Barry is " . $height['Barry']. " cm tall<br>";
echo "Charlie is " . $height['Charlie']. " cm tall<br>";
echo "David is " . $height['David']. " cm tall<br>";
echo "Ethan is " . $height['Ethan']. " cm tall<br>";
echo "Frank is " . $height['Frank']. " cm tall<br>";
echo "George is " . $height['George']. " cm tall<br>";
echo "Harry is " . $height['Harry']. " cm tall<br><br>";

// 4.2
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
echo " )<br><br>";
echo "Andy is " . $weight['Andy']. " kg<br>";
echo "Barry is " . $weight['Barry']. " kg<br>";
echo "Charlie is " . $weight['Charlie']. " kg<br>";
 ?>