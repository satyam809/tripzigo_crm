<?php
include "inc.php";  
 
$hotelnamemaster=$_REQUEST['hotelnamemaster'];

$where=' id="'.$hotelnamemaster.'" order by name asc';  
$rs=GetPageRecord('*','hotelMaster',$where); 
$resListing=mysqli_fetch_array($rs); 

$ab=GetPageRecord('*','hotelRateList','hotelId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" order by id desc');  
$data=mysqli_fetch_array($ab);

$a=GetPageRecord('*','RoomTypeMaster','id="'.$data['roomType'].'"');  
$resulthot=mysqli_fetch_array($a); 


$a=GetPageRecord('*','mealPlanMaster','id="'.$data['mealPlan'].'"');  
$resultmeal=mysqli_fetch_array($a);

 echo $resListing['details'];

 ?>
 <script> 
	parent.$('#hotelName').val('<?php echo $resListing['name']; ?>');  
	parent.$('#hotelPriceId').val('<?php echo $data['id']; ?>');  
  
 </script>
 