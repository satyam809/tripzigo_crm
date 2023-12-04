<div class="container-fluid">
    <div class="main-content">
        <div class="page-content">


            <div class="row">


                <div class="col-md-12 col-xl-12">
                    <h4 style="margin-bottom:30px;"><?php echo stripslashes($result['name']); ?><span
                                style="color: #353535; font-size: 14px; margin-top: 2px; float: right;"><?php echo stripslashes($result['destinations']); ?> - Adult: <?php echo stripslashes($result['adult']); ?> | Child: <?php echo stripslashes($result['child']); ?></span>
                    </h4>


                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="main-content">

        <div class="page-content">


            <!-- start page title -->


            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style=" margin-top:0px;">Pricing </h4>

                            <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate=""
                                  method="post" enctype="multipart/form-data">
                                <table class="table table-hover mb-0">

                                    <thead>
                                    <tr>
                                        <th width="1%">&nbsp;</th>
                                        <th>Item</th>
                                        <th width="30%"><div align="center">Option</div></th>
                                        <th>Type</th>
                                        
                                        <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                <div align="right">Net</div><?php } ?></th>
                                        <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                <div align="center">Markup</div><?php } ?></th>
                                        <!-- <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                <div align="center">International</div><?php } ?></th> -->
                                        <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                <div align="right">Gross</div><?php } ?></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $n=1;

                                    $begin = new DateTime( $result['startDate'] );
                                    $end   = new DateTime( $result['endDate'] );
                                     
                                    $withouthotel=0;
                                    $netflightcosting=0;
                                    $totalnetCost=0;
                                    $totalGross=0;
                                    $hoteloption1=0;
                                    $hoteloption2=0;
                                    $hoteloption3=0;
                                     
                                    
                                    $rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and startDate>="'.$result['startDate'].'" and startDate<="'.$result['endDate'].'" and sectionType!="Leisure" order by packageDays,time(checkIn) asc');
                                    while($rest=mysqli_fetch_array($rs)){ 
                                    $netCost=0;
                                    $markupValue=0;
                                    $gross=0;
                                        ?>

                                        <?php if ($rest['sectionType'] != '') { ?>

                                            <tr>
                                                <td width="1%">
                                                    <div class="bulbblue"
                                                         style="background-color:#343642; margin-right:0px;"><i
                                                                class="fa <?php if ($rest['sectionType'] == 'Accommodation') { ?>fa-bed<?php } ?><?php if ($rest['sectionType'] == 'Activity') { ?>fa-blind<?php } ?><?php if ($rest['sectionType'] == 'Transportation') { ?>fa-car<?php } ?><?php if ($rest['sectionType'] == 'FeesInsurance') { ?>fa-credit-card<?php } ?><?php if ($rest['sectionType'] == 'Meal') { ?>fa-cutlery<?php } ?><?php if ($rest['sectionType'] == 'Flight') { ?>fa-plane<?php } ?>"
                                                                aria-hidden="true"></i></div>
                                                </td>
                                                <td style=" font-weight: 700; cursor:pointer;" <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?> onclick="loadpop('Edit Pricing',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editpricing&id=<?php echo encode($rest['id']); ?>&pid=<?php echo $_REQUEST['id']; ?>&sectionType=<?php echo $rest['sectionType']; ?>&transfertype=<?php echo $rest['transferCategory']; ?>" <?php } ?> ><?php echo stripslashes($rest['name']); ?><?php if ($rest['sectionType'] == 'Accommodation') { ?>
                                                        <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span>

                                                        <div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo stripslashes($rest['hotelRoom']); ?>
                                                            - <?php echo date('d-m-Y', strtotime($rest['startDate'])); ?>
                                                            To <?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div>

                                                    <?php } else { ?>


                                                        <div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo date('d-m-Y', strtotime($rest['startDate']));
                                                            if ($rest['sectionType'] != 'FeesInsurance') { ?> - <i
                                                                    class="fa fa-clock-o"
                                                                    aria-hidden="true"></i> <?php echo date('g:i A', strtotime($rest['checkIn'])); ?> to <?php echo date('g:i A', strtotime($rest['checkOut'])); ?><?php }
                                                            if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
                                                                if ($rest['transferCategory'] == 'Private') { ?> -
                                                                    <strong>Vehicle: </strong><?php echo stripslashes($rest['vehicle']);
                                                                }
                                                            } ?></div>


                                                    <?php } ?></td>
                                                    <td width="30%"><div align="center">
                                                    <?php if($rest['sectionType']=='Accommodation'){ ?>
                                                    <span class="hoteloption<?php echo $rest['hotelOption']; ?>">Option&nbsp;<?php echo $rest['hotelOption']; ?></span>
                                                    <?php } else { echo '-'; }?>
                                                    </div></td>
                                                <td><?php if ($rest['sectionType'] == 'FeesInsurance') {
                                                        echo 'Fees - Insurance';
                                                    } else {
                                                        echo $rest['sectionType'];
                                                    }
                                                    if ($rest['transferCategory'] != '') {
                                                        echo ' - ' . $rest['transferCategory'];
                                                    } ?></td>
                                                <td>
                                                    <div align="right">
                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>&#8377; <?php } ?><?php
                                                        if ($rest['sectionType'] == 'Accommodation') {
                                                            if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
                                                               // echo $netCost = round($rest['overall_pricing']);
                                                                echo $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);
                                                            } else {
                                                                //$netCost = round($rest['overall_pricing']);
                                                                $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);
                                                            }
                                                        } else {

                                                            if ($rest['transferCategory'] == 'Private') {
                                                                if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
                                                                    //echo $netCost = round($rest['overall_pricing']);
                                                                    echo $netCost=round($rest['vehicle']*$rest['adultCost']);
                                                                } else {
                                                                    $netCost=round($rest['vehicle']*$rest['adultCost']);
                                                                }
                                                            } else {
                                                                if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
                                                                   // echo $netCost = round($rest['overall_pricing']);
                                                                    echo $netCost=round($rest['adultCost']*$result['adult'])+($rest['childCost']*$result['child']);
                                                                } else {
                                                                    //$netCost = round($rest['overall_pricing']);
                                                                    $netCost=round($rest['adultCost']*$result['adult'])+($rest['childCost']*$result['child']);
                                                                }
                                                                if ($rest['sectionType'] == 'Flight') {
                                                                    $netflightcosting = $netCost + $netflightcosting;
                                                                }
                                                            }
                                                        }


                                                        $totalnetCost=$netCost+$totalnetCost;

                                                        $markupValue=($rest['markupPercent']*$netCost/100);
                                                        $gross=round($netCost+$markupValue);

                                                        $totalGross=$gross+$totalGross;

                                                        // $totalnetCost = $netCost + $totalnetCost;
                                                        // $markupValue = ($rest['markupTotal']);
                                                        // $gross = round($netCost + $markupValue);
                                                        // $totalGross = $gross + $totalGross;
                                                        ?>
                                                    </div>
                                                </td>
                                                <td><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="center"><?php echo ($rest['markupPercent']); ?>%</div><?php } ?></td>
                                               
                                                <!-- <td>
                                                    <div align="center"><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false && $rest['international_trip'] == 'true') { ?><?php echo 'Yes'; ?><?php } else {
                                                            echo '-';
                                                        } ?></div>
                                                </td> -->
                                                <td>
                                                    <div align="right"><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>&#8377;<?php echo $gross; ?><?php } else {
                                                            $gross;
                                                        } ?></div>
                                                </td>
                                                <td> <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                        <div class="">
                                                            <button type="button" class="optionmenu"
                                                                    data-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical"></i></button>
                                                            <div class="dropdown-menu" style=""><a class="dropdown-item"
                                                                                                   style="cursor:pointer;"
                                                                                                   onclick="loadpop('Edit Pricing',this,'400px')"
                                                                                                   data-toggle="modal"
                                                                                                   data-target=".bs-example-modal-center"
                                                                                                   popaction="action=editpricing&id=<?php echo encode($rest['id']); ?>&pid=<?php echo $_REQUEST['id']; ?>&sectionType=<?php echo $rest['sectionType']; ?>&transfertype=<?php echo $rest['transferCategory']; ?>">Edit
                                                                    Pricing</a></div>
                                                        </div> <?php } ?></td>
                                            </tr>


                                            <?php $totalno++;
                                        }
                                    } ?>

                                    
