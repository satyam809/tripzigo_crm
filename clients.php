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
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Clients<div class="float-right">
									<form  action=""  class="newsearchsecform"  style="left:66px;"  method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
									
									
									
									<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Client') !== false) { ?>
									<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Client',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addclient" >Add Client</button>
									<?php } ?>
									</div></h4> 
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
							 <?php if($_SESSION['userid']==1){ ?> <div id="bulkassign" style="display:none;padding: 5px 2px; background-color: #f0f0f0; border-bottom: 2px solid #ddd; border-radius: 3px; margin-bottom: 10px; width:100%; float:left;"><table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td style="font-size:13px;"><input type="checkbox" id="ckbCheckAll"  style="width: 16px; height: 16px;margin-left: 6px;" /></td>
    <td style="font-size:13px;">Select All&nbsp;</td>
    <td><select id="assignToPerson" name="assignToPerson" class="form-control" style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"   autocomplete="off" >
  <option value="0" >Select Client Group</option>
  <?php  

$rs22=GetPageRecord('*','clientGroupMaster','  status=1 order by name asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
?>
  <option value="<?php echo $restuser['id']; ?>" ><?php echo stripslashes($restuser['name']); ?></option>
  <?php } ?>
</select></td>
    <td><button type="submit"  id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.value='Saving...';"  style="float:right;padding: 3px 10px;"  >
                                                Save
                                            </button></td>
    <td><input autocomplete="false" name="action" type="hidden" id="action" value="bulkclientaddtogroup" /></td>
  </tr>
</table>
</div> <?php } ?>



							 <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="1%"></th>
                                                  <th>Name</th>
                                                    <th width="1%">Mobile</th>
                                                    <th width="1%">Email</th>
                                                    <th width="1%">City</th>
                                                    <th width="1%">Status</th>
                                                    <th width="12%" align="left">By</th>
                                                    <th width="1%">&nbsp;</th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php

$searchKeyword='';
$searchKeyword=$_REQUEST['keyword'];
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain='';
if($searchKeyword!=''){ 
 $searchwhere=' and (	firstName like "%'.$searchKeyword.'%" or mobile like "%'.$searchKeyword.'%"  or email like "%'.$searchKeyword.'%"    )'; 
}


$where=' where (userType=4) and (firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%") order by id desc'; 
 
$limit=clean($_GET['records']);
$page=clean($_GET['page']);

$sNo=1;

$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$searchKeyword.'&';
 
$rs=GetRecordList('*','userMaster','  '.$where.'  ','50',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2]; //pagination

while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="1%"><?php if($rest['email']!='' && $_SESSION['userid']==1){ ?>
    <input type="checkbox" name="assignall[]" class="checkBoxClass" id="assignqury" value="<?php echo encode($rest['id']); ?>" onclick="selectedfun();" style="width: 16px; height: 16px;"><?php } ?></td>
  <td><a href="display.html?ga=clients&id=<?php echo encode($rest['id']); ?>&view=1"><strong><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></strong></a></td>
  <td width="1%"><?php  echo checkmobile(trim($rest['mobile'])); ?></td>
  <td width="1%"><?php echo $rest['email']; ?></td>
  <td width="1%"><?php  $a=GetPageRecord('*','cityMaster','id="'.$rest['city'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['name']; ?></td>
  <td width="1%"><?php echo newstatusbadges($rest['status']); ?></td>
<td width="12%" align="left"><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td width="1%"><a class="dropdown-item neweditpan" href="display.html?ga=clients&id=<?php echo encode($rest['id']); ?>&view=1" style="float:left;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
<td width="1%">
<a class="dropdown-item neweditpan"   onclick="loadpop2('Edit Client',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addclient&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table> 
							  
							   
							  </form>
							  
                                         
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Clients</div>
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

</script>

