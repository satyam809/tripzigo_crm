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
       
            $travelled_before=isset($_POST['travelled_before'])?addslashes($_POST['travelled_before']):"";
            $total_days=isset($_POST['total_days'])?addslashes($_POST['total_days']):"";
            $date_fixed=isset($_POST['date_fixed'])?addslashes($_POST['date_fixed']):"";
            $visa_status=isset($_POST['visa_status'])?addslashes($_POST['visa_status']):"";
            $flight_status=isset($_POST['flight_status'])?addslashes($_POST['flight_status']):"";
            $planning_with=isset($_POST['planning_with'])?addslashes($_POST['planning_with']):"";
            $vacation_type=isset($_POST['vacation_type'])?addslashes($_POST['vacation_type']):"";
            $stay_stars=isset($_POST['stay_stars'])?addslashes($_POST['stay_stars']):"";
            $budget=isset($_POST['budget'])?addslashes($_POST['budget']):"";
            $book_planning=isset($_POST['book_planning'])?addslashes($_POST['book_planning']):"";
            $payloadJson = isset($_POST['payloadJson'])?addslashes($_POST['payloadJson']):"";
            $itr_status = isset($_POST['itr_status'])?addslashes($_POST['itr_status']):"";
          
              
                $namevalue = 'travelled_before="' . $travelled_before . '",total_days="' . $total_days . '",date_fixed="' . $date_fixed . '",visa_status="' . $visa_status . '",flight_status="' . $flight_status . '",planning_with="' . $planning_with . '",vacation_type="' . $vacation_type . '",stay_stars="' . $stay_stars . '",budget="' . $budget . '",book_planning="' . $book_planning . '",payloadJson="' . $payloadJson. '",itr_status="'.$itr_status.'"';

                $lstaddid = addlistinggetlastid('whatsapp_chat', $namevalue);
                if ($lstaddid) {

                $whatsapp_chatdata = GetPageRecord('*', 'whatsapp_chat', ' id="' . $lstaddid . '"');
                $whatsapp_mobile = mysqli_fetch_array($whatsapp_chatdata);

               
                $data_json = $whatsapp_mobile['payloadJson'];
                $decodedData = json_decode($data_json, true);

                $mobile = '+'.$decodedData['sender']; 

                $namevalue = 'mobile="' . $mobile . '"';
                
                $where = 'id="' . $lstaddid . '"';
                updatelisting('whatsapp_chat', $namevalue, $where);

                // echo $lstaddid;  exit;
                echo json_encode(["status"=>"200","message"=>"whatsapp trigger successfully submitted"]); 
                }
                else
                {
                   echo json_encode(["status" => "400", "message" => "Error: Unable to retrieve last insert ID"]);
                }       
            
        
        break;
}
?>