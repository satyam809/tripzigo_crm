<?php 

if($_REQUEST['action']=='lockquery'){
$st=$_REQUEST['st'];
if($st==0){
$lockPostSaleSupplier=1;
}
if($st==1){
$lockPostSaleSupplier=0;
}

$namevalue ='lockPostSaleSupplier="'.$lockPostSaleSupplier.'"'; 
$where='id="'.decode($_REQUEST['id']).'"';    
updatelisting('queryMaster',$namevalue,$where);  
}
$rs1=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"');   
$editresult=mysqli_fetch_array($rs1); 

$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);



$rs1333=GetPageRecord('*','sys_PackageTips','packageId="'.$packagedatadetials['id'].'" and title like "%Inclusion%"');   
$packageTipsData=mysqli_fetch_array($rs1333);

?>

<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
 .bulbblue2 {
    height: 30px;
    width: 30px;
    background-color: #3b5de7;
    border-radius: 100%;
    text-align: center;
    overflow: hidden;
    line-height: 34px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    margin-right: 20px;
}
.cnfno{width: 140px;}
</style>
<div class="row">
<div class="col-md-12 col-xl-12" style="margin-left: 5px; padding-right:20px !important; ">

<?php if($packagedatadetials['id']>0){ ?>

<table class="table table-hover mb-0" <?php if($editresult['lockPostSaleSupplier']==1){ ?> style="pointer-events: none;"<?php } ?>>

                                            <thead>
                                                <tr>
                                                  <th>&nbsp;</th>
                                                  <th>Supplier</th>
                                                    <th><div align="center">Booking<br />Status</div></th>
                                                    <th><div align="center">Payment<br />
                                                    Status</div></th>
                                                    <th><div align="center">Invoice<br />Amount</div></th>
                                                    <th><div align="center">Cancellation<br />Date</div></th>
                                                    <th><div align="center">Due <br />
                                                    Date</div></th>
                                                    <th><div align="center">Paid<br />
                                                    Amount</div></th>
                                                    <th><div align="center">Pending<br />
                                                    Amount</div></th>
                                                    <th><div align="center">Remark</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$rsads=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType!="Leisure" group by sectionType order by sectionType asc');
while($groupservices=mysqli_fetch_array($rsads)){ 
?>
<tr>
  <td colspan="10" bgcolor="#1e5598" style="color:#fff; padding:10px; font-weight:800; border-radius: 3px;"><i class="fa <?php if($groupservices['sectionType']=='Accommodation'){ ?>fa-bed<?php } ?><?php if($groupservices['sectionType']=='Activity'){ ?>fa-blind<?php } ?><?php if($groupservices['sectionType']=='Transportation'){ ?>fa-car<?php } ?><?php if($groupservices['sectionType']=='FeesInsurance'){ ?>fa-credit-card<?php } ?><?php if($groupservices['sectionType']=='Meal'){ ?>fa-cutlery<?php } ?><?php if($groupservices['sectionType']=='Flight'){ ?>fa-plane<?php } ?>" aria-hidden="true"></i> &nbsp;<?php if($groupservices['sectionType']=='FeesInsurance'){ echo 'Fees - Insurance'; } else {  echo $groupservices['sectionType'];  } ?></td>
</tr>
<?php
$netflightcosting=0;
$totalnetCost=0;
$totalGross=0;

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and  sectionType="'.$groupservices['sectionType'].'" and sectionType!="Leisure" order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 


$aadv=GetPageRecord('count(id) as totalnotes','supplierNotes','serviceId="'.$rest['id'].'"');  
$notesyes=mysqli_fetch_array($aadv);

$netCost=0;
$markupValue=0;
$gross=0;

$predate=date('d-m-Y',strtotime($editresult['startDate']));
?>


<?php

if($rest['sectionType']=='Accommodation'){

 $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);

} else { 

if($rest['transferCategory']=='Private'){

 $netCost=round($rest['vehicle']*$rest['adultCost']);

} else {

 $netCost=round($rest['adultCost']*$editresult['adult'])+($rest['childCost']*$editresult['child']);

if($rest['sectionType']=='Flight'){
$netflightcosting=$netCost+$netflightcosting;
}


}
 
}
$netCost=$rest['overall_pricing'];



$totalnetCost=$netCost+$totalnetCost;

$markupValue=($rest['markupPercent']*$netCost/100);
$gross=round($netCost+$markupValue);

$totalGross=$gross+$totalGross;


if($rest['supplierAmount']>0){
//$netCost=$rest['supplierAmount'];
}


 
 ?>

<tr>
  <td colspan="10" style=" font-weight: 700; "   ><?php echo stripslashes($rest['name']); ?><?php if($rest['sectionType']=='Accommodation'){ ?>
<span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span> 

<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo stripslashes($rest['hotelRoom']); ?> - <?php echo date('d-m-Y',strtotime($rest['startDate'])); ?> To <?php echo date('d-m-Y',strtotime($rest['endDate'])); ?></div>

<?php } else { ?>


<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo date('d-m-Y',strtotime($rest['startDate'])); if($rest['sectionType']!='FeesInsurance'){ ?> - <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('g:i A',strtotime($rest['checkIn']));  ?> to <?php echo date('g:i A',strtotime($rest['checkOut']));  ?> <?php   }  if($rest['transferCategory']=='Private'){ ?> - <strong>Vehicle: </strong><?php echo stripslashes($rest['vehicle']); } ?></div>


<?php } ?></td>
  </tr>
<tr>
  <td><i class="fa fa-pencil" aria-hidden="true" style="font-size:25px; color:#002ed7; cursor:pointer;" onclick="loadpop('Post Sales Supplier',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addpostsalessupplier&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" title="Post Sales Supplier"></i></td>
  <td><?php  
$rs2=GetPageRecord('*','userMaster',' id="'.$rest['supplierId'].'" and status=1 and userType=5 order by firstName asc');
if(mysqli_num_rows($rs2)>0){ $restsup=mysqli_fetch_array($rs2); echo $restsup['company']; }else{ echo 'No Supplier Selected'; } ?></td>
  <td><div style="border-radius: 3px; text-align: center; padding:3px;font-size: 12px; width: 140px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if($rest['bookingStatusId']==0){ ?>e77350<?php } ?><?php if($rest['bookingStatusId']==1){ ?>e3445a<?php } ?><?php if($rest['bookingStatusId']==2){ ?>01c875<?php } ?><?php if($rest['bookingStatusId']==3){ ?>a55cd9<?php } ?><?php if($rest['bookingStatusId']==4){ ?>323232<?php } ?>;"><?php if($rest['bookingStatusId']==0){ ?>Mail Sent<?php } ?><?php if($rest['bookingStatusId']==1){ ?>Pending Confirmation<?php } ?><?php if($rest['bookingStatusId']==2){ ?>Confirmed<?php } ?><?php if($rest['bookingStatusId']==3){ ?>Not Confirmed<?php } ?><?php if($rest['bookingStatusId']==4){ ?>Rates Negotiation<?php } ?></div> 
  <?php if($rest['bookingStatusId']==2){ ?><div style=" font-size:12px; color:#666666;">Conf.: <?php echo $rest['confirmationNo']; ?></div><?php } ?>
</td>
  <td>
  <div style="border-radius: 3px; text-align: center; padding:3px; font-size: 12px; width:130px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if($rest['status']==0){ ?>e77350<?php } ?><?php if($rest['status']==1){ ?>01c875<?php } ?>;"><?php if($rest['status']==0){ ?>Payment Pending<?php } ?><?php if($rest['status']==1){ ?>Amount Paid<?php } ?></div>
     </td>
  <td>
  <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $netCost; ?></div>
     </td>
<td><div style=" width:100px; text-align:center; background-color:transparent; font-size:12px; <?php if($rest['dueDate']!='' && date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970' && $rest['dueDate']<date('Y-m-d') ){  ?>border:1px solid #FF0000;<?php } ?>"><?php if($rest['supplierCancellationDate']!='' && date('d-m-Y',strtotime($rest['supplierCancellationDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['supplierCancellationDate'])); } ?></div> </td>
<td><div style=" width:100px; text-align:center; background-color:transparent; font-size:12px; <?php if($rest['dueDate']!='' && date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970' && $rest['dueDate']<date('Y-m-d') ){  ?>border:1px solid #FF0000;<?php } ?>"><?php if($rest['dueDate']!='' && date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['dueDate'])); } ?></div> </td>
<td><div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $rest['paidAmount']; ?></div></td>
<td><div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $netCost-$rest['paidAmount']; ?></div></td>
<td align="center"><i class="fa fa-comment" aria-hidden="true" style="font-size:22px; <?php if($notesyes['totalnotes']>0){ ?> color:#FF6600; <?php } else { ?>  color:#c1c1c1; <?php } ?> cursor:pointer;"  onclick="loadpop('Remark',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addSupplierRemark&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" title="Remark (<?php echo $notesyes['totalnotes']; ?>)" ></i></td>
</tr> 

<?php $totalno++; } } ?>
                                            </tbody>
                              </table>
							  
							  <div style="text-align:right; overflow:hidden; margin-top:20px; padding-top:10px; border-top:1px solid #ddd;">
						
<?php if($_SESSION['userid']==1){ ?>				
<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=<?php echo $_REQUEST['c']; ?>&action=lockquery&st=<?php echo ($editresult['lockPostSaleSupplier']); ?>">
<button type="button" class="btn btn-pink btn-sm waves-effect waves-light"  style="margin-bottom:0px; float:right;"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php if($editresult['lockPostSaleSupplier']==1){ ?>Unlock<?php }else{ echo 'Save'; } ?></button>
</a>							  
<?php } ?>
<?php if($_SESSION['userid']!=1 && $editresult['lockPostSaleSupplier']==0){ ?>				
<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=<?php echo $_REQUEST['c']; ?>&action=lockquery&st=<?php echo ($editresult['lockPostSaleSupplier']); ?>">
<button type="button" class="btn btn-pink btn-sm waves-effect waves-light"  style="margin-bottom:0px; float:right;"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php if($editresult['lockPostSaleSupplier']==1){ ?>Unlock<?php }else{ echo 'Save'; } ?></button>
</a>							  
<?php } ?>

							  </div>
<?php } else {  ?>

<div style="text-align:center; font-size:16px; padding:30px; color:#999999; "><div style="text-align:center; font-size:60px;"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
Query Not Confirmed</div>
<?php } ?>

