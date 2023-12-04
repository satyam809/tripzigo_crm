<?php
require_once('../software/PHPMailer/class.phpmailer.php'); 
include("../software/PHPMailer/class.smtp.php"); 

function send_attachment_mail($fromemail,$to,$subject,$description,$ccmail,$attfilename) 
{ 
 
$select='*'; 
$where='id=1'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);  

	$mail = new PHPMailer(); 
	$mail->IsMail(); 
	$mail->SMTPAuth = $LoginUserDetails['securityType']; 
	$mail->SMTPSecure = $LoginUserDetails['smtpServer']; 
	$mail->Host = $LoginUserDetails['smtpServer']; 
	$mail->Port = $LoginUserDetails['emailPort'];   
	$mail->Username = $LoginUserDetails['emailAccount']; 
	$mail->Password = $LoginUserDetails['emailPassword'];  
	$mail->From = $LoginUserDetails['emailAccount']; 
	$mail->FromName = $LoginUserDetails['fromName']; 
	$mail->Subject = $subject; 
	$mail->AltBody = ""; 
	$mail->CharSet = 'UTF-8'; 
    $mail->ContentType = 'text/html'; 
	$mail->MsgHTML('<body>'.$description.'</body>');  
	$mail->AddAddress(trim($to), "");  
	 
	$attfilename = explode(',', $attfilename);
	foreach ($attfilename as $attachedFile) {
	$mail->AddAttachment('../software/profilepic/'.$attachedFile); 
	}  
	$ccmail = explode(',', $ccmail);
	foreach ($ccmail as $ccaddress) {
	$mail->AddCC(trim($ccaddress));
	}  
	$mail->IsHTML(true); 
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	$mail->Send(); 
}
 
 
 ?>
