<?php
include "../config/database.php";
include "../config/function.php";
include "../config/setting.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if(isset($_POST['client_name']) && trim($_POST['client_name'])!="" && isset($_POST['email']) && trim($_POST['email'])!="" && isset($_POST['phone']) && trim($_POST['phone'])!="" && isset($_POST['adult']) && trim($_POST['adult'])!="" && isset($_POST['child']) && trim($_POST['child'])!=""){
            $name=addslashes($_POST['client_name']);
            $email=addslashes($_POST['email']);
            $phone=addslashes($_POST['phone']);
            $adult=addslashes($_POST['adult']);
            $child=addslashes($_POST['child']);
            $submitName=isset($_POST['submit_name'])?addslashes($_POST['submit_name']):"";
            $month_of_travel=isset($_POST['month_of_travel'])?addslashes($_POST['month_of_travel']):"";
            $startDate = isset($_POST['start_date'])?date('Y-m-d', strtotime($_POST['start_date'])):"";
            $endDate = isset($_POST['end_date'])?date('Y-m-d', strtotime($_POST['end_date'])):"";
           
            $budget=isset($_POST['budget'])?"\nMy budget is ".addslashes($_POST['budget']):"";
            $notes=isset($_POST['notes'])?addslashes($_POST['notes']):"";
            $notes=$notes.$budget;
            $dateAdded = date('Y-m-d H:i:s');
          
            $start = strtotime($startDate);
            $end = strtotime($endDate);
            $day = ceil(abs($end - $start) / 86400);
                    
            $bb = GetPageRecord('*', 'userMaster', 'email="' . $email . '" and userType=4');        
            $clientidcheck = mysqli_fetch_array($bb);
            if ($clientidcheck['email'] == '') {
                $randPass = rand(999999, 100000);
                $namevalue4 = 'userType="4",submitName="' . $submitName . '",firstName="' . $name . '",mobile="' . $phone . '",password="' . md5($randPass) . '",status=1,email="' . $email . '",dateAdded="' . $dateAdded . '"';
                $clientId = addlistinggetlastid('userMaster', $namevalue4);
            } else {
              $clientId = $clientidcheck['id'];
            }
            if (trim($startDate) == '' or trim($endDate) == '') {
              $day = 0;
            }

            $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",name="' . $name . '",phone="' . $phone . '",email="' . $email . '",adult="' . $adult . '",child="' . $child . '",details="' . $notes . '",dateAdded="' . $dateAdded . '",day="' . $day . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",travelMonth="' . $month_of_travel . '"';
        
            $queryId = addlistinggetlastid('queryMaster', $namevalue);
        
            $namevalue3 = 'details="Query Created",queryId="' . $queryId . '",dateAdded="' . $dateAdded . '",logType="add_query"';
        
            addlisting('queryLogs', $namevalue3);
        
            if($queryId){
                echo json_encode(["status"=>"200","message"=>"Enquiry successfully booked"]);        
            }else{
                echo json_encode(["status"=>"500","message"=>"Something went wrong"]);
            }
        }else{
            echo json_encode(["status"=>"500","message"=>"Please Enter Required Data"]);
        }
        break;
}
?>