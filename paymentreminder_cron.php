<?php

include "inc.php";
// include "config/mail.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';


function paymentReminderBefore2Days(){
    $query1 = "SELECT * FROM `sys_PackagePayment` WHERE paymentStatus = 2 AND DATE(paymentDate) = CURDATE() + INTERVAL 2 DAY ORDER BY `id` DESC;";
    
    $result1 = mysqli_query(db(), $query1);
    echo '<pre>';
    print_r($result1);
    $queries1 = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        print_r($row);
        $queries1 = $row;
        $queryId = $queries1['queryId'];
        $packageId = $queries1['packageId'];

        $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
        $queryData = mysqli_fetch_array($fd);

        $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
        $userDetail = mysqli_fetch_array($rsa);

        $rs = GetPageRecord('*', 'sys_userMaster', 'id ="' . $queryData['assignTo'] . '"');

        echo "hello world";
        $sellerDetails = mysqli_fetch_array($rs);
        $sellerEmail = $sellerDetails['email'];
        echo '<pre>';
    print_r($sellerEmail);

        $subject = 'Payment Plan (via Tripzygo International)';

        $mailbody = file_get_contents('https://tripzygo.travel/crm/' . 'packagePaymentLink.php?pid=' . encode($packageId) . '&qid=' . encode($queryId) . '&shal=1');
        echo '<pre>';
    print_r($mailbody);


        include "config/mail.php";
        $ccmail = 'accounts@tripzygo.in, ' . $sellerEmail;
        $file_name = 'QRCode.jpeg';
        send_attachment_mail('info@tripzygo.in', $userDetail['email'], stripslashes($subject), stripslashes($mailbody), $ccmail, $file_name);



        $namevalue2 = 'sendPaymentPlanDate="' . date('Y-m-d H:i:s') . '"';
        $where = 'id="' . $queryId . '"';
        updatelisting('queryMaster', $namevalue2, $where);
    }
    
    // echo '<pre>';
    // print_r($queries1);
    // echo '</pre>';

}

paymentReminderBefore2Days();

?>