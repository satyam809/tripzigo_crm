<?php

include "inc.php";

$where='';

if($_REQUEST['keyword']!=''){ 

$where=' and name like "%'.$_REQUEST['keyword'].'%"';

}

?>

<style>

.mediaimagesbox{width:100%; height:100px; overflow:hidden;border:2px solid #fff; cursor:pointer; margin-bottom: 20px;}

.mediaimagesbox:hover{ border:2px solid #000;}

.mediaimagesbox img{width:100%; height:auto; min-height:100%; border:2px solid #fff;}

</style>

<?php 
if($_REQUEST['liboutertype']==2){


if($_REQUEST['totalnumbercount']==''){

$totalnumber='12';

} else {

$totalnumber=$_REQUEST['totalnumbercount'];

}



$number=1;

$rs=GetPageRecord('*','sysMediaLibrary',' 1 '.$where.' order by id desc ');

$totoalrows=$rest=mysqli_num_rows($rs);



$rs=GetPageRecord('*','sysMediaLibrary',' 1 '.$where.' order by id desc limit 0,'.$totalnumber.''); 

while($rest=mysqli_fetch_array($rs)){ 

 

if (getimagesize($fullurl.'package_image/'.$rest['name']) !== false) {

?>

<div class="col-md-9 col-xl-4" ><div class="mediaimagesbox" style="margin-bottom:0px;" onClick="<?php echo $_REQUEST['afunctin']; ?>('<?php echo str_replace(' ','%20',$rest['name']); ?>');"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['name']; ?>"  />





</div>

 <div style="margin-top:5px; margin-bottom:10px; font-size:12px; text-align:center;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:170px;"><?php  $img=explode('.',preg_replace('/[0-9]+/', '', $rest['name'])); if(trim(str_replace('_',' ',$img[0]))!=''){ echo ucfirst(str_replace('_',' ',$img[0])); } else { echo 'Untitled'; } ?></div>

</div>

<?php $number++; } }  ?> 



<?php if($totoalrows>=$number){ ?>

<div style="padding:0px 0px 40px; width:100%; text-align:center;"><input  type="button" value="Load more"   onclick="funloaduploadedphotos(<?php echo $totalnumber+6; ?>);" class="btn btn-primary"></div>

<?php } ?>

<?php } ?>




<?php
if($_REQUEST['liboutertype']==1){ 

$record=100;
if($_REQUEST['keyword']==''){
$_REQUEST['keyword']='nature';
$record=20;
}

?>
<div style="text-align:center;">
<div style="text-align:left;padding: 0px 10px;">
<h4>Find Images From Our Database</h4>
Use the field below to find images from our royalty-free database. We find you have good luck if you search for locations and more generic terms.
</div>
<hr />

<?php
$url='https://pixabay.com/api/?key=30629655-781934a4a678fb34f70273815&q='.str_replace(' ','%20',$_REQUEST['keyword']).'&image_type=photo&pretty=true&per_page='.$record.'';
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);
 

$json_arr = json_decode($result,true); 

 foreach($json_arr['hits'] as $hotelList){ 
 
 
?>
 <div class="libbotouterbox" onClick="<?php echo $_REQUEST['afunctin']; ?>('<?php echo str_replace(' ','%20',$hotelList['largeImageURL']); ?>');">
 <img src="<?php echo $hotelList['previewURL']; ?>" />
 </div> 

<?php } ?>

</div>
<div style="margin-top:10px; font-size:11px;padding-left: 10px;">
  <a href="https://pixabay.com/" target="_blank">powered by
  <div><img src="https://pixabay.com/static/img/logo.svg" style="width:92px"></div></a>
  </div>
<?php } ?>