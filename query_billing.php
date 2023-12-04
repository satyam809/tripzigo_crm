<?php
$rs13 = GetPageRecord('*', 'sys_packageBuilder', 'queryId="' . $editresult['id'] . '" and confirmQuote=1');
$packagedatadetials = mysqli_fetch_array($rs13);

$fd = GetPageRecord('*', 'queryMaster', 'id="' . decode($_REQUEST['id']) . '"');
$queryData = mysqli_fetch_array($fd);

$rs13ddd = GetPageRecord('*', 'sys_packageBuilderEvent', ' packageId="' . $packagedatadetials['id'] . '" order by  supplierCancellationDate desc');
$packageEvents = mysqli_fetch_array($rs13ddd);

if($_REQUEST['markRead'] != '' && $_SESSION['userid'] != 1){
        $namevalue = 'makeDone=1';
        $where = 'id="' . decode($_REQUEST['markRead']) . '"';
        updatelisting('queryTask', $namevalue, $where);
}

?>

<style>


    .statusbox {
        margin-right: 5px;
        padding: 10px;
        text-align: center;
        background-color: #000000;
        font-size: 13px;
        color: #fff;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .conf {
        width: 100px;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 5px;
        text-align: center;
    }
    .verified:hover{
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-md-12 col-xl-12" style="margin-left: 5px; padding-right: 13px !important;">

        <?php //if($packagedatadetials['id']>0 && $packageEvents['supplierCancellationDate']!='' && $packageEvents['supplierCancellationDate']!="1970-01-01"){

        if ($packagedatadetials['id'] > 0){ ?>

        <div style="margin-bottom:10px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#655be6;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php $ba = GetPageRecord('*', 'sys_packageBuilder', ' queryId="' . $editresult['id'] . '" and confirmQuote=1');
                                $packagecost = mysqli_fetch_array($ba);
                                echo number_format($packagecost['grossPrice']); ?>

                            </div>
                            Total Amount
                        </div>
                    </td>
                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#0cb5b5;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php $ba = GetPageRecord('SUM(amount) as totalrecived', 'sys_PackagePayment', ' queryId="' . $editresult['id'] . '" and packageId="' . $packagedatadetials['id'] . '" and paymentStatus=1 ');
                                $packagecostrecived = mysqli_fetch_array($ba);
                                echo number_format($packagecostrecived['totalrecived']); ?></div>
                            Received
                        </div>
                    </td>

                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#e45555;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php echo number_format(round($packagecost['grossPrice'] - $packagecostrecived['totalrecived'])); ?></div>
                            Pending
                        </div>
                    </td>
                    <td width="16%" align="left" valign="top">
                        <div class="statusbox" style="background-color: #ffffff; color: #000000; font-weight: 600;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php $ba = GetPageRecord('SUM(supplierAmount) as totalsupplierAmount', 'sys_packageBuilderEvent', ' packageId="' . $packagedatadetials['id'] . '" ');
                                $suppTotalcost = mysqli_fetch_array($ba);
                                echo number_format(round($packagecost['grossPrice'] - $suppTotalcost['totalsupplierAmount'])); ?></div>
                            Gross Profit
                        </div>
                    </td>
                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#e69f5b;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php echo number_format($suppTotalcost['totalsupplierAmount']); ?>

                            </div>
                            Total Supplier Amount
                        </div>
                    </td>
                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#71b183;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php $ba = GetPageRecord('SUM(paidAmount) as totalrecived', 'sys_packageBuilderEvent', ' packageId="' . $packagedatadetials['id'] . '" ');
                                $suppcostrecived = mysqli_fetch_array($ba);
                                echo number_format($suppcostrecived['totalrecived']); ?></div>
                            Supplier Received
                        </div>
                    </td>
                    <td width="14%" align="left" valign="top">
                        <div class="statusbox" style="background-color:#ae8393;">
                            <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                &#8377;<?php echo number_format(round($suppTotalcost['totalsupplierAmount'] - $suppcostrecived['totalrecived'])); ?></div>
                            Supplier Pending
                        </div>
                    </td>

                </tr>
            </table>

        </div>


        <div class="col-lg-12" style="    padding: 0px; padding-top:15px;">
            <h4 class="mt-0 header-title" style="border-bottom:0px; overflow:hidden;">Payments
                (<?php $ba = GetPageRecord('count(id) as totalpayments', 'sys_PackagePayment', ' queryId="' . $editresult['id'] . '" and packageId="' . $packagedatadetials['id'] . '" and paymentStatus!=0');
                $packagecostrecivedpayment = mysqli_fetch_array($ba);
                echo number_format($packagecostrecivedpayment['totalpayments']); ?>)

            </h4>
            <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
                  enctype="multipart/form-data">
                <table class="table table-hover mb-0" style="border:1px solid #ddd; font-size:12px;">

                    <thead>
                    <tr>
                        <th>Payment&nbsp;ID</th>
                        <th>Trans.&nbsp;ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Payment&nbsp;Date</th>
                        <th>Status</th>
                        <th align="center">&nbsp;</th>
                        <th align="center">Verify</th>
                        <th align="center" style="display:none;">&nbsp;</th>
                        <th align="center">Convenience Fee</th>
                        <th>Customer Receipt</th>
                        <th>
                            <div align="right">Action</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalpendingamountcount = 0;
                    $totalno = 1;
                    $rs = GetPageRecord('*', 'sys_PackagePayment', ' queryId="' . $editresult['id'] . '" and packageId="' . $packagedatadetials['id'] . '" and paymentStatus!=0 order by paymentDate asc');
                    while ($paymentlist = mysqli_fetch_array($rs)) {
                        ?>

                        <tr style=" <?php if ($paymentlist['paymentStatus'] == 1) { ?> background-color: #e4fff9;<?php } ?>">
                            <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) {
                                    echo encode($paymentlist['id']);
                                } else {
                                    echo '-';
                                } ?></td>
                            <td align="left" valign="top"
                                style="text-transform:uppercase;"><?php if ($paymentlist['paymentId'] != '') {
                                    echo($paymentlist['paymentId']);
                                } else {
                                    echo '-';
                                } ?></td>
                            <td align="left" valign="top"><?php if ($paymentlist['paymentId'] != '') { ?><span
                                        class="badge badge-dark"><?php echo($paymentlist['transectionType']); ?></span><?php } ?>
                            </td>
                            <td align="left" valign="top">&#8377;<?php echo($paymentlist['amount']);
                                $totalpendingamountcount += $paymentlist['amount']; ?></td>
                            <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) {
                                    echo date('d/m/Y - h:i A', strtotime($paymentlist['paymentDate']));
                                } else {
                                    echo date('d/m/Y', strtotime($paymentlist['paymentDate']));
                                } ?> </td>
                            <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) { ?><span
                                        class="badge badge-success">Paid</span><?php } ?>

                                <?php if (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) >= date('Y-m-d H:i:s')) {
                                    if ($paymentlist['paymentStatus'] == 2) { ?><span class="badge badge-warning">Scheduled</span><?php }
                                } else {
                                    if ($paymentlist['paymentStatus'] == 2) { ?>
                                        <span class="badge badge-danger">Overdue</span>
                                    <?php }
                                } ?>  </td>
                            <td align="center" valign="top">
                                <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>

                                    <?php if ($paymentlist['paymentStatus'] != 1) { ?>
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                                onclick="loadpop('Send Payment Link',this,'400px')" data-toggle="modal"
                                                data-target=".bs-example-modal-center"
                                                popaction="action=sendpaymentlink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo($paymentlist['amount']); ?>&sendlink=1"
                                                style="margin-bottom:0px; float:right; width: 100%;"><?php if ($paymentlist['paymentLinkDate'] == '') { ?>Send Link<?php } else { ?>Re-Send Link<?php } ?></button>
                                        <br/>
                                        <?php if ($paymentlist['paymentLinkDate'] != '' && $paymentlist['paymentLinkDate'] != '1970-01-01') { ?>
                                            <div style="width:100%; margin-top:2px; float:left;font-size: 10px;"><?php echo date('d-m-Y - h:i A', strtotime($paymentlist['paymentLinkDate'])); ?></div><?php }
                                    } ?>
                                <?php } ?></td>
                            <td>
                                <?php if($paymentlist['payment_verified']){ ?><a onclick="save_payment_receipt(this, <?php echo encode($paymentlist['id']); ?>)" popaction="id=<?php echo encode($invoiceData['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&paymentId=<?php echo $paymentlist['id']; ?>" data-toggle="tooltip" class="verified" data-placement="top" title="Click to download bill receipt">Verified</a><?php } else { echo 'Not confirmed'; }?>
                            </td>
                            <td align="center" valign="top"
                                style="display:none;"><?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>

                                    <?php if ($paymentlist['paymentStatus'] != 1) { ?>
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                                onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal"
                                                data-target=".bs-example-modal-center"
                                                popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo($paymentlist['amount']); ?>"
                                                style="margin-bottom:0px; float:right;"><?php if ($paymentlist['paymentWithoutLinkDate'] == '') { ?>Send Payment Details<?php } else { ?>Re-Send Payment Details<?php } ?></button>

                                        <br/>
                                        <?php if ($paymentlist['paymentWithoutLinkDate'] != '' && $paymentlist['paymentWithoutLinkDate'] != '1970-01-01') { ?>
                                            <div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A', strtotime($paymentlist['paymentWithoutLinkDate'])); ?>    </div>
                                        <?php }
                                    } else { ?>

                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                                onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal"
                                                data-target=".bs-example-modal-center"
                                                popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo($paymentlist['amount']); ?>&acn=1"
                                                style="margin-bottom:0px; float:right;"><?php if ($paymentlist['paymentWithoutLinkDate'] == '') { ?>Send Payment Details<?php } else { ?>Re-Send Payment Details<?php } ?></button>


                                        <br/>
                                        <?php if ($paymentlist['paymentWithoutLinkDate'] != '' && $paymentlist['paymentWithoutLinkDate'] != '1970-01-01') { ?>
                                            <div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A', strtotime($paymentlist['paymentWithoutLinkDate'])); ?>    </div>

                                        <?php } ?>
                                    <?php }
                                } ?></td>
                            <td align="center" valign="top"><?php if ($paymentlist['paymentStatus'] != 1) { ?><input
                                    type="number" min="0" name="conFee"
                                    id="conFee<?php echo encode($paymentlist['id']); ?>" class="conf"
                                    placeholder="Convenience Fee" value="<?php echo($paymentlist['conFee']); ?>"
                                    onkeyup="confeefun('<?php echo encode($paymentlist['id']); ?>');" /><?php } ?></td>
                            <td align="left" valign="top"><?php if ($paymentlist['receiptFile'] != '') { ?><a
                                    href="<?php echo $fullurl; ?>package_image/<?php echo $paymentlist['receiptFile']; ?>"
                                    target="_blank">Download</a><?php } ?></td>
                            <td align="left" valign="top">
                                <div style=" width: 100px;"><?php if ($paymentlist['paymentStatus'] != 1) { ?>
                                        <div align="right">
                                        <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?><?php if ($paymentlist['paymentBy'] == 0 && $paymentlist['paymentId'] != '') {
                                        } else { ?>


                                            <button type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                                    onclick="loadpop('Schedule Payment',this,'400px')"
                                                    data-toggle="modal" data-target=".bs-example-modal-center"
                                                    popaction="action=schedulepayment&payment=<?php echo(round($packagecost['grossPrice'] - $packagecostrecived['totalrecived'])); ?>&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>"
                                                    style="margin-bottom:0px; float:right;">Edit
                                            </button>


                                        <?php }
                                        } ?>
                                        </div><?php } ?>&nbsp;<?php if ($_SESSION['userid'] == 1) { ?>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-light"
                                                onclick="deletebill('<?php echo encode($paymentlist['id']); ?>');"
                                                style="margin-bottom:0px; float:right; margin-right: 3px;">
                                            Delete</button><?php } else {
                                            ?></div>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" style="margin-bottom:0px; float:right; margin-right: 3px;" <?php if($paymentlist['permission_status'] == 'accepted'){ ?> onclick="deleteBillUser('<?php echo encode($paymentlist['id']); ?>');" <?php } else{ ?>  onclick="askForPermissionToDelete('<?php echo encode($paymentlist['id']); ?>', <?php echo encode($editresult['id']); ?>);" <?php } ?> >
                                            Delete</button>
                                            <?php } ?>
                            </td>
                        </tr>


                        <?php $totalno++;
                    } ?>

                    <tr style=" <?php if ($paymentlist['paymentStatus'] == 1) { ?> background-color: #e4fff9;<?php } ?>">
                        <td colspan="3" align="right" valign="top"><strong>Not Scheduled Amount: </strong></td>
                        <td align="left" valign="top">
                            <strong>&#8377;<?php echo $packagecost['grossPrice'] - $totalpendingamountcount; ?></strong>
                        </td>
                        <td colspan="7" align="right"
                            valign="top"><?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
                                <?php if (($packagecost['grossPrice'] - $totalpendingamountcount) > 0) { ?>
                                    <button type="button" class="btn btn-pink btn-sm waves-effect waves-light"
                                            onclick="loadpop('Create Payment Plan',this,'400px')" data-toggle="modal"
                                            data-target=".bs-example-modal-center"
                                            popaction="action=schedulepayment&payment=<?php if ($totalno == 1) {
                                                echo(round($packagecost['grossPrice'] - $packagecostrecived['totalrecived']));
                                            } else {
                                                echo($packagecost['grossPrice'] - $totalpendingamountcount);
                                            } ?>&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&addpay=1"
                                            style="margin-bottom:0px; float:right;">Schedule Payment</button><?php } ?>
                            <?php } ?></td>
                    </tr>

                    </tbody>
                </table>

                <input name="action" type="hidden" id="action" value="sendSelectedPaymentPlanToMail"/>
                <input name="queryId" type="hidden" value="<?php echo $_REQUEST['id']; ?>"/>
                <input name="packageId" type="hidden" value="<?php echo encode($packagedatadetials['id']); ?>"/>
                <?php if ($totalno > 1) { ?>
                    <div style="overflow: hidden; width: 100%; margin-top: 10px;">
                        <table border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td>
                                    <!--<input name="Save" type="submit" value="Send Payment Plan To Mail"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:left;"  />-->
                                    <button type="button" class="btn btn-info btn-sm waves-effect waves-light"
                                            onclick="loadpop('Send Payment Plan To Mail',this,'400px')"
                                            data-toggle="modal" data-target=".bs-example-modal-center"
                                            popaction="action=sendSelectedPaymentPlanToMail&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>"
                                            style="margin-bottom:0px; float:right;">Send Payment Plan To Mail
                                    </button>
                                </td>
                                <td>&nbsp;&nbsp;
                                    <?php if ($queryData['sendPaymentPlanDate'] != '' && $queryData['sendPaymentPlanDate'] != '1970-01-01') { ?>Email Date: <?php echo date('d-m-Y - h:i A', strtotime($queryData['sendPaymentPlanDate'])); ?><?php } ?></td>
                            </tr>
                        </table>

                    </div>
                <?php } ?>
            </form>
        </div>


        <div class="col-lg-12" style="    padding: 0px; padding-top:15px;">
            <h4 class="mt-0 header-title" style="border-bottom:0px; overflow:hidden;">&nbsp;</h4>
            <?php
            $totalno = 1;
            $rsa = GetPageRecord('*', 'sys_invoiceMaster', ' queryId="' . $editresult['id'] . '" and packageId="' . $packagedatadetials['id'] . '"  order by id desc');
            while ($invoiceData = mysqli_fetch_array($rsa)) {
                ?>
                <div class="card" style=" border: 2px solid #ddd;">
                    <div class="card-body" style="padding:20px !important;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="5%" align="center"><i class="fa fa-file-text" aria-hidden="true"
                                                                 style="font-size:50px; color:#0066CC;"></i></td>
                                <td colspan="2" align="left" style="padding-left:10px;">
                                    <div style="color:#666666; margin-bottom:0px;">Invoice
                                        - <?php echo date('j M Y', strtotime($invoiceData['invoiceDate'])); ?></div>
                                    <div style="color:#000; font-size:24px;"><?php echo($invoiceData['invoiceId']); ?></div>
                                </td>
                                <td align="right">
                                    <button onclick="loadpop('View Invoice',this,'900px')" data-toggle="modal"
                                            data-target=".bs-example-modal-center"
                                            popaction="action=viewinvoice&id=<?php echo encode($invoiceData['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>"
                                            type="button" class="btn btn-primary waves-effect waves-light">View Invoice
                                    </button>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <?php $totalno++;
            } ?>
            <?php if ($totalno == 1) { ?>
                <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
                    <div style="text-align:center; padding:10px;">
                        <div style="margin-bottom:10px;">No Invoice Found</div>
                        <a target="actoinfrm"
                           href="actionpage.php?action=genrateinvoice&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&amount=<?php $ba = GetPageRecord('*', 'sys_packageBuilder', ' queryId="' . $editresult['id'] . '" and confirmQuote=1');
                           $packagecost = mysqli_fetch_array($ba);
                           echo trim($packagecost['grossPrice']); ?>">
                            <button type="button" class="btn btn-primary waves-effect waves-light">Genrate Invoice
                            </button>
                        </a>
                    </div>
                <?php }
            } ?>
            <?php } else { ?>

                <div style="text-align:center; font-size:16px; padding:30px; color:#999999; ">
                    <div style="text-align:center; font-size:60px;"><i class="fa fa-briefcase" aria-hidden="true"></i>
                    </div>
                    No itinerary confirmed or supplier's cancellation date not entered
                </div>
            <?php } ?>

            <div style="width: 100%; border: dashed #e45555 1px; background-color: #e4555514; padding: 10px; margin: 35px 0px 10px 0px; font-size: 14px; font-weight: 600; text-align: center;">
                Supplier Payment Details
            </div>


            <table class="table table-hover mb-0" <?php if ($editresult['lockPostSaleSupplier'] == 1) { ?> style="pointer-events: none;"<?php } ?>>

                <thead>
                <tr>
                    <th>Supplier</th>
                    <th>
                        <div align="center">Booking<br/>Status</div>
                    </th>
                    <th>
                        <div align="center">Payment<br/>
                            Status
                        </div>
                    </th>
                    <th>
                        <div align="center">Invoice<br/>Amount</div>
                    </th>
                    <th>
                        <div align="center">Cancellation<br/>Date</div>
                    </th>
                    <th>
                        <div align="center">Due <br/>
                            Date
                        </div>
                    </th>
                    <th>
                        <div align="center">Paid<br/>
                            Amount
                        </div>
                    </th>
                    <th>
                        <div align="center">Pending<br/>
                            Amount
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $rsads = GetPageRecord('*', 'sys_packageBuilderEvent', ' packageId="' . $packagedatadetials['id'] . '" and sectionType!="Leisure" group by sectionType order by sectionType asc');
                while ($groupservices = mysqli_fetch_array($rsads)) {
                    ?>
                    <tr>
                        <td colspan="8" bgcolor="#1e5598"
                            style="color:#fff !important; padding:10px; font-weight:800; border-radius: 3px;"><i
                                    style="color:#fff;"
                                    class="fa <?php if ($groupservices['sectionType'] == 'Accommodation') { ?>fa-bed<?php } ?><?php if ($groupservices['sectionType'] == 'Activity') { ?>fa-blind<?php } ?><?php if ($groupservices['sectionType'] == 'Transportation') { ?>fa-car<?php } ?><?php if ($groupservices['sectionType'] == 'FeesInsurance') { ?>fa-credit-card<?php } ?><?php if ($groupservices['sectionType'] == 'Meal') { ?>fa-cutlery<?php } ?><?php if ($groupservices['sectionType'] == 'Flight') { ?>fa-plane<?php } ?>"
                                    aria-hidden="true"></i>
                            &nbsp;<?php if ($groupservices['sectionType'] == 'FeesInsurance') {
                                echo 'Fees - Insurance';
                            } else {
                                echo $groupservices['sectionType'];
                            } ?></td>
                    </tr>
                    <?php
                    $netflightcosting = 0;
                    $totalnetCost = 0;
                    $totalGross = 0;

                    $rs = GetPageRecord('*', 'sys_packageBuilderEvent', ' packageId="' . $packagedatadetials['id'] . '" and  sectionType="' . $groupservices['sectionType'] . '" and sectionType!="Leisure" order by packageDays,time(checkIn) asc');
                    while ($rest = mysqli_fetch_array($rs)) {


                        $aadv = GetPageRecord('count(id) as totalnotes', 'supplierNotes', 'serviceId="' . $rest['id'] . '"');
                        $notesyes = mysqli_fetch_array($aadv);

                        $netCost = 0;
                        $markupValue = 0;
                        $gross = 0;

                        $predate = date('d-m-Y', strtotime($editresult['startDate']));
                        ?>


                        <?php

                        if ($rest['sectionType'] == 'Accommodation') {

                            $netCost = round($rest['singleRoomCost'] * $rest['singleRoom']) + ($rest['doubleRoomCost'] * $rest['doubleRoom']) + ($rest['tripleRoomCost'] * $rest['tripleRoom']) + ($rest['quadRoomCost'] * $rest['quadRoom']) + ($rest['cwbRoomCost'] * $rest['cwbRoom']) + ($rest['cnbRoomCost'] * $rest['cnbRoom']);

                        } else {

                            if ($rest['transferCategory'] == 'Private') {

                                $netCost = round($rest['vehicle'] * $rest['adultCost']);

                            } else {

                                $netCost = round($rest['adultCost'] * $editresult['adult']) + ($rest['childCost'] * $editresult['child']);

                                if ($rest['sectionType'] == 'Flight') {
                                    $netflightcosting = $netCost + $netflightcosting;
                                }


                            }

                        }

                        $netCost = $rest['overall_pricing'];
                        $totalnetCost = $netCost + $totalnetCost;

                        $markupValue = ($rest['markupPercent'] * $netCost / 100);
                        $gross = round($netCost + $markupValue);

                        $totalGross = $gross + $totalGross;


                        if ($rest['supplierAmount'] > 0) {
//$netCost=$rest['supplierAmount'];
                        }


                        ?>

                        <tr>
                            <td colspan="8"
                                style=" font-weight: 700; "><?php echo stripslashes($rest['name']); ?><?php if ($rest['sectionType'] == 'Accommodation') { ?>
                                    <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span>

                                    <div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo stripslashes($rest['hotelRoom']); ?>
                                        - <?php echo date('d-m-Y', strtotime($rest['startDate'])); ?>
                                        To <?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div>

                                <?php } else { ?>


                                    <div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo date('d-m-Y', strtotime($rest['startDate']));
                                        if ($rest['sectionType'] != 'FeesInsurance') { ?> - <i class="fa fa-clock-o"
                                                                                               aria-hidden="true"></i> <?php echo date('g:i A', strtotime($rest['checkIn'])); ?> to <?php echo date('g:i A', strtotime($rest['checkOut'])); ?><?php }
                                        if ($rest['transferCategory'] == 'Private') { ?> -
                                            <strong>Vehicle: </strong><?php echo stripslashes($rest['vehicle']);
                                        } ?></div>


                                <?php } ?></td>
                        </tr>
                        <tr>
                            <td><?php
                                $rs2 = GetPageRecord('*', 'userMaster', ' id="' . $rest['supplierId'] . '" and status=1 and userType=5 order by firstName asc');
                                if (mysqli_num_rows($rs2) > 0) {
                                    $restsup = mysqli_fetch_array($rs2);
                                    echo $restsup['company'];
                                } else {
                                    echo 'No Supplier Selected';
                                } ?></td>
                            <td>
                                <div style="border-radius: 3px; text-align: center; padding:3px;font-size: 12px; width: 140px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if ($rest['bookingStatusId'] == 0) { ?>e77350<?php } ?><?php if ($rest['bookingStatusId'] == 1) { ?>e3445a<?php } ?><?php if ($rest['bookingStatusId'] == 2) { ?>01c875<?php } ?><?php if ($rest['bookingStatusId'] == 3) { ?>a55cd9<?php } ?><?php if ($rest['bookingStatusId'] == 4) { ?>323232<?php } ?>;"><?php if ($rest['bookingStatusId'] == 0) { ?>Mail Sent<?php } ?><?php if ($rest['bookingStatusId'] == 1) { ?>Pending Confirmation<?php } ?><?php if ($rest['bookingStatusId'] == 2) { ?>Confirmed<?php } ?><?php if ($rest['bookingStatusId'] == 3) { ?>Not Confirmed<?php } ?><?php if ($rest['bookingStatusId'] == 4) { ?>Rates Negotiation<?php } ?></div>
                                <?php if ($rest['bookingStatusId'] == 2) { ?>
                                    <div style=" font-size:12px; color:#666666;">
                                    Conf.: <?php echo $rest['confirmationNo']; ?></div><?php } ?></td>
                            <td>
                                <div style="border-radius: 3px; text-align: center; padding:3px; font-size: 12px; width:130px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if ($rest['status'] == 0) { ?>e77350<?php } ?><?php if ($rest['status'] == 1) { ?>01c875<?php } ?>;"><?php if ($rest['status'] == 0) { ?>Payment Pending<?php } ?><?php if ($rest['status'] == 1) { ?>Amount Paid<?php } ?></div>
                            </td>
                            <td>
                                <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $netCost; ?></div>
                            </td>
                            <td>
                                <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px; <?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970' && $rest['dueDate'] < date('Y-m-d')) { ?>border:1px solid #FF0000;<?php } ?>"><?php if ($rest['supplierCancellationDate'] != '' && date('d-m-Y', strtotime($rest['supplierCancellationDate'])) != '01-01-1970') {
                                        echo date('d-m-Y', strtotime($rest['supplierCancellationDate']));
                                    } ?></div>
                            </td>
                            <td>
                                <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px; <?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970' && $rest['dueDate'] < date('Y-m-d')) { ?>border:1px solid #FF0000;<?php } ?>"><?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970') {
                                        echo date('d-m-Y', strtotime($rest['dueDate']));
                                    } ?></div>
                            </td>
                            <td>
                                <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $rest['paidAmount']; ?></div>
                            </td>
                            <td>
                                <div style=" width:100px; text-align:center; background-color:transparent; font-size:12px;"><?php echo $netCost - $rest['paidAmount']; ?></div>
                            </td>
                        </tr>

                        <?php $totalno++;
                    }
                } ?>
                </tbody>
            </table>

        </div>
    </div>
    <div id="saveconfee" style="display:none;"></div>
    <script>
        function confeefun(id) {
            var conFee = $('#conFee' + id).val();

            $('#saveconfee').load('actionpage.php?action=saveconfee&id=' + id + '&conFee=' + conFee + '&queryId=<?php echo $_REQUEST['id']; ?>');
        }

        function deletebill(id) {

            if (confirm('Are you sure want to delete?')) {
                $('#saveconfee').load('actionpage.php?action=deletebill&parentId=<?php echo $_REQUEST['id']; ?>&id=' + id);
            }

        }

        function deleteBillUser(id){
            Swal.fire({
                    title: "Are you sure?",
                    text: "You Want To Delete This Bill!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(function (e) {
                    if (e.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: 'actionpage.php',
                            data: {
                                id: id,
                                action: 'deleteBillUser',
                                parentId: '<?php echo $_REQUEST['id']; ?>'
                            },
                            success: function (response) {
                                if (response.success === true) {
                                    Swal.fire("Success", response.msg, "success");
                                    setTimeout(function (){
                                       window.location.href = response.url;
                                    }, 1200);
                                } else{
                                    Swal.fire("Error", "Something Went Wrong Please Try Again", "error");
                                }
                            }
                        });
                    }
                });
        }

        function askForPermissionToDelete(billId, queryId){
            Swal.fire({
                    title: "Are you sure?",
                    text: "You Want To Ask Permission From Admin To Delete This Bill!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(function (e) {
                    if (e.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: 'actionpage.php',
                            data: {
                                billId: billId,
                                queryId: queryId,
                                action: 'AskForDeletePermission'
                            },
                            success: function (response) {
                                if (response.success === true) {
                                    Swal.fire("Success", response.msg, "success");
                                } else if (response.success === false && response.info === true) {
                                    Swal.fire("Info", response.msg, "info");
                                }else{
                                    Swal.fire("Declined", "Something Went Wrong Please Try Again", "error");
                                }
                            }
                        });
                    }
                });
        }

    </script>
    <?php
    if ($_SESSION['queryTaskId'] != '') {
        ?>
        <script type="text/javascript">
            Swal.fire({
                    title: "Are you sure?",
                     text: "You Want To Mark This Notifications As Read !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(function (e) {
                if (e) {
                    let taskId = '<?php echo $_SESSION['queryTaskId']?>';
                    $.ajax({
                        type: 'post',
                        url: 'query_followup.php',
                        data: {
                            taskId: taskId,
                        },
                        success: function (response) {
                            if (response.success === true) {
                                  Swal.fire("Success", response.msg, "success");
                            } else {
                                 Swal.fire("Error", "Something Went Wrong Please Try Again", "error");
                            }
                        }
                    });
                } else {
                    <?php unset($_SESSION['queryTaskId']) ?>
                }
            });
        </script>
        <?php
    }
    ?>


    <div style="display: none;">
        <div id="paymentreceipt"></div>
    </div>
    <script>
        function save_payment_receipt(obj, id) {
            var popaction = encodeURI($(obj).attr('popaction'));
            console.log(popaction);
            $('#paymentreceipt').load('<?php echo $fullurl; ?>paymentreceipt.php?' + popaction, function() {
                downloadreceipt(id);
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>

            function downloadreceipt(id) {
                var element = document.getElementById('paymentreceipt');
                var opt = {
                    filename: 'Bill receipt - '+id+' -- <?php echo date("d M Y"); ?>.pdf'
                };
                html2pdf(element, opt);
            }
    </script>
