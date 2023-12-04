<?php

$servername = "localhost";
$username = "tripzfp3_tripzfp3";
$password = "Tripzygo@2703#";
$dbname =  "tripzfp3_tripzfym";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$batchSize = 500; // You can adjust this based on your server's capacity
$totalRecords = 26065;

// Initialize the $body variable outside the loop
$body = '';

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

function getAgentName($userId, $conn) {
    if ($userId != 0) {
        $sql_agent = "SELECT firstName,lastName FROM sys_userMaster WHERE id='".$userId."'";
        $agentData = mysqli_query($conn, $sql_agent);

        if (!$agentData) {
            die("Error: " . mysqli_error($conn));
        }

        $agentNames = mysqli_fetch_array($agentData);
        return ($agentNames) ? $agentNames['firstName'] . ' ' . $agentNames['lastName'] : null;
    }
    return '-';
}

function encode($string)
{
  if (trim($string) != '' && trim($string) != '0') {
    $encoded = $string + 100000;
    //$encoded = base64_encode(base64_encode(base64_encode($string)));  
    return  $encoded;
  }
}



for ($page = 1; $page <= ceil($totalRecords / $batchSize); $page++) {
    // Calculate offset for the current batch
    $offset = ($page - 1) * $batchSize;

    // SQL query with LIMIT and OFFSET clauses for the current batch
    $sql = "SELECT * FROM queryMaster LIMIT $batchSize OFFSET $offset";

    // Execute the SQL query and fetch records
    $rs = mysqli_query($conn, $sql);

    // Check for errors and handle the result (error handling code not shown here)
    if (!$rs) {
        die("Error: " . mysqli_error($conn));
    }

    // Process the fetched records and append to $body
    while ($rest = mysqli_fetch_assoc($rs)) {

      

        $sql_user = "SELECT * FROM userMaster WHERE id='".$rest['clientId']."'";
        $rs_client = mysqli_query($conn, $sql_user);

        $clientData = mysqli_fetch_array($rs_client);


        $dates = "SELECT * FROM queryLogs  where queryId='".$rest['id']."'";
        $rs_query = mysqli_query($conn, $dates);
        while ($leadDates = mysqli_fetch_array($rs_query)) {
            if ($leadDates['details'] == 'Query Created') {
                $leadCreationDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
            } elseif ($leadDates['details'] == 'Query Status Changed: Active') {
                $activeDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $activeAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: No Connect') {
                $noConnectDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $noConnectAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Follow Up') {
                $followUpDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $followUpAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Postponed') {
                $postponedDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $postponedAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Proposal Sent') {
                $proposalSendDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $proposalSendAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Changes') {
                $changesDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $changesAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Hot Lead') {
                $hotLeadDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $hotLeadAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Confirmed') {
                $confirmedDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $confirmedAgent = getAgentName($leadDates['userId'],$conn);
            } elseif ($leadDates['details'] == 'Query Status Changed: Cancelled') {
                $cancelledDate = date('d-m-Y', strtotime($leadDates['dateAdded']));
                $cancelledAgent = getAgentName($leadDates['userId'],$conn);
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
      

        $body .= ' <tr>
        <td>'. encode($rest['id']).'</td> 
        <td>'.$rest['statusId'].'</td>
        <td>'.$clientName.'</td>
        <td>'.$clientData['mobile'].'</td> 
        <td>'.$clientData['email'].'</td>
        <td>'.$leadCreationDate.'</td>
        <td>'.date('d-m-Y', strtotime($rest['updateDate'])).'</td>
        <td>'. $rest['destinationId'].'</td>
        <td>'.date('d-m-Y', strtotime($rest['startDate'])) .  ' Till ' . date('d-m-Y', strtotime($rest['endDate'])).'</td> 
        <td>'.$rest['adult'].'</td> 
        <td>'.stripslashes($rest['budgetId']).'</td> 
        <td>'.$activedate.'</td> 
        <td>'. $agent_active.'</td>  
        <td>'.$noconnectdate.'</td> 
        <td>'.$noconnectagent.'</td>
        <td>'.$follow_up_date.'</td>  
        <td>'.$follow_up_agent.'</td>  
        <td>'.$postponed_date.'</td>  
        <td>'.$postponed_agent.'</td> 
        <td>'.$proposal_send_date.'</td>  
        <td>'.$proposal_send_agent.'</td>  
        <td>'.$changes_date.'</td>  
        <td>'.$hot_lead_date.'</td> 
        <td>'.$hot_lead_agent.'</td> 
        <td>'.$confirmed_date.'</td>  
        <td>'.$confirmed_agent.'</td> 
        <td>'.$canceled_date.'</td> 
        <td>'.$cancel_agent.'</td>       
      </tr>';
    }
}

$data='<table width="100%" border="1" cellspacing="0" cellpadding="5">
<tr>
<th>Query ID</th>
<th>Current Status </th>
<th>Client Name </th>
<th>Phone</th>
<th>Email</th>
<th>Lead Creation Date </th>
<th>Updation Date </th>
<th>Destination </th>
<th>Time Of Travel</th>
<th># PAX </th>
<th>Duration </th>
<th>Budget </th>
<th>Active Date </th>
<th>Active Agent</th>
<th>No Connect Date</th>
<th>No Connect Agent</th>
<th>Follow Up Date </th>
<th>Follow Up Agent</th>
<th>Postponed Date</th>
<th>Postponed Agent</th>
<th>Proposal Sent Date </th>
<th>Proposal Sent Agent</th>
<th>Changes Date </th>
<th>Changes Agent</th>
<th>Hot Lead Date </th>
<th>Hot Lead Agent</th>
<th>Confirmed Date </th>
<th>Confirmed Agent</th>
<th>Cancelled Date</th>
<th>Cancelled Agent</th>
</tr>
'.$body.'
</table>
';

// $file = "download.xls"; 
// header("Content-type: application/vnd.ms-excel");
// header("Content-Disposition: attachment; filename=$file");
echo $data;

// Close the database connection
mysqli_close($conn);





?>