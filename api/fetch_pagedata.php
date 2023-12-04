<?php

include "../config/database.php";
include "../config/function.php";
include "../config/setting.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');


$where = ' where ' . '1 and 1 order by id desc'. '  ';
$page = clean($_GET['page']);
$sNo = 1;

$rs = GetRecordList('*', 'queryMaster', '   ' . $where . '  ', '25', $page, null);

$totalentry = $rs[1];
$paging = $rs[2];
$data_items = array(); // Initialize the data_items array
$lead_id ='';
$active_id='';
$active_agent='';
$no_connect_id='';
$no_connect_agent='';
$follow_up_id='';
$follow_up_agent='';
$postponed_id='';
$postponed_agent='';
$proposal_send_id='';
$proposal_send_agent='';
$changes_id='';
$changes_agent='';
$hot_lead_id='';
$hot_lead_agent='';
$confirmed_id='';
$confirmed_agent='';
$canceled_id='';
$cancel_agent='';
$active_id='';
$active_agent='';
$no_connect_id='';
$no_connect_agent='';
$follow_up_id='';
$postponed_id='';
$proposal_send_id='';
$changes_id='';
function getAgentName($userId) {
    if ($userId != 0) {
        $agentData = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $userId . '"');
        $agentNames = mysqli_fetch_array($agentData);
        return $agentNames['firstName'] . ' ' . $agentNames['lastName'] ?? null;
    }
    return '-';
}


while ($rest = mysqli_fetch_array($rs[0])) {
    $b = GetPageRecord('*', 'userMaster', 'id="' . $rest['clientId'] . '"');

    $clientData = mysqli_fetch_array($b);
    $dates=GetPageRecord('*','queryLogs',' queryId="'.$rest['id'].'"');
    while ($leadDates = mysqli_fetch_array($dates)) {
        if ($leadDates['details'] == 'Query Created') {
            $leadCreationDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
        } elseif ($leadDates['details'] == 'Query Status Changed: Active') {
            $activeDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $activeAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: No Connect') {
            $noConnectDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $noConnectAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Follow Up') {
            $followUpDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $followUpAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Postponed') {
            $postponedDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $postponedAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Proposal Sent') {
            $proposalSendDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $proposalSendAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Changes') {
            $changesDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $changesAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Hot Lead') {
            $hotLeadDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $hotLeadAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Confirmed') {
            $confirmedDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $confirmedAgent = getAgentName($leadDates['userId']);
        } elseif ($leadDates['details'] == 'Query Status Changed: Cancelled') {
            $cancelledDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            $cancelledAgent = getAgentName($leadDates['userId']);
        }
    }
    $clientName = isset($clientData['submitName']) ? stripslashes($clientData['submitName']) : '';
    $clientName .= isset($clientData['firstName']) ? ' ' . stripslashes($clientData['firstName']) : '';
    $clientName .= isset($clientData['lastName']) ? ' ' . stripslashes($clientData['lastName']) : '';

    $leadCreationDate = ($rest['id'] == $lead_id) ? date('d-m-Y', strtotime($lead_creation_date)) : '-';
    $activedate = ($rest['id'] == $active_id) ? date('d-m-Y', strtotime($active_date)) : '-';
    $agent_active = ($active_agent != '') ? $active_agent : '-';
    $noconnectdate = ($rest['id'] == $no_connect_id) ? date('d-m-Y', strtotime($no_connect_date)) : '-';
    $noconnectagent = ($no_connect_agent != '') ? $no_connect_agent : '-';
    $follow_up_date = ($rest['id'] == $follow_up_id) ? date('d-m-Y', strtotime($follow_up_date)) : '-';
    $follow_up_agent = ($follow_up_agent != '') ? $follow_up_agent : '-';
    $postponed_date = ($rest['id'] == $postponed_id) ?  date('d-m-Y', strtotime($postponed_date)) : '-';
    $postponed_agent = ($postponed_agent != '') ?  $postponed_agent : '-';
    $proposal_send_date = ($rest['id'] == $proposal_send_id) ?  date('d-m-Y', strtotime($proposal_send_date)) : '-';
    $proposal_send_agent = ($proposal_send_agent != '') ?  $proposal_send_agent : '-';
    $changes_date = ($rest['id'] == $changes_id) ?  date('d-m-Y', strtotime($changes_date)) : '-';
    $changes_agent = ($changes_agent != '') ?  $changes_agent : '-';
    $hot_lead_date = ($rest['id'] == $hot_lead_id) ?  date('d-m-Y', strtotime($hot_lead_date)) : '-';
    $hot_lead_agent = ( $hot_lead_agent != '') ?  date('d-m-Y', strtotime($hot_lead_agent)) : '-';
    $confirmed_date = ( $rest['id'] == $confirmed_id) ?  date('d-m-Y', strtotime($confirmed_date)) : '-';
    $confirmed_agent = ($confirmed_agent != '') ?  date('d-m-Y', strtotime($confirmed_agent)) : '-';
    $canceled_date = ($rest['id'] == $canceled_id) ?  date('d-m-Y', strtotime($canceled_date)) : '-';
    $cancel_agent = ($cancel_agent != '') ?  $cancel_agent : '-';
  

    

    

  

    $clientData1 = array(
        'Query ID' => encode($rest['id']),
        'Current Status' => getstatus($rest['statusId']),
        'Client Name' => $clientName,
        'Phone' => $clientData['mobile'],
        'Email' => $clientData['email'],
        'Lead Creation Date' => $leadCreationDate,
        'Updation Date' => date('d-m-Y', strtotime($rest['updateDate'])),
        'Destination' =>  $rest['destinationId'],
        'Time Of Travel' =>  date('d-m-Y', strtotime($rest['startDate'])) .  ' Till ' . date('d-m-Y', strtotime($rest['endDate'])),
        'PAX' => $rest['adult'],
        'Duration'=>  stripslashes($rest['day']),
        'Budget' => stripslashes($rest['budgetId']),
        'Active Date' => $activedate,
        'Active Agent' =>  $agent_active,
        'No Connect Date' => $noconnectdate,
        'No Connect Agent'=> $noconnectagent,
        'Follow Up Date' =>  $follow_up_date,
        'Follow Up Agent' => $follow_up_agent,
        'Postponed Date' => $postponed_date,
        'Postponed Agent' => $postponed_agent, 
        'Proposal Sent Date' => $proposal_send_date ,
        'Proposal Sent Agent' => $proposal_send_agent,
        'Changes Date' => $changes_date,
        'Changes Agent' => $changes_agent,
        'Hot Lead Date' => $hot_lead_date,
        'Hot Lead Agent'=> $hot_lead_agent,
        'Confirmed Date'=> $confirmed_date,
        'Confirmed Agent'=> $confirmed_agent,
        'Cancelled Date'=> $canceled_date,
        'Cancelled Agent'=> $cancel_agent



    );

        
   
    

    // Merge $clientData and $rest into one array
    //$mergedArray = $clientData1;

    // Add the merged array into $data_items
    $data_items[] = $clientData1;
}

echo json_encode( $data_items);



?>