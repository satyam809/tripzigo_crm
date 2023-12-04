<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 

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


?>


<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Insert Itinerary<div class="float-right">
									<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=2"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="margin-bottom:10px;">Back to query</button></a>
									</div></h4>
                                 <div   style=" margin-top: 20px; margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by query ID, name, destination"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;"> 
								  <input name="qid" type="hidden" value="<?php echo $_REQUEST['qid']; ?>" />
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" /> 
								  </form>
								  </div>
								 </div>
								 
							  </div>   
							 
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="2%">&nbsp;</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Date</th>
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
$where4=' and (name like "%'.$_REQUEST['keyword'].'%"  or destinations like "%'.$_REQUEST['keyword'].'%" or queryId like "'.decode($_REQUEST['keyword']).'") ';
}


$totalno='1';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where 1  '.$where2.' '.$where3.'  '.$where4.'  order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&qid='.$_REQUEST['qid'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_packageBuilder','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="2%"><a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><div style="width: 150px; height: 100px; overflow: hidden; border: 0px solid #b1b1b1; padding: 1px; box-shadow: 2px 2px 5px #00000042;"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" style="width:100%; height:auto; min-height:100%;"></div></a></td>
<td><a  target="_blank" href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" style="color: #000; font-weight: 600;"><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:11px; margin-top:2px;">ID: <?php echo encode($rest['id']); ?> -  <?php echo stripslashes($rest['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)</div><?php } ?></a></td>
<td>&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> </td>
<td>In: <?php echo displaydateinword($rest['startDate']); ?><br />
Out: <?php echo displaydateinword($rest['endDate']); ?></td>
<td> 
<div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['addedBy']); ?></div>
<div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div></td>
<td><a target="actoinfrm" onclick="$('.savingbutton<?php echo encode($rest['id']); ?>').attr('disabled','true');$('.savingbutton<?php echo encode($rest['id']); ?>').text('Inserting...');" href="actionpage.php?action=insertitinerary&qid=<?php echo $_REQUEST['qid']; ?>&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-info btn-lg waves-effect waves-light savingbutton<?php echo encode($rest['id']); ?>" id="savingbutton"  ><i class="fa fa-plus" aria-hidden="true"></i> Select </button></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Itinerary</div>
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
function duplicatePackage(id) {
  var result = confirm("Are you sure you want to create duplicate package?");
  if (result==true) {
   $('#ActionDiv').load('actionpage.php?pid='+id+'&action=addduplicatepackage');
  } else {
   return false;
  }
}
</script>