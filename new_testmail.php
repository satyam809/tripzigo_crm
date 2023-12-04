<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once('PHPMailer/class.phpmailer.php');
include("PHPMailer/class.smtp.php");



 $mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = 2;

$mail->Debugoutput = 'html';

$mail->SMTPAuth = true;

$mail->SMTPSecure = 'ssl';

$mail->Host = 'mail.tripzygo.travel';

$mail->Port = 465;

$mail->Username = 'info@tripzygo.travel';

$mail->Password = 'P=D_N^zkrNVK';

$mail->From = 'info@tripzygo.travel';

$mail->FromName = 'sonam';

$mail->Subject = 'testing';

$mail->AltBody = "";

$mail->CharSet = 'UTF-8';

$mail->ContentType = 'text/html';

$mail->MsgHTML('testing');

$mail->AddAddress('sonamrai@travbox.in');

$mail->IsHTML(true);

if(!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}








?>