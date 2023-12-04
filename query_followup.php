<?php
if ($_REQUEST['taskId'] != '') {
    include "config/database.php";
    include "config/function.php";
    $task_id = $_REQUEST['taskId'];
    if ($task_id != '') {
        $namevalue = 'makeDone=1';
        $where = 'id="' . $task_id . '"';
        updatelisting('queryTask', $namevalue, $where);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => true, 'msg' => 'This Notification Is Marked As Read.']);
        unset($_SESSION['queryTaskId']);
        exit;
    }
    header('Content-Type: application/json; charset=utf-8');
    unset($_SESSION['queryTaskId']);
    echo json_encode(['success' => false, 'msg' => 'No Data Found']);
    exit;
}
?>
    <style>
        .tasklist {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            border: 3px;
            border: 1px solid #ddd;
            border-left: 5px solid #ff8a12;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .tasklist .iconbox {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            background-color: #ff8a12;
            color: #fff;
            text-align: center;
            line-height: 50px;
            font-size: 18px;
            border-radius: 100%;
        }

        .makedone {
            border-left: 5px solid #009900;
        }

        .makedone .iconbox {
            background-color: #009900;
        }

        .makenotedone {
            border: 1px solid #CC3300;
            border-left: 5px solid #CC3300;
        }

        .makenotedone .iconbox {
            background-color: #CC3300;
        }
    </style>

    <div class="row">
        <div class="col-lg-8" style="padding-left:15px;">
            <h4 class="mt-0 header-title">Task / Followup's</h4>
            <div class="row" style="padding-left: 5px; padding-top: 15px;">

                <?php
                $n = 1;
                $rs = GetPageRecord('*', 'queryTask', ' queryId="' . $editresult['id'] . '" and taskType!="Notification" order by id desc');
                while ($rest = mysqli_fetch_array($rs)) {
                    ?>
                    <div class="col-lg-12">
                        <div class="tasklist<?php if ($rest['makeDone'] == 1) { ?> makedone<?php } ?><?php if ($rest['makeDone'] != 1 && date('Y-m-d', strtotime($rest['reminderDate'])) < date('Y-m-d')) { ?> makenotedone<?php } ?>">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2" align="left" valign="top">
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

                                        </div>
                                    </td>
                                    <td width="98%" align="left" valign="top" style="position:relative;">

                                        <?php if ($rest['makeDone'] == 1) { ?>
                                            <i class="fa fa-check-square" aria-hidden="true"
                                               style="font-size:24px; color:#009900; cursor:pointer; position:absolute; right:10px; top:22px;"
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Completed"></i>
                                        <?php } else { ?>
                                            <i class="fa fa-square-o" aria-hidden="true"
                                               style="font-size:24px; color:#333333; cursor:pointer; position:absolute; right:10px; top:22px;"
                                               data-placement="top" data-original-title="Click to complete"
                                               onclick="loadpop('Alert',this,'600px')" data-toggle="modal"
                                               data-target=".bs-example-modal-center"
                                               popaction="action=confirmtask&id=<?php echo encode($rest['id']); ?>&qid=<?php echo $_REQUEST['id']; ?>"></i>
                                        <?php } ?>


                                        <div style="margin-bottom:0px; font-size:16px; font-weight:500;<?php if ($rest['makeDone'] == 1) { ?>text-decoration: line-through;<?php } ?>"><?php echo(stripslashes($rest['details'])); ?></div>
                                        <?php if ($rest['status'] == 1) { ?>
                                            <div style="margin-bottom:5px; font-size:12px; color:#FF0000;<?php if ($rest['makeDone'] == 1) { ?>text-decoration: line-through;<?php } ?>">
                                                <i class="fa fa-clock-o"
                                                   aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A', strtotime($rest['reminderDate'])); ?>
                                                <?php if ($rest['makeDone'] != 1 && date('Y-m-d', strtotime($rest['reminderDate'])) < date('Y-m-d')) { ?>
                                                    <span class="badge badge-danger">Pending</span><?php } ?>
                                                <?php if ($rest['makeDone'] == 1) { ?> <span
                                                        class="badge badge-info"><?php echo date('d/m/Y - h:i A', strtotime($rest['confirmDate'])); ?></span><?php } ?>

                                            </div>
                                        <?php } ?>
                                        <div style="margin-bottom:5px; font-size:12px; ">
                                            <em><?php echo date('d/m/Y - h:i A', strtotime($rest['dateAdded'])); ?></em>
                                            by <?php $rsb = GetPageRecord('*', 'sys_userMaster', ' id="' . $rest['addedBy'] . '"');
                                            while ($restsource = mysqli_fetch_array($rsb)) {
                                                echo stripslashes($restsource['firstName'] . ' ' . $restsource['lastName']);
                                            } ?></div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <?php $n++;
                } ?>

                <?php if ($n == 1) { ?>
                    <div style="text-align:center; color:#999999; width:100%;">No Task</div>
                <?php } ?>
            </div>


        </div>
        <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Task') !== false) { ?>
            <div class="col-lg-4" style="padding-left:15px;">
                <h4 class="mt-0 header-title"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Add Task /
                    Followup</h4>

                <div class="row" style="padding: 5px;">
                    <div class="col-lg-12">
                        <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm"
                              target="actoinfrm" id="addeditfrm">

                            <div class="form-group mb-3">

                                <div style="margin-bottom:2px; font-size:12px;">Type</div>

                                <select name="taskType" class="form-control" autocomplete="off"
                                        style="width:100%; margin-bottom:20px;">
                                    <option value="Task">Task</option>
                                    <option value="Call">Call</option>
                                    <option value="Meeting">Meeting</option>
                                </select>

                                <div style="margin-bottom:2px; font-size:12px;">Description</div>
                                <textarea name="details" rows="4"
                                          class="form-control"><?php echo $datatask['details']; ?></textarea>
                                <input name="queryid" type="hidden" value="<?php echo encode($editresult['id']); ?>">
                                <input name="action" type="hidden" value="addtask">


                            </div>


                            <div class="form-group mb-3">


                                <table border="0" cellpadding="0" cellspacing="0">

                                    <tr>

                                        <td colspan="2" style=" font-size:12px;">Reminder Date</td>

                                        <td style=" font-size:12px;">&nbsp;&nbsp;&nbsp;Time</td>

                                        <td style=" font-size:12px;">&nbsp;&nbsp;&nbsp;Set Reminder</td>

                                    </tr>

                                    <tr>

                                        <td colspan="2"><input type="text" class="form-control" id="reminderDate"
                                                               name="reminderDate" readonly=""
                                                               value="<?php echo date('d-m-Y'); ?>"></td>
                                        <script>
                                            $(function () {
                                                $("#reminderDate").datepicker({
                                                    dateFormat: 'dd-mm-yy', minDate: 0
                                                });
                                            });
                                        </script>
                                        <td style="padding-left:10px;"><select id="reminderTime" name="reminderTime"
                                                                               class="form-control" autocomplete="off"
                                                                               style="width:130px;">

                                                <?php

                                                $thisday = date('Y-m-d', strtotime($_REQUEST['daydate']));

                                                $start = strtotime('00:00');

                                                $end = strtotime('23:30');

                                                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {


                                                    $thisdaytime = date('H:i:s', $i);

                                                    $newthisday = date('H:i:s', strtotime($thisday . ' ' . $thisdaytime));

                                                    ?>


                                                    <option value="<?php echo $newthisday; ?>" <?php if (date('g:i A', $i) == '1:00 PM') { ?> selected="selected"<?php } ?>><?php echo date('g:i A', $i); ?></option>;


                                                <?php } ?>

                                            </select></td>

                                        <td style="padding-left:10px;"><select name="status" class="form-control"
                                                                               autocomplete="off" style="width:100px;">

                                                <option value="1">Yes</option>

                                                <option value="0">No</option>

                                            </select></td>

                                    </tr>

                                </table>


                            </div>
                            <div class="form-group mb-2">
                                <select id="assignTo<?php echo encode($rest['id']); ?>" name="assignTo"
                                        class="form-control" autocomplete="off"
                                        onchange="changeAssignTo('<?php echo encode($rest['id']); ?>');">
                                    <option value="0">Assign To</option>
                                    <?php

                                    $rs22 = GetPageRecord('*', 'sys_userMaster', '  userType=1 or userType=0 order by firstName asc');
                                    while ($restuser = mysqli_fetch_array($rs22)) {
                                        ?>
                                        <option value="<?php echo $restuser['id']; ?>"
                                                <?php if ($restuser['id'] == $_SESSION['userid']){ ?>selected="selected"<?php } ?>><?php echo $restuser['firstName']; ?><?php echo $restuser['lastName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group" style="overflow:hidden;">


                                <div style="margin-top:5px;">
                                    <button type="submit" id="savingbutton" class="btn btn-primary"
                                            onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"
                                            style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i> Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>

            </div>
        <?php } ?>
    </div>
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
            if (e.isConfirmed) {
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