<tr style=" border-top:2px solid #ededed;border-bottom:2px solid #ededed; font-size:18px; font-weight:700;background-color: #00000008;">
  <td colspan="2" align="left"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><select name="billingType" id="billingType" style=" <?php //if($result['queryId']>0){ ?>display:none1;<?php //} ?>font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600;" onchange="changebillingtype();">
    <option value="1" <?php if($result['billingType']==1){ ?>selected="selected"<?php } ?>>Total price</option>
   <option value="2" <?php if($result['billingType']==2){ ?>selected="selected"<?php } ?>>Price per traveller</option> 
  </select></td>
    <td style="padding-left:10px;"><select name="gstType" id="gstType" style=" font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600;" onchange="changebillingtype();">
    <option value="0" <?php if($result['gstType']==0){ ?>selected="selected"<?php } ?>>GST On Total</option>
   <option value="1" <?php if($result['gstType']==1){ ?>selected="selected"<?php } ?>>GST On Markup</option> 
  </select></td>
  </tr>

                                </table>


                                <?php if($result['billingType']==1){ 
                                $totalnetCost=$totalnetCost;
                                $totalGross=$totalGross;  
                                    $totalnetCostview=$totalnetCost;
                                $totalGrossview=$totalGross; 
                                
                                }  else { 
                                    $totalnetCostview=$totalnetCost;
                                $totalGrossview=$totalGross; 
                                
                                    $totalnetCost=round($totalnetCost/($result['adult']+$result['child']));
                                    $totalGross=round($totalGross/($result['adult']+$result['child'])); 
                                    
                                }
                                

                                ?> 

                                <script>
                                function changebillingtype(){
                                var billingType = $('#billingType').val();
                                var gstType = $('#gstType').val();
                                $('#ActionDiv').load('actionpage.php?action=updatebillingtype&pid=<?php echo encode($result['id']); ?>&billingType='+billingType+'&gstType='+gstType);
                                }
                                
                                </script>   </td>

                                <td colspan="3"><?php  if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="right"><span style="font-size:13px; color:#00000008; display:none;"><?php if($result['billingType']==1){ echo 'Without Hotel - Total Net'; } else { echo 'Without Hotel - Per Person Net'; } ?>
  <br />
