<?php

include "inc.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: token, Content-Type');
//header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');
// Check if the request is a POST request
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $requestData = file_get_contents('php://input');
    $requestData = json_decode($requestData, true);

    $userID = $requestData['user_id'];
    $password = $requestData['password'];
    $data = $requestData['data'];
    $ftoken = '';
    $loginreturn = login($userID, $password, $ftoken);
    // echo $loginreturn;
    if ($loginreturn == 'yes') {

//        echo "This is the page\n";
        $_SESSION['user_id'] = $userID;
        $addedBy = $_SESSION['user_id'];
        $dateAdded = date('Y-m-d H:i:s');
        $leadsource = $data['leadsource'];
        $travelMonth = $data['travelMonth'];
        $description = $data['description'];
        $clientName = $data['clientName'];
        $email = $data['email'];
        $phone = $data['phone'];
        $fromCity = $data['fromCity'];
        $destination = $data['destination'];
        $chekin = $data['chekin'];
        $checkout = $data['checkout'];
        $adult = $data['adult'];
        $child = $data['child'];
        $infant = $data['infant'];
        $details = $data['details'];
        $days_looking_for = $data['daysRange'];
        $hotel_category = $data['hotelCategory'];
        $booked_flight = $data['booked_flight'];
        $airport = $data['airport'];
//        echo $email . PHP_EOL;

        // Perform the necessary operations to update the leads in the CRM
        $clientId = '';

        if ($clientName == '') {
            $clientName = $phone;
        }

        if ($leadsource == 'fb' || $leadsource == 'ig') {

            if ($leadsource == 'fb') {
                $leadSource = '13';
            }

            if ($leadsource == 'ig') {
                $leadSource = '14';
            }
        } else {

            $a = GetPageRecord('*', 'querySourceMaster', 'name="' . $leadsource . '"');
            if (mysqli_num_rows($a) > 0) {
                $datalead = mysqli_fetch_array($a);
                $leadSource = $datalead['id'];
            } else {
                $leadSource = '16';
            }
        }

        $a = GetPageRecord('*', 'cityMaster', 'name="' . $destination . '" and status=1');
        if (mysqli_num_rows($a) > 0) {
            $datacity = mysqli_fetch_array($a);
            $destinationId = $datacity['id'];
        } else {
            $namevalue = 'LOWER(name)="' . strtolower($destination). '",status=1';
            $lstDest = addlistinggetlastid('cityMaster', $namevalue);
            $destinationId = $lstDest;
        }


        $assignedToId = 0;

        $a2 = GetPageRecord('*', 'sys_user_city_mapping', 'city_id="' . $destinationId . '"');
        $userCount = mysqli_num_rows($a2);
        if ($userCount > 0) {
            if($userCount > 1){
                $userIdArr = [];
                while($res = mysqli_fetch_assoc($a2)){
                    $userIdArr[] = $res['user_id'];
                }

                $userIds = implode(',',$userIdArr);

                $getUserWithMinQry = GetPageRecord('assignTo,COUNT(id) as minNewQry', 'queryMaster', " statusId=1 and assignTo IN($userIds) GROUP BY assignTo ORDER BY minNewQry ASC LIMIT 1" );
                if(mysqli_num_rows($getUserWithMinQry) > 0){
                    $userData = mysqli_fetch_assoc($getUserWithMinQry);
                    $assignedToId = $userData['assignTo'];

                }
                else{
                    $maxSrchIndx = (count($userIdArr) - 1);
                    $assignedToId = $userIdArr[rand(0,$maxSrchIndx)];
                }
            }
            else{
                $getUser = mysqli_fetch_assoc($a2);
                $assignedToId = $getUser['user_id'];
            }
        }
        else{
            $assignedToId = 1;
        }

        $a = GetPageRecord('*', 'userMaster', 'mobile="' . $phone . '" and userType=4');
        if (mysqli_num_rows($a) > 0) {
            $profilename = mysqli_fetch_array($a);
            $clientName = $profilename['firstName'] . ' ' . $profilename['lastName'];
            $clientId = $profilename['id'];
        } else {
            $namevalue = 'email="' . $email . '",mobile="' . $phone . '",firstName="' . $clientName . '",status=1,profileId=5,userType=4,dateAdded="' . time() . '",addedBy="' . $_SESSION['user_id'] . '"';
            $clientId = addlistinggetlastid('userMaster', $namevalue);
        }




        if ($phone != '') {
            $namevalue = 'startDate="' . $chekin . '",endDate="' . $checkout . '",name="' . $clientName . '",phone="' . $phone . '",cityId="",email="' . $email . '",destinationId="' . $destinationId . '",serviceId="1",adult="' . $adult . '",child="' . $child . '",infant="' . $infant . '",assignTo="' .$assignedToId .'",leadSource="' . $leadSource . '",details="' . $description . ' (Budget: ' . $details . ', stay: '. $days_looking_for .', hotel category: '. $hotel_category .', flight already booked: '. $booked_flight .', airport: '. $airport .')' . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",fromCity="Delhi",travelMonth="' . $travelMonth . '"';
            $queryId = addlistinggetlastid('queryMaster', $namevalue);
        }

        // Return a response indicating the success or any relevant data
        $response = ['message' => 'Leads updated in CRM'];
        echo json_encode($response);
    } else {
        // Return error response
        $response = ['error' => 'Invalid credentials'];
        echo json_encode($response);
    }
    session_destroy();
}
//else{
//    $response = ['message' => 'method not allowed'];
//    echo json_encode($response);
//}

?>
