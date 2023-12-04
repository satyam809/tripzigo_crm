<?php
include "inc.php";
if($_REQUEST['action'] == 'MarkAllRead' && $_REQUEST['userId'] != ''){
    $user_id = $_POST['userId'];
    if($user_id != ''){
        $namevalue ='makeDone=1';
        $where='assignTo="'.$user_id.'" and makeDone!=1';
        updatelisting('queryTask',$namevalue,$where);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => true, 'msg' => 'Your Notifications Are Cleared.']);
        exit;
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'msg' => 'No Data Found']);
    exit;
}
?>
<div style="padding:10px;">
    <style>
        .swal2-container {
            z-index: 100000 !important;
        }
    </style>
    <script>
        function markDoneAllTask(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You Want To Clear Your Notifications !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes'
            }).then(function (e) {
                if (e.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: 'loadnotificationscreate.php',
                        data: {
                            userId: userId,
                            action: 'MarkAllRead'
                        },
                        success: function (response) {
                            if (response.success === true) {
                                Swal.fire("Success", response.msg, "success");
                                $('#loadnotificationscreate').load('loadnotificationscreate.php');
                            } else {
                                Swal.fire("Error", response.msg, "error");
                            }
                        }
                    });
                }
            });
        }
    </script>
    <div class="row">
        <div class="col-md-6">
            <div style=" font-size:14px; font-weight:600; margin-bottom:10px;"><i class="fa fa-clock-o" aria-hidden="true"></i> You have <span class="countreminders">0</span> notification </div>
        </div>
        <div class="col-md-6">
            <a onclick="markDoneAllTask(<?php echo $_SESSION['userid'] ?>)">
                <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"
                        style="margin-bottom:10px;"><i class="fa fa-check" aria-hidden="true"></i> Mark All Read
                </button>
            </a>
        </div>
    </div>
    <div id="showreminders">
        <?php
        $wherest = '';
        if ($LoginUserDetails['userType'] != 0) {
            $wherest = 'and assignTo="' . $_SESSION['userid'] . '"';
        }

        $n = 1;
        $rs = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and makeDone!=1 order by id desc');
        while ($rest = mysqli_fetch_array($rs)){
        if (date('Y-m-d', strtotime($rest['reminderDate'])) < date('Y-m-d', strtotime("+1 days"))){
        ?>
        <script>
            function markDoneTask(queryTaskId) {
                $.ajax({
                    type: 'post',
                    url: 'index.php',
                    data: {
                        queryTaskId: queryTaskId,
                    },
                });
            }

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success btn-lg',
                    cancelButton: 'btn btn-danger btn-lg'
                },
                buttonsStyling: true
            });

            function givePermissionToDelete(billId, userName, notificationId) {
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You Want To Give Permission For Delete Bill No " + billId + " To " + userName + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let permissionStatus = 'yes';
                        $.ajax({
                            type: 'post',
                            url: 'actionpage.php',
                            data: {
                                notification_id: notificationId,
                                bill_id: billId,
                                permission_status: permissionStatus,
                                action: 'GivePermissionToDelete'
                            },
                            success: function (response) {
                                if (response.success === true) {
                                    Swal.fire("Granted", response.msg, "success");
                                    $('#loadnotificationscreate').load('loadnotificationscreate.php');
                                } else {
                                    Swal.fire("Declined", response.msg, "error");
                                }
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        let permissionStatus = 'no';
                        $.ajax({
                            type: 'post',
                            url: 'actionpage.php',
                            data: {
                                notification_id: notificationId,
                                bill_id: billId,
                                permission_status: permissionStatus,
                                no_clicked: 'yes',
                                action: 'GivePermissionToDelete'
                            },
                            success: function (response) {
                                if (response.success === true) {
                                    Swal.fire("Granted", response.msg, "info");
                                    $('#loadnotificationscreate').load('loadnotificationscreate.php');
                                } else {
                                    Swal.fire("Declined", response.msg, "error");
                                }
                            }
                        });
                    }
                });
            }
        </script>
        <?php if ($rest['notificationType'] == 0){ ?>

        <a target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"
           href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3">
            <?php } ?>
            <?php if ($rest['notificationType'] == 1){ ?>
            <a target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"
               href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['queryId']); ?>&b=4&ntid=<?php echo encode($rest['id']); ?>">
                <?php } ?>

                <?php if ($rest['notificationType'] == 3){
                $bill_id = (int)filter_var($rest['details'], FILTER_SANITIZE_NUMBER_INT);
                $user_name = getUserNameNew($rest['addedBy']);
                ?>
                <a onclick="givePermissionToDelete('<?php echo($bill_id); ?>', '<?php echo($user_name); ?>', '<?php echo($rest['id']); ?>')"
                   href="javascript:void(0)">
                    <?php } ?>

                    <?php if ($rest['notificationType'] == 4){ ?>
                    <a target="_blank"
                       href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=5&markRead=<?php echo encode($rest['id']); ?>">
                        <?php } ?>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2">
                                    <div class="iconbox">
                                        <?php if ($rest['taskType'] == 'Task') { ?>
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'Call') { ?>
                                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'Meeting') { ?>
                                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'Notification') { ?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'PermissionNotification') { ?>
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'PermissionNotificationStatusAccepted') { ?>
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php if ($rest['taskType'] == 'PermissionNotificationStatusDeclined') { ?>
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td width="90%" style="padding-left:10px;">
                                    <div style="font-size:14px; font-weight:600; color:#0066CC;"><?php echo(stripslashes($rest['details'])); ?></div>
                                    <div style="font-size:12px;"><?php if ($rest['taskType'] == 'Notification') { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['dateAdded'])); ?><?php } else { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['reminderDate'])); ?><?php } ?></div>
                                </td>
                            </tr>

                </table>
            </a> <?php $n++;
            }
            } ?>

            <script>
                $('.countreminders').text('<?php echo $n - 1; ?>');
                $('.topnotifications').text('<?php echo $n - 1; ?>');

                if (<?php echo($n - 1); ?><1
                )
                {
                    $('.topnotifications').hide();
                }
                else
                {
                    $('.topnotifications').show();
                }

            </script>
    </div>
</div>

