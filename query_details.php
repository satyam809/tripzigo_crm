<?php
$assigned_user_data = GetPageRecord('*', 'sys_userMaster', ' id="' . $editresult['assignTo'] . '"');
$assigned_user_id = mysqli_fetch_array($assigned_user_data);
?>
<style>
 	.breadcrumb {
 		list-style: none;
 		overflow: hidden;
 		font: 18px Helvetica, Arial, Sans-Serif;
 		margin: 0px;
 		padding: 0;
 		margin-bottom: 30px;
 		margin-left: 5px;
 	}

 	.breadcrumb li {
 		float: left;
 	}

 	.breadcrumb li a {
 		color: white;
 		text-decoration: none;
 		padding: 10px 0 10px 55px;
 		background: brown;
 		background: hsla(34, 85%, 35%, 1);
 		position: relative;
 		display: block;
 		float: left;
 		background-color: #e0e0e0;
 		color: #000;
 		font-size: 13px;
 	}

 	.breadcrumb li a:after {
 		content: " ";
 		display: block;
 		width: 0;
 		height: 0;
 		border-top: 50px solid transparent;
 		border-bottom: 50px solid transparent;
 		border-left: 30px solid #e0e0e0;
 		position: absolute;
 		top: 50%;
 		margin-top: -50px;
 		left: 100%;
 		z-index: 2;
 	}

 	.breadcrumb li a:before {
 		content: " ";
 		display: block;
 		width: 0;
 		height: 0;
 		border-top: 50px solid transparent;
 		/* Go big on the size, and let overflow hide */
 		border-bottom: 50px solid transparent;
 		border-left: 30px solid white;
 		position: absolute;
 		top: 50%;
 		margin-top: -50px;
 		margin-left: 1px;
 		left: 100%;
 		z-index: 1;
 	}

 	.breadcrumb li:first-child a {
 		padding-left: 10px;
 	}


 	.breadcrumb li a:hover {
 		background: #cecece !important;
 	}

 	.breadcrumb li a:hover:after {
 		border-left-color: #cecece !important;
 	}


 	.steps {
 		margin: 40px;
 		padding: 0;
 		overflow: hidden;
 	}

 	.steps a {
 		color: white;
 		text-decoration: none;
 	}

 	.steps em {
 		display: block;
 		font-size: 1.1em;
 		font-weight: bold;
 	}

 	.steps li {
 		float: left;
 		margin-left: 0;
 		width: 150px;
 		/* 100 / number of steps */
 		height: 70px;
 		/* total height */
 		list-style-type: none;
 		padding: 5px 5px 5px 30px;
 		/* padding around text, last should include arrow width */
 		border-right: 3px solid white;
 		/* width: gap between arrows, color: background of document */
 		position: relative;
 	}

 	/* remove extra padding on the first object since it doesn't have an arrow to the left */
 	.steps li:first-child {
 		padding-left: 5px;
 	}

 	/* white arrow to the left to "erase" background (starting from the 2nd object) */
 	.steps li:nth-child(n+2)::before {
 		position: absolute;
 		top: 0;
 		left: 0;
 		display: block;
 		border-left: 25px solid white;
 		/* width: arrow width, color: background of document */
 		border-top: 40px solid transparent;
 		/* width: half height */
 		border-bottom: 40px solid transparent;
 		/* width: half height */
 		width: 0;
 		height: 0;
 		content: " ";
 	}

 	/* colored arrow to the right */
 	.steps li::after {
 		z-index: 1;
 		/* need to bring this above the next item */
 		position: absolute;
 		top: 0;
 		right: -25px;
 		/* arrow width (negated) */
 		display: block;
 		border-left: 25px solid #7c8437;
 		/* width: arrow width */
 		border-top: 40px solid transparent;
 		/* width: half height */
 		border-bottom: 40px solid transparent;
 		/* width: half height */
 		width: 0;
 		height: 0;
 		content: " ";
 	}

 	/* Setup colors (both the background and the arrow) */

 	/* Completed */
 	.steps li {
 		background-color: #7C8437;
 	}

 	.steps li::after {
 		border-left-color: #7c8437;
 	}

 	/* Current */
 	.steps li.current {
 		background-color: #C36615;
 	}

 	.steps li.current::after {
 		border-left-color: #C36615;
 	}

 	/* Following */
 	.steps li.current~li {
 		background-color: #EBEBEB;
 	}

 	.steps li.current~li::after {
 		border-left-color: #EBEBEB;
 	}

 	/* Hover for completed and current */
 	.steps li:hover {
 		background: #cecece !important;
 	}

 	.steps li:hover::after {
 		border-left-color: #696
 	}



 	.arrows {
 		white-space: nowrap;
 	}

 	.arrows li {
 		display: inline-block;
 		line-height: 26px;
 		margin: 0 9px 0 -10px;
 		padding: 0 20px;
 		position: relative;
 	}

 	.arrows li::before,
 	.arrows li::after {
 		border-right: 1px solid #666666;
 		content: '';
 		display: block;
 		height: 50%;
 		position: absolute;
 		left: 0;
 		right: 0;
 		top: 0;
 		z-index: -1;
 		transform: skewX(45deg);
 	}

 	.arrows li::after {
 		bottom: 0;
 		top: auto;
 		transform: skewX(-45deg);
 	}

 	.arrows li:last-of-type::before,
 	.arrows li:last-of-type::after {
 		display: none;
 	}

 	.arrows li a {
 		font: bold 24px Sans-Serif;
 		letter-spacing: -1px;
 		text-decoration: none;
 	}

 	.arrows li:nth-of-type(1) a {
 		color: hsl(0, 0%, 70%);
 	}

 	.arrows li:nth-of-type(2) a {
 		color: hsl(0, 0%, 65%);
 	}

 	.arrows li:nth-of-type(3) a {
 		color: hsl(0, 0%, 50%);
 	}

 	.arrows li:nth-of-type(4) a {
 		color: hsl(0, 0%, 45%);
 	}


 	.stclass1 a {
 		background-color: #655be6 !important;
 		color: #fff !important;
 	}

 	.stclass1 a::after {
 		border-left: 30px solid #655be6 !important;
 	}

 	.stclass2 a {
 		background-color: #0cb5b5 !important;
 		color: #fff !important;
 	}

 	.stclass2 a::after {
 		border-left: 30px solid #0cb5b5 !important;
 	}

 	.stclass3 a {
 		background-color: #0f1f3e !important;
 		color: #fff !important;
 	}

 	.stclass3 a::after {
 		border-left: 30px solid #0f1f3e !important;
 	}

 	.stclass4 a {
 		background-color: #e45555 !important;
 		color: #fff !important;
 	}

 	.stclass4 a::after {
 		border-left: 30px solid #e45555 !important;
 	}

 	.stclass5 a {
 		background-color: #46cd93 !important;
 		color: #fff !important;
 	}

 	.stclass5 a::after {
 		border-left: 30px solid #46cd93 !important;
 	}

 	.stclass6 a {
 		background-color: #6c757d !important;
 		color: #fff !important;
 	}

 	.stclass6 a::after {
 		border-left: 30px solid #6c757d !important;
 	}

 	.stclass7 a {
 		background-color: #f9392f !important;
 		color: #fff !important;
 	}

 	.stclass7 a::after {
 		border-left: 30px solid #f9392f !important;
 	}

 	.stclass8 a {
 		background-color: #cc00a9 !important;
 		color: #fff !important;
 	}

 	.stclass8 a::after {
 		border-left: 30px solid #cc00a9 !important;
 	}

 	.stclass9 a {
 		background-color: #FF6600 !important;
 		color: #fff !important;
 	}

 	.stclass9 a::after {
 		border-left: 30px solid #FF6600 !important;
 	}

    .stclass11 a {
        background-color: #ff69a1 !important;
        color: #fff !important;
    }

    .stclass11 a::after {
        border-left: 30px solid #ff69a1 !important;
    }

    .stclass12 a {
        background-color: #F09D00 !important;
        color: #fff !important;
    }

    .stclass12 a::after {
        border-left: 30px solid #F09D00 !important;
    }

 	.header-title {
 		padding: 6px 10px;
 		background-color: #f7f7f7;
 		border-radius: 4px;
 	}
 </style>
 <div class="row">
 	<div class="col-lg-12 querystatustabmain" style="overflow:hidden;">
 		<?php if ($clientData['mobile'] != '') {
				$mobileno = '';
				if (strlen($clientData['mobile']) > 10) {
					$mobileno = stripslashes($clientData['mobile']);
				}
				if (strlen($clientData['mobile']) == 10) {
					$mobileno = '91' . stripslashes($clientData['mobile']);
				}

			?><a target="_blank" href="https://api.whatsapp.com/send?text=Hi&phone=+91<?php echo str_replace('+91', '', str_replace('91', '', $mobileno)); ?>" style="float:right;" class="whatsappsharequerymain"><img src="images/whatsapp-button.png" alt="Send WhatsApp Message" height="45"></a> <?php } ?>


 		<ul class="breadcrumb">

 			<?php


				if ($editresult['statusId'] != 5) {

					$rs = GetPageRecord('*', 'queryStatusMaster', 'status = 1 order by sr asc');
					while ($rest = mysqli_fetch_array($rs)) {
                        ?>
 					<li class="<?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 1) { ?>stclass1<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 2) { ?>stclass2<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 3) { ?>stclass3<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 8) { ?>stclass8<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 4) { ?>stclass4<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 5) { ?>stclass5<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 6) { ?>stclass6<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 7) { ?>stclass7<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 9) { ?>stclass9<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 11) { ?>stclass11<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 12) { ?>stclass12<?php } ?>">

 						<a <?php if ($rest['id'] != 5) { ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>&userId=<?php echo $assigned_user_id['id']; ?>" <?php } else { ?>href="#" onclick="alert('You can not mark as confirmed manually.');" <?php } ?>><?php echo $rest['name']; ?></a>
 					</li>
 			<?php }
				} ?>



 			<?php
				if ($editresult['statusId'] == 5 && $LoginUserDetails['id'] == 1) {

					$rs = GetPageRecord('*', 'queryStatusMaster', 'status = 1 order by sr asc');
					while ($rest = mysqli_fetch_array($rs)) {
				?>
 					<li class="<?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 1) { ?>stclass1<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 2) { ?>stclass2<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 3) { ?>stclass3<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 8) { ?>stclass8<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 4) { ?>stclass4<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 5) { ?>stclass5<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 6) { ?>stclass6<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 7) { ?>stclass7<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 9) { ?>stclass9<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 11) { ?>stclass11<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 12) { ?>stclass12<?php } ?>">

 						<a <?php if ($rest['id'] != 1 && $rest['id'] != 2 && $rest['id'] != 3 && $rest['id'] != 4 && $rest['id'] != 7 && $rest['id'] != 8 && $rest['id'] != 9 && $rest['id'] != 11 && $rest['id'] != 12) {  ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>&userId=<?php echo $assigned_user_id['id']; ?>" <?php } else { ?>href="#" onclick="alert('Locked.');" <?php } ?>><?php if ($rest['id'] != 6 && $rest['id'] != 5) {  ?><i class="fa fa-lock" aria-hidden="false"></i> &nbsp;<?php } ?><?php echo $rest['name']; ?></a>
 					</li>
 			<?php }
				} ?>


 			<?php
				if ($editresult['statusId'] == 5 && $LoginUserDetails['id'] != 1) {

					$rs = GetPageRecord('*', 'queryStatusMaster', 'status = 1 order by sr asc');
					while ($rest = mysqli_fetch_array($rs)) {
				?>
 					<li class="<?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 1) { ?>stclass1<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 2) { ?>stclass2<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 3) { ?>stclass3<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 4) { ?>stclass4<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 5) { ?>stclass5<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 6) { ?>stclass6<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 7) { ?>stclass7<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 9) { ?>stclass9<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 8) { ?>stclass8<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 11) { ?>stclass11<?php } ?><?php if ($rest['id'] == $editresult['statusId'] && $editresult['statusId'] == 12) { ?>stclass12<?php } ?>">

 						<a <?php if ($rest['id'] != 1 && $rest['id'] != 2 && $rest['id'] != 3 && $rest['id'] != 4 && $rest['id'] != 7 && $rest['id'] != 5 && $rest['id'] != 6 && $rest['id'] != 8 && $rest['id'] != 9 && $rest['id'] != 11 && $rest['id'] != 12) {  ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>&userId=<?php echo $assigned_user_id['id']; ?>" <?php } else { ?>href="#" onclick="alert('Locked.');" <?php } ?>><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;<?php echo $rest['name']; ?></a>
 					</li>
 			<?php }
				} ?>

 		</ul>



 	</div>
 	<div class="col-lg-8" style="padding-left:15px;">

 		<h4 class="mt-0 header-title">Client Information</h4>

 		<div class="row" style="padding-left: 5px; padding-top: 15px;">
 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Client Name</label>
 					<?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?>
 				</div>
 			</div>

 			<div class="col-lg-3">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Mobile </label>
 					<?php echo stripslashes($clientData['mobileCode']); ?><?php echo stripslashes($clientData['mobile']); ?>
 				</div>
 			</div>

 			<div class="col-lg-5">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Email</label>
 					<?php echo stripslashes($clientData['email']); ?>
 				</div>
 			</div>


 			<div class="col-lg-4" style="display:none;">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Country</label>
 					<?php echo getCountryName($clientData['country']);  ?>
 				</div>
 			</div>

 			<div class="col-lg-3" style="display:none;">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">State</label>
 					<?php echo getStateName($clientData['state']);  ?>
 				</div>
 			</div>

 			<div class="col-lg-5" style="display:none;">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">City</label>
 					<?php echo getCityName($clientData['city']);  ?>
 				</div>
 			</div>

 		</div>



 		<h4 class="mt-3 header-title">Query Information</h4>

 		<div class="row" style="padding-left: 5px; padding-top: 15px;">
 			<div class="col-lg-4" style="display:none;">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">FROM CITY</label>
 					<?php echo stripslashes($editresult['fromCity']); ?>
 				</div>
 			</div>

 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">DESTINATION </label>
 					<?php echo getCityName($editresult['destinationId']); ?>
 				</div>
 			</div>

 			<div class="col-lg-5">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">FROM DATE</label>
 					<?php if (date('d-m-Y', strtotime($editresult['startDate'])) != '01-01-1970') {
							echo date('d-m-Y', strtotime($editresult['startDate']));
						} ?>
 				</div>
 			</div>


 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">TO DATE</label>
 					<?php if (date('d-m-Y', strtotime($editresult['endDate'])) != '01-01-1970') {
							echo date('d-m-Y', strtotime($editresult['endDate']));
						} ?>
 				</div>
 			</div>
 			<div class="col-lg-3">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">TRAVEL MONTH</label>
 					<?php echo $editresult['travelMonth']; ?>
 				</div>
 			</div>
 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">LEAD SOURCE</label>
 					<?php $rsb = GetPageRecord('*', 'querySourceMaster', ' id="' . $editresult['leadSource'] . '"');
						while ($restsource = mysqli_fetch_array($rsb)) {
						    if($_SESSION['userid']==1 || $_SESSION['userid']==4045 || $_SESSION['userid']==4025 ){
							echo stripslashes($restsource['name']);
						}} ?>
 				</div>
 			</div>

 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">SERVICE</label>
 					<?php $rsb = GetPageRecord('*', 'queryServicesMaster', ' id="' . $editresult['serviceId'] . '"');
						while ($restsource = mysqli_fetch_array($rsb)) {
							echo stripslashes($restsource['name']);
						} ?>
 				</div>
 			</div>



 			<div class="col-lg-3">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Adult(s)</label>
 					<?php echo $editresult['adult']; ?>
 				</div>
 			</div>

 			<div class="col-lg-5">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">child(s)</label>
 					<?php echo $editresult['child']; ?>
 				</div>
 			</div>

 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">infant(s) </label>
 					<?php echo $editresult['infant']; ?>
 				</div>
 			</div>






 			<div class="col-lg-3">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Assign To</label>
 					<?php $rsb = GetPageRecord('*', 'sys_userMaster', ' id="' . $editresult['assignTo'] . '"');
						while ($restsource = mysqli_fetch_array($rsb)) {
							echo stripslashes($restsource['firstName'] . ' ' . $restsource['lastName']);
						} ?>
 				</div>
 			</div>

 			<div class="col-lg-5">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Update</label>
 					<?php echo date('d/m/Y - h:i A', strtotime($editresult['updateDate'])); ?>
 				</div>
 			</div>

 			<div class="col-lg-4">
 				<div class="form-group input-group" style="position:relative;">
 					<label for="validationCustom02">Created</label>
 					<?php echo date('d-m-Y', strtotime($editresult['dateAdded'])); ?>
 				</div>
 			</div>
 			<?php if ($_SESSION['userid'] == 1) { ?>
 				<div class="col-lg-12" style="display:none;">
 					<table width="100%" border="0" cellspacing="0" cellpadding="5">
 						<tr>
 							<td width="41%">
 								<div class="form-group input-group" style="position:relative;">
 									<label for="validationCustom02">Internal Note</label>
 									<div class="form-group" style="overflow:hidden;">
 										<textarea name="internalnote" id="internalnote" onkeyup="saveinternalnote();" class="form-control" style="width:400px;" placeholder="Note"><?php echo strip($editresult['internalnote']); ?></textarea>
 									</div>
 								</div>
 							</td>
 							<td width="59%">
 								<div style="margin-top:5px;"><button type="submit" id="savingbutton" class="btn btn-primary" onclick="location.reload();">Save</button></div>
 							</td>
 						</tr>
 					</table>
 					<div style="display:none;" id="internote"></div>
 					<script>
 						function saveinternalnote() {
 							var internalnote = encodeURI($('#internalnote').val());
 							$('#internote').load('actionpage.php?action=saveinternalnote&queryId=<?php echo encode($editresult['id']); ?>&internalnote=' + internalnote);

 						}
 					</script>
 				</div>
 			<?php } ?>


 			<?php if ($editresult['details'] != '') { ?>
 				<div class="col-lg-12">
 					<div class="form-group input-group" style="position:relative;">
 						<label for="validationCustom02">Query Description</label>
 						<?php echo nl2br(stripslashes(html_entity_decode($editresult['details']))); ?>
 					</div>
 				</div>
 			<?php } ?>
 		</div>
 	</div>
 	<div class="col-lg-4" style="padding-left:15px;">
 		<h4 class="mt-0 header-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Notes</h4>

 		<div class="row" style="padding: 5px;">
 			<div class="col-lg-12">
 				<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm">
 					<div class="form-group" style="overflow:hidden;">
 						<textarea name="details" id="notedetails" onkeyup="notedetailsfun();" class="form-control" style="height:80px; border: 5px solid #ddd;" placeholder="Type Note Here"></textarea>

 						<div style="margin-top:5px; display:none;" id="noteaddbutton"><button type="submit" id="savingbutton" class="btn btn-secondary" onclick="this.form.submit();$('#noteaddbutton').hide();" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i> Add Note</button></div>
 					</div>
 					<input name="action" type="hidden" value="addnotes" />
 					<input name="queryid" type="hidden" value="<?php echo encode($editresult['id']); ?>" />
 				</form>
 			</div>

 			<div class="col-lg-12" id="queryNotes" style="max-height:372px; overflow:auto;">

 			</div>

 		</div>

 	</div>
 </div>

 <script>
 	function notedetailsfun() {
 		var notedetails = $('#notedetails').val();
 		if (notedetails != '') {
 			$('#noteaddbutton').show();
 		} else {
 			$('#noteaddbutton').hide();
 		}

 	}
 </script>
