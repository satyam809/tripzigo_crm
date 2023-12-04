<?php $totalPax=stripslashes($result['adult'])+stripslashes($result['child']); ?>
<?php 
if($_REQUEST['t']==1 || $_REQUEST['t']==2){
$namevalue ='packageTheme="'.$_REQUEST['t'].'"';  
$where='id="'.decode($_REQUEST['id']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord('*','sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);




?>

<style>
.checked {
  color: orange;
}
.itidaytab{ border:1px solid #ecf0f2; padding:10px 15px; text-align:left; font-weight:700; cursor:pointer; position:relative;}
.itidaytab:hover{ border:1px solid #ecf0f2; background-color:#eff9ff; }
.activedaytab{ border:1px solid #ecf0f2; background-color:#009fff73 !important; border-left:2px solid #000 !important;}
.itidaytab .fa-chevron-right { color: #ecf0f2; position: absolute; right: 10px; font-size: 15px; top: 15px; }
.itidaytab:hover .fa-chevron-right{color:#45bbff;}
.activedaytab .fa-chevron-right{color:#000;}
.itidaytab span{background-color: #000; color: #fff; padding: 3px 8px; border-radius: 40px; line-height: 17px; display: inline-block; border: 2px solid #ddd;}
.itidaytab select{padding: 0px; height: 25px; border: 0px; margin-top: 10px;}
.addeventbtnn{background-color: #333333; color: #FFFFFF; width: 40px; height: 40px; text-align: center; border-radius: 40px; font-size:16px; line-height: 38px; cursor: pointer; border: 2px solid #fff; box-shadow: 0px 0px 3px #b7b7b7;}
.addeventbtnn:hover{background-color:#23ae73;}

</style>
 
<div style="padding:20px; padding-left:80px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" style="border:1px solid #ecf0f2;">
	<!--<div style="height:150px; overflow:hidden; position:relative;" class="coverBanner">-->
	    <div style="height:500px;overflow:hidden; position:relative;" class="coverBanner">
	<img src="<?php echo $fullurl; ?>package_image/<?php echo str_replace('','',$result['coverPhoto']); ?>"  style="width:100%; height:auto; min-height:100%;" />
	<div style="background-color: #000000ba; color: #fff; padding: 10px 20px; font-size: 25px; position: absolute; left: 0px; bottom: 0px; width: 100%; font-weight: 600;"><?php echo stripslashes($result['name']); ?> <a style="font-size:18px; cursor:pointer;" onclick="loadpop2('Itinerary setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addtineraries&amp;id=<?php echo encode($result['id']); ?>">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></a>
	
	</div><a style="font-size: 13px; background-color: #00000082; color: #fff; cursor: pointer; position: absolute; right: 10px; top: 10px; padding: 5px 10px;border-radius: 4px;" onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&amp;afunctin=changeCoverPhoto&amp;pid=<?php echo encode($result['id']); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;Change Cover Photo</a>
	</div>

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%" colspan="2" align="left" valign="top" style="border-right:1px solid #ecf0f2;">
<?php
$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );

for($i = $begin; $i <= $end; $i->modify('+1 day')){

if($n==1){
$dayno=$n;
$daydate=$i->format("Y-m-d");
}
 

$ae=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and packageDays="'.$n.'"'); 
$checkday=mysqli_fetch_array($ae);  

if($checkday['id']==''){
$namevalue ='packageDays="'.$n.'",packageId="'.$result['id'].'"';   
addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   
}

?> 

	<div class="itidaytab" id="dayid<?php echo $n; ?>" onclick="load_build_day_details('<?php echo $n; ?>','<?php echo date('Y-m-d', strtotime($i->format("Y-m-d"))); ?>');">
	
	<?php if($result['queryId']>0){ ?>
	<strong><span><?php echo $n; ?></span> <?php echo $i->format("d"); ?> <?php echo $i->format("M"); ?> - <?php echo date('D', strtotime($i->format("Y-m-d"))); ?></strong> 
  
	<?php } else { ?>
	<strong>Day <?php echo $n; ?></strong> 
	<?php } ?>
	
	<i class="fa fa-chevron-right" aria-hidden="true"></i>
	
	<select id="destinationName<?php echo $n; ?>" class="form-control" onchange="load_build_day_details('<?php echo $n; ?>','<?php echo date('Y-m-d', strtotime($i->format("Y-m-d"))); ?>');">  
	<?php foreach(explode(',',$result['destinations']) as $val){ if($val!=''){ ?>
  <option value="<?php echo $val; ?>" <?php if($checkday['destinationName']==$val){ ?>selected="selected"<?php } ?>><?php echo $val; ?></option> 
  <?php } } ?>
</select> 
	</div>
	
	<?php $n++; } ?>
	
	
	<div class="itidaytab" id="dayid100000" onclick="load_build_day_details('100000','<?php echo date('Y-m-d', strtotime($i->format("Y-m-d"))); ?>');">
	
		<strong><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp; Package Terms</strong> 
	
	<i class="fa fa-chevron-right" aria-hidden="true"></i>
	
	  
	</div>
	
	</td>
    <td align="left" valign="top"><div id="load_build_day_details"></div></td>
  </tr>
</table>

	</td>
    <td width="35%" align="left" valign="top" t style="position:relative;">
	<div style="padding: 15px; position: absolute; z-index: 1; width: 100%; box-sizing: border-box; padding-top: 0px; padding-right: 0px; background-color:#fff; border-bottom:1px solid #ddd;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="padding-right:5px;"><input name="searchevent" type="text" id="searchevent"   style="width:100%; box-sizing:border-box; padding:10px; border:1px solid #ddd;border-radius: 4px;height: 43px;" placeholder="Search" onkeyup="loadeventlibrary();"/></td>
    <td width="50%"> 
      <select name="eventsection" id="eventsection" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid #ddd;border-radius: 4px;height: 43px;" onchange="loadeventlibrary();">
             <option value="DayItinerary">Day Itinerary</option>
	    <option value="Accommodation">Accommodation</option> 
        <option value="Activity">Activity</option>
        <option value="Transportation">Transportation</option>
        <option value="Insurance">Insurance / Visa</option>
        <option value="Meal">Meal</option>
        <option value="Flight">Flight</option>
        <option value="Leisure">Leisure</option>
        <option value="Cruise">Cruise</option>
      </select></td>
  </tr>
</table>

	</div>
	<div style="overflow:auto; height:100%;position: absolute; width:100%;">
	
	<div style="margin-top:70px; padding-left:15px;" id="loadeventlibrary">
	
	
	</div>
	
	</div>
	</td>
  </tr>
</table>

<div class="systemcard" id="followupsec">
                            <div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
                                <div style="font-size:16px; font-weight:600; margin-bottom:5px;">Itinerary Details</div>
                            </div>
                            <style>
                                .column {
                                    float: left;
                                    width: 33.33%;
                                    padding: 5px;
                                }

                                /* Clear floats after image containers */
                                .row::after {
                                    content: "";
                                    clear: both;
                                    display: table;
                                }
                            </style>
                            <div class="row">
                                <?php
								$itinerary_id = $result['id'];
								$itinerary_image = "select * from sys_packageBuilder_image where itinerary_id = $itinerary_id";
								$itinerary_image_rs = mysqli_query(db(), $itinerary_image) or die(mysqli_error());								
                                while ($itinerary_image_detail = mysqli_fetch_array($itinerary_image_rs)) {

                                ?>

                                    <div class="mx-2 my-2">
                                        <img src="package_image/<?php print_r($itinerary_image_detail['image_path']); ?>" alt="Snow" style="width:150px;height:150px;">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>



	<div class="m-3">
		<b class="pr-3">Itinerary Tags </b>
		<?php
			$tags = "select ts.*, t.name from Taggings ts, Tags t where t.id=ts.tags_id and tagable_id=".$result['id']." and taggable_type='itinerary'";
			$tags_rs = mysqli_query(db(), $tags) or die(mysqli_error());		
            while ($tags_detail = mysqli_fetch_array($tags_rs)) {
        ?>
        	<span class="badge badge-primary"><?php echo $tags_detail['name']; ?></span>
    	<?php
        }
    	?>
	</div>
	<div class="m-3">
		<b class="pr-3">Hotel Star</b>
		<?php 
			if($result['hotel']==0){
			?>
				<span class="badge badge-success">Any</span>
			<?php
			}else{
				
		?>
	  	<?php
			for($i=1;$i<=$result['hotel'];$i++){
				?>
					<span class="fa fa-star checked"></span>
				<?php
			}
			for($i=$result['hotel']+1;$i<=5;$i++){
				?>
					<span class="fa fa-star"></span>
				<?php
			}
		}
		?>

    </div>
	<?php
		if($result['location']!=""){
	?>
	<div class="m-3">
		<b class="pr-3">Location</b>
	    <span><?php echo $result['location']; ?></span>
    </div>
	<?php
		}
		if($result['description']!=""){
	?>
	<div class="m-3">
		<b class="pr-3">Description</b>
	    <span ><?php echo $result['description']; ?></span>
    </div>
	<?php
		}
	?>
	
	<div class="m-3">
		<b class="pr-3">Destination Type</b>
	    <span class="badge badge-info"><?php echo $result['destination_type']; ?></span>
    </div>

	<div class="m-3">
		<b class="pr-3">Tour Type</b>
	    <span class="badge badge-info"><?php echo $result['tour_type']; ?></span>
    </div>

	<div class="m-3">
		<b class="pr-3">Activity Type</b>
	    <span class="badge badge-info"><?php echo $result['activity_type']; ?></span>
    </div>

	<div class="m-3">
		<b class="pr-3">Landscape Type</b>
	    <span class="badge badge-info"><?php echo $result['landscape_type']; ?></span>
    </div>

	<div class="m-3">
		<b class="pr-3">Publicly Visible</b>
	    <span class="badge badge-info"><?php if($result['publicly_visible']){ echo "Yes";}else{ echo "No";} ?></span>
    </div>

</div>


 <script>
 
 function loadeventlibrary(){
 var eventsection = $('#eventsection').val();
 var destinationNameload = encodeURI($('#destinationNameload').val());
 var fromdateload = encodeURI($('#fromdateload').val());
 var dayloader = encodeURI($('#dayloader').val());
 var searchevent = encodeURI($('#searchevent').val());
 var loadp = $('#loadp').val();
 $('#loadeventlibrary').html('<div style="text-align:center;">Loading...</div>');
 $('#loadeventlibrary').load('loadeventlibrary.php?eventsection='+eventsection+'&searchevent='+searchevent+'&destinationNameload='+destinationNameload+'&fromdateload='+fromdateload+'&dayloader='+dayloader+'&loadp='+loadp);
 
 }
 
 function load_build_day_details(day,date){ 
 var destinationName = encodeURI($('#destinationName'+day).val());
 $('#load_build_day_details').load('load_build_day_details.php?day='+day+'&id=<?php echo $_REQUEST['id']; ?>&date='+date+'&destinationName='+destinationName); 
 }
 
 function changeCoverPhoto(img){
 
 if (img.indexOf('https://') > -1)
{
$('.coverBanner img').attr('src',img);

  } else { 
 $('.coverBanner img').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 }
 
 $( ".close" ).trigger( "click" );
 $('#ActionDiv').load('actionpage.php?pid=<?php echo encode($result['id']); ?>&action=setpackagecoverphoto&imagename='+img);
 } 
 
 
 load_build_day_details('<?php echo $dayno; ?>','<?php echo date('Y-m-d', strtotime($daydate)); ?>');
 
 
  setTimeout(function() {
  
  $('#dayid<?php echo $_REQUEST['pd']; ?>').trigger('click');
   }, 100);
 </script>