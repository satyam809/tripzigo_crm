<?php
include "inc.php";
if (isset($_POST['query_id']) && $_POST['query_id'] != "" &&  $_POST['flag'] == "callerdesk") {
    $query_id = decode($_POST['query_id']);
    $sql = "select * from queryMaster where id= $query_id";
    $single_query = mysqli_query(db(), $sql) or die(mysqli_error());
    $single_query_data = mysqli_fetch_array($single_query);

    $assing_to_id = $single_query_data['assignTo'];
    $sql_2 = "select * from sys_userMaster where id= $assing_to_id";
    $single_assign_to = mysqli_query(db(), $sql_2) or die(mysqli_error());
    $single_assign_to_data = mysqli_fetch_array($single_assign_to);

    $client_id = $single_query_data['clientId'];
    $sql_3 = "select * from userMaster where id= $client_id";
    $single_client = mysqli_query(db(), $sql_3) or die(mysqli_error());
    $single_client_data = mysqli_fetch_array($single_client);

    $camp_id = $single_query_data['id'];
    $calling_party_a = $single_assign_to_data['phone'];
    $calling_party_b = $single_client_data['mobile'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.callerdesk.io/api/click_to_call_v2?calling_party_a=$calling_party_a&calling_party_b=$calling_party_b&deskphone=8069145525&authcode=5f4d824d89e9063bc5085aefeae669c6&call_from_did=1&campid=$camp_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo json_encode($response);
} else {
    echo json_encode(array('status' => 400, 'data' => "Invalid Parameters.Please provide valid required data."));
    die;
}
