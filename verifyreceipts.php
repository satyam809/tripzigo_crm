<style>
    html {

        overflow-x: scroll;

    }

    ::-webkit-scrollbar {

        height: 10px;

    }

    /* The switch - the box around the slider */

    .switch {

        position: relative;

        display: inline-block;

        width: 30px !important;

        height: 17px;

    }



    /* Hide default HTML checkbox */

    .switch input {

        opacity: 0;

        width: 0;

        height: 0;

    }



    /* The slider */

    .slider {

        position: absolute;

        cursor: pointer;

        top: 0;

        left: 0;

        right: 0;

        bottom: 0;

        background-color: #ccc;

        -webkit-transition: .4s;

        transition: .4s;

    }



    .slider:before {

        position: absolute;

        content: "";

        height: 13px;

        width: 13px;

        left: 2px;

        bottom: 2px;

        background-color: white;

        -webkit-transition: .4s;

        transition: .4s;

    }



    input:checked+.slider {

        background-color: #2196F3;

    }



    input:focus+.slider {

        box-shadow: 0 0 1px #2196F3;

    }



    input:checked+.slider:before {

        -webkit-transform: translateX(13px);

        -ms-transform: translateX(13px);

        transform: translateX(13px);

    }



    /* Rounded sliders */

    .slider.round {

        border-radius: 17px;

    }



    .slider.round:before {

        border-radius: 50%;

    }



    .tooltip {

        position: relative;

        display: inline-block;

        opacity: 1 !important;

        cursor: pointer;

    }



    .tooltip:hover {

        text-decoration: underline dotted;

    }



    .tooltip .tooltiptext {

        visibility: hidden;

        width: 120px;

        background-color: DarkGray;

        color: white;

        text-align: center;

        border-radius: 6px;

        border: 1.5px gray dotted;

        padding: 5px 0;

        opacity: 0.7;



        /* Position the tooltip */

        position: absolute;

        z-index: 1;

    }



    .tooltip:hover .tooltiptext {

        visibility: visible;

    }
</style>





