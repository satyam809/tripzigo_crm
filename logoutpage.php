<?php 
include "inc.php";  
error_reporting(0);   
setcookie("username", '', time() -3600);
setcookie("password", '', time() -3600);
updatelisting('sys_userMaster','onlineStatus=0','id="'.$_SESSION['userid'].'"');
unset($_SESSION['sessionid']); 
unset($_SESSION['username']); 
unset($_SESSION['manualVoucherPin']);
session_destroy(); 
header('Location: login.html'); 
exit;  
?>
