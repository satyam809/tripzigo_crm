<?php 
if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'sys_userMaster',$where1);   
$editresult=mysqli_fetch_array($rs1); 
 

} 
 ?>
 
<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 2px !important;font-size: 12px; text-transform: uppercase;}


@import "compass/css3";

.new_site { }
.new_site_ribbon {
	bottom: 0px;
    height: 30px;
    background: rgb(201,46,46);
    padding: 3px 5px;
    width: 200px;
    position: relative;
	color:#fff;
	text-align: center;
	}
.new_site_ribbon:before {content: "";
    top: 0px;
    width: 0;
    height: 0px;
    border-width: 15px 6px;
    border-style: solid;
    border-color: rgb(201,46,46) rgb(201,46,46) rgb(201,46,46) transparent;
    position: absolute;
    left: -10px;}
.new_site_ribbon:after {
    top: 0px;
  position: absolute;
content: '';
width: 0;
height: 0;
border-left: 10px solid rgb(201,46,46);
border-top: 10px solid transparent;
border-bottom: 10px solid transparent;
right: -10px;
border-width: 15px 10px;
}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

<div class="page-content">
<div class="row">
<div class="col-md-12 col-xl-12">
<div class="card" style="margin: auto; padding: 0px 50px; background-color: #FFFFFF;">
 <div class="card-body" style="padding:0px;"> 
 <form action="" method="get" enctype="multipart/form-data" > 
		  <table width="100%" border="0" cellspacing="0" cellpadding="5">
