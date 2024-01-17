<?php

$mainwhere = '';



if ($_REQUEST['action'] == 'MarkAllRead' && $_REQUEST['userId'] != '') {

    $user_id = $_POST['userId'];

    if ($user_id != '') {

        $namevalue = 'makeDone=1';

        $where = 'assignTo="' . $user_id . '" and makeDone!=1';

        updatelisting('queryTask', $namevalue, $where);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['success' => true, 'msg' => 'Your Notifications Are Cleared.']);

        exit;

    }

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode(['success' => false, 'msg' => 'No Data Found']);

    exit;

}



if ($LoginUserDetails['userType'] != 0) {



    $mainwherecnfq = '';

    if ($LoginUserDetails['showQueryStatus'] == 1) {

        $mainwherecnfq = ' and (statusId=5) ';

    } else {

        $mainwherecnfq = ' and (addedBy="' . $_SESSION['userid'] . '" or  assignTo="' . $_SESSION['userid'] . '")  ';

    }



    $mainwhere .= 'and assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  or (   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '") )  ) ) ) ) or addedBy="' . $_SESSION['userid'] . '" or  assignTo="' . $_SESSION['userid'] . '") )  ';



} else {



    $startDate = date('d-m-Y', strtotime('-30 Days'));

    $endDate = date('d-m-Y');





    $mainwhere = '    ';

//$mainwhere='  and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"  ';



}





if ($LoginUserDetails['showQueryStatus'] == 2) {

    $mainwhere = '    ';

}





?>





<style>

    #chartdiv {

        width: 100%;

        height: 290px;

    }



    #chartdivdestination {

        width: 100%;

        height: 240px;

    }



    .text-muted {

        color: #000000 !important;

        font-weight: 700;

        font-size: 14px;

        text-transform: uppercase;

    }



    .container-fluid {

        max-width: 100%;

        padding-left: 80px;

        padding-right: 22px;

        padding-top: 8px;

    }



    .wrapper {

        margin-top: 56px;

        padding-left: 20px;

    }



    html {

        background-color: #eaeef2 !important;

    }



    body {

        background-color: #eaeef2 !important;

    }



    .card-body {

        padding: 10px 15px;

    }

</style>



<!-- Resources -->

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>

<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>

<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>



    <?php

    if(strpos($_SERVER['HTTP_REFERER'],'login.html')){

        $a=GetPageRecord('SUM(totalMinutes) as totalMinutes','userLogs',' checkoutTime is not null and  userId="'.$_SESSION['userid'].'" and date(cLogin)="'.date('Y-m-d').'"');

        $rest=mysqli_fetch_array($a);



        $break_time = GetPageRecord('break_end_time', 'userBreaks', 'activity_type="break" and user_id="' . $_SESSION['userid'] . '" and date(userDate)="' . date('Y-m-d') . '"');

        $break_rest=mysqli_fetch_array($break_time);



        $breakmins=0;

        if($break_rest && $break_rest['break_end_time']){

            $breaktimeseconds = strtotime($break_rest['break_end_time']) - strtotime('00:00:00');

            $breakmins =  round($breaktimeseconds/ 60);

        }



        $total_minutes = $rest['totalMinutes'] - $breakmins;

        $hours = sprintf("%02d",intdiv($total_minutes, 60)).':'. sprintf("%02d",($total_minutes % 60));

    ?>

        <a href="#" id="loginpopup" onclick="loadpop('Total working hours: <?php echo $hours; ?>',this,'600px')" data-toggle="modal"

        data-target=".bs-example-modal-center" popaction="action=loginhourspopup&userid=<?php echo $_SESSION['userid']; ?>&username=<?php echo $_SESSION['username']; ?>"></a>

         <script>

             $( document ).ready(function() {

                 $('#loginpopup').click();

             });



         </script>

    <?php } ?>





