<?php   
$fd=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$queryData=mysqli_fetch_array($fd);


?>

<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.conf{width: 100px;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 5px;
    text-align: center;}
</style>
<div class="row">
<div class="col-md-12 col-xl-12" style="margin-left: 5px; padding-right: 13px !important;">
 

<div style="margin-bottom:10px;"></div>
 
<div class="col-lg-12" style="    padding: 0px; padding-top:15px;"> 
<h4 class="mt-0 header-title" style="border-bottom:0px; overflow:hidden;">Guests (<?php $ba=GetPageRecord('count(id) as totalpayments','sys_guests',' queryId="'.$editresult['id'].'" '); $packagecostrecivedpayment=mysqli_fetch_array($ba); echo number_format($packagecostrecivedpayment['totalpayments']); ?>)
<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Guest') !== false) { ?>


<button type="button" class="btn btn-pink btn-sm waves-effect waves-light" onclick="loadpop('Add Guest',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuest&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>" style="margin-bottom:0px; float:right;">Add Guest</button>
<?php } ?>


</h4>
  <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>First Name</th>
                                                  <th>Last Name</th>
                                                  <th>Gender</th>
                                                  <th>Date of Birth </th>
                                                  <th><div align="right">Action</div></th>
                                                </tr>
                                            </thead>
<tbody>
<?php 
$totalno=1;
$rs=GetPageRecord('*','sys_guests',' queryId="'.decode($_REQUEST['id']).'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
?>

<tr>
  <td align="left" valign="top"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($rest['lastName']); ?></td>
  <td align="left" valign="top"><span style="text-transform:uppercase;"><?php echo stripslashes($rest['gender']); ?></span></td>
  <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['dob'])); ?></td>
  <td align="left" valign="top"><div align="right">
  <?php  if (strpos($LoginUserDetails["permissionAddEdit"], 'Guest') !== false) { ?>
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Upload Documents',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuestDocuments&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="margin-bottom:0px; margin-bottom: 0px; margin: 0px 5px;">Document</button>
  
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Edit Guest',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuest&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="margin-bottom:0px; margin-bottom: 0px; margin: 0px 5px;">Edit</button>
  

  <?php } ?>
  </div>
  </td>
</tr>


<?php  $totalno++; } ?>
        </tbody>
      </table> 
</div>    
</div>
							   
							   
							   