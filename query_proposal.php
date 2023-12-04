<?php
if($_REQUEST['status']==1 || $_REQUEST['status']==2 || $_REQUEST['status']==3){
if($_REQUEST['i']!=''){
$namevalue ='status="'.$_REQUEST['status'].'"';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


if($_REQUEST['status']==4){
if($_REQUEST['i']!=''){
$namevalue ='archiveThis=1';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


if($_REQUEST['status']==5){
if($_REQUEST['i']!=''){
$namevalue ='archiveThis=0';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


$string = '';
$string = preg_replace('/\.$/', '', $editresult['destinationId']);  
$array = explode(',', $string); 
foreach($array as $value)  
{
$destin.=getCityName($value).' ';
} ?>

<style>
.table td, .table th {
    vertical-align: middle;
}
</style>
<div class="sectabnew">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								 <div class="col-md-7 col-xl-7">
								 
								 <ul class="nav nav-tabs nav-tabs-custom" style="border-bottom:0px solid #dee2e6;">
								 
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['s']==0 || $_REQUEST['s']==''){ ?> active show<?php } ?>"  href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=0&s=0"><span class="d-none d-md-block">All</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span></a></li>
   
   
   <li style="display:none;" class="nav-item"><a class="nav-link<?php if($_REQUEST['s']==1){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&status=1&c=2&s=1"><span class="d-none d-md-block">Proposal</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span></a></li>
   
   
   <li style="display:none;" class="nav-item"><a class="nav-link<?php if($_REQUEST['s']==3){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&status=1&c=2&s=3"><span class="d-none d-md-block">Itinerary accepted</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span></a></li>
   
 
   <li style="display:none;" class="nav-item"><a class="nav-link<?php if($_REQUEST['s']==2){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&status=1&c=2&s=2"><span class="d-none d-md-block">Final</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
   
   
    <li class="nav-item"><a class="nav-link<?php if($_REQUEST['s']==4){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&status=1&c=2&s=4"><span class="d-none d-md-block">Archive</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
</ul>
								 
								 </div>
								   <div class="col-md-2 col-xl-2"> 
								  </div>
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by name or destination"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="id" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  <input name="view" type="hidden" value="1" />
								  <input name="c" type="hidden" value="2" />
								  </form>
								  </div>
								 </div>
								 
</div>
<div class="overflowautomobiletable">
<table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="2%">&nbsp;</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Date</th>
                                                    <th><div align="center">Confirm</div></th>
                                                    <th>Created</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$where2='';
if($_REQUEST['s']==1 || $_REQUEST['s']==2 || $_REQUEST['s']==3){
$where2=' and status="'.$_REQUEST['s'].'"';
}

$where3=' and archiveThis=0';

if($_REQUEST['s']==4){
$where3=' and archiveThis=1';
}

if($_REQUEST['keyword']!=''){
$where4=' and (name like "%'.$_REQUEST['keyword'].'%" or destinations like "%'.$_REQUEST['keyword'].'%") ';
}


$totalno='1';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where 1 and  queryId="'.$editresult['id'].'"    '.$where2.' '.$where3.'  '.$where4.'  order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 
$rs=GetRecordList('*','sys_packageBuilder','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$abcde=GetPageRecord('sum(amount) as totalpaymentreceived','sys_PackagePayment','packageId="'.$rest['id'].'" and paymentId!=""'); 
$paymentdata=mysqli_fetch_array($abcde); 
?>

<tr <?php if($rest['confirmQuote']==1){ ?>style="background-color: #e7fff8;"<?php } ?>>
  <td width="2%"> 
  <a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>"><div style="width: 130px; height: 80px; overflow: hidden; border: 0px solid #b1b1b1; padding: 1px; box-shadow: 2px 2px 5px #00000042;"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" style="width:100%; height:auto; min-height:100%;"></div></a>  </td>
<td><a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" style="color: #000; font-weight: 600;"><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:11px; margin-top:2px;">ID: <?php echo encode($rest['id']); ?> -  <?php echo stripslashes($rest['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)</div><?php } ?>


</a><?php if($paymentdata['totalpaymentreceived']>0){ ?>
<div style="margin-top:10px;"><strong>Total Payment Recived:</strong> &#8377;<?php echo number_format($paymentdata['totalpaymentreceived']); ?> <a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=5"><span class="badge badge-success">View</span></a></div>
<?php } ?></td>
<td>&#8377;<?php echo number_format($rest['grossPrice']); ?> </td>
<td>In: <?php echo displaydateinword($rest['startDate']); ?><br />
Out: <?php echo displaydateinword($rest['endDate']); ?></td>
<td> <div align="center">
<?php if($rest['grossPrice']>0){ ?>
<?php if($rest['confirmQuote']==0){ ?>
<div onclick="loadpop('Alert',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmitineararies&id=<?php echo encode($rest['id']); ?>&queryid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-square-o" aria-hidden="true" style="font-size:24px; color:#333333; cursor:pointer;"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to confirm itinerary."  ></i></div>
<?php } ?>

<?php if($rest['confirmQuote']==1){ ?>
<i class="fa fa-check-square" aria-hidden="true" style="font-size:24px; color:#2cb58f; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Itinerary confirmed. This action cannot be undone."></i>
<?php } } ?>

</div></td>
<td> 
<div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['addedBy']); ?></div>
<div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div></td>
<td> <div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical"></i>                                            </button>
                                            <div class="dropdown-menu" style="">
											<div class="leg"  style="display:none;">CHANGE STATUS</div>
											
											  <a  style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=1&i=<?php echo encode($rest['id']); ?>" class="dropdown-item">Proposal<?php if($rest['status']==1){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
											  
											  
											 <?php if($rest['grossPrice']>0){ ?>
											 
											 <a  style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=3&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Itinerary accepted<?php if($rest['status']==3){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
											 
											  <a  style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=2&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Final<?php if($rest['status']==2){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a><?php } ?>
											  
												<!--<hr />-->
												<div class="leg">ACTIONS</div>
												<a class="dropdown-item"  target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html&phone=+91<?php echo str_replace('+91','',$clientData['mobile']); ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i> &nbsp;WhatsApp</a>
											
											<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Proposal') !== false) { ?>	
                                                <a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Itinerary setup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtineraries&id=<?php echo encode($rest['id']); ?>&queryid=<?php echo $_REQUEST['id']; ?>&fromquery=1">Edit Itinerary</a>
												
												
												<a href="#" onclick="duplicatePackage('<?php echo encode($rest['id']); ?>');" class="dropdown-item">Duplicate</a>
												
												<?php } ?>
												
												<?php if($rest['archiveThis']==0){ ?>

	<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=4&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Archive</a>
												<?php } else { ?>
												
												<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=5&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Not Archive</a>
												<?php } ?>
												</div>
                                        </div> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
		</div>								
										
										   <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Itinerary</div>
						   <?php } ?>
						   
						   
<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Proposal') !== false) { ?>			   
<div  class="sectabnew">

<div class="float-right"><button type="button" class="btn btn-info btn-lg waves-effect waves-light" onclick="loadpop('Itinerary setup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtineraries&queryid=<?php echo $_REQUEST['id']; ?>&startDate=<?php echo $editresult['startDate']; ?>&endDate=<?php echo $editresult['endDate']; ?>&adult=<?php echo $editresult['adult']; ?>&child=<?php echo $editresult['child']; ?>&destination=<?php echo trim($destin); ?>"  ><i class="fa fa-plus" aria-hidden="true"></i> Create itinerary</button>
  </div>
									
<div class="float-right">
<a href="display.html?ga=selectitinerary&qid=<?php echo $_REQUEST['id']; ?>"><button type="button" class="btn btn-warning btn-lg waves-effect waves-light" style="margin-right: 10px;" ><i class="fa fa-download" aria-hidden="true"></i> Insert itinerary</button></a>
</div>						
 					
</div>
<?php } ?>

<script>
function duplicatePackage(id) {
  var result = confirm("Are you sure you want to create duplicate package?");
  if (result==true) {
   $('#ActionDiv').load('actionpage.php?pid='+id+'&action=addduplicatepackage&queryid=<?php echo $_REQUEST['id']; ?>');
  } else {
   return false;
  }
}
</script>