<div class="wrapper">

    <div class="dashboardleft">

        <div class="dashboardleftinnter">

            <h4 class="card-title" style=" margin-top:0px; font-size: 18px;">Query Status</h4>

            <a href="display.html?startDate=<?php echo date('d-m-Y'); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=">

                <div class="listbox">

                    <span><?php echo countlisting('id', 'queryMaster', ' where   DATE(dateAdded)="' . date('Y-m-d') . '" ' . $mainwhere . '  '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Today's

                        Queries

                    </div>

                </div>

            </a>



            <a href="display.html?startDate=01-01-<?php echo date('Y', strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=">

                <div class="listbox" style="background-color:#e4ebf9;">

                    <span><?php echo countlisting('id', 'queryMaster', ' where  1 ' . $mainwhere . '   '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total

                        Queries

                    </div>

                </div>

            </a>

            <a href="display.html?startDate=01-01-<?php echo date('Y', strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=8">

                <div class="listbox" style="background-color:#ffe7fb;">

                    <span><?php echo countlisting('id', 'queryMaster', ' where   statusId=8 and clientId in (select id from userMaster where userType=4 and firstName!="") ' . $mainwherecnfq . ' '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Proposal

                        Sent

                    </div>

                </div>

            </a>



            <a href="display.html?startDate=01-01-<?php echo date('Y', strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=9">

                <div class="listbox" style="background-color:#fff1e8;">

                    <span><?php echo countlisting('id', 'queryMaster', ' where   statusId=9  and clientId in (select id from userMaster where userType=4 and firstName!="") ' . $mainwherecnfq . ' '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Pro.

                        Conf

                    </div>

                </div>

            </a>



            <a href="display.html?startDate=01-01-<?php echo date('Y', strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=5">

                <div class="listbox" style="background-color:#e4fdf2;">

                    <span><?php echo countlisting('id', 'queryMaster', ' where   statusId=5  and clientId in (select id from userMaster where userType=4 and firstName!="") ' . $mainwherecnfq . ' '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total

                        Confirmed

                    </div>

                </div>

            </a>

            <a href="display.html?startDate=01-01-<?php echo date('Y', strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=7">

                <div class="listbox" style="background-color:#ffeeed;">

                    <span><?php echo countlisting('id', 'queryMaster', ' where   statusId=7  ' . $mainwhere . '   and clientId in (select id from userMaster where userType=4 and firstName!="")  '); ?></span>



                    <div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Lost

                    </div>

                </div>

            </a>

            <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>

                <a href="#" onclick="createquery('');">

                    <button type="button"

                            class="btn btn-secondary btn-lg waves-effect waves-light createquerybtnmaindash"

                            style="margin-bottom: 10px; border-radius: 12px; padding: 12px; width: 100%;text-align:left;">

                        <i class="fa fa-plus" aria-hidden="true"></i> Add Query

                    </button>

                </a>

            <?php } ?>



            <?php if ($_SESSION['userid'] == 1) { ?>

                <a href="#" onclick="loadpop('Invite team member',this,'600px')" data-toggle="modal"

                   data-target=".bs-example-modal-center" popaction="action=addstaff">

                    <button type="button" class="btn btn-primary btn-lg waves-effect waves-light invitememberboxbutton"

                            style="margin-bottom: 10px; border-radius: 12px; padding: 12px; width: 100%; text-align:left;">

                        <i class="fa fa-user" aria-hidden="true"></i> Invite team member

                    </button>

                </a>

            <?php } ?>



        </div>





    </div>

    <div class="container-fluid" style="padding-left:300px !important;">

        <div class="row">

            <div class="col-xl-6">

                <div class="card">

                    <div class="card-body" style="height:350px;">

                        <p class="text-muted font-weight-medium mt-1 mb-2"><i class="fa fa-calendar-check-o"

                                                                              aria-hidden="true"></i> Task / Followup's

                        </p>

                        <a onclick="markDoneAllTask(<?php echo $_SESSION['userid'] ?>)">

                            <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"

                                    style="margin-bottom:10px;"><i class="fa fa-check" aria-hidden="true"></i> Mark All

                                Read

                            </button>

                        </a>

                        <div style="height:285px; overflow:auto;">

                            <div class="taskfollowuplist">

                                <?php

                                $totalno = 1;



                                $a = GetPageRecord('*', 'queryTask', ' 1 ' . $mainwhere . ' and (makeDone!=1 ) and taskType!="Notification" order by id desc');

                                while ($rest = mysqli_fetch_array($a)) {





                                    $b = GetPageRecord('*', 'queryMaster', 'id="' . $rest['queryId'] . '"');

                                    $queryData = mysqli_fetch_array($b);



                                    $bc = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');

                                    $clientData = mysqli_fetch_array($bc);



                                    ?>

                                    <div class="tasklist">

                                        <div class="heading">

                                            <?php if ($rest['notificationType'] == 3){

                                            $bill_id = (int)filter_var($rest['details'], FILTER_SANITIZE_NUMBER_INT);

                                            $user_name = getUserNameNew($rest['addedBy']); ?>

                                            <a style="color:#000000;"

                                               onclick="givePermissionToDelete('<?php echo($bill_id); ?>', '<?php echo($user_name); ?>', '<?php echo($rest['id']); ?>')"

                                               href="javascript:void(0)">

                                                <?php } ?>

                                                <?php if ($rest['notificationType'] == 0){ ?>

                                                <a target="_blank" onclick="markDoneTask('<?php echo($rest['id']); ?>')"

                                                   href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3"

                                                   style="color:#000000;">

                                                    <?php } ?>

                                                    <?php if ($rest['notificationType'] == 4){ ?>

                                                    <a style="color:#000000;" target="_blank"

                                                       href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=5&markRead=<?php echo encode($rest['id']); ?>">

                                                        <?php } ?>

                                                        <?php

                                                        if ($rest['taskType'] == 'Task') { ?>

                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>

                                                        <?php } ?>

                                                        <?php if ($rest['taskType'] == 'Call') { ?>

                                                            <i class="fa fa-phone-square" aria-hidden="true"></i>

                                                        <?php } ?>

                                                        <?php if ($rest['taskType'] == 'Meeting') { ?>

                                                            <i class="fa fa-handshake-o" aria-hidden="true"></i>

                                                        <?php } ?>

                                                        <?php if ($rest['taskType'] == 'PermissionNotification') { ?>

                                                            <i class="fa fa-lock" aria-hidden="true"></i>

                                                        <?php } ?>

                                                        <?php if ($rest['taskType'] == 'PermissionNotificationStatusAccepted') { ?>

                                                            <i class="fa fa-unlock" aria-hidden="true"></i>

                                                        <?php } ?>

                                                        <?php if ($rest['taskType'] == 'PermissionNotificationStatusDeclined') { ?>

                                                            <i class="fa fa-close" aria-hidden="true"></i>

                                                        <?php } ?> &nbsp;<?php echo encode($rest['queryId']); ?>

                                                        - <?php echo(stripslashes($rest['details'])); ?>

                                                    </a>

                                        </div>

                                        <div class="subline"><span

                                                    style="margin-bottom:5px; font-size:12px; color:#FF0000;<?php if ($rest['makeDone'] == 1) { ?>text-decoration: line-through;<?php } ?>"><i

                                                        class="fa fa-clock-o"

                                                        aria-hidden="true"></i> <?php echo date('d/m/Y-h:i A', strtotime($rest['reminderDate'])); ?> </span>

                                            - <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?> <?php if ($rest['makeDone'] != 1 && date('Y-m-d', strtotime($rest['reminderDate'])) >= date('Y-m-d')) { ?>

                                                <span class="badge badge-info">Scheduled</span><?php } ?>



                                            <?php if ($rest['makeDone'] != 1 && date('Y-m-d', strtotime($rest['reminderDate'])) < date('Y-m-d')) { ?>

                                                <span class="badge badge-danger">Pending</span><?php } ?>

                                            <?php if ($rest['makeDone'] == 1) { ?> <span class="badge badge-success">Done</span>

                                                <div style="width:100%; margin-top:2px; font-size:11px;"><?php echo date('d/m/Y - h:i A', strtotime($rest['confirmDate'])); ?></div><?php } ?>



                                        </div>

                                    </div>

                                    <?php $totalno++;

                                } ?>



                            </div>

                            <?php if ($totalno == 1) { ?>

                                <div style="padding:10px; text-align:center;">Task / Followup's</div><?php } ?>

                        </div>



                    </div>

                </div>

            </div>

            <style>



                .todayspayment {

                    position: fixed;

                    top: 0px;

                    left: 0px;

                    right: 0px;

                    bottom: 0px;

                    margin: 370px;

                    margin-top: 100px;

                    background-color: #fff;

                    height: 420px;

                    z-index: 99999999;

                }

            </style>

            <div class="col-xl-6">

                <div class="card" id="showtodayspayment">

                    <div class="card-body" style="height: 350px;">

                        <p class="text-muted font-weight-medium mt-1 mb-2"><i class="fa fa-file-text"

                                                                              aria-hidden="true"></i> Today's Payment

                            Collection </p>

                        <button type="button" id="closepayment" onclick="closepayementbox();"

                                class="btn btn-secondary btn-lg waves-effect waves-light"

                                style="padding: 6px 10px; position: absolute; top: 12px; right: 30px; display:none;">

                            Close

                        </button>



                        <div style="height:277px; overflow:auto;">

                            <table class="table table-hover mb-0" style="border:1px solid #ddd;">



                                <thead>

                                <tr>

                                    <th>Query ID</th>

                                    <th>Amount</th>

                                    <th>Due Date</th>

                                    <th>Status</th>

                                </tr>

                                </thead>

                                <tbody>

                                <?php

                                $pendingpay = 0;

                                $totalno = 1;



                                if ($LoginUserDetails['showQueryStatus'] == 1) {



                                    $a = GetPageRecord('*', 'sys_PackagePayment', ' 1 and DATE(paymentDate)<="' . date('Y-m-d') . '" and paymentStatus!=1   order by paymentDate asc');

                                } else {

                                    $a = GetPageRecord('*', 'sys_PackagePayment', ' 1 and DATE(paymentDate)<="' . date('Y-m-d') . '" and paymentStatus!=1 and queryId in(select id from queryMaster where 1 ' . $mainwhere . ')  order by paymentDate asc');



                                }





                                while ($paymentlist = mysqli_fetch_array($a)) {





                                    $b3d = GetPageRecord('*', 'userMaster', 'id in (select clientId from queryMaster where id="' . $paymentlist['queryId'] . '" )');

                                    $clientData = mysqli_fetch_array($b3d);

                                    ?>



                                    <tr style="font-size:12px;">

                                        <td align="left" valign="top"><a

                                                    href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>"

                                                    target="_blank"

                                                    style="color: #2b99e7 !important;">#<?php echo encode($paymentlist['queryId']); ?></a><br/><?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?>

                                        </td>

                                        <td align="left" valign="top" style="    font-size: 14px;">

                                            &#8377;<?php echo($paymentlist['amount']); ?></td>

                                        <td align="left"

                                            valign="top"><?php echo date('d/m/Y', strtotime($paymentlist['paymentDate'])); ?> </td>

                                        <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) { ?>

                                                <span class="badge badge-success">Paid</span><?php } ?>



                                            <?php if (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) >= date('Y-m-d H:i:s')) {

                                                if ($paymentlist['paymentStatus'] == 2) {

                                                    $pendingpay = 1; ?><span

                                                            class="badge badge-warning">Scheduled</span><?php }

                                            } else {

                                                if ($paymentlist['paymentStatus'] == 2) {

                                                    $pendingpay = 1; ?> <span

                                                            class="badge badge-danger">Overdue</span> <?php }

                                            } ?>  </td>

                                    </tr>





                                    <?php $totalno++;

                                } ?>

                                </tbody>

                            </table>

                        </div>





                    </div>

                </div>

            </div>





        </div>



        <div class="row">





            <div class="col-xl-5">

                <div class="card">

                    <div class="card-body" style="height: height: 375px;;">

                        <p class="text-muted font-weight-medium mt-1 mb-2">This Year Queries</p>



                        <script>

                            am4core.ready(function () {



// Themes begin

                                am4core.useTheme(am4themes_animated);

// Themes end



// Create chart instance

                                var chart = am4core.create("chartdiv", am4charts.XYChart3D);



// Add data

                                chart.data = [





                                    <?php

                                    for($iM = 1;$iM <= 12;$iM++){

                                    $month = date("M", strtotime("$iM/12/10"));

                                    ?>

                                    {

                                        "country": "<?php echo $month; ?>",

                                        "visits": <?php echo countlisting('id', 'queryMaster', ' where 1 ' . $mainwhere . ' and MONTH(dateAdded)=' . date("m", strtotime("$iM/12/10")) . ' and YEAR(dateAdded)=' . date('Y') . ' '); ?>

                                    },

                                    <?php $i++; } ?>





                                ];



// Create axes

                                let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());

                                categoryAxis.dataFields.category = "country";

                                categoryAxis.renderer.labels.template.rotation = 270;

                                categoryAxis.renderer.labels.template.hideOversized = false;

                                categoryAxis.renderer.minGridDistance = 20;

                                categoryAxis.renderer.labels.template.horizontalCenter = "right";

                                categoryAxis.renderer.labels.template.verticalCenter = "middle";

                                categoryAxis.tooltip.label.rotation = 270;

                                categoryAxis.tooltip.label.horizontalCenter = "right";

                                categoryAxis.tooltip.label.verticalCenter = "middle";



                                let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());





// Create series

                                var series = chart.series.push(new am4charts.ColumnSeries3D());

                                series.dataFields.valueY = "visits";

                                series.dataFields.categoryX = "country";

                                series.name = "Visits";

                                series.tooltipText = "{categoryX}: [bold]{valueY}[/]";

                                series.columns.template.fillOpacity = .8;



                                var columnTemplate = series.columns.template;

                                columnTemplate.strokeWidth = 2;

                                columnTemplate.strokeOpacity = 1;

                                columnTemplate.stroke = am4core.color("#FFFFFF");



                                columnTemplate.adapter.add("fill", function (fill, target) {

                                    return chart.colors.getIndex(target.dataItem.index);

                                })



                                columnTemplate.adapter.add("stroke", function (stroke, target) {

                                    return chart.colors.getIndex(target.dataItem.index);

                                })



                                chart.cursor = new am4charts.XYCursor();

                                chart.cursor.lineX.strokeOpacity = 0;

                                chart.cursor.lineY.strokeOpacity = 0;



                            }); // end am4core.ready()

                        </script>



                        <!-- HTML -->

                        <div id="chartdiv"></div>

                    </div>

                </div>

            </div>



            <div class="col-xl-4">

                <div class="card">

                    <div class="card-body" style="height: height: 365px;;">

                        <p class="text-muted font-weight-medium mt-1 mb-2">QUERIES BY STATUS</p>

                        <div id="chartdiv2" style="height:292px;"></div>



                        <script>

                            am4core.ready(function () {



// Themes begin

                                am4core.useTheme(am4themes_animated);

// Themes end



                                var chart = am4core.create("chartdiv2", am4charts.SlicedChart);

                                chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect



                                chart.data = [



                                    <?php

                                    $a = GetPageRecord('*', 'queryStatusMaster', ' 1 order by id asc');

                                    while($stageres = mysqli_fetch_array($a)){





                                    $abcd = GetPageRecord('count(id) as totalsages', 'queryMaster', 'statusId="' . $stageres['id'] . '" ' . $mainwhere . '');

                                    $leadstagecount = mysqli_fetch_array($abcd);

                                    ?>

                                    {

                                        "name": "<?php echo strip($stageres['name']); ?>",

                                        "value": <?php echo $leadstagecount['totalsages']; ?>

                                    },<?php } ?>



                                ];



                                var series = chart.series.push(new am4charts.FunnelSeries());

                                series.colors.step = 2;

                                series.dataFields.value = "value";

                                series.dataFields.category = "name";

                                series.alignLabels = false;



                                series.labelsContainer.paddingLeft = 15;

                                series.labelsContainer.width = 200;



//series.orientation = "horizontal";

//series.bottomRatio = 1;





                            }); // end am4core.ready()



                        </script>

                    </div>

                </div>

            </div>





            <div class="col-xl-3">

                <div class="card">

                    <div class="card-body">

                        <p class="text-muted font-weight-medium mt-1 mb-2">Online Clients </p>



                        <style>

                            .statusboxed {

                                width: 12px !important;

                                height: 12px !important;

                                border-radius: 100%;

                            }

                        </style>





                        <div style="height:251px; overflow:auto;" id="loadliveclients">

                        </div>





                        <script>

                            window.setInterval(function () {

                                loadliveusers();

                            }, 10000);



                            function loadliveusers() {

                                $('#loadliveusers').load('loadliveusers.php');

                                $('#loadliveclients').load('loadliveclients.php');

                            }



                            loadliveusers();

                        </script>



                        <div style=" margin-top:10px;">



                            <a href="display.html?ga=usermessenger">

                                <button type="button" class="btn btn-primary btn-lg" style=" width:100%;"><i

                                            class="fa fa-comments" aria-hidden="true"></i> View All Chats

                                </button>

                            </a>



                        </div>

                    </div>

                </div>

            </div>





        </div>





        <?php if ($LoginUserDetails['userType'] == 0) { ?>

            <div class="row">





                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <p class="text-muted font-weight-medium mt-1 mb-2">SALES REPS</p>

                            <div style="height:320px; overflow:auto;">

                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">

                                    <tr>

                                        <td align="left" style="padding:5px; border-bottom:1px solid #ddd;">

                                            <strong>Name</strong></td>

                                        <td align="center" bgcolor="#F3F3F3"

                                            style="padding:5px;  border-bottom:1px solid #ddd;">

                                            <strong>Assigned</strong></td>

                                        <td align="center" bgcolor="#E8FFF1"

                                            style="padding:5px;  border-bottom:1px solid #ddd;">

                                            <strong>Confirmed </strong></td>

                                    </tr>

                                    <?php

                                    $rr = 1;

                                    // $rs = GetPageRecord('count(id) as astotalcountquery,id,assignTo', 'queryMaster', '  1 and assignTo!=0  group by assignTo order by astotalcountquery desc limit 0, 15 ');
                                    // comment by sonam
                                    $rs = GetPageRecord('count(id) as astotalcountquery,id,assignTo', 'queryMaster', '  1 and assignTo!=0  group by assignTo order by astotalcountquery desc');

                                    while ($rest = mysqli_fetch_array($rs)) {



                                        $abcd = GetPageRecord('*', 'sys_userMaster', 'id="' . $rest['assignTo'] . '"');

                                        $userdata = mysqli_fetch_array($abcd);

                                        ?>



                                        <tr>

                                            <td width="72%" align="left"

                                                style="padding:5px; border-bottom:1px solid #ddd;"><?php echo $rr; ?>

                                                . <?php echo strip($userdata['firstName']); ?> <?php echo strip($userdata['lastName']); ?></td>

                                            <td width="28%" align="center" bgcolor="#F3F3F3"

                                                style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id', 'queryMaster', ' where  1 ' . $mainwhere . ' and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="' . $userdata['id'] . '"  '); ?></td>

                                            <td width="28%" align="center" bgcolor="#E8FFF1"

                                                style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id', 'queryMaster', ' where statusId=5   ' . $mainwhere . ' and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="' . $userdata['id'] . '"  '); ?></td>

                                        </tr>

                                        <?php $rr++;

                                    } ?>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>





                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <p class="text-muted font-weight-medium mt-1 mb-2">TOP LEAD SOURCES</p>

                            <div style="height:320px; overflow:auto;">

                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">

                                    <tr>

                                        <td align="left" style="padding:5px; border-bottom:1px solid #ddd;">

                                            <strong>Name</strong></td>

                                        <td align="center" bgcolor="#F3F3F3"

                                            style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Total

                                                Queries </strong></td>

                                        <td align="center" bgcolor="#E8FFF1"

                                            style="padding:5px;  border-bottom:1px solid #ddd;">

                                            <strong>Confirmed </strong></td>

                                    </tr>

                                    <?php

                                    $rr = 1;

                                    $rs = GetPageRecord('count(id) as sourcetotal,id,leadSource', 'queryMaster', '  1 and leadSource!=0  group by leadSource order by sourcetotal desc limit 0, 15 ');

                                    while ($rest = mysqli_fetch_array($rs)) {



                                        $abcd = GetPageRecord('*', 'querySourceMaster', 'id="' . $rest['leadSource'] . '"');

                                        $userdata = mysqli_fetch_array($abcd);

                                        ?>



                                        <tr>

                                            <td width="72%" align="left"

                                                style="padding:5px; border-bottom:1px solid #ddd;"><?php echo $rr; ?>

                                                . <?php echo strip($userdata['name']); ?></td>

                                            <td width="28%" align="center" bgcolor="#F3F3F3"

                                                style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id', 'queryMaster', ' where  1 ' . $mainwhere . ' and   leadSource="' . $userdata['id'] . '"  and clientId in (select id from userMaster where userType=4 and firstName!="")  '); ?></td>

                                            <td width="28%" align="center" bgcolor="#E8FFF1"

                                                style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id', 'queryMaster', ' where  statusId=5 and 1 ' . $mainwhere . ' and   leadSource="' . $userdata['id'] . '"  and clientId in (select id from userMaster where userType=4 and firstName!="")  '); ?></td>

                                        </tr>

                                        <?php $rr++;

                                    } ?>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>





                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <p class="text-muted font-weight-medium mt-1 mb-2">Online Users </p>



                            <style>

                                .statusboxed {

                                    width: 12px !important;

                                    height: 12px !important;

                                    border-radius: 100%;

                                }

                            </style>





                            <div style="height:320px; overflow:auto;" id="loadliveusers">

                            </div>

                        </div>

                    </div>

                </div>



                <script>

                    window.setInterval(function () {

                        loadliveusers();

                    }, 10000);



                    function loadliveusers() {

                        $('#loadliveusers').load('loadliveusers.php');

                    }



                    loadliveusers();

                </script>

            </div>

        <?php } ?>

        <!-- end container-fluid -->

    </div>

    <div style="position:fixed; width:100%; height:100%; top:0; left:0; z-index:999; background-color:#00000094; display:none;"

         id="blackdiv"></div>



    <script>

        function closepayementbox() {

            /*$('#blackdiv').hide();

            $('#closepayment').hide();

            $('#showtodayspayment').removeClass('todayspayment');*/

        }



        function openpayementbox() {/*

											$('#blackdiv').show();

											$('#closepayment').show();

											$('#showtodayspayment').addClass('todayspayment');

										*/

        }

        <?php if($pendingpay == 1){ ?>

        openpayementbox();

        <?php } ?>

    </script>

    <script>

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

            $('.container-fluid').removeAttr('style');

        }

    </script>

