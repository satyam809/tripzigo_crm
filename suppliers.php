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
                                    <h4 class="card-title cardtitle">Suppliers<div class="float-right">
									
									<form  action=""  class="newsearchsecform"  style="left:80px;"  method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
									
									
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Supplier',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addsupplier" >Add Supplier</button> <?php } ?>
									</div></h4> 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Company</th>
                                                    <th> Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Location</th>
                                                    <th width="15%">By</th>
                                                    <th width="12%">Date</th>
                                                    <th width="1%">&nbsp;</th>
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

// $where=' where (userType=5) and (firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%") order by id desc'; 


$where ='WHERE
    userMaster.userType = 5
    AND (
        userMaster.firstName LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.lastName LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.email LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.mobile LIKE "%'.$_REQUEST['keyword'].'%" 
        OR (SELECT name FROM cityMaster WHERE id = userMaster.city) LIKE "%'.$_REQUEST['keyword'].'%" 
        OR (SELECT name FROM countryMaster WHERE id = userMaster.country) LIKE "%'.$_REQUEST['keyword'].'%" 
    )order by id desc';



$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
 //$rs=GetRecordList('*','userMaster','  '.$where.'  ','25',$page,$targetpage);
$rs=GetRecordList('userMaster.company,
    userMaster.submitName,
    userMaster.firstName,
    userMaster.lastName,
    userMaster.email,
    userMaster.mobile,
    userMaster.mobileCode,
    (SELECT name FROM cityMaster WHERE id = userMaster.city) AS cityname,
    (SELECT name FROM countryMaster WHERE id = userMaster.country) AS countryname,
    userMaster.addedBy,
    userMaster.dateAdded,
    userMaster.id','userMaster','  '.$where.'  ','25',$page,$targetpage);



$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
    
?>

<tr>
  <td><?php echo stripslashes($rest['company']); ?></td>
  <td><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></td>
<td><?php echo checkemail(stripslashes($rest['email'])); ?></td>
<td><?php if(checkmobile(trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo checkmobile(trim($rest['mobile'])); ?></td>
<td><?php if($rest['cityname']!=''){ echo ($rest['cityname']); ?>, <?php echo ($rest['countryname']); } else { echo '<span class="lightgraytext">Not Selected</span>'; }?></td>

<td width="15%"><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td width="12%"><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></td>
<td width="1%">

<a class="dropdown-item neweditpan" onclick="loadpop2('Edit Supplier',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addsupplier&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Supplier</div>
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