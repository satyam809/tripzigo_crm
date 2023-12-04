<?php
include "inc.php";
$wherest = 'and assignTo="' . $_SESSION['userid'] . '"';
$is_reminder_between_time_data = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and taskType!="Notification" and taskType!="PermissionNotification" and makeDone!=1 and taskType!="PermissionNotificationStatusAccepted" and taskType!="PermissionNotificationStatusDeclined" and taskType!="Reminder" and reminderDate between "'.date('Y-m-d H:i').'" and "'.date('Y-m-d H:i', strtotime('+10 minutes')).'" order by dateAdded asc');
$is_reminder_between_time_result = mysqli_fetch_array($is_reminder_between_time_data);

if ($is_reminder_between_time_result > 0){
?>
    <div class="col-md-12">
        <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
             role="alert" data-brk-library="component__alert">
            <a style="color: black;"
               href="display.html?ga=query&view=1&id=<?php echo encode($is_reminder_between_time_result['queryId']); ?>&c=3" title="Mark Done"
               onclick="markDoneTask('<?php echo($is_reminder_between_time_result['id']); ?>')">
                <button type="button" class="close"><i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </a>
            <a style="text-decoration: none;" target="_blank" onclick="markDoneTask('<?php echo($is_reminder_between_time_result['id']); ?>')"
               href="display.html?ga=query&view=1&id=<?php echo encode($is_reminder_between_time_result['queryId']); ?>&c=3">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <div class="iconbox">
                                <?php if ($is_reminder_between_time_result['taskType'] == 'Task') { ?>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($is_reminder_between_time_result['taskType'] == 'Call') { ?>
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($is_reminder_between_time_result['taskType'] == 'Meeting') { ?>
                                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($is_reminder_between_time_result['taskType'] == 'Notification') { ?>
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <?php } ?>
                            </div>
                        </td>
                        <td width="90%" style="padding-left:10px;">
                            <div style="font-size:14px; font-weight:600; color:black;"><?php echo(stripslashes($is_reminder_between_time_result['details'])); ?></div>
                            <div style="color: black; font-size:12px;"><?php if ($is_reminder_between_time_result['taskType'] == 'Notification') { ?><?php echo date('d/m/Y - h:i A', strtotime($is_reminder_between_time_result['dateAdded'])); ?><?php } else { ?><?php echo date('d/m/Y - h:i A', strtotime($is_reminder_between_time_result['reminderDate'])); ?><?php } ?></div>
                        </td>
                    </tr>
                </table>
            </a>
        </div>
    </div>
<?php }else{
    $rs = GetPageRecord('*', 'queryTask', ' 1 ' . $wherest . ' and taskType!="Notification" and taskType!="PermissionNotification" and makeDone!=1 and taskType!="PermissionNotificationStatusAccepted" and taskType!="PermissionNotificationStatusDeclined" and taskType!="Reminder" order by reminderDate asc');
    $rest = mysqli_fetch_array($rs);
    ?>
        <?php if ($rest > 0){ ?>
    <div class="col-md-12">
        <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
             role="alert" data-brk-library="component__alert">
            <a style="color: black;"
               href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3" title="Mark Done"
               onclick="markDoneTask('<?php echo($rest['id']); ?>')">
                <button type="button" class="close"><i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </a>
            <a style="text-decoration: none;" target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"
               href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3">
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
                            <div style="font-size:14px; font-weight:600; color:black;"><?php echo(stripslashes($rest['details'])); ?></div>
                            <div style="color: black; font-size:12px;"><?php if ($rest['taskType'] == 'Notification') { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['dateAdded'])); ?><?php } else { ?><?php echo date('d/m/Y - h:i A', strtotime($rest['reminderDate'])); ?><?php } ?></div>
                        </td>
                    </tr>
                </table>
            </a>
        </div>
    </div>
<?php }} ?>
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
$rest1 = mysqli_fetch_array($rs1);

if ($rest1 > 0){
    ?>
    <div class="col-md-12">
        <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
             role="alert" data-brk-library="component__alert">
            <a target="_blank" style="color: black;"
               href="display.html?ga=query&view=1&id=<?php echo encode($rest1['queryId']); ?>&c=5" title="Mark Done"
               onclick="markDoneTask('<?php echo($rest1['id']); ?>')">
                <button type="button" class="close"><i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </a>
            <a style="text-decoration: none;" target="_blank" onclick="markDoneTask('<?php echo($rest1['id']); ?>')"
               href="display.html?ga=query&view=1&id=<?php echo encode($rest1['queryId']); ?>&c=5">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <div class="iconbox">
                                <?php if ($rest1['taskType'] == 'Task') { ?>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($rest1['taskType'] == 'Call') { ?>
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($rest1['taskType'] == 'Meeting') { ?>
                                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($rest1['taskType'] == 'Notification') { ?>
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if ($rest1['taskType'] == 'Reminder') { ?>
                                    <i class="fa fa-rupee" aria-hidden="true"></i>
                                <?php } ?>
                            </div>
                        </td>
                        <td width="90%" style="padding-left:10px;">
                            <div style="font-size:14px; font-weight:600; color:black;"><?php echo(stripslashes($rest1['details'])); ?></div>
                            <div style="color: black; font-size:12px;"><?php if ($rest1['taskType'] == 'Notification') { ?><?php echo date('d/m/Y - h:i A', strtotime($rest1['dateAdded'])); ?><?php } else { ?><?php echo date('d/m/Y - h:i A', strtotime($rest1['reminderDate'])); ?><?php } ?></div>
                        </td>
                    </tr>
                </table>
            </a>
        </div>
    </div>
<?php } ?>
