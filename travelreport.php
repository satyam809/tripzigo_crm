<?php
if ($_REQUEST['startDate'] != '' && $_REQUEST['endDate'] != '') {
    $startDate = date('d-m-Y', strtotime($_REQUEST['startDate']));
    $endDate = date('d-m-Y', strtotime($_REQUEST['endDate']));
} else {
    $startDate = date('d-m-Y', strtotime('-10 Days'));
    $endDate = date('d-m-Y', strtotime('+10 Days'));
}

$where1 = '';
$where2 = '';

//or DATE(dateAdded) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '"
$whereintotal = 'and DATE(startDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" OR DATE(endDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" ';
$uwhere = 'and endDate>"'.date('Y-m-d').'" and DATE(startDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" ';
$cwhere = 'and endDate<"'.date('Y-m-d').'" and NOT(endDate > "'.date('Y-m-d').'") and DATE(startDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" OR DATE(endDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" ';
$whereintotal2 = ' and DATE(paymentDate) between  "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '" ';

$clientsearch = '';

if ($_REQUEST['keyword'] != '') {
    $clientsearch = ' and queryId in (select id from queryMaster where clientId in (select id from userMaster where firstName like "%' . $_REQUEST['keyword'] . '%" or lastName like "%' . $_REQUEST['keyword'] . '%"  or mobile like "%' . $_REQUEST['keyword'] . '%"  or email like "%' . $_REQUEST['keyword'] . '%" )  or id="' . decode($_REQUEST['keyword']) . '" )  or id="' . decode($_REQUEST['keyword']) . '"';
}

$searchcity = '';
if ($_REQUEST['searchcity'] != '') {
    $searchcity = ' and queryId in(select id from queryMaster where  destinationId="' . $_REQUEST['searchcity'] . '") ';
}

$searchusers = '';
if ($_REQUEST['searchusers'] != '') {
    $searchusers = ' and queryId in(select id from queryMaster where   assignTo="' . $_REQUEST['searchusers'] . '") ';
}
?>

