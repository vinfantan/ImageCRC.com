<?php
require ($_SERVER['DOCUMENT_ROOT'].'/cropimagesign/config/constants.php');
// require 'constants.php';
 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conn->connect_error){
	die('Database error:'.$conn->connect_error);
	echo "success";
}

