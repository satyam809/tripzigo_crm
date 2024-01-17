<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php
$datefilter = '';

if ($_REQUEST['startDate'] != '' && $_REQUEST['endDate'] != '') {
    $startDate = date('d-m-Y', strtotime($_REQUEST['startDate']));
    $endDate = date('d-m-Y', strtotime($_REQUEST['endDate']));
    $datefilter = ' and date(updateDate)<="' . date('Y-m-d', strtotime($endDate)) . '" and  date(updateDate)>="' . date('Y-m-d', strtotime($startDate)) . '"';
} else {
    $startDate = date('d-m-Y', strtotime('-30 Days'));
    $endDate = date('d-m-Y');
}
$mainwhereassignfield = '';
if ($_REQUEST['dltid'] != '') {
    deleteRecord('queryMaster', 'id="' . decode($_REQUEST['dltid']) . '"');
    ?>
    <script>
        alert('Successfully Deleted!');
    </script>
    <?php
}
$totalno = '1';
$totalmail = '0';
$select = '';
$where = '';
$rs = '';
$wheremain = '';
$searchwhere = '';
$searchwhereuser = '';
$mainwhere = '';
$noteswhere = '';
if ($LoginUserDetails['userType'] != 0) {
    if ($LoginUserDetails['showQueryStatus'] == 0) {
        //$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  ';
        $mainwhere = '  ';
    }
    if ($LoginUserDetails['showQueryStatus'] == 1) {
        $mainwhere = ' and (statusId=5  or statusId=9) ';
    }
    if ($LoginUserDetails['showQueryStatus'] == 2) {
        $mainwhere = ' and 1  ';
    } else {
        $mainwhere .= 'and assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  or (   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '") )  ) ) ) ) or addedBy="' . $_SESSION['userid'] . '" or  assignTo="' . $_SESSION['userid'] . '") )  ';
        $mainwhereassignfield = ' and id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  or (   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '" ) ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '")  ) ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="' . $LoginUserDetails['branchId'] . '") )  ) ) ) ) or id="' . $_SESSION['userid'] . '" ) )  ';
    }
    if ($_REQUEST['statusid'] == 1) {
        //$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
    }
    if ($_REQUEST['statusid'] == '') {
        //$noteswhere='and id in (select queryId from queryNotes)';
    }
} else {
    $mainwhere = ' and 1 ';
}
$searchcity = '';
if ($_REQUEST['searchcity'] != '') {
    $searchcity = ' and  destinationId="' . $_REQUEST['searchcity'] . '"';
}
$searchsource = '';
if ($_REQUEST['searchsource'] != '') {
    $searchsource = ' and  leadSource="' . $_REQUEST['searchsource'] . '"';
}
$searchconfirmproposal = '';
if ($_REQUEST['searchconfirmproposal'] == 1) {
    $searchconfirmproposal = ' and id in (select queryId from sys_packageBuilder where confirmQuote=1)';
}
$searchusers = '';
if ($_REQUEST['searchusers'] != '') {
    $searchusers = ' and  assignTo="' . $_REQUEST['searchusers'] . '"';
}
$leadaddedby = '';
if($_REQUEST['leadaddedby'] != ''){
    if ($_REQUEST['leadaddedby'] == 0){
        $leadaddedby = 'and addedBy="0"';
    }
    if ($_REQUEST['leadaddedby'] == 'any'){
        $leadaddedby = '';
    }
    if ($_REQUEST['leadaddedby'] > 0){
        $leadaddedby = 'and addedBy="'.$_REQUEST['leadaddedby'].'"';
    }
}
$statusid = '';
if ($_REQUEST['statusid'] != '') {
    $statusid = ' and  statusId="' . $_REQUEST['statusid'] . '"';
}
if ($_REQUEST['keyword'] != '') {
    $searchwhereuser = ' and (id="' . decode($_REQUEST['keyword']) . '" or clientId in (select id from userMaster where firstName like "%' . $_REQUEST['keyword'] . '%" or lastName like "%' . $_REQUEST['keyword'] . '%"  or mobile like "%' . $_REQUEST['keyword'] . '%" or email like "%' . $_REQUEST['keyword'] . '%") )';
}
$wheres = ' 1 ' . $mainwhere . ' ' . $searchcity . ' ' . $searchwhereuser . '  ' . $searchusers . ' ' . $statusid . ' ' . $noteswhere . ' ' . $searchsource . ' ' . $datefilter . ' ' . $searchconfirmproposal . ' ' . $leadaddedby . 'order by id desc';
$wheres2 = ' and clientId in (select id from userMaster where userType=4) ' . $mainwhere . ' ' . $searchcity . ' ' . $searchwhereuser . '  ' . $searchusers . ' ' . $statusid . '  ' . $searchsource . '  ' . $datefilter . '    order by id asc';
$where2 = ' clientId in (select id from userMaster where userType=4) ' . $mainwhere . ' ' . $searchcity . ' ' . $searchwhereuser . '  ' . $searchusers . ' ' . $statusid . ' ' . $searchsource . '  ' . $datefilter . '   order by id desc';
$where3 = ' clientId in (select id from userMaster where userType=4) ' . $mainwhere . ' ' . $searchcity . ' ' . $searchwhereuser . '  ' . $searchusers . '  ' . $searchsource . '  ' . $datefilter . ' ' . $leadaddedby . '    order by id desc';
$no_where = 'clientId in (select id from userMaster where userType=4)' . $mainwhere;
?>
<style>
    .table td,
    .table th {
        vertical-align: top;
    }

    .statusbox {
        margin-right: 1px;
        padding: 8px;
        text-align: center;
        background-color: #000000;
        font-size: 12px;
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

    .container-fluid {
        max-width: 100%;
        padding-left: 92px;
        padding-right: 22px;
        padding-top: 8px;
    }

    .wrapper {
        margin-top: 56px;
        padding-left: 20px;
    }

    html {
        background-color: #fff !important;
    }

    body {
        background-color: #fff !important;
    }

    .card {
        -webkit-box-shadow: 0 0 1.25rem rgb(255 255 255 / 10%);
        box-shadow: 0 0 1.25rem rgb(255 255 255 / 10%);
    }

    .table > tbody > tr > td,
    .table > tfoot > tr > td,
    .table > thead > tr > td {
        padding: 10px 12px;
    }

    .sts-box-border {
        border: 2px solid darkred;
    }
     .select2-search__field
    {
         width: fit-content!important;
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
                                <h4 class="card-title" style=" margin-top:0px;">Query
                                    <div class="float-right">
                                        <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>
                                            <script type="text/javascript">
                                                function changeTodayDate() {
                                                    var dateOfToday = '<?php echo date('d-m-Y'); ?>';
                                                    $("#startDate").val(dateOfToday);
                                                    $("#searchForm").submit();
                                                }
                                            </script>
                                            <a onclick="changeTodayDate();">
                                                <button type="button"
                                                        class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray"
                                                        style="margin-bottom:10px;">
                                                    <i aria-hidden="true"></i> Today
                                                </button>
                                            </a>
                                            <a onclick="$('.searchquerymain').toggle();">
                                                <button type="button"
                                                        class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray"
                                                        style="margin-bottom:10px;">
                                                    <i class="fa fa-filter" aria-hidden="true"></i> Filter
                                                </button>
                                            </a>
                                        <?php if ($LoginUserDetails['userType'] == 0) { ?>
                                            <a href="getloadfromdocs.php" target="actoinfrm">
                                                <button type="button"
                                                        class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray"
                                                        style="margin-bottom:10px;" onclick="$('#loadleads').show();">
                                                    Load Leads <img src="loadleads.webp"
                                                                    style="width:16px;display:none;" id="loadleads"/>
                                                </button>
                                            </a>
                                        <?php } ?>
                                            <button type="button"
                                                    class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray hideinmobile"
                                                    data-toggle="dropdown" aria-expanded="false"
                                                    style="margin-bottom:10px;">
                                                Options <i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                            <div class="dropdown-menu"
                                                 style="position: absolute; transform: translate3d(1222px, 224px, 0px); top: 0px; left: 0px; will-change: transform;"
                                                 x-placement="bottom-start">
                                                <a class="dropdown-item" style="cursor:pointer;"
                                                   href="client-Import.xls" target="_blank">Download Excel Format</a><a
                                                        class="dropdown-item" style="cursor:pointer;"
                                                        onclick="loadpop('Import',this,'400px')" data-toggle="modal"
                                                        data-target=".bs-example-modal-center"
                                                        popaction="action=importFBleads">Import Excel</a><a
                                                        class="dropdown-item" style="cursor:pointer;"
                                                        href="<?php echo $fullurl; ?>exportQuery.php?startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&statusid=<?php echo $_REQUEST['statusid']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchsource=<?php echo $_REQUEST['searchsource']; ?>&searchconfirmproposal=<?php echo $_REQUEST['searchconfirmproposal']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>"
                                                        target="_blank">Export Data</a>
                                            </div>
                                            <a onclick="createquery('');">
                                                <button type="button"
                                                        class="btn btn-secondary btn-lg waves-effect waves-light"
                                                        style="margin-bottom:10px;"><i class="fa fa-plus"
                                                                                       aria-hidden="true"></i> Add Query
                                                </button>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray showinmobile"
                                                    style="float: left; margin-right: 5px;"
                                                    onclick="$('.searchquerymain').toggle();">
                                                <i class="fa fa-search" aria-hidden="true"></i> Search
                                            </button>
                                        <?php } ?>
                                    </div>
                                </h4>
                                <div style="margin-bottom:10px;" class="querytabslead">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="11%" align="left" valign="top"><a href="display.html?ga=query">
                                                    <div class="statusbox" style="background-color:#53c434;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                                            <?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', $no_where);
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?>
                                                        </div>
                                                        All
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=1&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 1 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 1) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#655be6;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
                                                            <?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=1 and ' . $where3);
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?>
                                                        </div>
                                                        New
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=2&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 2 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 2) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#0cb5b5;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=2 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Active
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=3&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 3 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 3) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#0f1f3e;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=3 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        No Connect
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=9&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 9 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 9) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#FF6600;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=9 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Follow Up
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=12&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 12 ?>">
                                                    <div id="sts12"
                                                         class="statusbox<?php if ($_REQUEST['statusid'] == 12) {
                                                             echo ' sts-box-border'; ?><?php } else {
                                                             echo '';
                                                         } ?>" style="background-color:#F09D00;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=12 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Postponed
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=8&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 8 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 8) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#cc00a9;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=8 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Proposal Sent
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=11&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 11 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 11) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#ff69a1;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=11 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Changes
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=4&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 4 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 4) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#e45555;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=4 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Hot Lead
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=5&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?><?php $_SESSION['statusid'] = 5 ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 5) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#46cd93;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=5 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Confirmed
                                                    </div>
                                                </a></td>
                                            <td width="11%" align="left" valign="top"><a
                                                        href="display.html?ga=query&statusid=6&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>&page=<?php echo $_REQUEST['page']; ?>&searchcity=<?php echo $_REQUEST['searchcity']; ?>&searchusers=<?php echo $_REQUEST['searchusers']; ?>&leadaddedby=<?php echo $_REQUEST['leadaddedby']; ?>">
                                                    <div class="statusbox<?php if ($_REQUEST['statusid'] == 6) {
                                                        echo ' sts-box-border'; ?><?php } else {
                                                        echo '';
                                                    } ?>" style="background-color:#6c757d;">
                                                        <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba = GetPageRecord('count(id) as totalids', 'queryMaster', ' statusId=6 and ' . $where3 . ' ');
                                                            $statusData = mysqli_fetch_array($ba);
                                                            echo $statusData['totalids']; ?></div>
                                                        Cancelled
                                                    </div>
                                                </a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="hideinmobile searchquerymain"
                                     style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                        <div class="col-md-3 col-xl-3 ">
                                            <form action="" method="get" enctype="multipart/form-data" id="searchForm"
                                                  class="querytabsleadsearch ">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <!--                              <input name="page" type="hidden" value="-->
                                                        <?php //echo $_REQUEST['page']; ?><!--" />-->
                                                        <input name="ga" type="hidden"
                                                               value="<?php echo $_REQUEST['ga']; ?>"/>
                                                        <input name="statusid" type="hidden"
                                                               value="<?php echo $_REQUEST['statusid']; ?>"/>
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
                                                                                             placeholder="Search by ID, name, email, mobile"
                                                                                             value="<?php echo $_REQUEST['keyword']; ?>"
                                                                                             style=" width:250px;">
                                                        </td>
                                                        <td style="padding-left:5px;">
                                                            <select class="js-example-basic-multiple" name="searchcity[]" multiple="multiple" style="width:160px!important;" >
                                                                <option value="">All Destinations</option>
                                                                <?php
                                                                $rs22 = GetPageRecord('*', 'queryMaster', ' destinationId in (select id from cityMaster where name!="") group by destinationId order by id desc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {
                                                                    $a = GetPageRecord('*', 'cityMaster', ' 1 and id="' . $restuser['destinationId'] . '" ');
                                                                    $resultcityname = mysqli_fetch_array($a);
                                                                    ?>
                                                                    <option value="<?php echo $restuser['destinationId']; ?>"
                                                                            <?php if ($restuser['destinationId'] == $_REQUEST['searchcity']) { ?>selected="selected" <?php } ?>><?php echo $resultcityname['name']; ?></option>
                                                                <?php } ?>
                                                            </select></td>
                                                        <?php if ($LoginUserDetails['userType'] == 0) { ?>
                                                            <td style="padding-left:5px;"><select name="searchusers"
                                                                                                  class="form-control"
                                                                                                  style="width:130px;">
                                                                <option value="">All Users</option>
                                                                <?php
                                                                $rs22 = GetPageRecord('*', 'sys_userMaster', ' 1 and status=1  order by firstName desc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {
                                                                    ?>
                                                                    <option value="<?php echo $restuser['id']; ?>"
                                                                            <?php if ($restuser['id'] == $_REQUEST['searchusers']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($restuser['firstName']); ?><?php echo stripslashes($restuser['lastName']); ?></option>
                                                                <?php } ?>
                                                            </select></td><?php } ?>
                                                        <td style="padding-left:5px;"><select name="searchsource"
                                                                                              class="form-control"
                                                                                              id="searchsource"
                                                                                              style="width:140px;">
                                                                <option value="">All Source</option>
                                                                <?php
                                                                $rs22 = GetPageRecord('*', 'querySourceMaster', ' 1  order by name asc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {
                                                                    ?>
                                                                    <option value="<?php echo $restuser['id']; ?>"
                                                                            <?php if ($restuser['id'] == $_REQUEST['searchsource']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($restuser['name']); ?></option>
                                                                <?php } ?>
                                                            </select></td>
                                                        <td style="padding-left:5px;"><select name="leadaddedby"
                                                                                              class="form-control"
                                                                                              style="width:130px;">
                                                                <option <?php if ($_REQUEST['leadaddedby'] == 0) { ?>selected="selected" <?php } ?> value="0">None</option>
                                                                <?php
                                                                $rs22 = GetPageRecord('*', 'sys_userMaster', ' 1  order by firstName asc');
                                                                while ($restuser = mysqli_fetch_array($rs22)) {
                                                                    ?>
                                                                    <option value="<?php echo $restuser['id']; ?>"
                                                                            <?php if ($restuser['id'] == $_REQUEST['leadaddedby']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($restuser['firstName']); ?><?php echo stripslashes($restuser['lastName']); ?></option>
                                                                <?php } ?>
                                                                <option value="any" <?php if ($_REQUEST['leadaddedby'] == 'any' || $_REQUEST['leadaddedby'] == '') { ?>selected="selected" <?php } ?>>Any</option>
                                                            </select></td>
                                                        <td style="padding-left:5px;">
                                                            <button type="submit"
                                                                    class="btn btn-secondary btn-lg waves-effect waves-light"
                                                                    style="padding: 6px 10px;"><i class="fa fa-search"
                                                                                                  aria-hidden="true"></i>
                                                                Search
                                                            </button>
                                                        </td>
                                                        <td style="padding-left:5px;"><a href="display.html?ga=query">
                                                                <button type="button"
                                                                        class="btn btn-secondary btn-lg waves-effect waves-light"
                                                                        style="padding: 6px 10px;">All
                                                                </button>
                                                            </a></td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="frmaction.html" method="post" enctype="multipart/form-data"
                                      name="addeditfrm" target="actoinfrm" id="addeditfrm">
                                    <div id="bulkassign"
                                         style="display:none;padding: 5px 2px; background-color: #f0f0f0; border-bottom: 2px solid #ddd; border-radius: 3px; margin-bottom: 10px;">
                                        <table border="0" cellspacing="0" cellpadding="5">
                                            <tr>
                                                <td style="font-size:13px;"><input type="checkbox" id="ckbCheckAll"
                                                                                   style="width: 16px; height: 16px;"/>
                                                </td>
                                                <td style="font-size:13px;">Select All&nbsp;</td>
                                                <td><select id="assignToPerson" name="assignToPerson"
                                                            class="form-control"
                                                            style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"
                                                            autocomplete="off">
                                                        <option value="0">Assign To</option>
                                                        <?php
                                                        $rs22 = GetPageRecord('*', 'sys_userMaster', '  userType=1 or userType=0 order by firstName asc');
                                                        while ($restuser = mysqli_fetch_array($rs22)) {
                                                            ?>
                                                            <option value="<?php echo $restuser['id']; ?>"
                                                                    <?php if ($restuser['id'] == $rest['assignTo']) { ?>selected="selected" <?php } ?>>
                                                                <?php if ($restuser['id'] == 1) {
                                                                    echo 'Not Assign';
                                                                } else { ?>
                                                                    <?php echo $restuser['firstName']; ?><?php echo $restuser['lastName'];
                                                                } ?></option>
                                                        <?php } ?>
                                                    </select></td>
                                                <td>
                                                    <button type="submit" id="savingbutton" class="btn btn-primary"
                                                            onclick="this.form.submit(); this.value='Saving...';"
                                                            style="float:right;padding: 3px 10px;">
                                                        Save
                                                    </button>
                                                </td>
                                                <td><input autocomplete="false" name="action" type="hidden" id="action"
                                                           value="bulkassignquery"/></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $g = 1;
                                    if ($LoginUserDetails['userType'] != 0 && $_REQUEST['statusid'] < 2) {
                                    } ?>
                                    <?php
                                    $where = ' where ' . $wheres . '  ';
                                    $limit = clean($_GET['records']);
                                    $page = clean($_GET['page']);
                                    $sNo = 1;
                                    $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&searchcity=' . $_REQUEST['searchcity'] . '&statusid=' . $_REQUEST['statusid'] . '&startDate=' . $_REQUEST['startDate'] . '&endDate=' . $_REQUEST['endDate'] . '&searchusers=' . $_REQUEST['searchusers'] . '&leadaddedby=' . $_REQUEST['leadaddedby'] . '&';
                                    $rs = GetRecordList('*', 'queryMaster', '   ' . $where . '  ', '25', $page, $targetpage);
                                    $totalentry = $rs[1];
                                    $paging = $rs[2];
                                    while ($rest = mysqli_fetch_array($rs[0])) {
                                        $b = GetPageRecord('*', 'userMaster', 'id="' . $rest['clientId'] . '"');
                                        $clientData = mysqli_fetch_array($b);
                                        $c = GetPageRecord('id,details', 'queryNotes', 'queryId="' . $rest['id'] . '" order by id desc');
                                        $notesdata = mysqli_fetch_array($c);
                                        $checkQuery = 1;
                                        $rs133 = GetPageRecord('*', 'sys_packageBuilder', 'queryId="' . $rest['id'] . '" and confirmQuote=1');
                                        $packageDatas = mysqli_fetch_array($rs133);
                                        $rs133a = GetPageRecord('id', 'sys_packageBuilder', 'queryId="' . $rest['id'] . '"');
                                        $packagehave = mysqli_fetch_array($rs133a);
                                        $totalpackagehave = mysqli_num_rows($rs133a);

                                        $task_data = GetPageRecord('*', 'queryTask', ' queryId="' . $rest['id'] . '" and taskType!="Notification" order by id asc');
                                        while ($response_of_task_data = mysqli_fetch_array($task_data)) {
                                            if ($rest['id'] && $response_of_task_data['queryId']) {
                                                $follow_up_date = $response_of_task_data['dateAdded'];
                                                $follow_up_id = $response_of_task_data['queryId'];
                                            }
                                        }
                                        ?>
                                        <div class="querylistbox">
                                            <div class="qtp">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td width="3%" align="left" valign="top"
                                                            style="padding-right:10px;"><input type="checkbox"
                                                                                               name="assignall[]"
                                                                                               class="checkBoxClass"
                                                                                               id="assignqury"
                                                                                               value="<?php echo encode($rest['id']); ?>"
                                                                                               onclick="selectedfun();"
                                                                                               style="width: 16px; height: 16px;">
                                                        </td>
                                                        <td width="14%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="font-size:15px; font-weight:500;line-height: 16px; margin-bottom:3px; font-weight:600;">
                                                                <a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>"><?php echo encode($rest['id']); ?></a>
                                                            </div>
                                                            <?php echo getstatus($rest['statusId']); ?>
                                                        </td>
                                                        <td width="20%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;font-weight:600;"><?php echo stripslashes($rest['name']); ?></div>
                                                            <div style="font-size:13px; color:#686868;"><?php echo stripslashes($rest['phone']); ?></div>
                                                        </td>
                                                        <td width="17%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="font-size:13px; line-height: 16px;"><span
                                                                        style="color:#686868;">Destination<br/>
                                  </span><span style="max-width:180px; overflow:hidden;overflow-wrap: break-word;">
                                    <?php
                                    $string = '';
                                    $string = preg_replace('/\.$/', '', $rest['destinationId']);
                                    $array = explode(',', $string);
                                    foreach ($array as $value) { ?>
                                        <span class="badge badge-boxed  badge-soft-success"
                                              style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo getCityName($value); ?></span>
                                    <?php } ?></span></div>
                                                        </td>
                                                        <td width="15%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="font-size:12px; line-height: 16px; margin-bottom:3px;">
                                                                <span style="color:#686868;"><i class="fa fa-calendar"
                                                                                                aria-hidden="true"></i></span> <?php echo date('d-m-Y', strtotime($rest['startDate'])); ?>
                                                            </div>
                                                            <div style="font-size:12px; line-height: 16px;"><span
                                                                        style="color:#686868;">Till</span> <?php echo date('d-m-Y', strtotime($rest['endDate'])); ?>
                                                            </div>
                                                        </td>
                                                        <td align="left" valign="top"
                                                            style="font-size:13px; line-height: 16px;">
                                                            <?php
                                                            $taskdetails = '';
                                                            $rstt = GetPageRecord('*', 'queryTask', ' queryId="' . $rest['id'] . '" order by id desc limit 0,1');
                                                            while ($resttask = mysqli_fetch_array($rstt)) { ?>
                                                            <div style="font-size:13px; line-height: 16px; margin-bottom:3px;"><span
                                                                        style="color:#686868;<?php if ($resttask['makeDone'] != 1 && date('Y-m-d', strtotime($resttask['reminderDate'])) < date('Y-m-d')) { ?> color:#FF0000;<?php } ?>"><?php if ($resttask['taskType'] == 'Task') { ?>
                                                                        <i class="fa fa-calendar-check-o"
                                                                           aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                    <?php if ($resttask['taskType'] == 'Call') { ?>
                                                                        <i class="fa fa-phone-square"
                                                                           aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                    <?php if ($resttask['taskType'] == 'Meeting') { ?>
                                                                        <i class="fa fa-handshake-o"
                                                                           aria-hidden="true"></i>
                                                                    <?php } ?>&nbsp;<span
                                                                            style="<?php if ($resttask['makeDone'] == 1) { ?>text-decoration: line-through;<?php } ?>"><?php if ($resttask['makeDone'] != 1 && date('Y-m-d', strtotime($resttask['reminderDate'])) < date('Y-m-d')) { ?>
                                                                            <img src="images/animbell.gif"
                                                                                 height="16"/><?php } ?><?php echo $taskdetails = (stripslashes($resttask['details'])); ?></span></span>
                                                            </div>
                                                            <?php }
                                                            if ($taskdetails == '') {
                                                                echo 'No Task';
                                                            } ?></span>
                                                            <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size:12px;color:#686868;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px;">
                                                                <i class="fa fa-sticky-note" aria-hidden="true"
                                                                   style=" color:#ffa500;"></i> &nbsp;
                                                                <?php echo stripslashes($notesdata['details']);
                                                                if ($notesdata['details'] == '') {
                                                                    echo 'No Notes';
                                                                } ?></div>
                                                        </td>
                                                        <td width="13%" align="right" valign="middle">
                                                            <div class="btn-group" role="group" aria-label="Option">
                                                                <a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>">
                                                                    <button type="button" class="btn btn-secondary"><i
                                                                                class="fa fa-eye"
                                                                                aria-hidden="true"></i></button>
                                                                </a>
                                                                <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>
                                                                    <?php if (trim($clientData['mobile']) != '') {
                                                                        $mobileno = '';
                                                                        if (strlen($clientData['mobile']) > 10) {
                                                                            $mobileno = stripslashes($clientData['mobile']);
                                                                        }
                                                                        if (strlen($clientData['mobile']) == 10) {
                                                                            $mobileno = '' . stripslashes($clientData['mobile']);
                                                                        }
                                                                        ?>
                                                                        <a target="_blank"
                                                                           href="https://api.whatsapp.com/send?text=Hi&phone=+91<?php echo str_replace('+91', '', $mobileno); ?>">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"><i
                                                                                        class="fa fa-whatsapp"
                                                                                        aria-hidden="true"></i></button>
                                                                        </a>
                                                                        <a onclick="click_to_call_v2('<?php echo encode($rest['id']); ?>');">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"><i
                                                                                        class="fa fa-phone"
                                                                                        aria-hidden="true"></i></button>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <a popaction="action=composemail&queryId=<?php echo encode($rest['id']); ?>"
                                                                       onclick="loadpop('Compose Mail',this,'900px')"
                                                                       data-toggle="modal"
                                                                       data-target=".bs-example-modal-center">
                                                                        <button type="button" class="btn btn-secondary">
                                                                            <i class="fa fa-envelope-o"
                                                                               aria-hidden="true"></i></button>
                                                                    </a>
                                                                    <a onclick="createquery('<?php echo encode($rest['id']); ?>');">
                                                                        <button type="button" class="btn btn-secondary">
                                                                            <i class="fa fa-pencil"
                                                                               aria-hidden="true"></i></button>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="qbt">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td width="3%" align="center" valign="top"
                                                            style="padding-right:10px;"> <?php if ($rest['priorityStatus'] == 1) { ?>
                                                                <img src="images/hot.gif" width="32"
                                                                     height="23"/><?php } ?>
                                                        </td>
                                                        <td width="14%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="font-size:12px; line-height: 16px; margin-bottom:3px;color:#686868;">
                                                                Requirement
                                                            </div>
                                                            <div class="blueicons"
                                                                 style="font-size:12px; font-weight:600;"><?php $rsb = GetPageRecord('*', 'queryServicesMaster', ' id="' . $rest['serviceId'] . '"');
                                                                while ($restsource = mysqli_fetch_array($rsb)) {
                                                                    echo stripslashes($restsource['name']);
                                                                } ?></div>
                                                        </td>
                                                        <td width="20%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo stripslashes($rest['email']); ?></div>
                                                            <div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php $rsb = GetPageRecord('*', 'querySourceMaster', ' id="' . $rest['leadSource'] . '"');
                                                                while ($restsource = mysqli_fetch_array($rsb)) {
                                                                    
                                         if($_SESSION['userid']==1 || $_SESSION['userid']==4045 ){
                                                                    echo stripslashes($restsource['name']);
                                                               } } ?></div>
                                                        </td>
                                                        <td width="17%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="color:#303030; font-size:12px; margin-bottom:3px;">
                                                                Travellers
                                                            </div>
                                                            <div style="font-size:13px; line-height: 16px;"><?php echo $rest['adult']; ?>
                                                                <span style="color:#686868; font-size:11px;">Adult</span> <?php echo $rest['child']; ?>
                                                                <span style="color:#686868; font-size:11px;">Clild</span> <?php echo $rest['infant']; ?>
                                                                <span style="color:#686868; font-size:11px;">Infant</span>
                                                            </div>
                                                        </td>
                                                        <td width="15%" align="left" valign="top"
                                                            style="padding-right:20px;">
                                                            <div style="color:#303030; font-size:12px; margin-bottom:3px;">
                                                                Assigned to
                                                            </div>
                                                            <div id="contentForAssignTo" style="font-size:12px;">
                                                                <select
                                                                        id="assignTo<?php echo encode($rest['id']); ?>"
                                                                        name="assignTo<?php echo encode($rest['id']); ?>"
                                                                        class="form-control"
                                                                        style="padding: 3px; font-size: 12px; height: 25px; line-height: 15px; color: #000; font-weight: 600;"
                                                                        autocomplete="off"
                                                                        onchange="changeAssignTo('<?php echo encode($rest['id']); ?>','<?php echo $rest['assignTo'];?>');">
                                                                    <option id="idOfSelect<?php echo $_SESSION['userid']; ?>" value="<?php echo $_SESSION['userid']; ?>">
                                                                        Assign to me
                                                                    </option>
                                                                    <?php
                                                                    $rs22 = GetPageRecord('*', 'sys_userMaster', ' id!="' . $LoginUserDetails['id'] . '" ' . $mainwhereassignfield . ' and (userType=1 or userType=0) order by firstName asc');
                                                                    while ($restuser = mysqli_fetch_array($rs22)) {
                                                                        ?>
                                                                        <option id="idOfSelect<?php echo $restuser['id']; ?>" value="<?php echo $restuser['id']; ?>"
                                                                                <?php if ($restuser['id'] == $rest['assignTo']) { ?>selected="selected" <?php } ?>>
                                                                            <?php if ($restuser['id'] == 1) {
                                                                                echo 'Not Assign';
                                                                            } else { ?>
                                                                                <?php echo $restuser['firstName']; ?><?php echo $restuser['lastName'];
                                                                            } ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td align="left" valign="top">
                                                            <div style="font-size:12px; line-height: 16px; margin-bottom:3px;">
                                                                <span style="color:#686868;"><i class="fa fa-clock-o"
                                                                                                aria-hidden="true"></i> Created</span>
                                                            </div>
                                                            <div style="font-size:11px; line-height: 16px; margin-bottom:3px;"><?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></div>
                                                        </td>
                                                        <?php
                                                        if ($rest['id'] == $follow_up_id && $rest['statusId'] != 5 && $rest['statusId'] != 6 && $rest['statusId'] != 7) {
                                                            ?>
                                                            <td align="left" valign="top">
                                                                <div style="font-size:12px; line-height: 16px; margin-bottom:3px;">
                                                                    <span style="color:#686868;"><i
                                                                                class="fa fa-clock-o"
                                                                                aria-hidden="true"></i> Follow Up Date</span>
                                                                </div>
                                                                <div style="font-size:11px; line-height: 16px; margin-bottom:3px;"><?php echo date('d/m/Y - h:i A', strtotime($follow_up_date)); ?></div>
                                                            </td>
                                                        <?php } ?>
                                                        <td width="13%" align="left" valign="top">
                                                            <div style="font-size:12px; line-height: 16px; margin-bottom:3px;">
                                                                <span style="color:#686868;"><i class="fa fa-clock-o"
                                                                                                aria-hidden="true"></i> Last Updated</span>
                                                            </div>
                                                            <div style="font-size:11px; line-height: 16px; margin-bottom:3px;"><?php echo date('d/m/Y - h:i A', strtotime($rest['updateDate'])); ?></div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if ($packagehave['id'] != '') { ?>
                                                <div class="viewpackageheader"
                                                     onclick="$('#pro<?php echo $rest['id']; ?>').toggle();"><i
                                                            class="fa fa-dot-circle-o" aria-hidden="true"></i> &nbsp;View
                                                    Proposal (<?php echo $totalpackagehave; ?>)
                                                </div>
                                                <div class="proposallistouter" style="display:none;"
                                                     id="pro<?php echo $rest['id']; ?>">
                                                    <?php
                                                    $rspro = GetPageRecord('id,name,grossPrice,confirmQuote', 'sys_packageBuilder', ' 1 and  queryId="' . $rest['id'] . '" order by id desc');
                                                    while ($restproposal = mysqli_fetch_array($rspro)) {
                                                        ?>
                                                        <a href="display.html?ga=itineraries&view=1&id=<?php echo encode($restproposal['id']); ?>"><i
                                                                    class="fa fa-list-alt" aria-hidden="true"></i>
                                                            &nbsp;<?php echo stripslashes($restproposal['name']); ?> (&#8377;<?php echo number_format($restproposal['grossPrice']); ?>
                                                            ) &nbsp; <?php if ($restproposal['confirmQuote'] == 1) { ?>
                                                                <i class="fa fa-check" aria-hidden="true"
                                                                   style="color:#00CC00;"></i><?php } ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php $totalno++;
                                    } ?>
                                </form>
                                <?php if ($totalno == 1) { ?>
                                    <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No
                                        Query
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
                </div>
                <!--end col-->
                <!-- end row -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function dltfunction(id) {
        if (confirm('Are you sure your want to delete?')) {
            window.location.href = 'display.html?ga=query&dltid=' + id;
        }
    }

    $(function () {
        $("#startDate").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-90:+00"
        });
        $("#endDate").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-90:+00"
        });
    });
</script>
<script>
    function changeAssignTo(id, id2) {
        let previous = $('#idOfSelect' + id2).val();
        Swal.fire({
            title: "Are you sure?",
            text: "You Want To Change Assigned To !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then(function (e) {
            if (e.isConfirmed) {
                var assignTo = $('#assignTo' + id).val();
                // console.log(id);
                // console.log(assignTo);
                $('#actoinfrm').attr('src', 'actionpage.php?action=changeassignstatus&queryid=' + id + '&assignTo=' + assignTo);
                $.ajax({
                type: "GET",
                url: "ajax-query-wamsg-on-assign.php", // Changed URL here
                data: {
                    queryid: id,
                    assignedToId: assignTo,
                },
                success: function(response) {
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            }else{
                $('#assignTo' + id).val(previous).attr("selected","selected");
            }
        });
    }

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            if ($(".checkBoxClass").prop('checked') == true) {
                $('#bulkassign').show();
            } else {
                $('#bulkassign').hide();
            }
        });
    });

    function selectedfun() {
        var mychecked = $('.checkBoxClass:checked').length
        if (mychecked == 0) {
            $('#bulkassign').hide();
        }
        if (mychecked > 0) {
            $('#bulkassign').show();
        }
    }
     $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
        placeholder: 'Select a destination', // Set your desired placeholder text here
        allowClear: true, // If you want to allow clearing the selected option
        minimumResultsForSearch: Infinity // Hide the search box
    });
}); 
</script>