<style>
    .table td, .table th {
        vertical-align: top;
    }

    .sts-box-border {
        border: 2px solid black;
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
                                <h4 class="card-title" style=" margin-top:0px;">Tours Report</h4>
                                <div style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                        <div class="col-md-3 col-xl-3">
                                            <form action="" method="get" enctype="multipart/form-data" id="tourForm">
                                                <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>"/>
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="startDate"
                                                                   name="startDate" readonly="" placeholder="From"
                                                                   value="<?php echo $startDate; ?>"
                                                                   style="width:130px;"></td>
                                                        <td style="padding-left:5px;"><input type="text"
                                                                                             class="form-control"
                                                                                             id="endDate" name="endDate"
                                                                                             readonly=""
                                                                                             placeholder="From"
                                                                                             value="<?php echo $endDate; ?>"
                                                                                             style="width:130px;"></td>
                                                        <td style="padding-left:5px;"><input type="text" name="keyword"
                                                                                             class="form-control"
                                                                                             placeholder="Search by name, email, mobile"
                                                                                             value="<?php echo $_REQUEST['keyword']; ?>"
                                                                                             style=" width:250px;">
                                                        </td>
                                                        <td style="padding-left:5px;"><select name="searchcity"
                                                                                              class="form-control"
                                                                                              style="width:180px;">
                                                                <option value="">All Destinations</option>
                                                                <?php

                                                                $rs22 = GetPageRecord('*', 'queryMaster', '  fromCity!="" and destinationId in (select id from cityMaster) group by destinationId order by id desc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {

                                                                    $a = GetPageRecord('*', 'cityMaster', ' 1 and id="' . $restuser['destinationId'] . '" ');
                                                                    $resultcityname = mysqli_fetch_array($a);
                                                                    ?>
                                                                    <option value="<?php echo $restuser['destinationId']; ?>"
                                                                            <?php if ($restuser['destinationId'] == $_REQUEST['searchcity']){ ?>selected="selected"<?php } ?>><?php echo $resultcityname['name']; ?></option>
                                                                <?php } ?>
                                                            </select></td>
                                                        <?php if ($LoginUserDetails['userType'] == 0) { ?>
                                                            <td style="padding-left:5px;"><select name="searchusers"
                                                                                                  class="form-control"
                                                                                                  style="width:180px;">
                                                                <option value="">All Users</option>
                                                                <?php

                                                                $rs22 = GetPageRecord('*', 'sys_userMaster', ' 1  order by firstName desc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {

                                                                    ?>
                                                                    <option value="<?php echo $restuser['id']; ?>"
                                                                            <?php if ($restuser['id'] == $_REQUEST['searchusers']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['firstName']); ?><?php echo stripslashes($restuser['lastName']); ?></option>
                                                                <?php } ?>
                                                            </select></td><?php } ?>
                                                        <td style="padding-left:5px;">
                                                            <button type="submit"
                                                                    class="btn btn-secondary btn-lg waves-effect waves-light"
                                                                    style="padding: 6px 10px;"><i class="fa fa-search"
                                                                                                  aria-hidden="true"></i>
                                                                Search
                                                            </button>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" value="<?php echo $_REQUEST['tour']; ?>"
                                                       name="tour" id="tourTypes">
                                                <input name="page" type="hidden"
                                                       value="<?php echo $_REQUEST['page']; ?>"/>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div style="margin-bottom:10px;">
                                    <script type="text/javascript">
                                        function changeTourType(tourType) {
                                            $("#tourTypes").val(tourType);
                                            $("#tourForm").submit();
                                        }
                                    </script>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="33%" align="left" valign="top">
                                                <a href="javascript:void(0);" onclick="changeTourType('totaltours')">
                                                    <div class="statusbox <?php if ($_REQUEST['tour'] == 'totaltours') {
                                                        echo 'sts-box-border';
                                                    } else {
                                                        echo '';
                                                    } ?>" style="background-color:#655be6;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                                            <?php
                                                            $ba = GetPageRecord('count(id) as totaltours', 'sys_packageBuilder', ' confirmQuote=1 ' . $whereintotal . ' and queryId in (select id from queryMaster where statusId=5) ' . $clientsearch . ' ' . $clientsearch . ' ' . $searchcity . '');
                                                            $packagecost = mysqli_fetch_array($ba);
                                                            echo($packagecost['totaltours']); ?>
                                                        </div>
                                                        Total Tours
                                                    </div>
                                                </a>
                                            </td>
                                            <td width="33%" align="left" valign="top">
                                                <a href="javascript:void(0);"
                                                   onclick="changeTourType('completedtours')">
                                                    <div class="statusbox <?php if ($_REQUEST['tour'] == 'completedtours') {
                                                        echo 'sts-box-border';
                                                    } else {
                                                        echo '';
                                                    } ?>" style="background-color:#0cb5b5;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as completedtours', 'sys_packageBuilder', ' confirmQuote=1 ' . $cwhere . ' and queryId in (select id from queryMaster where statusId=5)  ' . $clientsearch . ' ' . $clientsearch . ' ' . $searchcity . ' ');
                                                            $packagecostrecived = mysqli_fetch_array($ba);
                                                            echo($packagecostrecived['completedtours']); ?></div>
                                                        Completed Tours
                                                    </div>
                                                </a>
                                            </td>

                                            <td width="33%" align="left" valign="top">
                                                <a onclick="changeTourType('upcomingtours')" href="javascript:void(0);">
                                                    <div class="statusbox <?php if ($_REQUEST['tour'] == 'upcomingtours') {
                                                        echo 'sts-box-border';
                                                    } else {
                                                        echo '';
                                                    } ?>" style="background-color:#e45555;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as upcomingtours', 'sys_packageBuilder', ' confirmQuote=1 ' . $uwhere . ' and queryId in (select id from queryMaster where statusId=5)  ' . $clientsearch . ' ' . $clientsearch . ' ' . $searchcity . ' ');
                                                            $packagecostrecived = mysqli_fetch_array($ba);
                                                            echo($packagecostrecived['upcomingtours']); ?></div>
                                                        Upcoming Tours
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>

                                </div>


                                <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                    <thead>
                                    <tr>
                                        <th>Query ID</th>
                                        <th>Package</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Assigned</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $totalno = 1;
                                    if ($_REQUEST['tour'] == 'totaltours') {
                                        $where = ' where confirmQuote=1 and queryId!=0   ' . $clientsearch . ' ' . $searchcity . ' ' . $searchusers . $whereintotal . ' and queryId in (select id from queryMaster where statusId=5)  order by startDate asc';
                                    } elseif ($_REQUEST['tour'] == 'completedtours') {
                                        $where = ' where confirmQuote=1 and queryId!=0   ' . $clientsearch . ' ' . $searchcity . ' ' . $searchusers . $cwhere . ' and queryId in (select id from queryMaster where statusId=5)  order by startDate asc';
                                    } elseif ($_REQUEST['tour'] == 'upcomingtours') {
                                        $where = ' where confirmQuote=1 and queryId!=0 and endDate>"' . date('Y-m-d') . '" ' . $clientsearch . ' ' . $searchcity . ' ' . $searchusers . $uwhere . ' and queryId in (select id from queryMaster where statusId=5)  order by startDate asc';
                                    } else {
                                        $where = ' where confirmQuote=1 and queryId!=0 ' . $clientsearch . ' ' . $searchcity . ' ' . $searchusers . ' ' . $whereintotal . ' and queryId in (select id from queryMaster where statusId=5) order by startDate asc';
                                        /*$where = ' where startDate>="' . date('Y-m-d', strtotime($startDate)) . '" and startDate<="' . date('Y-m-d', strtotime($endDate)) . '"' . $whereintotal .'and confirmQuote=1 and queryId!=0   ' . $clientsearch . ' ' . $searchcity . ' ' . $searchusers . ' and queryId in (select id from queryMaster where statusId=5)  order by startDate asc';*/
                                    }

                                    $limit = clean($_GET['records']);

                                    $page = clean($_GET['page']);

                                    $sNo = 1;

                                    $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&startDate=' . $_REQUEST['startDate'] . '&endDate=' . $_REQUEST['endDate'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity=' . $_REQUEST['searchcity'] . '&searchusers=' . $_REQUEST['searchusers'] . '&tour=' . $_REQUEST['tour'] . '&';

                                    $rs = GetRecordList('*', 'sys_packageBuilder', '   ' . $where . '  ', '25', $page, $targetpage);

                                    $totalentry = $rs[1];

                                    /*echo "<h1>";
                                    print_r($rs[4]);
                                    echo "</h1>";*/

                                    $paging = $rs[2];

                                    while ($rest = mysqli_fetch_array($rs[0])) {

                                        $b = GetPageRecord('*', 'queryMaster', 'id="' . $rest['queryId'] . '"');
                                        $queryData = mysqli_fetch_array($b);

                                        $bc = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
                                        $clientData = mysqli_fetch_array($bc);

                                        ?>

                                        <tr>
                                            <td align="left" valign="top" style="padding-right:20px;">
                                                <div style="font-size:15px; font-weight:500;line-height: 16px; margin-bottom:3px; font-weight:600;">
                                                    <a style="color: blue !important;"
                                                       href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>"><?php echo encode($rest['id']); ?></a>
                                                </div>
                                            </td>
                                            <td align="left" valign="top"
                                                style="text-transform:uppercase;"><?php echo stripslashes($rest['name']);
                                                if ($rest['destinations'] != '') { ?>
                                                    <div style="color:#999999; font-size:11px; margin-top:2px;">ID: <a
                                                            href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>"
                                                            target="_blank"><?php echo encode($rest['id']); ?></a>
                                                    - <?php echo stripslashes($rest['destinations']); ?>
                                                    &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s)
                                                    - <?php echo stripslashes($rest['child']); ?> Child(s)
                                                    </div><?php } ?>

                                                <div style="margin-top:5px; font-weight:700;">
                                                    From: <?php echo displaydateinword($rest['startDate']); ?> -
                                                    To: <?php echo displaydateinword($rest['endDate']); ?></div>
                                            </td>
                                            <td align="left" valign="top">
                                                <div style="font-weight:600; margin-bottom:3px;"><?php echo stripslashes($clientData['submitName']); ?><?php echo stripslashes($clientData['firstName']); ?><?php echo stripslashes($clientData['lastName']); ?></div>
                                                <div style="  font-size:11px;margin-bottom:2px;"><i class="fa fa-mobile"
                                                                                                    aria-hidden="true"></i> <?php echo stripslashes($clientData['mobile']); ?>
                                                </div>
                                                <div style="  font-size:11px;"><i class="fa fa-envelope"
                                                                                  aria-hidden="true"></i>
                                                    <?php echo stripslashes($clientData['email']); ?></div>
                                            </td>
                                            <td align="left" valign="top">
                                                <?php if ($rest['endDate'] < date('Y-m-d')) { ?>
                                                    <span class="badge badge-success">Compleated</span>
                                                <?php } ?>



                                                <?php if ($rest['endDate'] > date('Y-m-d')) { ?>
                                                    <span class="badge badge-danger">Upcoming</span>
                                                <?php } ?>


                                            </td>
                                            <td align="left" valign="top">
                                                <div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($queryData['assignTo']); ?></div>
                                                <div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div>
                                            </td>
                                        </tr>


                                        <?php $totalno++;
                                    } ?>
                                    </tbody>
                                </table>


                                <?php if ($totalno == 1) { ?>
                                    <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No
                                        Data
                                    </div>
                                <?php } else { ?>
                                    <div class="mt-3 pageingouter">
                                        <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">
                                            Total Records: <strong><?php echo $totalentry; ?></strong></div>
                                        <div class="pagingnumbers"><?php echo $paging; ?></div>

                                    </div>

                                <?php } ?>
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


    $(function () {
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