<div class="wrapper">

    <div class="container-fluid">

        <div class="main-content">



            <div class="page-content">







                <!-- start page title -->





                <div class="row">

                    <div class="col-md-12 col-xl-12">

                        <div class="card">

                            <div class="card-body" style="padding:0px;">

                                <h4 class="card-title" style=" margin-top:0px;">Unverified/Verified receipts</h4>

                                <div style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">



                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">





                                        <div class="col-md-3 col-xl-3">

                                            <form action="" method="get" enctype="multipart/form-data">

                                                <table border="0" cellpadding="0" cellspacing="0">

                                                    <tr>

                                                        <td><input name="ga" style="display: none;" value="verifyreceipts">&nbsp;</td>

                                                        <td style="padding-left:5px;"><select name="status" class="form-control" style="width:150px;">

                                                                <option value="0">All Status</option>

                                                                <option value="1" <?php if ($_REQUEST['status'] == 1) { ?> selected="selected" <?php } ?>>Paid</option>

                                                                <option value="2" <?php if ($_REQUEST['status'] == 2) { ?> selected="selected" <?php } ?>>Scheduled</option>

                                                            </select> </td>

                                                        <td style="padding-left:5px;"><select name="verify" class="form-control" style="width:150px;">

                                                                <option value="0">All Payment</option>

                                                                <option value="1" <?php if ($_REQUEST['verify'] == 1) { ?> selected="selected" <?php } ?>>Verified</option>

                                                                <option value="2" <?php if ($_REQUEST['verify'] == 2) { ?> selected="selected" <?php } ?>>Not verified</option>

                                                            </select> </td>
                                                        <td style="padding-left:5px;">
                                                            <select name="agent" class="form-control" style="width:150px;">
                                                                <option value="0">All Users</option>
                                                                <?php
                                                                $sql = 'SELECT id,firstName,lastName FROM sys_userMaster where status=1 and id not in(1,4060)';
                                                                $result = mysqli_query(db(), $sql) or die(mysqli_error(db()));
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    if ($_REQUEST['agent'] == $row['id']) {
                                                                        echo '<option value="' . $row['id'] . '" selected>' . $row['firstName'] . ' ' . $row['lastName'] . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $row['id'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>

                                                        <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>

                                                    </tr>

                                                </table>

                                            </form>

                                        </div>

                                    </div>



                                </div>

                                <table class="table table-hover mb-0">



                                    <thead>

                                        <tr>

                                            <th>Payment&nbsp;ID</th>

                                            <th>Trans.&nbsp;ID</th>

                                            <th>Query&nbsp;ID</th>

                                            <th>Agent</th>

                                            <th>Type</th>

                                            <th>Amount</th>

                                            <th>Payment&nbsp;Date</th>

                                            <th>Status</th>

                                            <th align="center">Verify</th>

                                            <th align="center">Otp</th>

                                            <th align="center" style="display:none;">&nbsp;</th>

                                            <th>Receipt</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php



                                        $page = clean($_GET['page']);
                                        //$targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&status=' . $_REQUEST['status'] . '&';
                                        $checkagent = isset($_REQUEST['agent']) ? $_REQUEST['agent'] : '';
                                        $verify = isset($_REQUEST['verify']) ? $_REQUEST['verify'] : '';
                                        $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&verify=' . $verify . '&status=' . $_REQUEST['status'] . '&agent=' . $checkagent . '&';


                                        $where1 = '1';

                                        if ($_REQUEST['status']) {

                                            $where1 = 'sys_PackagePayment.paymentStatus=' . $_REQUEST['status'];
                                        } else {

                                            $where1 = 'sys_PackagePayment.paymentStatus!=0';
                                        }

                                        if ($_REQUEST['verify'] == '1') {

                                            $where1 .= ' and sys_PackagePayment.payment_verified=' . $_REQUEST['status'];
                                        } else if ($_REQUEST['verify'] == '2') {

                                            $where1 .= ' and (sys_PackagePayment.payment_verified is NULL or payment_verified=0)';
                                        }

                                        $where1 .= ' and sys_PackagePayment.paymentDate > "2023-10-01 00:00:00"';

                                        if ($checkagent != 0) {

                                            $where1 .= ' AND queryId IN (SELECT id FROM queryMaster WHERE assignTo = "' . $checkagent . '")';
                                           
                                        }

                                        $rs = GetRecordList('*', 'sys_PackagePayment', 'where ' . $where1 . ' order by paymentDate desc', 25, $page, $targetpage);

                                        



                                        $totalentry = $rs[1];

                                        $paging = $rs[2];


                                        // print_r(mysqli_fetch_array($rs[0]));die;
                                        while ($paymentlist = mysqli_fetch_array($rs[0])) {
                                            $b3a = GetPageRecord(
                                                'firstName,lastName',
                                                'sys_userMaster',
                                                'id IN (SELECT assignTo FROM queryMaster WHERE id = "' . $paymentlist['queryId'] . '")'
                                            );


                                            $agentData = mysqli_fetch_array($b3a);



                                        ?>



                                            <tr style=" <?php if ($paymentlist['paymentStatus'] == 1) { ?> background-color: #e4fff9;<?php } ?>">

                                                <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) {

                                                                                    echo encode($paymentlist['id']);
                                                                                } else {

                                                                                    echo '-';
                                                                                } ?></td>

                                                <td align="left" valign="top" style="text-transform:uppercase;"><?php if ($paymentlist['paymentId'] != '') {

                                                                                                                    echo ($paymentlist['paymentId']);
                                                                                                                } else {

                                                                                                                    echo '-';
                                                                                                                } ?></td>

                                                <td align="left" valign="top" style="text-transform:uppercase;"><a style="color: #2196F3 !important;" href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>&c=5"><?php echo htmlspecialchars(encode($paymentlist['queryId'])); ?></a>
                                                </td>



                                                <td align="left" valign="top"><?php echo stripslashes($agentData['firstName']); ?> <?php echo stripslashes($agentData['lastName']); ?></td>



                                                <td align="left" valign="top"><?php if ($paymentlist['paymentId'] != '') { ?><span class="badge badge-dark"><?php echo ($paymentlist['transectionType']); ?></span><?php } ?>

                                                </td>

                                                <td align="left" valign="top">&#8377;<?php echo ($paymentlist['amount']);

                                                                                        $totalpendingamountcount += $paymentlist['amount']; ?></td>

                                                <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) {

                                                                                    echo date('d/m/Y - h:i A', strtotime($paymentlist['paymentDate']));
                                                                                } else {

                                                                                    echo date('d/m/Y', strtotime($paymentlist['paymentDate']));
                                                                                } ?> </td>

                                                <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) { ?><span class="badge badge-success">Paid</span><?php } ?>



                                                    <?php if (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) >= date('Y-m-d H:i:s')) {

                                                        if ($paymentlist['paymentStatus'] == 2) { ?><span class="badge badge-warning">Scheduled</span><?php }
                                                                                                                                                } else {

                                                                                                                                                    if ($paymentlist['paymentStatus'] == 2) { ?>

                                                            <span class="badge badge-danger">Overdue</span>

                                                    <?php }
                                                                                                                                                } ?>
                                                </td>

                                                <td><?php if ($paymentlist['payment_verified'] != '1' && ($paymentlist['paymentStatus'] == '1' || (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) < date('Y-m-d H:i:s')))) { ?><label class="switch">

                                                            <input type="checkbox" name="verify" id="verify" onclick="loadpop('Enter OTP',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addotpreportpgenerate&id=<?php echo $paymentlist['id'] ?>">

                                                            <span class="slider round"></span>

                                                        </label><?php } else if ($paymentlist['payment_verified'] == '1') { //echo "Verified";
                                                                ?> <div class="tooltip" onclick="loadpop('Enter OTP',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addotpreportpgenerate&id=<?php echo $paymentlist['id'] ?>&unverify=true">Verified<span class="tooltiptext">Click to Unverify</span>

                                                        </div> <?php } ?></td>

                                                <script>
                                                    $(document).ready(function() {



                                                        $('#myModal').on('hidden.bs.modal', function() {

                                                            $('input[name=verify]').attr('checked', false);

                                                        })

                                                    });
                                                </script>

                                                <td align="left" valign="top"><?php if ($paymentlist['payment_verified'] != '1' && ($paymentlist['paymentStatus'] == '1' || (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) < date('Y-m-d H:i:s')))) {

                                                                                    echo encode($paymentlist['id']) + $paymentlist['queryId'];
                                                                                } else if ($paymentlist['payment_verified'] == '1') {

                                                                                    echo '-';
                                                                                } ?></td>

                                                <td align="center" valign="top" style="display:none;"><?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>



                                                        <?php if ($paymentlist['paymentStatus'] != 1) { ?>

                                                            <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo ($paymentlist['amount']); ?>" style="margin-bottom:0px; float:right;"><?php if ($paymentlist['paymentWithoutLinkDate'] == '') { ?>Send Payment Details<?php } else { ?>Re-Send Payment Details<?php } ?></button>



                                                            <br />

                                                            <?php if ($paymentlist['paymentWithoutLinkDate'] != '' && $paymentlist['paymentWithoutLinkDate'] != '1970-01-01') { ?>

                                                                <div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A', strtotime($paymentlist['paymentWithoutLinkDate'])); ?> </div>

                                                            <?php }
                                                                                                            } else { ?>



                                                            <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo ($paymentlist['amount']); ?>&acn=1" style="margin-bottom:0px; float:right;"><?php if ($paymentlist['paymentWithoutLinkDate'] == '') { ?>Send Payment Details<?php } else { ?>Re-Send Payment Details<?php } ?></button>





                                                            <br />

                                                            <?php if ($paymentlist['paymentWithoutLinkDate'] != '' && $paymentlist['paymentWithoutLinkDate'] != '1970-01-01') { ?>

                                                                <div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A', strtotime($paymentlist['paymentWithoutLinkDate'])); ?> </div>



                                                            <?php } ?>

                                                    <?php }
                                                                                                        } ?>
                                                </td>



                                                <td align="left" valign="top"><?php if ($paymentlist['receiptFile'] != '') { ?><a href="<?php echo $fullurl; ?>package_image/<?php echo $paymentlist['receiptFile']; ?>" target="_blank">Download</a><?php } ?></td>

                                            </tr>





                                        <?php  } ?>

                                    </tbody>

                                </table>

                                <div class="mt-3 pageingouter">

                                    <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>

                                    <div class="pagingnumbers"><?php echo $paging; ?></div>

                                </div>

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

