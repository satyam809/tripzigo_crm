<?php

require "vendor/autoload.php";

header("HTTP/1.1 200 OK");

$post = file_get_contents("php://input");
$data = json_decode($post, true);

$keyId = 'rzp_test_sesLPwya1pnQS7';
$keySecret = '7TyWOkG5DMsIwnn6QbZDfP1T';
$webhookSecret = 'DheXVx7Gj3cFg2L';

const PAYMENT_PAID = "payment_link.paid";
const PAYMENT_LINK_EXPIRES = "payment_link.expired";

$eventArray = [PAYMENT_PAID, PAYMENT_LINK_EXPIRES];

if ((isset($data['event']) === true) && (empty($data['event']) === false) && in_array($data['event'], $eventArray) === true){
    if (isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE']) === true){
        try {
            $api = new \Razorpay\Api\Api($keyId, $keySecret);
            $api->utility->verifyWebhookSignature($post, $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'], $webhookSecret);
        }
        catch (\Razorpay\Api\Errors\SignatureVerificationError $error){
            $log = array("message" => $error->getMessage(), "data" => $data);
            error_log(json_encode($log), 3, 'error_log/my-errors.log');
            echo "Unauthorized";
        }

        switch ($data['event']){
            case PAYMENT_PAID:
                $status = $data['payload']['payment_link']['entity']['status'];
                $order_id = $data['payload']['payment_link']['entity']['order_id'];
                $payment_link_id = $data['payload']['payment_link']['entity']['id'];
                if ($status == "paid"){
                    $conn = mysqli_connect("localhost", "tripzygo_website", "e2FeSHdQpr@GT28", "tripzygo_website");
                    if ($conn){
                        $sql = 'UPDATE queryPaymentLinks SET order_id="'.$order_id.'", paid_at="'.date('Y-m-d H:i:s').'", status="'.$status.'" WHERE payment_link_id="'.$payment_link_id.'"';
                        if (mysqli_query($conn, $sql)){
                            error_log(json_encode('Success'), 3, 'error_log/my-errors.log');
                        }else{
                            error_log(json_encode(mysqli_errno($conn)), 3, 'error_log/my-errors.log');
                        }
                        $get_data = 'SELECT `reference_id` FROM `queryPaymentLinks` WHERE `payment_link_id` = "'.$payment_link_id.'"';
                        $data = mysqli_query($conn, $get_data);
                        $result = mysqli_fetch_array($data);
                        $reference_id = $result[0];
                        $sql_1 = 'UPDATE sys_PackagePayment SET paymentStatus="1", paymentDate="'.date('Y-m-d H:i:s').'" WHERE paymentId="'.$reference_id.'"';
                        if (mysqli_query($conn, $sql_1)){
                            error_log(json_encode('Success For Second Table'), 3, 'error_log/my-errors.log');
                        }else{
                            error_log(json_encode(mysqli_errno($conn)), 3, 'error_log/my-errors.log');
                        }
                    }else{
                        error_log(json_encode('Connection Failed'), 3, 'error_log/my-errors.log');
                    }

                }
                break;
            case PAYMENT_LINK_EXPIRES:
                $status = $data['payload']['payment_link']['entity']['status'];
                $payment_link_id = $data['payload']['payment_link']['entity']['id'];
                if ($status == "expired"){
                    $conn = mysqli_connect("localhost", "tripzygo_website", "e2FeSHdQpr@GT28", "tripzygo_website");
                    if ($conn){
                        $sql = 'UPDATE queryPaymentLinks SET status="'.$status.'" WHERE payment_link_id="'.$payment_link_id.'"';
                        if (mysqli_query($conn, $sql)){
                            error_log(json_encode('Success'), 3, 'error_log/my-errors.log');
                        }else{
                            error_log(json_encode(mysqli_errno($conn)), 3, 'error_log/my-errors.log');
                        }
                        $get_data = 'SELECT `reference_id` FROM `queryPaymentLinks` WHERE `payment_link_id` = "'.$payment_link_id.'"';
                        $data = mysqli_query($conn, $get_data);
                        $result = mysqli_fetch_array($data);
                        $reference_id = $result[0];
                        $sql_1 = 'UPDATE sys_PackagePayment SET paymentStatus="4", paymentDate="'.date('Y-m-d H:i:s').'" WHERE paymentId="'.$reference_id.'"';
                        if (mysqli_query($conn, $sql_1)){
                            error_log(json_encode('Success For Second Table'), 3, 'error_log/my-errors.log');
                        }else{
                            error_log(json_encode(mysqli_errno($conn)), 3, 'error_log/my-errors.log');
                        }
                    }else{
                        error_log(json_encode('Connection Failed'), 3, 'error_log/my-errors.log');
                    }

                }
                break;
        }
    }
}