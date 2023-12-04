<?php
echo "hello world";
// exit;
include "inc.php";
// include "config/mail.php";

// date_default_timezone_set('Asia/Calcutta');
// require 'vendor/autoload.php';
$id = intval($_GET['queryid']);
$id = $id - 100000;
$assignedToId = $_GET['assignedToId'];
if ($assignedToId !== 1) {
    $userid = '2000217680';
    $passwd = 'ksrcbmxS';
    $supportTeam = '8544811103';
    
    $queryString1 = "SELECT qM.phone as phone, qM.name as clientName, cM.name as destination, concat(suM.firstName,' ',suM.lastName) as agentname, suM.phone as agentphone, suM.mobile as agentmobile FROM `queryMaster` qM join `cityMaster` cM on qM.destinationId = cM.id join `sys_userMaster` suM on qM.assignTo = suM.id where qM.id = ". $id;

    $queryString2 = "SELECT * from sys_userMaster where id = ". $assignedToId;

    $result1 = mysqli_query(db(), $queryString1);
    $result2 = mysqli_query(db(), $queryString2);

    // $queries1 = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $queries1 = $row;
    }

    while ($row = mysqli_fetch_assoc($result2)) {
        $queries2 = $row;
    }
    
    // echo '<pre>';
    // print_r($queries1);

    $phone = $queries1['phone'];
    $clientName = $queries1['clientName'];
    $agentname = $queries2['firstName'].' '.$queries2['lastName'];
    $agentphone = $queries2['phone'];
    $agentmobile = $queries2['mobile'];

    if($agentmobile != ''){
        $agentphone = $agentmobile;
    }

    $destination = $queries1['destination'];

    $msgReqURL = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Dear+'.urlencode($clientName).'%2C%0A%0AThank+you+for+contacting+us%21+Our+travel+buddy+'.urlencode($agentname).'+will+contact+you+shortly%21%F0%9F%98%87%0A%0AYou+can+also+reach+out+to+our+travel+buddy%21+%F0%9F%93%9E+%0A%0A%2ATravel+Buddy%2A%3A+%2A'.urlencode($agentname).'%2A+%0A%2AContact+Details%2A%3A++%2A'.$agentphone.'%2A+%0A%0ABe+Ready+To+Save+Huge+On+Flights+%E2%9C%88%EF%B8%8F%2C+Stays+%F0%9F%8F%A8%2C++Holiday+%F0%9F%9B%84%2C+%26+Cabs+for+your+next+trip+to+'.urlencode($destination).'+%F0%9F%9A%95%0A%0APlan+Your+Trip+with+Us+Now%21%F0%9F%98%89';
            
    $curl1 = curl_init($msgReqURL);
    curl_setopt($curl1, CURLOPT_POST, true);
    curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
    $result1 = curl_exec($curl1);
    curl_close($curl1);
    // echo "\n\ntest: ".$result1;
}
?>