</span> <?php if($result['billingType']==1){     $withouthotelnet=$withouthotel; } else {   $withouthotelnet=round($withouthotel/($result['adult']+$result['child'])); } //$totalnetCost; ?></div><?php } ?></td>

<td width="7%"></td>
  
<td colspan="2" align="right">	 	<div align="right" style="display:none;"><span style="font-size:13px; color:#666666;"><?php if($result['billingType']==1){ echo 'Without Hotel - Total'; } else { echo 'Without Hotel - Per Person'; } ?></span><br />&#8377;<?php  $total=(($totalGross/100*$result['baseMarkup'])+$totalGross)+($result['extraMarkup']); echo $totalwithouth=(($withouthotelnet/100*$result['baseMarkup'])+$withouthotelnet)+($result['extraMarkup']); ?></div>




<div align="right" style="width:150px;"><span style="font-size:13px; color:#000; margin-bottom: 5px; display: block;">Extra Markup - <?php if($result['extraMarkup']>0){ echo '&#8377;'.($result['extraMarkup']); }else{ echo ($result['baseMarkup']).'%'; } ?></span>    </div>
	
	<a style="padding: 2px 10px; font-size: 12px; background-color: #059a7f; color: #fff !important; border-radius: 2px; top: -3px; position: relative; cursor:pointer; float:right;"  onclick="loadpop('Add Extra Markup',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=packageextramarkup&pid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Update</a></td>
</tr>








                                 
<?php


$rsyes=GetPageRecord('*','sys_packageBuilderEvent','  packageId="'.$result['id'].'" and startDate>="'.$result['startDate'].'" and startDate<="'.$result['endDate'].'" and sectionType="Accommodation" '); 
$hotelyes=mysqli_fetch_array($rsyes);

$totalcgst=0;
$totalsgst=0;
$totaligst=0;
if($result['gstType']==0){
if($result['cgst']>0){ $totalcgst=round($total*$result['cgst']/100); }
if($result['sgst']>0){ $totalsgst=round($total*$result['sgst']/100); }
if($result['igst']>0){ $totaligst=round($total*$result['igst']/100); }
}

