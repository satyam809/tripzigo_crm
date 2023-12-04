<?php
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 
?>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>

<?php if($_POST['action']=='submitquery' && $_POST['mobileNumber']!='' &&  $_POST['clientEmail']!='' &&  $_POST['clientName']!='' ){
 

$startDate=date('Y-m-d',strtotime('+ 2 Days'));   
$endDate=date('Y-m-d',strtotime('+ 3 Days'));    
$submitName=addslashes($_POST['submitName']);  

$name=addslashes($_POST['clientName']); 
$mobile=addslashes($_POST['mobileNumber']);   
$email=addslashes($_POST['clientEmail']);   
$details=addslashes($_POST['enquiryFor']);   
 

$addedBy=1;  
$dateAdded=date('Y-m-d H:i:s');
 
 
$bb=GetPageRecord('*','userMaster','email="'.$email.'" and userType=4');   
$clientidcheck=mysqli_fetch_array($bb);
 

if($clientidcheck['email']==''){

$namevalue4 ='userType="4",submitName="'.$submitName.'",firstName="'.$name.'",mobile="'.$mobile.'",status=1,email="'.$email.'",addedBy="'.$addedBy.'",dateAdded="'.time().'"';
$clientId=addlistinggetlastid('userMaster',$namevalue4); 

} else {
 
$clientId=$clientidcheck['id'];

}

  
$rs=GetPageRecord('*','sys_userMaster','id=1 '); 
$invoicedataa=mysqli_fetch_array($rs);

 

 

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",clientId="'.$clientId.'",name="'.$name.'",phone="'.$mobile.'",countryId=101,email="'.$email.'",serviceId=1,adult=1,child=0,infant=0,assignTo=1,leadSource=43,details="'.$details.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$queryId=addlistinggetlastid('queryMaster',$namevalue);   


$namevalue3 ='details="Query Created",queryId="'.$queryId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",logType="add_query"'; 
addlisting('queryLogs',$namevalue3); 

  
 ?>
<script>
parent.$('#clientName').val('');
parent.$('#addeditfrm').hide();
parent.$('#thanksmsg').show();
</script>
 
 <?php
 
}