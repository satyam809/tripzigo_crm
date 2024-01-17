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
        $amount = $queries1['amount'];
        $paymentDate = $queries1['paymentDate'];
        $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
        $queryData = mysqli_fetch_array($fd);

        $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
        $userDetail = mysqli_fetch_array($rsa);

        $rs = GetPageRecord('*', 'sys_userMaster', 'id ="' . $queryData['assignTo'] . '"');

        echo "hello world";
        $sellerDetails = mysqli_fetch_array($rs);
        $sellerEmail = $sellerDetails['email'];
        $userPhone = $queryData['phone'];
        $userName = $queryData['name'];
        

        // Create a DateTime object from the given string
        $dateObject = new DateTime($paymentDate);
        
        // Format the date as "dd-mm-yyyy"
        $formattedDate = $dateObject->format('d-m-Y');
        
        echo '<pre>';
        print_r($sellerEmail);
        print_r($userPhone);
        print_r($amount);

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
        
        $userid = '2000217680';
        $passwd = 'ksrcbmxS';
        // $supportTeam = '8544811103';
        
        $indianCurrencyFormat = number_format($amount, 2, '.', ',');
        print_r($indianCurrencyFormat);

        // $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$userPhone.'&v=1.1&format=json&msg_type=IMAGE&method=SENDMEDIAMESSAGE&caption=Hi+'.urlencode($userName).'%21+%0A%0A%F0%9F%8C%BBHope+you+are+doing+well+%F0%9F%8C%BBJust+a+heads+up+about+your+upcoming+payment%F0%9F%94%94+for+Booking+ID+'.encode($queryId).'.+Your+next+installment+of+INR+'.$indianCurrencyFormat.'+is+due+on+'.urlencode($formattedDate).'.+%E2%8C%9APlease+ensure+timely+payment+to+avoid+any+disruptions+or+any+further+potential+booking+cancellations.%F0%9F%95%90+%0A%E2%9C%85Feel+free+to+use+the+attached+QR+code+for+a+swift+transaction.%0A%F0%9F%93%A7For+more+detailed+info%2C+check+your+email.%F0%9F%93%A7%0A%E2%98%8EIn+case+of+any+query+%E2%80%93+feel+free+to+connect%E2%98%8E%0A%0AThanks+%26+Regards%0A%E2%9C%88Tripzygo+International%E2%9C%88&media_url=https%3A%2F%2Fwww.tripzygo.in%2FQRCode.jpeg';
        
        // $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$userPhone.'&v=1.1&format=json&msg_type=IMAGE&method=SENDMEDIAMESSAGE&caption=Hi+'.urlencode($userName).'%21+%0A%0A%F0%9F%8C%BBHope+you+are+doing+well+%F0%9F%8C%BBJust+a+heads+up+about+your+upcoming+payment%F0%9F%94%94+for+Booking+ID+'.encode($queryId).'.+%2AYour+next+installment+of+INR+'.$indianCurrencyFormat.'+is+due+on+'.urlencode($formattedDate).'.%2A+%0A%E2%8C%9APlease+ensure+timely+payment+to+avoid+any+disruptions+or+any+further+potential+booking+cancellations.%F0%9F%95%90+%0A%E2%9C%85Feel+free+to+use+the+attached+QR+code+for+a+swift+transaction.%0A%F0%9F%93%A7For+more+detailed+info%2C+check+your+email.%F0%9F%93%A7%0A%E2%98%8EIn+case+of+any+query+%E2%80%93+feel+free+to+connect%E2%98%8E%0A%0AThanks+%26+Regards%0A%E2%9C%88Tripzygo+International%E2%9C%88&media_url=https%3A%2F%2Fwww.tripzygo.in%2FQRCode.jpeg';
        $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$userPhone.'&v=1.1&format=json&msg_type=IMAGE&method=SENDMEDIAMESSAGE&caption=Hi+'.urlencode($userName).'%21+%0A%0A%F0%9F%8C%BBHope+you+are+doing+well+%F0%9F%8C%BBJust+a+heads+up+about+your+upcoming+payment%F0%9F%94%94+for+Booking+ID+'.encode($queryId).'.+%2AYour+next+installment+of+INR+'.$indianCurrencyFormat.'+is+due+on+'.urlencode($formattedDate).'.%2A+%0A%E2%8C%9APlease+ensure+timely+payment+to+avoid+any+disruptions+or+any+further+potential+booking+cancellations.%F0%9F%95%90+%0A%E2%9C%85Feel+free+to+use+the+attached+QR+code+for+a+smooth+transaction.%0A%F0%9F%93%A7For+more+detailed+info%2C+check+your+email.%F0%9F%93%A7%0A%E2%98%8EIn+case+of+any+query+%E2%80%93+feel+free+to+connect%E2%98%8E%0A%0AThanks+%26+Regards%0A%E2%9C%88Tripzygo+International%E2%9C%88&media_url=https%3A%2F%2Fwww.tripzygo.in%2FQRCode.jpeg';
        echo $msgReqURL1;
        
        $curl1 = curl_init($msgReqURL1);
        curl_setopt($curl1, CURLOPT_POST, true);
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        $result2 = curl_exec($curl1);
        curl_close($curl1);
        echo "\n\ntest: ".$result2;
    }
    
    // echo '<pre>';
    // print_r($queries1);
    // echo '</pre>';

}

paymentReminderBefore2Days();

?>