if($result['gstType']==1){
$totalmarkup=(round($totalGross/100*$result['baseMarkup']))+($result['extraMarkup']);

if($result['cgst']>0){ $totalcgst=round($totalmarkup*$result['cgst']/100); }
if($result['sgst']>0){ $totalsgst=round($totalmarkup*$result['sgst']/100); }
if($result['igst']>0){ $totaligst=round($totalmarkup*$result['igst']/100); }
}

 ?>
 <tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="8" align="left" bgcolor="#F5F5F5">
  
  
  <table width="100%" border="0" cellpadding="15" cellspacing="0" class="bordertable" style="margin:10px 0px; font-size:12px;">
    <tr style="background-color:#212529 !important; color:#FFFFFF;">
      <th align="left"><strong>Service</strong></th>
      <th align="left"><strong>Price (&#8377;)</strong></th>
      <th align="left">Markup</th>
      <th align="left"><strong>CGST (<?php echo stripslashes($result['cgst']); ?>%)</strong></th>
      <th align="left"><strong>SGST (<?php echo stripslashes($result['sgst']); ?>%)</strong></th>
      <th align="left"><strong>IGST (<?php echo stripslashes($result['igst']); ?>%)</strong></th>
      <th align="left"><strong>TCS (<?php echo stripslashes($result['tcsPercent']); ?>%)</strong></th>
      <th align="left"><strong>Discount</strong></th>
      <th align="left"><strong>Total</strong></th>
    </tr>

    <tr style="font-size:14px; <?php if($hotelyes['id']!=''){?>display:none;<?php } ?>">
      <td align="left">Without Hotel Services </td>
      <td align="left"><?php $otherservicetotal=0; echo $otherservicetotal=$withouthotelnet;  $total=(($totalGross/100*$result['baseMarkup'])+$totalGross)+($result['extraMarkup']);  
	  $totalwithouth=(($withouthotelnet/100*$result['baseMarkup'])+$withouthotelnet)+($result['extraMarkup']); ?>
	  
	  <?php  //echo $othermarkup=(($withouthotelnet/100*$result['baseMarkup'])+$result['extraMarkup']); $otherservicetotal=$othermarkup+$otherservicetotal; ?>	  </td>
  <td align="left"><?php
	
	  $basemarkup=0;
	  echo $basemarkup=round(($totalwithouth*$result['baseMarkup']/100)+$result['extraMarkup']);
	  $totalwithouth=$basemarkup+$totalwithouth; 
	 $pricemarkupandwithouthotel=$basemarkup+$otherservicetotal;
	 
	  $otherservicetotal=$basemarkup+$otherservicetotal;
	  ?>	  </td>
      <td align="left"><?php if($result['cgst']>0){?> 
	  <?php if($result['gstType']==0){
	 echo  $othercgst=round($pricemarkupandwithouthotel*$result['cgst']/100);    $otherservicetotal=$othercgst+$otherservicetotal;
	  }  else {
	    echo  $othercgst=round(($basemarkup)*$result['cgst']/100); $otherservicetotal=$othercgst+$otherservicetotal;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?></td>
    
    <td align="left">
	  
	  <?php if($result['sgst']>0){?> 
	  <?php if($result['gstType']==0){
	  echo $othersgst=round($pricemarkupandwithouthotel*$result['sgst']/100);   $otherservicetotal=$othersgst+$otherservicetotal;
	  }  else {
	  echo $othersgst=round(($basemarkup)*$result['sgst']/100);  $otherservicetotal=$othersgst+$otherservicetotal;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?>	  </td>
      <td align="left">
	  
	  <?php if($result['igst']>0){?> 
	  <?php if($result['gstType']==0){
	  echo $otherigst=round($pricemarkupandhotel*$result['igst']/100);    $otherservicetotal=$otherigst+$otherservicetotal;
	  }  else {
	  echo $otherigst=round(($basemarkup)*$result['igst']/100);  $otherservicetotal=$otherigst+$otherservicetotal;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?>	  </td>
      <td align="left"><?php  
	  
	  if($result['billingType']==1){ 
	    $othertcs=round(($withouthotelnet-$netflightcosting)*$result['tcsPercent']/100);
	  } else {
	  
	  $totalflightperperson = round(($withouthotelnet-($netflightcosting)/($result['adult']+$result['child'])));
	  $othertcs=round(($totalflightperperson*$result['tcsPercent'])/100);

	  }
	  
	   ?> 
	  <?php  if($othertcs<1){ echo '-'; } else {  echo  $othertcs;  $otherservicetotal=$othertcs+$otherservicetotal;  } ?></td>
      <td align="left"><?php if($result['totalDiscount']>0){ echo $otherdiscount=$result['totalDiscount'];  $otherservicetotal=$otherservicetotal-$otherdiscount; } else { echo '-'; }  ?></td>
      <td align="left"><strong>&#8377;</strong><?php echo $otherservicetotal; ?></td>
    </tr>
    <?php
	$thishotelcost=0;
	$hotesltotalcosting=0;
	$othercgst=0;
	$hotelmarkup=0;
	$othersgst=0;
	$otherigst=0;
	$othertcs=0;
	$otherdiscount=0;
	
	

	$rs=GetPageRecord('*','sys_packageBuilderEvent',' sectionType="Accommodation" and packageId="'.$result['id'].'" and startDate>="'.$result['startDate'].'" and startDate<="'.$result['endDate'].'" and sectionType!="Leisure" group by hotelOption order by hotelOption asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<tr style="font-size:14px;">
      <td align="left"  class="hoteloption<?php echo $rest['hotelOption']; ?>td" ><span style="color:#FFFFFF; font-size:14px;">Hotel Option <?php echo $rest['hotelOption']; ?></span> </td>
      <td align="left">
	   <?php
	   
	  
	    if($result['billingType']==1){ 
	   
	    if($rest['hotelOption']==1){ echo $thishotelcost=$hoteloption1+$withouthotelnet; }  
	   if($rest['hotelOption']==2){ echo $thishotelcost=$hoteloption2+$withouthotelnet; }  
	   if($rest['hotelOption']==3){ echo $thishotelcost=$hoteloption3+$withouthotelnet; }  
	   
	   } else { 
	      if($rest['hotelOption']==1){ echo $thishotelcost=round(($hoteloption1)/($result['adult']+$result['child'])+$withouthotelnet); }  
	   if($rest['hotelOption']==2){ echo $thishotelcost=round(($hoteloption2)/($result['adult']+$result['child'])+$withouthotelnet); }  
	   if($rest['hotelOption']==3){ echo $thishotelcost=round(($hoteloption3)/($result['adult']+$result['child'])+$withouthotelnet); }  
	   
	   }
	   $hotesltotalcosting=$hotelmarkup+$thishotelcost;
	   ?>	  </td>
      <td align="left">
	  <?php
	
	  $basemarkup=0;
	  echo $basemarkup=round(($hotesltotalcosting*$result['baseMarkup']/100)+$result['extraMarkup']);
	  $hotesltotalcosting=$basemarkup+$hotesltotalcosting;
	 $pricemarkupandhotel=$hotesltotalcosting;
	  ?>	  </td>
      <td align="left">
	  
	  <?php 
	  
	  
	  if($result['cgst']>0){?> 
	  <?php if($result['gstType']==0){
	 echo  $othercgst=round($pricemarkupandhotel*$result['cgst']/100);    $hotesltotalcosting=$othercgst+$hotesltotalcosting;
	  }  else {
	    echo  $othercgst=round($basemarkup*$result['cgst']/100); $hotesltotalcosting=$othercgst+$hotesltotalcosting;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?>	  </td>
      <td align="left">
	  
	  <?php if($result['sgst']>0){?> 
	  <?php if($result['gstType']==0){
	  echo $othersgst=round($pricemarkupandhotel*$result['sgst']/100);   $hotesltotalcosting=$othersgst+$hotesltotalcosting;
	  }  else {
	  echo $othersgst=round($basemarkup*$result['sgst']/100);  $hotesltotalcosting=$othersgst+$hotesltotalcosting;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?>	  </td>
      <td align="left">
	  
	  <?php if($result['igst']>0){?> 
	  <?php if($result['gstType']==0){
	  echo $otherigst=round($pricemarkupandhotel*$result['igst']/100);    $hotesltotalcosting=$otherigst+$hotesltotalcosting;
	  }  else {
	  echo $otherigst=round($basemarkup*$result['igst']/100);  $hotesltotalcosting=$otherigst+$hotesltotalcosting;
	  }?>
	  
	  
	  <?php } else { echo '-'; }?>	  </td>
      <td align="left">
	  
	  <?php  
	   
	    $othertcs=round(($thishotelcost)*$result['tcsPercent']/100);
	  
	  
	   ?> 
	  <?php  if($othertcs<1){ echo '-'; } else {  echo  $othertcs;  $hotesltotalcosting=$othertcs+$hotesltotalcosting;  } ?>	  </td>
      <td align="left"><?php if($result['totalDiscount']>0){ echo $otherdiscount=$result['totalDiscount'];  $hotesltotalcosting=$hotesltotalcosting-$otherdiscount;  $hotesltotalcosting; } else { echo '-'; }  ?></td>
      <td align="left">&#8377;</strong><?php echo $hotesltotalcosting;
	  
	   if($rest['hotelOption']==1){
	  $option1Hotel=$hotesltotalcosting;
	  }
	   if($rest['hotelOption']==2){
	  $option2Hotel=$hotesltotalcosting;
	  }
	   if($rest['hotelOption']==3){
	  $option3Hotel=$hotesltotalcosting;
	  }
	  
	   ?></td>
    </tr>

<?php } ?>



</td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td height="30" colspan="6" align="left"><table border="0" cellspacing="0" cellpadding="0"  style="display:none;">
    <tr>
      <td align="left" style="border-top:0px;"><input name="showcgst" type="checkbox" value="1" <?php if($result['showcgst']==1){ ?> checked="checked" <?php } ?> /></td>
      <td align="right" style="border-top:0px;">Show</td>
    </tr>
  </table></td>
  <td width="5%" align="right">CGST&nbsp;% </td>
  <td width="1%" align="right"  style="font-size:18px;"><input name="cgst" type="number" min="0" class="form-control" id="cgst" value="<?php echo stripslashes($result['cgst']); ?>" style="width:80px;"></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="6" align="left"><table border="0" cellspacing="0" cellpadding="0"  style="display:none;">
    <tr>
      
      <td align="left" style="border-top:0px;"><input name="showsgst" type="checkbox" value="1" <?php if($result['showsgst']==1){ ?> checked="checked" <?php } ?> /></td>
	   <td align="right" style="border-top:0px;">Show</td>
    </tr>
  </table></td>
  <td width="5%" align="right">SGST&nbsp;%</td>
  <td width="1%" align="right"  style="font-size:18px;"><input name="sgst" type="number" min="0" class="form-control" id="sgst" value="<?php echo stripslashes($result['sgst']); ?>" style="width:80px;"></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="6" align="left"> <table border="0" cellspacing="0" cellpadding="0"  style="display:none;">
    <tr>
      <td align="left" style="border-top:0px;"><input name="showigst" type="checkbox" value="1" <?php if($result['showigst']==1){ ?> checked="checked" <?php } ?> /></td>
      <td align="right" style="border-top:0px;">Show</td>
    </tr>
  </table></td>
  <td width="5%" align="right">IGST&nbsp;%</td>
  <td width="1%" align="right"  style="font-size:18px;"><input name="igst" type="number" min="0" class="form-control" id="igst" value="<?php echo stripslashes($result['igst']); ?>" style="width:80px;"></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="6" align="left"><table border="0" cellspacing="0" cellpadding="0"  style="display:none;">
    <tr>
      
      <td align="left" style="border-top:0px;"><input name="showtcs" type="checkbox" value="1" <?php if($result['showtcs']==1){ ?> checked="checked" <?php } ?> /></td>
	    <td align="right" style="border-top:0px;">Show</td>
    </tr>
  </table></td>
  <td width="5%" align="right">TCS&nbsp;%<?php 
  if($result['billingType']==1){
   $totaltcs=round(($totalnetCost-$netflightcosting)*$result['tcsPercent']/100);
  } else { 
  $totaltcs=round(($totalnetCost-($netflightcosting/($result['adult']+$result['child'])))*$result['tcsPercent']/100);
  }
  
   ?></strong></td>
  <td width="1%" align="right"  style="font-size:18px;"><input name="tcsPercent" type="number" min="0" class="form-control" id="tcsPercent" value="<?php echo stripslashes($result['tcsPercent']); ?>" style="width:80px;"></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="6" align="left">&nbsp;</td>
  <td width="5%" align="right">
  Discount   </td>
  <td width="1%" align="right" style="font-size:18px;"><input name="totalDiscount" type="number" min="0" class="form-control" id="totalDiscount" value="<?php echo stripslashes($result['totalDiscount']); ?>" style="width:80px;"></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px;background-color: #00000008; display:none; ">
  <td colspan="6" align="right">&nbsp;</td>
  <td width="5%" align="right">Price&nbsp;In:</td>
  <td width="1%" align="right" style="font-size:18px;"><select name="convertedCurrency" id="convertedCurrency" style=" font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600; width:100px;" onchange="$('#changecussyes').val('1');$('#billingformsave').submit();">
  <?php
  
  $rs=GetPageRecord('*','currencyExchangeMaster',' status=1 order by id asc');
while($restcurr=mysqli_fetch_array($rs)){ 
?> 
    <option value="<?php echo $restcurr['name']; ?>" <?php if($result['convertedCurrency']==$restcurr['name']){ ?>selected="selected"<?php } ?>><?php echo $restcurr['name']; ?></option>  
	<?php } ?>
	
  </select></td>
  
  <?php
  
  if($result['convertedCurrency']!='INR'){
	

?>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="8" align="right"><strong><?php echo round($result['convertedCost']).' '.$result['convertedCurrency']; ?></strong></td>
  </tr>
<?php } ?>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="6" align="left">&nbsp;</td>
  <td colspan="2" align="right"><input name="ebo" type="text" class="form-control" id="ebo" value="<?php echo stripslashes($result['ebo']); ?>" placeholder="Early Bird Offer" style="text-align:center;" ></td>
  </tr>
  </tbody>
 </table>
 
                                  
                                 
                                  
                                   
                                  
                                    



                                    








                                   
 <div style="text-align:right; margin-top:10px;"><input name="Save" type="submit" value="Update Billing" id="savingbutton" class="btn btn-primary" style="padding: 10px 20px;" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" ></div>
								<input name="action" type="hidden" id="action" value="saveGSTpackagebuilder">  
								<input name="pid" type="hidden" value="<?php echo encode($result['id']); ?>">
								<input name="changecussyes" id="changecussyes" type="hidden" value="0">
								<input name="finalcostperperson" id="finalcostperperson" type="hidden" value="<?php echo $finalcostperperson; ?>">
                            </form>
                            <?php
                           

                            updatelisting('sys_packageBuilder','netPrice="'.$totalnetCostview.'",withoutHotelGross="'.$otherservicetotal.'",withoutHotelNet="'.$totalwithouth.'",grossPrice="'.(($totalcgst+$totalsgst+$totaligst+$total+$totaltcs)-$result['totalDiscount']).'",totaligst="'.$totaligst.'",totalsgst="'.$totalsgst.'",optionOneHotel="'.$option1Hotel.'",optionTwoHotel="'.$option2Hotel.'",optionThreeHotel="'.$option3Hotel.'",totalcgst="'.$totalcgst.'",grosstcs="'.$totaltcs.'",grossNoGSTPrice="'.$total.'"','id="'.$result['id'].'"'); 
                            ?>

                        </div>


                        <div class="modal-body">


                            <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate=""
                                  method="post" enctype="multipart/form-data" style="display:none;">

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="card-title" style=" margin-top:0px;">Deposit information </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row" style="margin-left: -8px; margin-top: 10px;">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="validationCustom02">Amount</label>
                                                        <input name="depositAmount" type="number" min="0"
                                                               class="form-control" id="depositAmount"
                                                               value="<?php echo stripslashes($result['depositAmount']); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="validationCustom02">Due date</label>
                                                        <input name="depositDueDate" type="text" min="0"
                                                               class="form-control datecale" id="depositDueDate"
                                                               value="<?php if ($result['depositDueDate'] != '') {
                                                                   echo date('d-m-Y', strtotime($result['depositDueDate']));
                                                               } else {
                                                                   echo date('d-m-Y', strtotime(' + 7 days'));
                                                               } ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="validationCustom02"
                                                               style="width: 100%;">&nbsp;</label>
                                                        <input name="Save" type="submit" value="Save" id="savingbutton"
                                                               class="btn btn-primary"
                                                               onclick="this.form.submit(); this.disabled=true; this.value='Saving...';">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                

                                <input name="action" type="hidden" id="action" value="savepageduedate">
                                <input name="pid" type="hidden" value="<?php echo encode($result['id']); ?>">
                            </form>


                        </div>


                    </div>


                </div>


            </div><!--end col-->

            <!-- end row -->

        </div>

        <!-- End Page-content -->


    </div>
</div>
</div>


<script>
    $(function () {
        $(".datecale").datepicker({
            dateFormat: 'dd-mm-yy', minDate: 0
        });
    });
</script>
