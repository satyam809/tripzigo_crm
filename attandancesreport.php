<?php if ($_REQUEST['attandancedays'] == '') {
    $attandancedays = 1;
} else {
    $attandancedays = $_REQUEST['attandancedays'];
} ?>
<style>
    .table td,
    .table th {
        vertical-align: top;
    }

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

    .notes {
        font-size: 12px;
        background-color: #FFFFCC;
        border: 1px solid #FFCC33;
        padding: 0px 5px;
        color: #ff6a00;
        font-weight: 600;
        float: left;
        margin-top: 2px;
        border-radius: 2px;
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
                            <div class="card-body" style="padding:0px;">

                                <div style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">

                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">


                                        <div class="col-md-3 col-xl-3">
                                            <form action="" method="get" enctype="multipart/form-data">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td><select name="attandancedays" class="form-control" style="width:220px;">
                                                                <option value="1" <?php if ($attandancedays == 1) { ?> selected="selected" <?php } ?>>
                                                                    Today's Attandance nkjjjk
                                                                </option>
                                                                <option value="2" <?php if ($attandancedays == 2) { ?> selected="selected" <?php } ?>>
                                                                    Last 7 Days Attandance
                                                                </option>
                                                                <option value="3" <?php if ($attandancedays == 3) { ?> selected="selected" <?php } ?>>
                                                                    This Month Attandance
                                                                </option>
                                                                <option value="4" <?php if ($attandancedays == 4) { ?> selected="selected" <?php } ?>>
                                                                    Last Month Attandance
                                                                </option>
                                                            </select></td>
                                                        <?php if ($LoginUserDetails['userType'] == 0) { ?>
                                                            <td style="padding-left:5px;"><select name="searchusers" class="form-control" style="width:180px;">
                                                                    <option value="">All Users</option>
                                                                    <?php

                                                                    $rs22 = GetPageRecord('*', 'sys_userMaster', ' 1  order by firstName asc');
                                                                    while ($restuser = mysqli_fetch_array($rs22)) {

                                                                    ?>
                                                                        <option value="<?php echo $restuser['id']; ?>" <?php if ($restuser['id'] == $_REQUEST['searchusers']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($restuser['firstName']); ?><?php echo stripslashes($restuser['lastName']); ?></option>
                                                                    <?php } ?>
                                                                </select></td><?php } ?>
                                                        <td style="padding-left:5px;">
                                                            <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"><i class="fa fa-search" aria-hidden="true"></i>
                                                                Search
                                                            </button>
                                                        </td>

                                                        <td style="padding-left:5px;"><a href="display.html?ga=attandancesreport">
                                                                <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;">Reset
                                                                </button>
                                                            </a></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title" style=" padding:20px 0px; float:left; width:100%; margin-top:0px;">

                                    <?php if ($attandancedays == 1) { ?> Today's Attandance <?php } ?>
                                    <?php if ($attandancedays == 2) { ?> Last 7 Days Attandance<?php } ?>
                                        <?php if ($attandancedays == 3) { ?> This Month Attandance<?php } ?>
                                            <?php if ($attandancedays == 4) { ?> Last Month Attandance<?php } ?> Report </h4>

                                <?php if ($attandancedays == 1) { ?>
                                    <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th colspan="7" align="left" bgcolor="#F5F5F5"><?php echo date('l, j F Y'); ?></th>
                                            </tr>
                                            <tr>
                                                <th width="2%">
                                                    <div align="center">Sr.</div>
                                                </th>
                                                <th width="20%"><strong>Name</strong></th>
                                                <th width="12%">
                                                    <div align="center">First&nbsp;Login&nbsp;Time</div>
                                                </th>
                                                <th width="12%">
                                                    <div align="center">Sessions</div>
                                                </th>
                                                <th width="12%">
                                                    <div align="center">Last&nbsp;Update</div>
                                                </th>
                                                <th width="12%">
                                                    <div align="center">Type</div>
                                                </th>
                                                <th width="12%">
                                                    <div align="center">Total Break Time</div>
                                                </th>
                                                <th width="12%">
                                                    <div align="center">Working Hours</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $g = 1;
                                            if ($_REQUEST['searchusers'] != '') {
                                                $whereto = ' and id="' . $_REQUEST['searchusers'] . '" ';
                                            }
                                            $totalno = 1;
                                            $where = ' where  1 and status=1 '  . $whereto . '  ';
                                            $limit = clean($_GET['records']);
                                            $page = clean($_GET['page']);
                                            $sNo = 1;
                                            $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity' . $_REQUEST['searchcity'] . '&statusid=' . $_REQUEST['statusid'] . '&';
                                            $rs = GetRecordList('*', 'sys_userMaster', '   ' . $where . '  ', '200', $page, $targetpage);
                                            $totalentry = $rs[1];
                                            $paging = $rs[2];
                                            while ($res = mysqli_fetch_array($rs[0])) {
                                                $totaltime = 0;
                                                $totaltimecount = '0';
                                                $totaltimecountfinal = '0';
                                                $firstlogin = '';

                                                $rst = GetPageRecord('cLogin,checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . date('Y-m-d') . '" order by id asc');
                                                while ($restattand = mysqli_fetch_array($rst)) {
                                                    if ($firstlogin == '') {
                                                        $firstlogin = $restattand['cLogin'];
                                                    }
                                                }

                                                $a = GetPageRecord('totalMinutes', 'userLogs', ' checkoutTime is not null and  userId="' . $res['id'] . '" and date(cLogin)="' . date('Y-m-d') . '"');
                                                $rest = mysqli_fetch_array($a);
                                                //print_r($rest['totalMinutes']);die;
                                                $break_time = GetPageRecord('SUM(minutes) as totalBreakMinutes', 'useractivities', 'activity_type="1" and user_id="' . $res['id'] . '" and date(add_date)="' . date('Y-m-d') . '"');
                                                $break_rest = mysqli_fetch_array($break_time);
                                                //print_r($break_rest['totalBreakMinutes']);die;
                                                $breakmins = 0;
                                                if ($break_rest && $break_rest['end_time']) {
                                                    $breaktimeseconds = strtotime($break_rest['end_time']) - strtotime('00:00:00');
                                                    $breakmins =  round($breaktimeseconds / 60);
                                                }

                                                $total_minutes = $rest['totalMinutes'] - $break_rest['totalBreakMinutes'];
                                                //echo $total_minutes;
                                                $total_break_time = sprintf("%02d", intdiv($break_rest['totalBreakMinutes'], 60)) . ':' . sprintf("%02d", ($break_rest['totalBreakMinutes'] % 60));

                                                $hours = sprintf("%02d", intdiv($total_minutes, 60)) . ':' . sprintf("%02d", ($total_minutes % 60));


                                                $rsts = GetPageRecord('count(id) as totalsessionsnumber', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . date('Y-m-d') . '" order by id asc');
                                                $ressessions = mysqli_fetch_array($rsts);

                                                $rstsl = GetPageRecord('checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . date('Y-m-d') . '" order by id desc');

                                                $lastupdatetime = mysqli_fetch_array($rstsl);
                                            ?>
                                                <tr>
                                                    <td width="2%" align="left" valign="top">
                                                        <div align="center"><?php echo $totalno; ?></div>
                                                    </td>
                                                    <td width="20%" align="left" valign="top">
                                                        <strong><?php echo $res['firstName']; ?></strong>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center">
                                                            <?php if ($firstlogin != '') {
                                                                echo date('h:i A', strtotime($firstlogin));
                                                            } else {
                                                                echo '-';
                                                            } ?>
                                                        </div>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center"><?php echo $ressessions['totalsessionsnumber']; ?></div>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center">
                                                            <?php if ($firstlogin != '') {
                                                                echo date('h:i A', strtotime($lastupdatetime['checkoutTime']));
                                                            } else {
                                                                echo '-';
                                                            } ?>
                                                        </div>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center">
                                                            <?php if ($rest['totalMinutes'] < 1) { ?>
                                                                <span class="badge badge-danger">Absent</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-success">Present</span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center"><?php echo $total_break_time; ?></div>
                                                    </td>
                                                    <td width="12%" align="left" valign="top">
                                                        <div align="center"><?php echo $hours; ?></div>
                                                    </td>
                                                </tr>
                                            <?php $totalno++;
                                                $g++;
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <?php if ($attandancedays == 2) {
                                    $startdate = date('Y-m-d', strtotime('-7 Days'));
                                    $enddate = date('Y-m-d', strtotime('-1 Days'));


                                    $begin = new DateTime($startdate);
                                    $end = new DateTime($enddate);

                                    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                                ?>
                                        <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="7" align="left" bgcolor="#F5F5F5"><?php echo date('l, j F Y', strtotime($i->format("Y-m-d"))); ?></th>
                                                </tr>
                                                <tr>
                                                    <th width="2%">
                                                        <div align="center">Sr.</div>
                                                    </th>
                                                    <th width="20%"><strong>Name</strong></th>
                                                    <th width="12%">
                                                        <div align="center">First&nbsp;Login&nbsp;Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Sessions</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Last&nbsp;Update</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Type</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Total Break Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Working Hours</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $g = 1;

                                                if ($_REQUEST['searchusers'] != '') {
                                                    $whereto = ' and id="' . $_REQUEST['searchusers'] . '" ';
                                                }

                                                $totalno = 1;

                                                $where = ' where  1 ' . $whereto . 'and status = 1 order by firstName asc';
                                                $limit = clean($_GET['records']);
                                                $page = clean($_GET['page']);
                                                $sNo = 1;
                                                $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity' . $_REQUEST['searchcity'] . '&statusid=' . $_REQUEST['statusid'] . '&';
                                                $rs = GetRecordList('*', 'sys_userMaster', '   ' . $where . '  ', '200', $page, $targetpage);
                                                $totalentry = $rs[1];
                                                $paging = $rs[2];
                                                while ($res = mysqli_fetch_array($rs[0])) {

                                                    $totaltime = 0;
                                                    $totaltimecount = '0';
                                                    $totaltimecountfinal = '0';
                                                    $firstlogin = '';


                                                    $rst = GetPageRecord('cLogin,checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    while ($restattand = mysqli_fetch_array($rst)) {

                                                        if ($firstlogin == '') {
                                                            $firstlogin = $restattand['cLogin'];
                                                        }
                                                    }

                                                    $a = GetPageRecord('SUM(totalMinutes) as totalMinutes', 'userLogs', '  userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $rest = mysqli_fetch_array($a);

                                                    $break_time = GetPageRecord('end_time', 'useractivities', 'activity_type="break" and user_id="' . $res['id'] . '" and date(add_date)="' . date('Y-m-d') . '"');
                                                    $break_rest = mysqli_fetch_array($break_time);

                                                    $breakmins = 0;
                                                    if ($break_rest && $break_rest['end_time']) {
                                                        $breaktimeseconds = strtotime($break_rest['end_time']) - strtotime('00:00:00');
                                                        $breakmins =  round($breaktimeseconds / 60);
                                                    }

                                                    $total_minutes = $rest['totalMinutes'] - $breakmins;

                                                    $total_break_time = sprintf("%02d", intdiv($breakmins, 60)) . ':' . sprintf("%02d", ($breakmins % 60));

                                                    $hours = sprintf("%02d", intdiv($total_minutes, 60)) . ':' . sprintf("%02d", ($total_minutes % 60));


                                                    $rsts = GetPageRecord('count(id) as totalsessionsnumber', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $ressessions = mysqli_fetch_array($rsts);

                                                    $rstsl = GetPageRecord('checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id desc');
                                                    $lastupdatetime = mysqli_fetch_array($rstsl);
                                                ?>

                                                    <tr>
                                                        <td width="2%" align="left" valign="top">
                                                            <div align="center"><?php echo $totalno; ?></div>
                                                        </td>
                                                        <td width="20%" align="left" valign="top">
                                                            <strong><?php echo $res['firstName']; ?></strong>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($firstlogin));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $ressessions['totalsessionsnumber']; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($lastupdatetime['checkoutTime']));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($rest['totalMinutes'] < 1) { ?>
                                                                    <span class="badge badge-danger">Absent</span>
                                                                <?php } else { ?>
                                                                    <span class="badge badge-success">Present</span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $total_break_time; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $hours; ?></div>
                                                        </td>
                                                    </tr>
                                                <?php $totalno++;
                                                    $g++;
                                                } ?>
                                            </tbody>
                                        </table>

                                <?php }
                                } ?>

                                <?php if ($attandancedays == 3) {
                                    $startdate = date('Y-m-1');
                                    $enddate = date('Y-m-d');
                                    $begin = new DateTime($startdate);
                                    $end = new DateTime($enddate);
                                    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                                ?>
                                        <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="7" align="left" bgcolor="#F5F5F5"><?php echo date('l, j F Y', strtotime($i->format("Y-m-d"))); ?></th>
                                                </tr>
                                                <tr>
                                                    <th width="2%">
                                                        <div align="center">Sr.</div>
                                                    </th>
                                                    <th width="20%"><strong>Name</strong></th>
                                                    <th width="12%">
                                                        <div align="center">First&nbsp;Login&nbsp;Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Sessions</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Last&nbsp;Update</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Type</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Total Break Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Working Hours</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $g = 1;

                                                if ($_REQUEST['searchusers'] != '') {
                                                    $whereto = ' and id="' . $_REQUEST['searchusers'] . '" ';
                                                }

                                                $totalno = 1;

                                                $where = ' where  1  and status=1 ' . $whereto . ' order by firstName asc';
                                                $limit = clean($_GET['records']);
                                                $page = clean($_GET['page']);
                                                $sNo = 1;
                                                $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity' . $_REQUEST['searchcity'] . '&statusid=' . $_REQUEST['statusid'] . '&';
                                                $rs = GetRecordList('*', 'sys_userMaster', '   ' . $where . '  ', '200', $page, $targetpage);
                                                $totalentry = $rs[1];
                                                $paging = $rs[2];
                                                while ($res = mysqli_fetch_array($rs[0])) {

                                                    $totaltime = 0;
                                                    $totaltimecount = '0';
                                                    $totaltimecountfinal = '0';
                                                    $firstlogin = '';


                                                    $rst = GetPageRecord('cLogin,checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    while ($restattand = mysqli_fetch_array($rst)) {

                                                        if ($firstlogin == '') {
                                                            $firstlogin = $restattand['cLogin'];
                                                        }
                                                    }

                                                    $a = GetPageRecord('SUM(totalMinutes) as totalMinutes', 'userLogs', '  userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $rest = mysqli_fetch_array($a);

                                                    $break_time = GetPageRecord('end_time', 'useractivities', 'activity_type="break" and user_id="' . $res['id'] . '" and date(add_date)="' . date('Y-m-d') . '"');
                                                    $break_rest = mysqli_fetch_array($break_time);

                                                    $breakmins = 0;
                                                    if ($break_rest && $break_rest['end_time']) {
                                                        $breaktimeseconds = strtotime($break_rest['end_time']) - strtotime('00:00:00');
                                                        $breakmins =  round($breaktimeseconds / 60);
                                                    }

                                                    $total_minutes = $rest['totalMinutes'] - $breakmins;

                                                    $total_break_time = sprintf("%02d", intdiv($breakmins, 60)) . ':' . sprintf("%02d", ($breakmins % 60));

                                                    $hours = sprintf("%02d", intdiv($total_minutes, 60)) . ':' . sprintf("%02d", ($total_minutes % 60));


                                                    $rsts = GetPageRecord('count(id) as totalsessionsnumber', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $ressessions = mysqli_fetch_array($rsts);

                                                    $rstsl = GetPageRecord('checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id desc');
                                                    $lastupdatetime = mysqli_fetch_array($rstsl);
                                                ?>

                                                    <tr>
                                                        <td width="2%" align="left" valign="top">
                                                            <div align="center"><?php echo $totalno; ?></div>
                                                        </td>
                                                        <td width="20%" align="left" valign="top">
                                                            <strong><?php echo $res['firstName']; ?></strong>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($firstlogin));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $ressessions['totalsessionsnumber']; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($lastupdatetime['checkoutTime']));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($rest['totalMinutes'] < 1) { ?>
                                                                    <span class="badge badge-danger">Absent</span>
                                                                <?php } else { ?>
                                                                    <span class="badge badge-success">Present</span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $total_break_time; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $hours; ?></div>
                                                        </td>
                                                    </tr>
                                                <?php $totalno++;
                                                    $g++;
                                                } ?>
                                            </tbody>
                                        </table>

                                <?php }
                                } ?>
                                <?php if ($attandancedays == 4) {
                                    $startdate = date('Y-m-1', strtotime('- 1 Months'));
                                    $enddate = date('Y-m-t', strtotime('- 1 Months'));


                                    $begin = new DateTime($startdate);
                                    $end = new DateTime($enddate);

                                    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                                ?>
                                        <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                    <th colspan="7" align="left" bgcolor="#F5F5F5"><?php echo date('l, j F Y', strtotime($i->format("Y-m-d"))); ?></th>
                                                </tr>
                                                <tr>
                                                    <th width="2%">
                                                        <div align="center">Sr.</div>
                                                    </th>
                                                    <th width="20%"><strong>Name</strong></th>
                                                    <th width="12%">
                                                        <div align="center">First&nbsp;Login&nbsp;Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Sessions</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Last&nbsp;Update</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Type</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Total Break Time</div>
                                                    </th>
                                                    <th width="12%">
                                                        <div align="center">Working Hours</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $g = 1;

                                                if ($_REQUEST['searchusers'] != '') {
                                                    $whereto = ' and id="' . $_REQUEST['searchusers'] . '" ';
                                                }

                                                $totalno = 1;

                                                $where = ' where  1   and status=1' . $whereto . ' order by firstName asc';
                                                $limit = clean($_GET['records']);
                                                $page = clean($_GET['page']);
                                                $sNo = 1;
                                                $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity' . $_REQUEST['searchcity'] . '&statusid=' . $_REQUEST['statusid'] . '&';
                                                $rs = GetRecordList('*', 'sys_userMaster', '   ' . $where . '  ', '200', $page, $targetpage);
                                                $totalentry = $rs[1];
                                                $paging = $rs[2];
                                                while ($res = mysqli_fetch_array($rs[0])) {

                                                    $totaltime = 0;
                                                    $totaltimecount = '0';
                                                    $totaltimecountfinal = '0';
                                                    $firstlogin = '';


                                                    $rst = GetPageRecord('cLogin,checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    while ($restattand = mysqli_fetch_array($rst)) {

                                                        if ($firstlogin == '') {
                                                            $firstlogin = $restattand['cLogin'];
                                                        }
                                                    }

                                                    $a = GetPageRecord('SUM(totalMinutes) as totalMinutes', 'userLogs', '  userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $rest = mysqli_fetch_array($a);

                                                    $break_time = GetPageRecord('end_time', 'useractivities', 'activity_type="break" and user_id="' . $res['id'] . '" and date(add_date)="' . date('Y-m-d') . '"');
                                                    $break_rest = mysqli_fetch_array($break_time);

                                                    $breakmins = 0;
                                                    if ($break_rest && $break_rest['end_time']) {
                                                        $breaktimeseconds = strtotime($break_rest['end_time']) - strtotime('00:00:00');
                                                        $breakmins =  round($breaktimeseconds / 60);
                                                    }

                                                    $total_minutes = $rest['totalMinutes'] - $breakmins;

                                                    $total_break_time = sprintf("%02d", intdiv($breakmins, 60)) . ':' . sprintf("%02d", ($breakmins % 60));

                                                    $hours = sprintf("%02d", intdiv($total_minutes, 60)) . ':' . sprintf("%02d", ($total_minutes % 60));

                                                    $rsts = GetPageRecord('count(id) as totalsessionsnumber', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id asc');
                                                    $ressessions = mysqli_fetch_array($rsts);

                                                    $rstsl = GetPageRecord('checkoutTime', 'userLogs', ' userId="' . $res['id'] . '" and date(cLogin)="' . $i->format("Y-m-d") . '" order by id desc');
                                                    $lastupdatetime = mysqli_fetch_array($rstsl);
                                                ?>
                                                    <tr>
                                                        <td width="2%" align="left" valign="top">
                                                            <div align="center"><?php echo $totalno; ?></div>
                                                        </td>
                                                        <td width="20%" align="left" valign="top">
                                                            <strong><?php echo $res['firstName']; ?></strong>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($firstlogin));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $ressessions['totalsessionsnumber']; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($firstlogin != '') {
                                                                    echo date('h:i A', strtotime($lastupdatetime['checkoutTime']));
                                                                } else {
                                                                    echo '-';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center">
                                                                <?php if ($rest['totalMinutes'] < 1) { ?>
                                                                    <span class="badge badge-danger">Absent</span>
                                                                <?php } else { ?>
                                                                    <span class="badge badge-success">Present</span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $total_break_time; ?></div>
                                                        </td>
                                                        <td width="12%" align="left" valign="top">
                                                            <div align="center"><?php echo $hours; ?></div>
                                                        </td>
                                                    </tr>
                                                <?php $totalno++;
                                                    $g++;
                                                } ?>
                                            </tbody>
                                        </table>

                                <?php }
                                } ?>
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
    $(function() {
        $("#startDate").datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $("#endDate").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>


<script>
    function changeAssignTo(id) {
        var assignTo = $('#assignTo' + id).val();
        $('#actoinfrm').attr('src', 'actionpage.php?action=changeassignstatus&queryid=' + id + '&assignTo=' + assignTo);
    }
</script>