</div>
</div>


<script>
function saveexpcontent(id){  
var paidAmount = Number($('#paidAmount'+id).val()); 
var supplierAmount = Number($('#supplierAmount'+id).val()); 
var restpending = Number(supplierAmount-paidAmount);
$('#pendingAmount'+id).val(restpending);

var supplierId = encodeURI($('#supplierId'+id).val()); 
var dueDate = encodeURI($('#dueDate'+id).val());  
var suppliercancellationdate = encodeURI($('#suppliercancellationdate'+id).val());  
var bookingStatusId = encodeURI($('#bookingStatusId'+id).val());  
var confirmationNo = encodeURI($('#confirmationNo'+id).val());
if(bookingStatusId==2){
$('#confirmationNo'+id).show();
}else{
$('#confirmationNo'+id).hide();
}




var pendingAmount = encodeURI($('#pendingAmount'+id).val()); 
var status = encodeURI($('#status'+id).val()); 
 
$('#ActionDiv').load('actionpage.php?action=savesuppliercosting&id='+id+'&supplierAmount='+supplierAmount+'&supplierId='+supplierId+'&dueDate='+dueDate+'&paidAmount='+paidAmount+'&bookingStatusId='+bookingStatusId+'&pendingAmount='+pendingAmount+'&suppliercancellationdate='+suppliercancellationdate+'&status='+status+'&confirmationNo='+confirmationNo);

}


</script>