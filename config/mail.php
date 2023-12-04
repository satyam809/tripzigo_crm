<?php
require_once('PHPMailer/class.phpmailer.php');
include("PHPMailer/class.smtp.php");

function send_attachment_mail($fromemail, $to, $subject, $description, $ccmail, $attfilename)
{
    $path=$_SERVER['DOCUMENT_ROOT'].'/crm/voucherAttachments/'.$attfilename;
    
    $ccmail = explode(',', $ccmail);
    
    $name=$attfilename;
    
    $select = '*';
    if ($fromemail != '') {
        $where = 'id="' . $fromemail . '"';
    } else {
        $where = 'id=1';
    }

    $rs = GetPageRecord($select, 'sys_userMaster', $where);
    $LoginUserDetails = mysqli_fetch_array($rs);


    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPDebug = 3;

    $mail->Debugoutput = 'html';

    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';

    $mail->Host = 'mail.tripzygo.travel';

    $mail->Port = 465;

    $mail->Username = 'info@tripzygo.travel';

    $mail->Password = 'P=D_N^zkrNVK';

    /*$mail->SMTPAuth = $LoginUserDetails['securityType'];

    $mail->SMTPSecure = $LoginUserDetails['smtpServer'];

    $mail->Host = $LoginUserDetails['smtpServer'];

    $mail->Port = $LoginUserDetails['emailPort'];  

    $mail->Username = $LoginUserDetails['emailAccount'];

    $mail->Password = $LoginUserDetails['emailPassword'];*/

    $mail->From = 'info@tripzygo.travel';

    $mail->FromName = $LoginUserDetails['fromName'];

    $mail->Subject = $subject;

    $mail->AltBody = "";

    $mail->CharSet = 'UTF-8';

    $mail->ContentType = 'text/html';

    $mail->MsgHTML('<body>' . $description . '</body>');

    $mail->AddAddress(trim($to), "");

    $mail->AddAttachment($path,$name,$encoding ='base64',$type = 'application/octet-stream');

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
    
    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }


}

function send_attachment_mail_with_reply_to($fromemail, $to, $subject, $description, $ccmail, $attfilename, $reply_to)
{
    $path = $_SERVER['DOCUMENT_ROOT'].'/crm/voucherAttachments/'.$attfilename;
    
    $ccmail = explode(',', $ccmail);
    
    $name = $attfilename;
    
    $select = '*';
    if ($fromemail != '') {
        $where = 'id="' . $fromemail . '"';
    } else {
        $where = 'id=1';
    }

    $rs = GetPageRecord($select, 'sys_userMaster', $where);
    
    $LoginUserDetails = mysqli_fetch_array($rs);

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPDebug = 3;

    $mail->Debugoutput = 'html';

    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';

    $mail->Host = 'mail.tripzygo.travel';

    $mail->Port = 465;

    $mail->Username = 'info@tripzygo.travel';

    $mail->Password = 'P=D_N^zkrNVK';

    /*$mail->SMTPAuth = $LoginUserDetails['securityType'];

    $mail->SMTPSecure = $LoginUserDetails['smtpServer'];

    $mail->Host = $LoginUserDetails['smtpServer'];

    $mail->Port = $LoginUserDetails['emailPort'];  

    $mail->Username = $LoginUserDetails['emailAccount'];

    $mail->Password = $LoginUserDetails['emailPassword']; 
*/
        
    $mail->addReplyTo(trim($reply_to), $LoginUserDetails['fromName']);
    
    $mail->From = 'info@tripzygo.travel';

    $mail->FromName = $LoginUserDetails['fromName'];

    $mail->Subject = $subject;

    $mail->AltBody = "";

    $mail->CharSet = 'UTF-8';

    $mail->ContentType = 'text/html';

    $mail->MsgHTML('<body>' . $description . '</body>');

    $mail->AddAddress(trim($to), "");

    if($attfilename != ''){
        
         
         $mail->AddAttachment($path,$name,$encoding ='base64',$type = 'application/octet-stream');
    }

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
   //print_r($mail); 
    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }


}

function send_report_mail($fromemail, $to, $subject, $description, $ccmail, $attfilename)
{
    $parts = explode('/', $attfilename);
    // print_r($parts);
    $path=$_SERVER['DOCUMENT_ROOT'].'/crm/reports/'.$parts[2];
    
    $ccmail = explode(',', $ccmail);
    echo "hello world!";
    $name= $parts[2];
    
    $select = '*';
    if ($fromemail != '') {
        $where = 'id="' . $fromemail . '"';
    } else {
        $where = 'id=1';
    }

    $rs = GetPageRecord($select, 'sys_userMaster', $where);
    $LoginUserDetails = mysqli_fetch_array($rs);


    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPDebug = 3;

    $mail->Debugoutput = 'html';

    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';

    $mail->Host = 'mail.tripzygo.travel';

    $mail->Port = 465;

    $mail->Username = 'info@tripzygo.travel';

    $mail->Password = 'P=D_N^zkrNVK';

    /*$mail->SMTPAuth = $LoginUserDetails['securityType'];

    $mail->SMTPSecure = $LoginUserDetails['smtpServer'];

    $mail->Host = $LoginUserDetails['smtpServer'];

    $mail->Port = $LoginUserDetails['emailPort'];  

    $mail->Username = $LoginUserDetails['emailAccount'];

    $mail->Password = $LoginUserDetails['emailPassword'];*/

    $mail->From = 'info@tripzygo.travel';

    $mail->FromName = $LoginUserDetails['fromName'];

    $mail->Subject = $subject;

    $mail->AltBody = "";

    $mail->CharSet = 'UTF-8';

    $mail->ContentType = 'text/html';

    $mail->MsgHTML('<body>' . $description . '</body>');

    $mail->AddAddress(trim($to), "");

    $mail->AddAttachment($path,$name,$encoding ='base64',$type = 'application/octet-stream');

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
    
    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }


}

?>
