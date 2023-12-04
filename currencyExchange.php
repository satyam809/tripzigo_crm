<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 
?>
 <script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "#emailsignature",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Currency Exchange Rate<div class="float-right">
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Currency Exchange Rate',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcurrencyexchange" style="margin-bottom:20px;">Add Currency</button> <?php } ?>
									</div></h4> 
							 <div   style="  margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
								  </form>
								  </div>
								 </div>
								 
							  </div>
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th>Exchange Rate</th>
                                                    <th>Status</th>
                                                    <th>Update</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where name!="" order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','currencyExchangeMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td>1 <?php echo stripslashes($rest['name']); ?></td>
  <td><?php echo stripslashes($rest['rate']); ?> INR</td>
  <td><?php if($rest['status']==1){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
<td><?php  $a=GetPageRecord('*','userMaster','id="'.$rest['addedBy'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['firstName']; ?><br />
<?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td><div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical"></i>                                            </button>
                                            <div class="dropdown-menu" style="">
                                             <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>   <a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Edit Currency Exchange Rate',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcurrencyexchange&id=<?php echo encode($rest['id']); ?>">Edit Currency</a>            <?php } ?>                                </div>
                                        </div></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Currency Exchange</div>
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