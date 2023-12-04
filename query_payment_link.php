<div class="sectabnew">
    <div class="float-right">
        <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"
                onclick="loadpop('Add Payment Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center"
                popaction="action=addpaymentlink&queryid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-plus"
                                                                                            aria-hidden="true"></i> Add
            Payment Link
        </button>
    </div>
</div>
<style>
    .table td, .table th {
        vertical-align: middle;
    }
</style>
<script type="text/javascript">
    function sendPaymentLinkSMS(paymentLinkId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Want To Send Payment Link !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then(function (e) {
            if (e.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: 'actionpage.php',
                    data: {
                        paymentLinkId: paymentLinkId,
                        action: 'sendpaymentlinksms'
                    },
                    success: function (response) {
                        if (response.success === true) {
                            Swal.fire("Success", response.msg, "success");
                        } else if(response.success === false && response.info === true) {
                            Swal.fire("Info", response.msg, "info");
                        } else {
                            Swal.fire("Declined", "Something Went Wrong Please Try Again", "error");
                        }
                    }
                });
            }
        });
    }

    function sendPaymentLinkWhatsApp(paymentLinkId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Want To Send Payment Link !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then(function (e) {
            if (e.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: 'actionpage.php',
                    data: {
                        paymentLinkId: paymentLinkId,
                        action: 'sendpaymentlinkwhatsapp'
                    },
                    success: function (response) {
                        if (response.success === true) {
                            Swal.fire("Success", response.msg, "success");
                            window.open(response.url, '_blank');
                        } else if(response.success === false && response.info === true) {
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
<div class="overflowautomobiletable">
    <table class="table table-hover mb-0">
        <thead>
        <tr>
            <th>Sr.</th>
            <th>Query Id</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Status</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $totalno = '1';
        $sr = 1;
        $select = '*';
        $table_name = 'queryPaymentLinks';
        $where = 'where query_id="' . decode($_REQUEST['id']) . '"';
        $rs = '';
        $limit = clean($_GET['records']);
        $page = clean($_GET['page']);
        $sNo = 1;

        $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&view=' . $_REQUEST['view'] . '&id=' . $_REQUEST['id'] . '&c=' . $_REQUEST['c'] . '&';

        $rs = GetRecordList($select, $table_name, '  ' . $where . '  ', '25', $page, $targetpage);

        $totalentry = $rs[1];

        $paging = $rs[2];

        while ($rest = mysqli_fetch_array($rs[0])) {
            ?>

            <tr <?php if ($rest['confirmQuote'] == 1){ ?>style="background-color: #e7fff8;"<?php } ?>>
                <td><?php echo $sr++; ?></td>
                <td><?php echo encode($rest['query_id']); ?></td>
                <td>
                    <div align="left">
                        <a style="padding: 2px 4px; font-size: 12px; background-color: #059a7f; color: #fff; border-radius: 2px; top: -3px; position: relative; cursor:pointer;"
                           onclick="loadpop('Edit Pricing',this,'400px')"
                           data-toggle="modal" data-target=".bs-example-modal-center"
                           popaction="action=editpaymentpricing&pid=<?php echo $rest['id']; ?>&queryid=<?php echo encode($rest['query_id']); ?>">Edit</a> <?php if ($rest['amount'] > 0) {
                            echo '&#8377;' . number_format($rest['amount']);
                        } else {
                            echo 0 . '&#8377;';
                        } ?></div>
                </td>
                <td><?php echo $rest['description']; ?>
                </td>
                <td>
                    <?php ($rest['status'] != '') ? print_r(GetStatusForPaymentLinks($rest['id'])) : '-' ; ?>
                </td>
                <td>
                    <div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['created_by']); ?></div>
                    <div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['created_at']); ?></div>
                </td>
                <td>
                    <?php echo date('d/m/Y - h:i A', strtotime($rest['created_at'])); ?>
                </td>
                <td>
                    <?php echo date('d/m/Y - h:i A', strtotime($rest['updated_at'])); ?>
                </td>
                <td>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <a aria-label="Sent Via WhatsApp" class="dropdown-item" onclick="sendPaymentLinkWhatsApp('<?php echo $rest['id']; ?>')" href="javascript:void(0)"><i style="color: green;" class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:void(0)" class="dropdown-item" onclick="sendPaymentLinkSMS('<?php echo $rest['id']; ?>')"><i style="color: blue;" class="fa fa-mobile" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php $totalno++;
        } ?>
        </tbody>
    </table>
</div>

<?php if ($totalno == 1) { ?>
    <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Payment Links</div>
<?php } else { ?>
    <div class="mt-3 pageingouter">
        <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">
            Total Records: <strong><?php echo $totalentry; ?></strong></div>
        <div class="pagingnumbers"><?php echo $paging; ?></div>
    </div>
<?php } ?>