<tr>
<td width="77%"><h4 class="card-title" style=" margin-top:0px; width:100%;" id="revtitle">Update Sales Target - <?php echo $editresult['firstName']; ?> <?php echo $editresult['lastName']; ?></h4></td>
<td width="17%" align="right"><select name="targetYear" id="targetYear" class="form-control">
<?php for($i=date('Y'); $i<=date('Y')+10; $i++){ ?>
<option value="<?php echo $i; ?>" <?php if($_REQUEST['targetYear']== $i){ ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
<?php } ?> 
</select></td>
<td width="6%" align="right"><input name="Save" type="submit" value="Set Year" id="savingbutton" class="btn btn-primary"></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" />
<input type="hidden" name="add" value="1" />
</form>
</div>
</div>
</div>
</div>
  
									
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                 
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="margin: auto; border: 1px solid #ddd; padding: 0px 50px; background-color: #FFFFFF;">
						 <div class="card-body" style="padding:0px;">  
                                      
									
								  

<div class="row">
<div class="col-md-12 col-xl-12">
<div class="row " style="margin-top:20px;">
 <style>
 	.dataColor { font-weight: 600;}
 </style>

 <table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr  style="background-color: #148cc9; color: #fff;">
    <td height="50"><div align="center"><strong>Month</strong></div></td>
    <td height="50"><div align="center"><strong>Target Amount</strong></div></td>
    <td><div align="center"><strong>Total Query </strong></div></td>
    <td><div align="center"><strong>Total Follow Up </strong></div></td>
    <td><div align="center"><strong>Total Confirmed </strong></div></td>
    <td><div align="center"><strong>Total Lost </strong></div></td>
    <td><div align="center"><strong>Total Revenue </strong></div></td>
    <td><div align="center"><strong>Total Profit </strong></div></td>
    <td><div align="center"><strong>Total Achieved</strong></div></td>
    <td><strong>Progress</strong></td>
  </tr>
  <?php 
  if($_REQUEST['targetYear']!=''){
  	$currYear=$_REQUEST['targetYear'];
  }else{
  	$currYear=date('Y');
  }
   
  for($i=1; $i<=12; $i++){
  
	$ba=GetPageRecord('*','salesTargetMaster',' salesPersonId="'.decode($_REQUEST['id']).'" and targetMonth="'.$i.'" and targetYear="'.$currYear.'"');  
	$targetData=mysqli_fetch_array($ba);
  
   ?>
  <tr>
    <td><div class="new_site"><div class="new_site_ribbon"><?php echo date('F Y', strtotime($currYear.'-'.$i.'-01')); ?></div>
        </div></td>
    <td><input name="targetAmount<?php echo $i; ?>" type="number" class="form-control" id="targetAmount" value="<?php echo $targetData['targetAmount']; ?>" style="text-align: center;"></td>
    <td><div align="center" class="dataColor" >
      <?php $a=GetPageRecord('*','queryMaster',' assignTo="'.decode($_REQUEST['id']).'" and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'"');  echo number_format(mysqli_num_rows($a));
		$totalQuery+=mysqli_num_rows($a);
		 ?>
    </div></td>
    <td><div align="center" class="dataColor" >
      <?php $a=GetPageRecord('*','queryMaster',' assignTo="'.decode($_REQUEST['id']).'" and statusId=9 and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'"');  echo number_format(mysqli_num_rows($a)); $totalFollowupQuery+=mysqli_num_rows($a); ?>
    </div></td>
    <td><div align="center" class="dataColor" >
      <?php $a=GetPageRecord('*','queryMaster',' assignTo="'.decode($_REQUEST['id']).'" and statusId=5 and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'"');  echo number_format(mysqli_num_rows($a)); $totalConfirmedQuery+=mysqli_num_rows($a); ?>
    </div></td>
    <td><div align="center" class="dataColor" >
      <?php $a=GetPageRecord('*','queryMaster',' assignTo="'.decode($_REQUEST['id']).'" and statusId=6 and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'"');  echo number_format(mysqli_num_rows($a));  $totalLostQuery+=mysqli_num_rows($a); ?>
    </div></td>
    <td><div align="center" class="dataColor" >&#8377;<?php $ba=GetPageRecord('SUM(grossPrice) as totalClientCost','sys_packageBuilder',' queryId in (select id from queryMaster where assignTo="'.decode($_REQUEST['id']).'" and statusId=5 and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'") and confirmQuote=1'); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['totalClientCost']); $totalRevenue+=$packagecost['totalClientCost']; ?>
      </div></td>
    <td><div align="center" class="dataColor" >
      &#8377;<?php  
	$ba=GetPageRecord('SUM(supplierAmount) as totalsupplierAmount','sys_packageBuilderEvent',' packageId in (select id from sys_packageBuilder where queryId in (select id from queryMaster where assignTo="'.decode($_REQUEST['id']).'" and statusId=5 and MONTH(dateAdded)="'.date('m', strtotime($currYear.'-'.$i.'-01')).'" and YEAR(dateAdded)="'.date('Y', strtotime($currYear.'-'.$i.'-01')).'") and confirmQuote=1) '); $suppTotalcost=mysqli_fetch_array($ba); echo number_format(round($packagecost['totalClientCost']-$suppTotalcost['totalsupplierAmount']));
		
		$totalProfit+=round($packagecost['totalClientCost']-$suppTotalcost['totalsupplierAmount']);
		
		 ?>
    </div></td>
    <td><div align="center" class="dataColor" ><?php if($targetData['targetAmount']>0 && $packagecost['totalClientCost']>0){ echo $fianlpercentage=number_format(($packagecost['totalClientCost']/$targetData['targetAmount']*100),2); }else{ echo $fianlpercentage='0'; } ?>%
    </div></td>
    <td><div style="width:100px; background-color:#F3F3F3; border:1px solid #ddd;height:10px;">
	
	<div style="height:10px; <?php if($fianlpercentage>59){ ?> background-color:#009900;<?php } ?>  <?php if($fianlpercentage>29 && $fianlpercentage<59){ ?>background-color:#FF9900;<?php } ?> <?php if($fianlpercentage<29 ){ ?>background-color:#FF0000;<?php } ?> width:<?php echo $fianlpercentage; ?>%;"></div>
	</div></td>
  </tr>
  
  <?php } ?>
  <tr style="background-color: #148cc9; color: #fff;">
    <td colspan="2" align="right"><strong>Total: </strong></td>
    <td><div align="center"><strong><?php echo number_format($totalQuery); ?></strong></div></td>
    <td><div align="center"><strong><?php echo number_format($totalFollowupQuery); ?></strong></div></td>
    <td><div align="center"><strong><?php echo number_format($totalConfirmedQuery); ?></strong></div></td>
    <td><div align="center"><strong><?php echo number_format($totalLostQuery); ?></strong></div></td>
    <td><div align="center"><strong>&#8377;<?php echo number_format($totalRevenue); ?></strong></div></td>
    <td><div align="center"><strong>&#8377;<?php echo number_format($totalProfit); ?></strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


 
          
</div>
</div>   
  
</div>							  
							 
							  
							  </div>
							
								  
						  </div>    </div>   </div>
					 


<div class="modal-footer">  
<input name="Cancel" type="button" value="Cancel"   aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" onclick="createqueryclose()">
<input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';">
<input autocomplete="false" name="action" type="hidden" id="action" value="updateSalesTarget" />  
<input autocomplete="false" name="targetYear" type="hidden" id="targetYear" value="<?php echo $currYear; ?>" />
<input autocomplete="false" name="salesPersonId" type="hidden" id="salesPersonId" value="<?php echo $_REQUEST['id']; ?>" />
</div>

					</form>
					 
 
 </div>
 </div>
 </div>
 </div>
 