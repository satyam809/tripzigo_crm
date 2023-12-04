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
        if(isset($_POST['email']) && trim($_POST['email'])!=""){
            $first_name=isset($_POST['first_name'])?addslashes($_POST['first_name']):"";
            $last_name=isset($_POST['last_name'])?addslashes($_POST['last_name']):"";
            $email=addslashes($_POST['email']);
            $phone=isset($_POST['phone'])?addslashes($_POST['phone']):"";

            $data_rs = mysqli_query(db(), "select u.id from userMaster u,Newsletter n where n.client_id=u.id and u.email='$email'") or die(mysqli_error());
            $data_newsletter = mysqli_fetch_all($data_rs,MYSQLI_ASSOC);             
            if($data_newsletter){
                echo json_encode(["status"=>"500","message"=>"You have already shown interest in our newsletter"]);
            }else{
                $namevalue = 'firstName="' . $first_name . '",lastName="' . $last_name . '",email="' . $email . '",mobile="' . $phone . '"';
                $lstaddid = addlistinggetlastid('userMaster', $namevalue);
                $namevalue = 'client_id="' . $lstaddid . '",status="1"';
                $lstaddid = addlistinggetlastid('Newsletter', $namevalue);
                echo json_encode(["status"=>"200","message"=>"Newsletter successfully submitted"]);        
            }
        }else{
            echo json_encode(["status"=>"500","message"=>"Please Enter Email Id"]);
        }
        break;
}
?>