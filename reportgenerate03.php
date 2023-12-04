<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';


function tomorrowTours(){
    $query1 = "SELECT 
        spB.name,
        spB.confirmedBy as agent_id,
        CONCAT(s_uM.firstname, ' ', s_uM.lastname) AS agent_name,
        s_uM.phone as agent_phone,
        s_uM.mobile as agent_mobile,
        spB.startDate as startDate,
        spB.destinations as destinations,
        spB.days as trip_days,
        qM.name as cust_name,
        qM.email as eMail,
        qM.phone as cust_phone
    FROM `sys_packageBuilder` spB
    inner join `queryMaster` qM on spB.queryId = qM.id 
    inner join `sys_userMaster` s_uM on s_uM.id = spB.confirmedBy
    where 
        spB.confirmQuote = 1 
        and qM.statusId = 5 
        and spB.startDate = CURDATE() + INTERVAL 1 DAY
    order by qM.id desc;";

    // echo "\n\ntest: ".$query1;
    
    $result1 = mysqli_query(db(), $query1);

    $queries1 = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $queries1[] = $row;
    }
    
    echo '<pre>';
    print_r($queries1);
    // echo '</pre>';

    foreach ($queries1 as &$row) {
        
        $agent_id = $row['agent_id'];
        // $agent_phone = substr(str_replace(' ', '','97171 35620'),-10);
        $agent_phone = substr(str_replace(' ', '', $row['agent_phone']),-10);
        $agent_mobile = substr(str_replace(' ','', $row['agent_mobile']), -10);
        if($agent_mobile == ''){
            $agent_mobile = $agent_phone;
        }
        $agent_name = trim(preg_replace('/\s+/', ' ', $row['agent_name']));
        $startDate = $row['startDate'];
        $destinations = trim(preg_replace('/\s+/', ' ', $row['destinations']));
        $trip_days = $row['trip_days'];
        $cust_name = trim(preg_replace('/\s+/', ' ', $row['cust_name']));
        $eMail = $row['eMail'];
        $cust_phone = substr(str_replace(' ', '', $row['cust_phone']), -10);
        $userid = '2000217680';
        $passwd = 'ksrcbmxS';
        $supportTeam = '8544811103';

        $msgReqURL1 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$cust_phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Hi+%2A'.urlencode($cust_name).'%2A%2C%0A%0AWe+hope+you%27re+all+set+for+your+long-awaited+journey+to+%2A'.urlencode($destinations).'%2A%21+%F0%9F%98%8D%0A%0AIn+case+of+any+queries%2C+feel+free+to+contact+your+travel+buddy+%2A'.urlencode($agent_name).'%2A+%28%2A'.$agent_mobile.'%2A%29+or+our+support+team+on+%2A'.$supportTeam.'%2A.+%F0%9F%93%9E%0A%0AWishing+you+an+unforgettable+trip%21+Safe+travels%21+%E2%9C%88%EF%B8%8F%F0%9F%8C%9F&isTemplate=true&footer=Have+a+memorable+trip+ahead';
        
        $msgReqURL2 = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$agent_mobile.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Hi+%2A'.urlencode($cust_name).'%2A%2C%0A%0AWe+hope+you%27re+all+set+for+your+long-awaited+journey+to+%2A'.urlencode($destinations).'%2A%21+%F0%9F%98%8D%0A%0AIn+case+of+any+queries%2C+feel+free+to+contact+your+travel+buddy+%2A'.urlencode($agent_name).'%2A+%28%2A'.$agent_mobile.'%2A%29+or+our+support+team+on+%2A'.$supportTeam.'%2A.+%F0%9F%93%9E%0A%0AWishing+you+an+unforgettable+trip%21+Safe+travels%21+%E2%9C%88%EF%B8%8F%F0%9F%8C%9F&isTemplate=true&footer=Have+a+memorable+trip+ahead';

        $curl1 = curl_init($msgReqURL1);
        curl_setopt($curl1, CURLOPT_POST, true);
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        $result1 = curl_exec($curl1);
        curl_close($curl1);
        echo "\n\ntest: ".$result1;
        
        $curl2 = curl_init($msgReqURL2);
        curl_setopt($curl2, CURLOPT_POST, true);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $result2 = curl_exec($curl2);
        curl_close($curl2);
        echo "\n\ntest: ".$result2;

    }
}

tomorrowTours();

?>