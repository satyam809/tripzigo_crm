<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';


function promotional_messages(){
    $msg_30days_before_birthday = "SELECT CONCAT(sg.firstName, ' ', sg.lastName) AS name, sg.dob as dob, qm.phone as phone FROM sys_guests sg INNER JOIN queryMaster qm ON sg.queryId = qm.id WHERE MONTH(sg.dob) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND DAY(sg.dob) = DAY(DATE_SUB(NOW(), INTERVAL 1 MONTH)) ORDER BY sg.id DESC;";

    $result1 = mysqli_query(db(), $msg_30days_before_birthday);

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

        $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$cust_phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Hey+'.urlencode($cust_name).'+%21+%0A%F0%9F%8E%89+Guess+what%3F+%0A%F0%9F%8E%81+Your+birthday+is+just+around+the+corner%2C+and+we%27ve+got+something+special+planned+for+you%21+%0A%F0%9F%8C%9F+Tripzygo+is+gearing+up+to+surprise+you+with+an+amazing+booking+for+your+next+adventure%21+%E2%9C%88%EF%B8%8F%F0%9F%8F%A8+%0AGet+ready+for+a+fantastic+trip%21+%F0%9F%8C%8D%F0%9F%8E%82+Let+the+countdown+to+your+birthday+and+the+ultimate+travel+experience+begin%21+%F0%9F%9A%80+%0A%0A%23BirthdaySurprise+%23TravelWithTripzygo+%F0%9F%8E%8A%0A%0Awww.tripzygo.in';
        
        $curl1 = curl_init($msgReqURL1);
        curl_setopt($curl1, CURLOPT_POST, true);
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        $result1 = curl_exec($curl1);
        curl_close($curl1);
        echo "\n\ntest: ".$result1;
    }

    $msg_on_birthday = "SELECT CONCAT(sg.firstName, ' ', sg.lastName) AS name, sg.dob as dob, qm.phone as phone FROM sys_guests sg INNER JOIN queryMaster qm ON sg.queryId = qm.id WHERE MONTH(sg.dob) = MONTH(NOW()) AND DAY(sg.dob) = DAY(NOW()) ORDER BY sg.id DESC;";

    $result2 = mysqli_query(db(), $msg_on_birthday);

    $queries2 = array();
    while ($row = mysqli_fetch_assoc($result2)) {
        $queries2[] = $row;
    }
    
    echo '<pre>';
    print_r($queries2);

    foreach ($queries2 as &$row) {
        
        // $destinations = trim(preg_replace('/\s+/', ' ', $row['destination']));
        $cust_name = trim(preg_replace('/\s+/', ' ', $row['name']));
        $cust_phone = substr(str_replace(' ', '', $row['phone']), -10);
        $userid = '2000217680';
        $passwd = 'ksrcbmxS';

        $msgReqURL2 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$cust_phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Hey+'.urlencode($cust_name).'+%21+%0A%F0%9F%8E%89%F0%9F%8E%82+Happy+Birthday%21+%F0%9F%A5%B3%E2%9C%A8+%0AMay+your+day+be+filled+with+joy%2C+laughter%2C+and+amazing+moments%21+%0A%F0%9F%8E%81%F0%9F%8E%88+Guess+what%3F+Tripzygo+has+a+special+surprise+just+for+you+-+a+fantastic+booking+of+flight+and+hotel%21+%F0%9F%8C%8D%E2%9C%88%EF%B8%8F%F0%9F%8F%A8+%0AAnd+here%27s+the+cherry+on+top+-+book+today+to+avail+the+best+discount%21+%F0%9F%92%B0%F0%9F%91%8C+%0AGet+ready+for+an+unforgettable+adventure%21+%F0%9F%9A%80%F0%9F%8C%9F+Cheers+to+another+year+of+wonderful+experiences%21+%F0%9F%A5%82%F0%9F%8E%89+%0A%0A%23BirthdayJoy+%23TripzygoSurprise+%23BookToday+%F0%9F%8E%8A';
        
        $curl2 = curl_init($msgReqURL2);
        curl_setopt($curl2, CURLOPT_POST, true);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $result2 = curl_exec($curl2);
        curl_close($curl2);
        echo "\n\ntest: ".$result2;
    }

}

promotional_messages();

?>