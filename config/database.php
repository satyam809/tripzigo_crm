<?php 
ob_start();
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname =  "crm";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
date_default_timezone_set('Asia/Calcutta');
?>