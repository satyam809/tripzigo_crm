<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';


function promotional_messages(){
    $trip_end_feedback_2days = "SELECT name, phone, endDate FROM `queryMaster` WHERE endDate = DATE_SUB(DATE(NOW()), INTERVAL 2 DAY) ORDER BY `id` DESC;";

    $result1 = mysqli_query(db(), $trip_end_feedback_2days);

    $queries1 = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $queries1[] = $row;
    }
    
    echo '<pre>';
    print_r($queries1);

    foreach ($queries1 as &$row) {
        
        // $destinations = trim(preg_replace('/\s+/', ' ', $row['destination']));
        $cust_name = trim(preg_replace('/\s+/', ' ', $row['name']));
        $cust_phone = substr(str_replace(' ', '', $row['phone']), -10);
        $userid = '2000217680';
        $passwd = 'ksrcbmxS';

        $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$cust_phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Dear+'.urlencode($cust_name).'%0A%0A%F0%9F%8C%9F+We+hope+you+had+an+amazing+trip+with+Tripzygo%21+%F0%9F%9A%80+%0AYour+feedback+means+the+world+to+us%2C+and+we%27d+be+thrilled+if+you+could+take+a+moment+to+share+your+experience+by+giving+us+a+5-star+rating%21+%E2%AD%90%E2%AD%90%E2%AD%90%E2%AD%90%E2%AD%90+%0AYour+support+helps+us+continue+providing+top-notch+service+to+travelers+like+you.+%F0%9F%99%8F+%0AThank+you+in+advance+for+your+kind+review%21+%F0%9F%8C%8D%E2%9C%88%EF%B8%8F%0A%0A+%23HappyTravels+%23FiveStarExperience+%F0%9F%8C%9F%0A%0ATripzygo+International+%21&isTemplate=true';
        
        $curl1 = curl_init($msgReqURL1);
        curl_setopt($curl1, CURLOPT_POST, true);
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        $result1 = curl_exec($curl1);
        curl_close($curl1);
        echo "\n\ntest: ".$result1;
    }

}

promotional_messages();

?>