<div id="saveconfee" style="display:none;"></div>



<script>
    function confeefun(id) {

        var conFee = $('#conFee' + id).val();



        $('#saveconfee').load('actionpage.php?action=saveconfee&id=' + id + '&conFee=' + conFee + '&queryId=<?php echo $_REQUEST['id']; ?>');

    }



    function deletebill(id) {



        if (confirm('Are you sure want to delete?')) {

            $('#saveconfee').load('actionpage.php?action=deletebill&parentId=null&id=' + id);

        }



    }



    function deleteBillUser(id) {

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

        }).then(function(e) {

            if (e.isConfirmed) {

                $.ajax({

                    type: 'post',

                    url: 'actionpage.php',

                    data: {

                        id: id,

                        action: 'deleteBillUser',

                        parentId: '<?php echo $_REQUEST['id']; ?>'

                    },

                    success: function(response) {

                        if (response.success === true) {

                            Swal.fire("Success", response.msg, "success");

                            setTimeout(function() {


                                window.location.href = response.url;

                            }, 1200);

                        } else {

                            Swal.fire("Error", "Something Went Wrong Please Try Again", "error");

                        }

                    }

                });

            }

        });

    }



    function askForPermissionToDelete(billId, queryId) {

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

        }).then(function(e) {

            if (e.isConfirmed) {

                $.ajax({

                    type: 'post',

                    url: 'actionpage.php',

                    data: {

                        billId: billId,

                        queryId: queryId,

                        action: 'AskForDeletePermission'

                    },

                    success: function(response) {

                        if (response.success === true) {

                            Swal.fire("Success", response.msg, "success");

                        } else if (response.success === false && response.info === true) {

                            Swal.fire("Info", response.msg, "info");

                        } else {

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

        }).then(function(e) {

            if (e) {

                let taskId = '<?php echo $_SESSION['queryTaskId'] ?>';

                $.ajax({

                    type: 'post',

                    url: 'query_followup.php',

                    data: {

                        taskId: taskId,

                    },

                    success: function(response) {

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