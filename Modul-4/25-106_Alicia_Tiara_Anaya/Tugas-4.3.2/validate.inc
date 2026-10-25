<?php 
// function validateName(&$errors, $field_list, $field_name)
// {
// 	$pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet) 
// 	if (!isset($field_list[$field_name]) ||
// 	empty($field_list[$field_name]))
// 		$errors[$field_name] = 'required';
// 	else if (!preg_match($pattern, $field_list[$field_name]))
// 		$errors[$field_name] = 'invalid';
// }


// soal 9
function validateName(&$errors, $field_list, $field_name) 
{
    $pattern = "/^[a-zA-Z'-]+$/"; 
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'invalid';
    }
}

function validateEmail(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'required';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'invalid email format';
    }
}

function validatePassword(&$errors, $field_list, $field_name, $min_length = 6) 
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'required';
    } else if (strlen($field_list[$field_name]) < $min_length) {
        $errors[$field_name] = 'must be at least ' . $min_length . ' characters';
    }
}

function validateAddress(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'required';
    }
}
function validateState(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '-1' || empty($field_list[$field_name])) {
        $errors[$field_name] = 'required';
    }
}
 ?>