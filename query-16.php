<?php

if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');
}




if($_REQUEST['dltid']!=''){
deleteRecord('queryMaster','id="'.decode($_REQUEST['dltid']).'"');  
?>
<script>
alert('Successfully Deleted!');
</script>
<?php
}




$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs='';  
$wheremain=''; 

$searchwhere='';
$searchwhereuser='';
$mainwhere=''; 
$noteswhere='';


if($LoginUserDetails['userType']!=0){ 

if($LoginUserDetails['showQueryStatus']==0){
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

if($LoginUserDetails['showQueryStatus']==1){
$mainwhere=' and (statusId=5  or statusId=9) '; 
}

if($LoginUserDetails['showQueryStatus']==2){
$mainwhere=' and 1  '; 
}

if($_REQUEST['statusid']==1){ 
$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
}

if($_REQUEST['statusid']==''){ 
$noteswhere='and id in (select queryId from queryNotes)';
}

} else {
$mainwhere=' and 1 '; 
}



$searchcity='';
if($_REQUEST['searchcity']!=''){
$searchcity=' and  destinationId="'.$_REQUEST['searchcity'].'"';
}


$searchsource='';
if($_REQUEST['searchsource']!=''){
$searchsource=' and  leadSource="'.$_REQUEST['searchsource'].'"';
}


$searchconfirmproposal='';
if($_REQUEST['searchconfirmproposal']==1){
$searchconfirmproposal=' and id in (select queryId from sys_packageBuilder where confirmQuote=1)';
}


$searchusers='';
if($_REQUEST['searchusers']!=''){
$searchusers=' and  assignTo="'.$_REQUEST['searchusers'].'"';
}

$statusid='';
if($_REQUEST['statusid']!=''){
$statusid=' and  statusId="'.$_REQUEST['statusid'].'"';
}

if($_REQUEST['keyword']!=''){
$searchwhereuser=' and (id="'.decode($_REQUEST['keyword']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") )';
}

$wheres=' fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.' '.$noteswhere.' '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'" '.$searchconfirmproposal.'  order by id desc'; 

$wheres2=' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.'  '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id asc'; 


$where2='  fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.' '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id desc'; 

$where3='  fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.'  '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id desc'; 

?>

<style>
.table td, .table th {
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.notes{font-size: 12px; background-color: #FFFFCC; border: 1px solid #FFCC33; padding: 0px 5px; color: #ff6a00; font-weight: 600; float: left; margin-top: 2px; border-radius: 2px;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Query<div class="float-right">
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>	
									<a href="client-Import.xls" target="_blank"><button type="button"  class="btn btn-primary btn-lg" style="margin-bottom:10px;" ><i class="fa fa-download" aria-hidden="true"></i> Download Excel Format</button></a>
									
									
									<button type="button"  id="savingbutton" class="btn btn-primary btn-lg" onclick="loadpop('Import',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=importFBleads" style="margin-bottom:10px;" ><i class="fa fa-upload" aria-hidden="true"></i> Import Excel</button>
									<a style="margin-bottom:10px;" href="<?php echo $fullurl; ?>exportQuery.php?startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&statusid=<?php echo $_REQUEST['statusid']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchsource=<?php echo $_REQUEST['searchsource']; ?>&searchconfirmproposal=<?php echo $_REQUEST['searchconfirmproposal']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank" class="btn btn-secondary btn-lg waves-effect waves-light">Export Data</a>
									<a href="display.html?ga=query&add=1" ><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="margin-bottom:10px;"  ><i class="fa fa-plus" aria-hidden="true"></i> Add Query</button></a><?php } ?>
									</div></h4> 
							 <div   style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="Search by ID, name, email, mobile"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:250px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    <td style="padding-left:5px;"><select name="searchcity" class="form-control"  style="width:160px;">
  <option value="" >All Destinations</option>
  <?php  

$rs22=GetPageRecord('*','queryMaster','  fromCity!="" and destinationId in (select id from cityMaster where name!="") group by destinationId order by id desc'); 
while($restuser=mysqli_fetch_array($rs22)){ 

$a=GetPageRecord('*','cityMaster',' 1 and id="'.$restuser['destinationId'].'" ');  
$resultcityname=mysqli_fetch_array($a);
?>
  <option value="<?php echo $restuser['destinationId']; ?>" <?php if($restuser['destinationId']==$_REQUEST['searchcity']){ ?>selected="selected"<?php } ?>><?php echo $resultcityname['name']; ?></option>
  <?php } ?>
</select></td>
   <?php  if($LoginUserDetails['userType']==0){ ?> <td style="padding-left:5px;"><select name="searchusers" class="form-control"  style="width:130px;">
  <option value="" >All Users</option>
  <?php  

$rs22=GetPageRecord('*','sys_userMaster',' 1  order by firstName desc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$_REQUEST['searchusers']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['firstName']); ?> <?php echo stripslashes($restuser['lastName']); ?></option>
  <?php } ?>
</select></td><?php } ?>
    <td style="padding-left:5px;"><select name="searchsource" class="form-control" id="searchsource"  style="width:140px;">
  <option value="" >All Source</option>
  <?php  

$rs22=GetPageRecord('*','querySourceMaster',' 1  order by name asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$_REQUEST['searchsource']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['name']); ?></option>
  <?php } ?>
</select></td> 
     
    <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
	
	<td style="padding-left:5px;"><a href="display.html?ga=query"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  >All</button></a></td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>
								  </div>
								 </div>
								 
							  </div>
							  
							  <div style="margin-bottom:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=1&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
	<?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=1 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?>
	
	</div>New</div></a></td>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=2&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#0cb5b5;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=2 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Active</div></a></td>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=3&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#0f1f3e;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=3 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>No Connect</div></a></td>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=4&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#e45555;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=4 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Hot Lead</div></a></td>
    
	<td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=8&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#cc00a9;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=8 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Proposal Sent</div></a></td>
	<td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=9&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#FF6600;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=9 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Pro. Conf.</div></a></td>
	<td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=5&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#46cd93;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=5 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Confirmed</div></a></td>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=6&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#6c757d;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=6 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>Cancelled</div></a></td>
    <td width="11%" align="left" valign="top"><a href="display.html?ga=query&statusid=7&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>">
      <div class="statusbox" style="background-color:#f9392f; margin-right:0px;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totalids','queryMaster',' statusId=7 and '.$where3.' '); $statusData=mysqli_fetch_array($ba); echo $statusData['totalids']; ?></div>
    Lost</div></a></td>
    </tr>
</table>

							  </div>
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
							  <div id="bulkassign" style="display:none;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="14%"><select id="assignToPerson" name="assignToPerson" class="form-control" style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"   autocomplete="off" >
  <option value="0" >Assign To</option>
  <?php  

$rs22=GetPageRecord('*','sys_userMaster','  userType=1 or userType=0 order by firstName asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$rest['assignTo']){ ?>selected="selected"<?php } ?>>
  <?php if($restuser['id']==1){ echo 'Not Assign'; } else { ?>
  <?php echo $restuser['firstName']; ?> <?php echo $restuser['lastName'];  }?></option>
  <?php } ?>
</select></td>
    <td width="4%"><button type="submit"  id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.value='Saving...';"  style="float:right;padding: 3px 10px;"  >
                                                Save
                                            </button></td>
    <td width="82%"><input autocomplete="false" name="action" type="hidden" id="action" value="bulkassignquery" /></td>
  </tr>
</table>
</div>
                                        
										<table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                    <th>Client</th>
                                                    <th>Source</th>
                                                    <th>Travel Date</th>
                                                    <th>From</th>
                                                    <th>Destination</th>
                                                    <th>Pax</th>
                                                    <th>Status</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
<tbody>

<?php
$g=1;
if($LoginUserDetails['userType']!=0 && $_REQUEST['statusid']<2){ 

$ckdg=GetPageRecord('*','queryMaster','id not in (select queryId from queryNotes)   and statusId=1 '.$wheres2.'  '); 
while($rest=mysqli_fetch_array($ckdg)){ 

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);

$c=GetPageRecord('id','queryNotes','queryId="'.$rest['id'].'"'); 
$notesdata=mysqli_fetch_array($c);


//$ckdgg=GetPageRecord('count(id) as totalpendingquery','queryMaster','  id not in (select queryId from queryNotes)  '.$wheres2.'   '); 
//$resttotalpending=mysqli_fetch_array($ckdgg);

if($rest['id']!=''){
?>

 
<?php $totalno++; $g++; } }  } ?>

<?php 
  $where=' where '.$wheres.'  ';
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&statusid='.$_REQUEST['statusid'].'&startDate='.$_REQUEST['startDate'].'&endDate='.$_REQUEST['endDate'].'&searchusers='.$_REQUEST['searchusers'].'&'; 
$rs=GetRecordList('*','queryMaster','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);

$c=GetPageRecord('id','queryNotes','queryId="'.$rest['id'].'"'); 
$notesdata=mysqli_fetch_array($c);
$checkQuery=1;


$rs133=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" and confirmQuote=1');   
$packageDatas=mysqli_fetch_array($rs133); 
?>

<tr style=" <?php if($notesdata==0){ ?> background-color: #eff3f6;<?php } ?> <?php  if($rest['priorityStatus']==1){?> background-color: #ffe7e7;<?php } ?> ">
  <td align="left" valign="top"> 
  
  <?php if($checkQuery==1){ ?><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" <?php if($rest['priorityStatus']==1){ ?>style="color:#FF0000"<?php } ?>><?php } ?>
  <div style="font-weight:600;"><?php if($checkQuery==1){  echo encode($rest['id']); } ?></div><div style=" color:#666666; font-size:11px;"><?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></div>
  
  
  
  
 <?php if($notesdata['id']!=''){ ?><div class="notes"><i class="fa fa-comment" aria-hidden="true"></i> Notes</div><br /><?php } ?>
 <?php if($rest['priorityStatus']==1){ ?> 
 <img src="images/hot.gif" width="32" height="23" /><?php } ?>
  
  <?php if($checkQuery==1){ ?></a><?php } ?>  </td>
<td align="left" valign="top"><div style="font-weight:600; margin-bottom:3px;"><?php if(checkduplicate('queryMaster',' clientId='.$rest['clientId'].' and id!='.$rest['id'].'')=='yes'){ ?><i class="fa fa-files-o" aria-hidden="true" style="color:#FF6600;"></i><?php } ?> <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></div><?php if($checkQuery==1){ ?><div style="  font-size:11px;margin-bottom:2px;"><i class="fa fa-mobile" aria-hidden="true"></i> <?php echo stripslashes($clientData['mobile']); ?></div><div style="  font-size:11px;"><i class="fa fa-envelope" aria-hidden="true"></i> 
<?php echo stripslashes($clientData['email']); ?></div><?php } ?></td>
<td align="left" valign="top">
<?php $rsb=GetPageRecord('*','querySourceMaster',' id="'.$rest['leadSource'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['name']); }?> </td>
<td align="left" valign="top"><?php if(date('d-m-Y',strtotime($rest['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['startDate'])); } ?></td>
<td align="left" valign="top"><?php echo $rest['fromCity']; ?></td>
<td align="left" valign="top"><div style="max-width:180px; overflow:hidden;overflow-wrap: break-word;"><?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										<span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo  getCityName($value); ?></span>
										<?php }?></div></td>
<td align="left" valign="top"><?php echo $rest['adult']+$rest['child']+$rest['infant']; ?></td>
<td align="left" valign="top"><?php echo getstatus($rest['statusId']); ?> </td>
<td align="left" valign="top"><?php if($LoginUserDetails['id']==3201){ ?>
<select id="assignTo<?php echo encode($rest['id']); ?>" name="assignTo<?php echo encode($rest['id']); ?>" class="form-control" style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"   autocomplete="off" onchange="changeAssignTo('<?php echo encode($rest['id']); ?>');">
  <option value="0" >Assign To</option>
  <?php  

$rs22=GetPageRecord('*','sys_userMaster','  userType=1 or userType=0 order by firstName asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$rest['assignTo']){ ?>selected="selected"<?php } ?>>
  <?php if($restuser['id']==1){ echo 'Not Assign'; } else { ?>
  <?php echo $restuser['firstName']; ?> <?php echo $restuser['lastName'];  }?></option>
  <?php } ?>
</select>
<?php } ?><?php  if($LoginUserDetails['userType']==0){  if($LoginUserDetails['userType']==0){ ?> <select id="assignTo<?php echo encode($rest['id']); ?>" name="assignTo<?php echo encode($rest['id']); ?>" class="form-control" style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"   autocomplete="off" onchange="changeAssignTo('<?php echo encode($rest['id']); ?>');">
  <option value="0" >Assign To</option>
  <?php  

$rs22=GetPageRecord('*','sys_userMaster','  userType=1 or userType=0 order by firstName asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$rest['assignTo']){ ?>selected="selected"<?php } ?>>
  <?php if($restuser['id']==1){ echo 'Not Assign'; } else { ?>
  <?php echo $restuser['firstName']; ?> <?php echo $restuser['lastName'];  }?></option>
  <?php } ?>
</select><?php } } ?>
<div style="font-size:12px; margin-top:7px;"><strong>Assigned:</strong> <?php $rs22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); if($restuser['id']==1){ echo 'Not Assign'; } else {  echo $restuser['firstName']; ?> <?php echo $restuser['lastName'];  }?></div>
<div style="font-size:12px; margin-top:7px;">Update: <?php echo date('d/m/Y h:i A',strtotime($rest['updateDate'])); ?></div></td> 
<td align="left" valign="top"><?php if($checkQuery==1){ ?><div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical" <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Query" aria-describedby="tooltip504165"<?php } ?> ></i>										 </button>
                                            <div class="dropdown-menu" style="">
											<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>
 			<a class="dropdown-item"  href="display.html?ga=query&add=1&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Edit</a>
 			
			<?php if(trim($clientData['mobile'])!=''){
				$mobileno='';
				if(strlen($clientData['mobile'])>10){
				$mobileno=stripslashes($clientData['mobileCode']).stripslashes($clientData['mobile']);
				}
				if(strlen($clientData['mobile'])==10){
				$mobileno='91'.stripslashes($clientData['mobile']);
				}
				
			 ?>
			<a class="dropdown-item"  target="_blank" href="https://api.whatsapp.com/send?text=Hi&phone=<?php echo $mobileno; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i> &nbsp;WhatsApp Msg.</a><?php } ?>
			
			
											<?php } ?>
                                                <a class="dropdown-item" href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;View</a>         
												
						 <?php if($_SESSION['userid']==1){ ?>
					 <a class="dropdown-item" onclick="dltfunction(<?php echo encode($rest['id']); ?>);" style="cursor:pointer;"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;Delete</a>                                 <?php } ?>
												
												                                   </div>
                      </div><?php } ?></td>
</tr>


<?php  $totalno++; } ?>
                                          </tbody>
                              </table>
                           					</form>
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Query</div>
						   <?php } else { ?>
								<div class="mt-3 pageingouter">	
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
							  </div>
										  
										<?php } ?>
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	<script>



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>
				
	
<script>
function changeAssignTo(id){
var assignTo = $('#assignTo'+id).val();  
$('#actoinfrm').attr('src','actionpage.php?action=changeassignstatus&queryid='+id+'&assignTo='+assignTo);
}


$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#bulkassign').show();
		}else{
		$('#bulkassign').hide();
		}
    });
});
function selectedfun(){ 
var mychecked = $('.checkBoxClass:checked').length 
if (mychecked==0) {
    $('#bulkassign').hide();
}
if (mychecked>0) {
    $('#bulkassign').show();
} 
}



 




function dltfunction(id)
{
   if(confirm('Are you sure your want to delete?'))
   {
     window.location.href = 'display.html?ga=query&dltid='+id;
   }
}



</script>