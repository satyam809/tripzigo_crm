<?php
include "inc.php";


$a=GetPageRecord('*','sys_userMaster','  id="'.$_SESSION['userid'].'"');
$invoiceData=mysqli_fetch_array($a);

$abc=GetPageRecord('*','sys_userMaster','id=1');
$LoginUserDetails=mysqli_fetch_array($abc);

$rsa=GetPageRecord('*','sys_invoiceMaster',' id="'.decode($_REQUEST['id']).'" order by id desc');
$invoiceData=mysqli_fetch_array($rsa);
echo $invoiceData;

$rsa=GetPageRecord('*','queryMaster',' id="'.decode($_REQUEST['queryId']).'" order by id desc');
$rest=mysqli_fetch_array($rsa);

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"');
$clientData=mysqli_fetch_array($b);

if($clientData['city']!=''){ $clientCity= getCityName($clientData['city']); }

$bp=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" and confirmQuote=1');
$result=mysqli_fetch_array($bp);

$bp=GetPageRecord('*','sys_PackagePayment','id="'.$_REQUEST['paymentId'].'"');
$packagePayment=mysqli_fetch_array($bp);

?>
<style>
    td > table > tbody > tr > td {
        padding-top:3px;padding-bottom:2px;
    }
    td > table.payment > tbody > tr > td {
        padding-top:10px;padding-bottom:7px;
    }
</style>
<div id="capture" style="width:700px; margin: auto; padding:5px; margin-top:50px;">
<table style="font-size:18px;">
    <tr>
        <td width="50%" align="left"><img src="<?php echo $fullurl; ?>profilepic/<?php echo stripslashes($LoginUserDetails['invoiceLogo']); ?>" style="max-width:200px; height:auto;"/><br /><br />

        <strong>International  </strong><br>
         <strong>GSTN:</strong> <?php echo stripslashes($LoginUserDetails['Invoicegstn']); ?><br>
        </td>
        <td width="50%" align="left">
            <strong><?php echo stripslashes($LoginUserDetails['invoiceCompany']); ?>  </strong><br>
            Office No.: <?php echo stripslashes($LoginUserDetails['invoiceAddress']); ?>  <br>
            <strong>Contact no:</strong> <a href="">8544833301, 01762-414634</a>  <br>
            <strong>Email Id:</strong> <a href="">accounts@Tripzygo.in</a>  <br>
            <strong>Website:</strong> <a href="">www.Tripzygo.in</a>  <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-top:25px;padding-bottom:25px;"><hr style="border-top: 1px solid orange;"/></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; text-transform: uppercase;">
            <strong> Payment Receipt </strong>
        </td>
    </tr>
    <tr>
        <td><table style="font-size:18px;">
                <tr style="padding-top:10px;padding-bottom:10px;"><td>Booking Id: </td><td><strong><?php echo encode($rest['id']); ?></strong></td></tr>
                <tr style="padding-top:10px;padding-bottom:10px;"><td>Customer Name: </td><td><strong><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></strong><br></td></tr>
                <tr style="padding-top:10px;padding-bottom:10px;"><td>Package Name:</td><td> <strong><?php echo $result['name']; ?></strong></td></tr>

            </table></td>
        <td rowspan="3" align="right" valign="top" style="padding-top:10px;padding-bottom:10px;">Date: <strong><?php echo date('d/M/Y', strtotime($packagePayment['paymentDate'])); ?></strong></td>
    </tr>

    <tr>
        <td colspan="2" style=" padding-top:30px;">
        <table class="payment" style="border-collapse: collapse; width:100%; margin: auto; font-size:18px; text-align: center;">
            <tr  style="border: 3px solid black; border-bottom:none;">
                <td>Payment Date</td>
                <td>Amount</td>
                <td>Mode of Payment</td>
            </tr>

            <tr  style="border: 3px solid black;">
                <td ><?php echo date('d/M/Y', strtotime($packagePayment['paymentDate'])); ?></td>
                <td><?php echo $packagePayment['amount']; ?></td>
                <td><?php echo $packagePayment['transectionType']; ?></td>
            </tr>
        </table>
        </td>
    </tr>

    <tr>
        <td colspan="2">Kindly deposit the pending amount on or before the due date. Ignore if the full payment has been made.</td>
    </tr>

    <tr>
        <td colspan="2" style="color: red; text-align: center;padding-top:150px;font-size:16px;">Note: This is system generated document , No signature required.</td>
    </tr>

</table>
</div>


