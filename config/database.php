<?php
ob_start();
error_reporting(E_ALL); // Uncomment if you want to display errors for debugging
session_start();

function db()
{
    static $conn;
    if ($conn === NULL) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname =  "crm";
        $conn = mysqli_connect($servername, $username, $password, $dbname,3308);
    }
    return $conn;
}

date_default_timezone_set('Asia/Calcutta');

// // Check if the user is logged in and set a last activity time
// if (isset($_SESSION['userid']) && $_SESSION['userid'] != 1) {
//     // Set the last activity time (this can be a session variable or stored in a database)
//     $_SESSION['last_activity'] = time(); // Store the current timestamp
// }

// // Check if the last activity time exists and if it's past 11 PM
// if (isset($_SESSION['last_activity'])) {
//     $logout_time = strtotime('23:00:00'); // 11 PM
//     $current_time = time(); // Current timestamp

//     // Check if the current time is past 11 PM
//     if ($current_time > $logout_time) {
//         // Define $userId if needed
//         $userId = $_SESSION['userid']; // You may need to retrieve the user ID from your session storage

//         // Perform necessary database operations
//         $date = date('Y-m-d');
//         $checkoutTime = date('Y-m-d H:i:s');
//         mysqli_query(db(), "UPDATE userLogs SET checkoutTime = '$checkoutTime' WHERE userid = '$userId' AND DATE(cLogin) = '$date'");

//         // Perform logout operations
//         unset($_SESSION['userid']); // Unset the user session or perform other logout operations
//         session_unset();
//         session_destroy();

//         // Redirect to the login page or display a message
//         header("Location: login.php");
//         exit;
//     }
// }


