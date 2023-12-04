<?php
include "inc.php";
?>
<div style="padding:10px;">
    <div class="row">
        <div class="col-md-12">
            <div style=" font-size:14px; font-weight:600; margin-bottom:10px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> You have <span class="loadcountreminders">0</span> Reminders
            </div>
        </div>
    </div>
    <div id="showreminders">
        <?php
        $wherest = 'and assignTo="' . $_SESSION['userid'] . '"';
        $n = 1;
        $rs = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and makeDone!=1 and taskType!="Notification" and taskType!="PermissionNotification" and taskType!="PermissionNotificationStatusAccepted" and taskType!="PermissionNotificationStatusDeclined" order by reminderDate asc');
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
        </script>
        <?php if ($rest['notificationType'] == 0){ ?>

        <a target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"
           href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3">
            <?php } ?>
            <?php if ($rest['notificationType'] == 1){ ?>
            <a target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"
               href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['queryId']); ?>&b=4&ntid=<?php echo encode($rest['id']); ?>"><i class="fa fa-check" aria-hidden="true"></i>
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
                            </div>
                        </td>
                        <td width="90%" style="padding-left:10px;">
                            <div style="font-size:14px; font-weight:600; color:#0066CC;"><?php echo(stripslashes($rest['details'])); ?></div>
                            <div style="font-size:12px;"><?php if ($rest['taskType'] == 'Notification') { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['dateAdded'])); ?><?php } else { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['reminderDate'])); ?><?php } ?>
                            </div>
                        </td>
                        <td>
                            <i title="Mark Done" class="fa fa-check" aria-hidden="true"></i>
                        </td>
                    </tr>

                </table>
            </a> <?php $n++;
            }
            } ?>
            <div style="height:277px; overflow:auto;">
                    <?php

                    $a = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and makeDone!=1 and taskType="Reminder" order by reminderDate asc');
                    $a_rs = mysqli_fetch_array($a);

                    $b= GetPageRecord('destination_type', 'sys_packageBuilder', 'queryId="'.$a_rs['queryId'].'"');
                    $b_rs = mysqli_fetch_array($b);

                    if ($b_rs['destination_type'] == 'domestic'){
                        $time = date('Y-m-d', strtotime('+15 Days'));
                    }elseif ($b_rs['destination_type'] == 'international'){
                        $time = date('Y-m-d', strtotime('+30 Days'));
                    }else{
                        $time = date('Y-m-d', strtotime('+30 Days'));
                    }

                    $rs1 = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and makeDone!=1 and taskType="Reminder" and date(reminderDate) >= "'.$time.'" order by reminderDate asc');

                    while ($paymentlist = mysqli_fetch_array($rs1)) {

                        $b3d = GetPageRecord('*', 'userMaster', 'id in (select clientId from queryMaster where id="' . $paymentlist['queryId'] . '" )');

                        $clientData = mysqli_fetch_array($b3d);

                        ?>

                <a target="_blank" href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>&c=5" title="Mark Done"
                    onclick="markDoneTask('<?php echo($paymentlist['id']); ?>')">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2">
                                    <div class="iconbox">
                                        <i class="fa fa-rupee" aria-hidden="true"></i>
                                    </div>
                                </td>
                                <td width="90%" style="padding-left:10px;">
                                    <div style="font-size:14px; font-weight:600; color:#0066CC;"><?php echo $paymentlist['details'] . ' ' . '#' .encode($paymentlist['queryId']); ?></div>
                                    <div style="font-size:12px;"><?php echo date('d/m/Y', strtotime($paymentlist['reminderDate'])) ; ?></div>
                                </td>
                                <td>
                                    <i title="Mark Done" class="fa fa-check" aria-hidden="true"></i>
                                </td>
                            </tr>

                        </table>
                    </a>
                        <?php
                        $n++;
                    } ?>
            </div>
            <script>
                $('.loadcountreminders').text('<?php echo $n - 1; ?>');
                $('.loadtopnotifications').text('<?php echo $n - 1; ?>');

                if (<?php echo($n - 1); ?><1
                )
                {
                    $('.loadtopnotifications').hide();
                }
                else
                {
                    $('.loadtopnotifications').show();
                }

            </script>
    </div>
</div>
