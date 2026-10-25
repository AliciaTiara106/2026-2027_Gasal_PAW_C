<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		body { margin: 20px; Courier, monospace; }
	    pre { font-family: "Courier New", Courier, monospace; font-weight: bold; font-size: 14px; margin: 0; }
        h3 { font-family: Arial, sans-serif; }
	</style>
</head>
<body>
	<h3>Posted data: </h3>
	<?php
	foreach ($_POST as $key => $value)
	    echo "($key) => ($value)<br />";

	// $surname = $_POST['surname'];
	?>
</body>
</html>