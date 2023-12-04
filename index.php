<?php
include "inc.php";
include "config/logincheck.php";
if ($_SESSION['userid'] == '' || $_SESSION['username'] == '') {
   header("Location: login.html");
   exit();
}

if ($_REQUEST['queryTaskId'] != ''){
    $_SESSION['queryTaskId'] = $_REQUEST['queryTaskId'];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($_SESSION['queryTaskId']);
    exit;
}

if ($LoginUserDetails['qrCode'] != $LoginUserDetails['verifyQrCode']) {
   header("Location: login.html");
   exit();
}

$namevalue = 'onlineStatus=2,onlineSessionDate="' . date('Y-m-d H:i:s') . '"';
$where = 'id="' . $_SESSION['userid'] . '" and is_scheduled="no"';
updatelisting('sys_userMaster', $namevalue, $where);



$naviactive = 'da';
$pageselect = '';


if ($pageselect == '') {
   $pageselect = 00;
}


if ($_REQUEST['ga'] == 'itineraries') {
   $selectedmenu = 2;
}

if ($_REQUEST['ga'] == 'clients') {
   $selectedmenu = 3;
}

if ($_REQUEST['ga'] == 'query') {
   $selectedmenu = 4;
}

if ($_REQUEST['ga'] == 'suppliers') {
   $selectedmenu = 5;
}

if ($_REQUEST['ga'] == 'CollectionReport') {
   $selectedmenu = 6;
}

if ($_REQUEST['ga'] == 'inbox') {
   $selectedmenu = 7;
}

if ($_REQUEST['ga'] == 'collection') {
   $selectedmenu = 8;
}

if ($_REQUEST['ga'] == 'taggings') {
   $selectedmenu = 9;
}

$pageurl = 'dashboard.php';


if ($_REQUEST['ga'] != '') {

   $topPageName = $moduledetails['name'];

   $addpage = '';
   if ($_REQUEST['add'] == 1) {
      $addpage = 'add_';
   }

   if ($_REQUEST['view'] == 1) {
      $addpage = 'view_';
   }



   $pageurl = $addpage . $_REQUEST['ga'] . '.php';
   echo $pageurl;
}


if ($_REQUEST['ga'] == 'setting') {
   $pageurl = 'companysetting.php';
}

if ($_REQUEST['ga'] == 'myprofile') {
    $pageurl = 'my_profile.php';
}

if (isset($_SESSION['userid'])) {
    if (time() - $_SESSION["login_time_stamp"] > 43200) {
        header("Location: logoutpage.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
   <title><?php echo $clientnameglobal; ?></title>
   <?php include "headerinc.php"; ?>

</head>

<body>
   <?php include "header.php"; ?>

   <?php include $pageurl; ?>
   <?php include "footer.php"; ?>

</body>

</html>
