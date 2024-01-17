<?php
include "inc.php";
error_reporting(0);

// Destroy the cookies
setcookie("username", '', time() - 3600);
setcookie("password", '', time() - 3600);

// Start the session
session_start();

if (isset($_SESSION['userid'])) {
    if ($_SESSION['userid'] == 1) {
        updatelisting('sys_userMaster', 'onlineStatus=0', 'id="' . $_SESSION['userid'] . '"');
    } else {
        // Get the user ID from the session and delete all related active sessions
        $userId = mysqli_real_escape_string(db(), $_SESSION['userid']);
        $sql = "DELETE FROM active_sessions WHERE user_id = '$userId'";
        
        // Update the checkoutTime in userLogs
        $date = date('Y-m-d');
        $checkoutTime = date('Y-m-d H:i:s');
       // echo "UPDATE userLogs SET checkoutTime ='$checkoutTime' WHERE user_id = '$userId' AND DATE(cLogin) = '$date'";die;
        mysqli_query(db(), "UPDATE userLogs SET checkoutTime = '$checkoutTime' WHERE userid = '$userId' AND DATE(cLogin) = '$date'");
        
        // Execute the DELETE query
        $result = mysqli_query(db(), $sql);

        if ($result === false) {
            // Log the error or display a generic message to the user
            echo "Error: Unable to log out. Please try again later.";
            exit;
        }
    }

    // Clear all session variables
    $_SESSION = array();
    session_unset();
    session_destroy();
}

// Redirect to the login page
header('Location: login.html');
exit;
?>
