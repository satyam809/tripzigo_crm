<?php
ob_start();
if ($_REQUEST['sts'] > 0 && $_REQUEST['sts'] < 13) {
    $namevalue = 'statusId="' . $_REQUEST['sts'] . '"';
    $userId = $_REQUEST['userId'];
    $where = 'id="' . decode($_REQUEST['id']) . '"';
    updatelisting('queryMaster', $namevalue, $where);

    $rs13 = GetPageRecord('*', 'queryStatusMaster', 'id="' . $_REQUEST['sts'] . '"');
    $stausdata = mysqli_fetch_array($rs13);

    $namevalue3 = 'details="Query Status Changed: ' . $stausdata['name'] . '",queryId="' . decode($_REQUEST['id']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",userId="' . $userId . '",logType="status_change"';
    addlisting('queryLogs', $namevalue3);

    sendautomationmail(decode($_REQUEST['id']), $fullurlproposal);

    header('Location:display.html?ga=query&view=1&id=' . $_REQUEST['id'] . '');

}


$startDate = date('d-m-Y', strtotime('+2 Days'));
$endDate = date('d-m-Y', strtotime('+4 Days'));


if ($_REQUEST['id'] != '') {
    $select1 = '*';
    $where1 = 'id="' . decode($_REQUEST['id']) . '"';
    $rs1 = GetPageRecord($select1, 'queryMaster', $where1);
    $editresult = mysqli_fetch_array($rs1);

    if ($editresult['startDate'] != '' && $editresult['endDate'] != '') {

        $startDate = date('d-m-Y', strtotime($editresult['startDate']));
        $endDate = date('d-m-Y', strtotime($editresult['endDate']));

    }


    $b = GetPageRecord('*', 'userMaster', 'id="' . $editresult['clientId'] . '"');
    $clientData = mysqli_fetch_array($b);
}


$rs = GetPageRecord($select, 'sys_userMaster', 'id in (select addedBy from sys_userMaster where id="' . $result['addedBy'] . '") ');
$invoicedataa = mysqli_fetch_array($rs);


if ($_REQUEST['c'] == '') {
    $filename = 'query_details.php';
}
if ($_REQUEST['c'] == 2) {
    $filename = 'query_proposal.php';
}

if ($_REQUEST['c'] == 3) {
    $filename = 'query_followup.php';
}

if ($_REQUEST['c'] == 4) {
    $filename = 'query_supplier.php';
}

if ($_REQUEST['c'] == 5) {
    $filename = 'query_billing.php';
}

if ($_REQUEST['c'] == 6) {
    $filename = 'query_history.php';
}
if ($_REQUEST['c'] == 7) {
    $filename = 'query_mails.php';
}
if ($_REQUEST['c'] == 8) {
    $filename = 'query_operation.php';
}
if ($_REQUEST['c'] == 9) {
    $filename = 'query_tourexpences.php';
}
if ($_REQUEST['c'] == 10) {
    $filename = 'query_guest.php';
}
if ($_REQUEST['c'] == 11) {
    $filename = 'query_payment_link.php';
}


$mainwhere = '';
if ($LoginUserDetails['userType'] != 0) {
    $mainwhere = ' and (addedBy="' . $_SESSION['userid'] . '" or  assignTo="' . $_SESSION['userid'] . '") ';
} else {
    $mainwhere = ' and addedBy in (select addedBy from sys_userMaster where id="' . $_SESSION['userid'] . '") ';
}

/*$ck=GetPageRecord('id','queryMaster',' id in (select queryId from queryNotes) and id='.(decode($_REQUEST['id'])-1).' '.$mainwhere.' order by id DESC limit 0,1');
$notesdatack=mysqli_fetch_array($ck);
if($notesdatack['id']!=''){
$checkQuery=1;
}else{
header('Location:display.html?ga=query');
exit();
}*/


?>

<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: ".editorclass",
        themes: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>

<style>
    .table td, .table th {
        vertical-align: top;
    }

    label {
        width: 100% !important;
        margin-bottom: 2px !important;
        font-size: 12px;
        text-transform: uppercase;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #6c757d;
        border-color: #dee2e6 #dee2e6 #fff;
        color: #fff !important;
        border-radius: 3px;
    }

    .nav-link {
        display: block;
        padding: 8px 30px;
    }

    .header-title {
        margin-bottom: 8px;
        letter-spacing: .02em;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }

    label {
        color: #9a9a9a;
    }

    .input-group {
        font-size: 16px;
    }


    .nav-link {
        padding: 8px 13px !important;
    }
</style>
<div class="wrapper">
    <div class="container-fluid">
        <div class="main-content">

            <div class="page-content">


                <!-- start page title -->


                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card" style="min-height:500px;">
                            <div class="card-body">
                                <h4 class="card-title mobilemargianbottomzero"
                                    style=" margin-top:0px; overflow:hidden;">Query
                                    ID: <?php echo encode($editresult['id']); ?> <?php if ($editresult['priorityStatus'] == 1) { ?>
                                        <img src="images/hot.gif" width="40" height="27"/><?php } ?>

                                    <div class="float-right">
                                        <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>
                                            <a href="#"
                                               onclick="createquery('<?php echo encode($editresult['id']); ?>');"  >
                                                <button type="button"
                                                        class="btn btn-secondary btn-lg waves-effect waves-light"
                                                        style="margin-bottom:10px;">Edit Query
                                                </button></a><?php } ?>

                                        <a href="display.html?ga=query">
                                            <button type="button"
                                                    class="btn btn-primary btn-lg waves-effect waves-light"
                                                    style="margin-bottom:10px;">Back
                                            </button>
                                        </a>
                                    </div>
                                </h4>
                                <div class=" ">
                                    <div class="inquerytabsmain">

                                        <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                            <div class="col-md-12 col-xl-12">

                                                <ul class="nav nav-tabs nav-tabs-custom"
                                                    style="border-bottom:0px solid #dee2e6;">

                                                    <li class="nav-item"><a
                                                                class="nav-link<?php if ($_REQUEST['c'] == '') { ?> active show<?php } ?>"
                                                                href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>"><span
                                                                    class="d-none d-md-block"><i class="fa fa-id-card-o"
                                                                                                 aria-hidden="true"></i> &nbsp;Query Details</span><span
                                                                    class="d-block d-md-none"><i
                                                                        class="mdi mdi-home-variant h5"></i></span></a>
                                                    </li>

                                                    <?php if ($clientData['firstName'] != '' && $startDate != '' && $endDate != '') { ?>

                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Proposal') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 2) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=2"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-list-alt"
                                                                                aria-hidden="true"></i> &nbsp;Proposal</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-account h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>

                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Mails') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 7) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=7"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-envelope-o"
                                                                                aria-hidden="true"></i> &nbsp;Mails</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>


                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Task') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 3) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=3"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-calendar-check-o"
                                                                                aria-hidden="true"></i> &nbsp;Followup's</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-email h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>


                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Suppliers') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 4) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=4"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-users"
                                                                                aria-hidden="true"></i> &nbsp;Suppliers Comm.</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>


                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'TourExpences') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 9) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=9"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-credit-card-alt"
                                                                                aria-hidden="true"></i> &nbsp;Post Sales Supplier</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>

                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'PaymentLinks') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 11) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=11"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-rupee"
                                                                                aria-hidden="true"></i> &nbsp;Payment Links </span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>

                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Operation') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 8) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=8"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-check-square-o"
                                                                                aria-hidden="true"></i> &nbsp;Voucher</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>


                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Billing') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 5) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=5"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-file-text"
                                                                                aria-hidden="true"></i> &nbsp;Billing</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>


                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'Guest') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 10) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=10"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-user"
                                                                                aria-hidden="true"></i> &nbsp;Guest Docs.</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?>

                                                        <?php if (strpos($LoginUserDetails["permissionView"], 'History') !== false) { ?>
                                                            <li class="nav-item"><a
                                                                        class="nav-link<?php if ($_REQUEST['c'] == 6) { ?> active show<?php } ?>"
                                                                        href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=6"><span
                                                                            class="d-none d-md-block"><i
                                                                                class="fa fa-clock-o"
                                                                                aria-hidden="true"></i> &nbsp;History</span><span
                                                                            class="d-block d-md-none"><i
                                                                                class="mdi mdi-settings h5"></i></span></a>
                                                            </li>
                                                        <?php } ?><?php } ?>
                                                </ul>

                                            </div>


                                        </div>

                                    </div>


                                    <?php include $filename; ?>


                                </div>


                            </div>
                        </div>


                    </div>


                </div>


            </div><!--end col-->

            <!-- end row -->

        </div>

        <!-- End Page-content -->


    </div>
</div>    </div>


<script>
    function queryNotes() {
        $('#queryNotes').load('loadQueryNotes.php?id=<?php echo encode($editresult['id']); ?>');
    }

    queryNotes();
</script>
