<?php
// echo "hello world!";
include "inc.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
        // $addedBy = $_SESSION['user_id'];
        $addedBy = 0;
        $dateAdded = date('Y-m-d H:i:s');
        $leadsource = $data['leadsource'];
        $travelMonth = $data['travelMonth'];
        $description = $data['description'];
        $clientName = $data['clientName'];
        $email = $data['email'];
        $phone = '+91'.$data['phone'];
        $fromCity = $data['fromCity'];
        $destination = $data['destination'];
        $chekin = isset($data['chekin']) ? $data['chekin'] : '2023-11-15';
        $checkout = isset($data['checkout']) ? $data['checkout'] : '2023-11-15';
        $adult = $data['adult'];
        $child = $data['child'];
        $infant = $data['infant'];
        $details = $data['details'];
        $days_looking_for = $data['daysRange'];
        $hotel_category = $data['hotelCategory'];
        $booked_flight = $data['booked_flight'];
        $airport = $data['airport'];
        $package_name = $data['packageName'];
        $campaign_id = $data['campaign_id'];
     
        $package_name2 = '<a href="' . $package_name . '" target="_blank">' . $package_name . '</a>';

        
        $monthOfTravel = $data['monthOfTravel'];
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

		$b = GetPageRecord('*', 'sys_userMaster', 'id="' . $assignedToId . '"');
		$agentdetails = mysqli_fetch_array($b);
		$agentname = $agentdetails['firstName'] . ' ' . $agentdetails['lastName'];
		if($agentdetails['mobile'] == ''){
            $agentphone = $agentdetails['phone'];
        }
		else{
			$agentphone = $agentdetails['mobile'];
		}

        if ($phone != '') {
            
            $namevalue = 'startDate="' . $chekin . '",endDate="' . $checkout . '",name="' . $clientName . '",phone="' . $phone . '",cityId="5",email="' . $email . '",destinationId="' . $destinationId . '",serviceId="1",adult="' . $adult . '",child="' . $child . '",infant="' . $infant . '",assignTo="' .$assignedToId .'",leadSource="' . $leadSource . '",details="' . $description . ' (Budget: ' . $details . ', stay: '. $days_looking_for .', hotel category: '. $hotel_category .',campaign_id: '. $campaign_id .', flight already booked: '. $booked_flight .', airport: '. $airport .', package_name: '.htmlentities($package_name2).', monthOfTravel: '.$monthOfTravel.')' . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",fromCity="Delhi",travelMonth="' . $travelMonth . '"';
            $queryId = addlistinggetlastid('queryMaster', $namevalue);
        }

		if ($assignedToId != 1) {	
// 			$userid = '2000217680';
// 			$passwd = 'ksrcbmxS';
// 			$supportTeam = '8544811103';

// 			$msgReqURL = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Dear+'.urlencode($clientName).'%2C%0A%0AThank+you+for+contacting+us%21+Our+travel+buddy+'.urlencode($agentname).'+will+contact+you+shortly%21%F0%9F%98%87%0A%0AYou+can+also+reach+out+to+our+travel+buddy%21+%F0%9F%93%9E+%0A%0A%2ATravel+Buddy%2A%3A+%2A'.urlencode($agentname).'%2A+%0A%2AContact+Details%2A%3A++%2A'.$agentphone.'%2A+%0A%0ABe+Ready+To+Save+Huge+On+Flights+%E2%9C%88%EF%B8%8F%2C+Stays+%F0%9F%8F%A8%2C++Holiday+%F0%9F%9B%84%2C+%26+Cabs+for+your+next+trip+to+'.urlencode($destination).'+%F0%9F%9A%95%0A%0APlan+Your+Trip+with+Us+Now%21%F0%9F%98%89';
            
// 			$curl1 = curl_init($msgReqURL);
// 			curl_setopt($curl1, CURLOPT_POST, true);
// 			curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
// 			$result1 = curl_exec($curl1);
// 			curl_close($curl1);
// 			echo "\n\ntest: ".$result1;
		}
		
		 $destination_list = array('Kashmir','Kerala','Goa','Rajasthan','Sikkim','Meghalaya','Shimla','Manali','Kasol','Spiti Valley','Udaipur','Jaisalmer');
		 $destination_eur = ['Spain', 'Amsterdam', 'France', 'Paris', 'Italy', 'London', 'Switzerland', 'Turkey', 'Greece', 'Austria', 'Netherlands', 'Czech Republic', 'United Kingdom', 'Hungary', 'Iceland', 'Norway', 'Germany', 'Europe'];

       // Check if 'destination_list' exists in the $destination_list array
         if (in_array($destination, $destination_list)) {
		
		// Start Curl msg send from Gupsup on Whatsapp
		// API Endpoint URL
        $apiUrl = 'https://api.gupshup.io/wa/api/v1/template/msg';
        
        // Data to be sent in the POST request
        $postData = array(
            'channel' => 'whatsapp',
            'source' => '917717301766',
            'destination' => $phone,
            'src.name' => 'M7pki7B58TcoqEYW8tZLG3K8',
            'template' => '{"id":"a6e84b8f-c711-4283-bd38-d83fc90a3f3e","params":[]}'
        );
        
        // Set additional headers
        $headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'apikey: eozskjal3wvqajqmgbhbpj1r5ubed34k',
        );
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Execute cURL session and fetch result
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        
        // Close cURL session
        curl_close($ch);
        
        // Process the response
        echo $response;
        	// End Curl
         }
         else if(in_array($destination, $destination_eur))
         {
             $url = 'https://api.gupshup.io/wa/api/v1/template/msg';
             $api_key = 'eozskjal3wvqajqmgbhbpj1r5ubed34k';
        
            $data = array(
                'channel' => 'whatsapp',
                'source' => '917717301766',
                'destination' => $phone,
                'src.name' => 'M7pki7B58TcoqEYW8tZLG3K8',
                'template' => '{"id":"5b270eb9-6890-4b19-9aee-1817b31f62e3","params":[]}'
            );
        
            // URL-encode the data
            $post_fields = http_build_query($data);
        
            $ch = curl_init($url);
        
            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'apikey: ' . $api_key,
                'Cache-Control: no-cache',
            ));
        
            // Execute cURL session
            $response = curl_exec($ch);
        
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
        
            // Close cURL session
            curl_close($ch);   
         }
         
         
         else {
             
        	// API Endpoint URL
        $apiUrl = 'https://api.gupshup.io/wa/api/v1/template/msg';
        
       
        $postData = array(
            'channel' => 'whatsapp',
            'source' => '917717301766',
            'destination' => $phone,
            'src.name' => 'M7pki7B58TcoqEYW8tZLG3K8',
            'template' => '{"id":"ee8adb2f-5314-4b6f-8944-0222ae4c71d6","params":[]}'
           
        );
        // Set additional headers
        $headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded',
            'apikey: eozskjal3wvqajqmgbhbpj1r5ubed34k',
        );
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Execute cURL session and fetch result
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        
        // Close cURL session
        curl_close($ch);
        
        // Process the response
        echo $response;
	
		// Internation Curl 
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
