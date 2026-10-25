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
// pengujian soal 3
	// require 'validate.inc';
    // if (validateName($_POST, 'surname')) {
    // 	echo 'Data OK!';
    // } else {
    // 	echo 'Data invalid!';
    // }


// soal 5
   	// $errors = array();
	// if (isset($_POST['surname']))
	// {
	// 	require 'validate.inc';
	// validateName($errors, $_POST, 'surname');
	// if ($errors)
	// {
	// 	echo '<h1>Invalid, correct the following errors:</h1>';
	// foreach ($errors as $field => $error)
	// 	echo "$field $error</br>";
	// // tampilkan kembali form
	// 	include 'form.inc';
	// }
	// else {
	// 	echo 'Form submitted successfully with no errors';
	// } } else
	// // tampilkan kembali form
	// 	include 'form.inc';
 	
// Soal 9
	$errors = array();

	if (isset($_POST['surname'])) {
	    require 'validate.inc';

	    validateName($errors, $_POST, 'surname');
	    validateEmail($errors, $_POST, 'email');
	    validatePassword($errors, $_POST, 'passwd');
	    validateAddress($errors, $_POST, 'address');
	    validateState($errors, $_POST, 'state');
	    
	    if ($errors) {
	        echo '<h1>Invalid, correct the following errors:</h1>';
	        echo '<ul>';
	        foreach ($errors as $field => $error) {
	            echo "<li><strong>$field</strong>: $error</li>";
	        }
	        echo '</ul>';

	        include 'form.inc'; 
	    } else {
	        echo '<h1>Form submitted successfully with no errors</h1>';
	    }
	} else {
	    include 'form.inc';
	}
 	?>
</body>
</html>