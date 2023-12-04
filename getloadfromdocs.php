<?php 
include "inc.php"; 
 
$rsa=GetPageRecord($select,'sys_userMaster','id=1'); 
$getleadurl=mysqli_fetch_array($rsa);

 
?> 
<script src="assets/js/jquery.min.js"></script>

<?php
 $finalvar='';
$DOM = new DOMDocument();
$rows = $DOM->getElementsByTagName("tr");

for ($i = 0; $i < $rows->length; $i++) {
    $cols = $rows->item($i)->getElementsbyTagName("td");
	
		$name='';
	$mobile='';
	$email='';
	$address='';
	$finalvar='';
	$n=1;
    for ($j = 0; $j < $cols->length; $j++) {
	

	if($i>1){
		
		
	if($n==1){
	
	
	
	if(trim($cols->item($j)->nodeValue)!=''){
	 
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	
	if($n==2){
	if(trim($cols->item($j)->nodeValue)!=''){
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	if($n==3){
	if(trim($cols->item($j)->nodeValue)!=''){
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	 
		
		
		
		
        //echo $cols->item($j)->nodeValue, " - ";
		}
		
        // you can also use DOMElement::textContent
        // echo $cols->item($j)->textContent, "\t";
    $n++; if($n==3){$n=1;} 
	
	 //echo $name.'-'.$mobile.'-'.$email.'-'.$address;
	}
   

$arr=explode(',',$finalvar);
$name='';
$mobile='';
$email='';
$name='';

//print_r($arr);

$name=trim($arr[0]);
$mobile=trim($arr[1]);
$email=trim($arr[2]); 

//echo $name.'-'.$mobile.'-'.$email.'-'.$address;
 
 $bb=GetPageRecord('*','userMaster','mobile="'.$mobile.'" and userType=4');    
$clientidcheck=mysqli_fetch_array($bb); 



if($clientidcheck['mobile']=='' && $name!='' && $name!=' ' && $name!='  ' && $name!='   ' && $name!='�'){

if($mobile!='' && $name!=''){

if (strpos($mobile, 'not for') !== false || strpos($mobile, 'are not sourced') !== false || strpos($email, 'Sheet1') !== false) {

} else {

$randPass = rand(999999,100000);

$namevalue4 ='userType="4",submitName="Mr.",firstName="'.$name.'",mobile="'.$mobile.'",password="'.md5($randPass).'",status=1,email="'.$email.'",addedBy=1,dateAdded="'.time().'"';
$clientId=addlistinggetlastid('userMaster',$namevalue4); 

$dateAdded=date('Y-m-d H:i:s');

$namevalue ='startDate="'.date('Y-m-d').'",endDate="'.date('Y-m-d',strtotime(' + 2 days')).'",name="'.$name.'",phone="'.$mobile.'",email="'.$email.'",serviceId="'.$serviceId.'",adult="2",assignTo="1",leadSource="28",title="'.$title.'",details="'.$details.'",addedBy="1",dateAdded="'.$dateAdded.'",day="'.$day.'",updateDate="'.$dateAdded.'",clientId="'.$clientId.'",priorityStatus="0"';

$queryId=addlistinggetlastid('queryMaster',$namevalue); 

}

}

$finalvar='';
}



   ?>

<script>  

 parent.redirectpage('display.html?ga=query'); 

</script>

<?php 
   
   
}
?>