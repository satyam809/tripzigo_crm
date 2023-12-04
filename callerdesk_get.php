<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";



if (isset($_GET['SourceNumber']) && $_GET['SourceNumber'] != "" && isset($_GET['DestinationNumber']) && $_GET['DestinationNumber'] != "" && isset($_GET['DialWhomNumber']) && $_GET['DialWhomNumber'] != "" && isset($_GET['CallDuration']) && $_GET['CallDuration'] != "" &&  isset($_GET['coins']) && $_GET['coins'] != "" && isset($_GET['Status']) && $_GET['Status'] != "" && isset($_GET['StartTime']) && $_GET['StartTime'] != "" && isset($_GET['EndTime']) && $_GET['EndTime'] != "" &&  isset($_GET['CallSid']) && $_GET['CallSid'] != "" && isset($_GET['CallRecordingUrl']) && $_GET['CallRecordingUrl'] != "" && isset($_GET['Direction']) && $_GET['Direction'] != "" && isset($_GET['campid']) && $_GET['campid'] != "" && isset($_GET['TalkDuration']) && $_GET['TalkDuration'] != "") {
    $sourceNumber = $_GET['SourceNumber'];
    $destinationNumber = $_GET['DestinationNumber'];
    $dialWhomNumber = $_GET['DialWhomNumber'];
    $callDuration = $_GET['CallDuration'];
    $coins = $_GET['coins'];
    $status = $_GET['Status'];
    $startTime = $_GET['StartTime'];
    $endTime = $_GET['EndTime'];
    $callSid = $_GET['CallSid'];
    $callRecordingUrl = $_GET['CallRecordingUrl'];
    $direction = $_GET['Direction'];
    $campid = $_GET['campid'];
    $talkDuration = $_GET['TalkDuration'];
    $callerdesk = 'sourceNumber="' . $sourceNumber . '",destinationNumber="' . $destinationNumber . '",dialWhomNumber="' . $dialWhomNumber . '",callDuration="' . $callDuration . '",coins="' . $coins . '",status="' . $status . '",startTime="' . $startTime . '", endTime="' . $endTime . '",callSid="' . $callSid . '",callRecordingUrl="' . $callRecordingUrl . '",direction="' . $direction . '",campid="' . $campid . '",talkDuration="' . $talkDuration . '"';
    // $sql_ins = "insert into callerdeskMaster set " . $callerdesk . "";
    // mysqli_query(db(), $sql_ins) or die(mysqli_error(db()));
    // print_r(mysqli_insert_id(db()));

    $inserted_id = addlistingCalldesk('callerdeskMaster', $callerdesk);
    if ($inserted_id) {
        echo json_encode(array('status' => 200, 'data' => "Data added successfully."));
        die;
    } else {
        echo json_encode(array('status' => 400, 'data' => "Calldesk id already exits."));
        die;
    }
} else {
    echo json_encode(array('status' => 400, 'data' => "Invalid Parameters.Please provide valid required data."));
    die;
}
