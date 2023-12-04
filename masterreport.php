<?php
$datefilter = '';

if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
    $startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
    $endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
    $startDate=date('d-m-Y',strtotime('-30 Days'));
    $endDate=date('d-m-Y',strtotime('+30 Days'));
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
$mainwhere = ' and 1 ';
$wheres = ' 1 ' . $mainwhere . ' ' . $searchcity . ' ' . $searchwhereuser . '  ' . $searchusers . ' ' . $statusid . ' ' . $noteswhere . ' ' . $searchsource . ' ' . $datefilter . ' ' . $searchconfirmproposal . '  order by id desc';
?>

<style>
    .table td, .table th {
        vertical-align: top;
    }
    .statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
</style>
<div class="wrapper">
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-content">
                <!-- start page title -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card" style="min-height:500px;">
                            <div class="card-body"  style="padding:0px;">
                                <h4 class="card-title" style=" margin-top:0px;">Master Report</h4>
                                <div   style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                        <div class="col-md-3 col-xl-3">
                                            <form  action=""    method="get" enctype="multipart/form-data">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
                                                        <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
                                                        <?php  if($LoginUserDetails['userType']==0){ ?> <?php } ?>
                                                        <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
                                                        <td><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px; margin-left:10px;" onclick="fnExcelReport();"><i class="fa fa-download" aria-hidden="true"></i> Export Report</button></td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" name="ga" value="masterreport" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-bottom:10px;"> </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0" style="border:1px solid #ddd; display:1none !important;" id="headerTable" >
                                        <thead>
                                        <tr>
                                            <th>Query ID</th>
                                            <th>Current Status </th>
                                            <th>Client Name </th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Lead Creation Date </th>
                                            <th>Updation Date </th>
                                            <th>Destination </th>
                                            <th>Time Of Travel</th>
                                            <th># PAX </th>
                                            <th>Duration </th>
                                            <th>Budget </th>
                                            <th>Active Date </th>
                                            <th>Active Agent</th>
                                            <th>No Connect Date</th>
                                            <th>No Connect Agent</th>
                                            <th>Follow Up Date </th>
                                            <th>Follow Up Agent</th>
                                            <th>Postponed Date</th>
                                            <th>Postponed Agent</th>
                                            <th>Proposal Sent Date </th>
                                            <th>Proposal Sent Agent</th>
                                            <th>Changes Date </th>
                                            <th>Changes Agent</th>
                                            <th>Hot Lead Date </th>
                                            <th>Hot Lead Agent</th>
                                            <th>Confirmed Date </th>
                                            <th>Confirmed Agent</th>
                                            <th>Cancelled Date</th>
                                            <th>Cancelled Agent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $g = 1;
                                        if ($LoginUserDetails['userType'] != 0 && $_REQUEST['statusid'] < 2) {
                                        } ?>
                                        <?php
                                        $where = ' where ' . $wheres . '  ';
                                        $limit = clean($_GET['records']);
                                        $page = clean($_GET['page']);
                                        $sNo = 1;
                                        $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&startDate=' . $_REQUEST['startDate'] . '&endDate=' . $_REQUEST['endDate'] . '&';
                                        $rs = GetRecordList('*', 'queryMaster', '   ' . $where . '  ', '25', $page, $targetpage);
                                        $totalentry = $rs[1];
                                        $paging = $rs[2];
                                        while ($rest = mysqli_fetch_array($rs[0])) {
                                            $b = GetPageRecord('*', 'userMaster', 'id="' . $rest['clientId'] . '"');
                                            $clientData = mysqli_fetch_array($b);
                                            $checkQuery = 1;
                                            $dates=GetPageRecord('*','queryLogs',' queryId="'.$rest['id'].'"');
                                            while ($lead_dates = mysqli_fetch_array($dates)){
                                                if ($lead_dates['details'] == 'Query Created' && $rest['id'] == $lead_dates['queryId']){
                                                    $lead_creation_date = $lead_dates['dateAdded'];
                                                    $lead_id = $lead_dates['queryId'];
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Active' && $rest['id'] == $lead_dates['queryId']){
                                                    $active_date = $lead_dates['dateAdded'];
                                                    $active_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $active_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Hot Lead' && $rest['id'] == $lead_dates['queryId']){
                                                    $hot_lead_date = $lead_dates['dateAdded'];
                                                    $hot_lead_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $hot_lead_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Proposal Sent' && $rest['id'] == $lead_dates['queryId']){
                                                    $proposal_send_date = $lead_dates['dateAdded'];
                                                    $proposal_send_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $proposal_send_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }

                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Follow Up' && $rest['id'] == $lead_dates['queryId']){
                                                    $follow_up_date = $lead_dates['dateAdded'];
                                                    $follow_up_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $follow_up_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Confirmed' && $rest['id'] == $lead_dates['queryId']){
                                                    $confirmed_date = $lead_dates['dateAdded'];
                                                    $confirmed_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $confirmed_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Cancelled' && $rest['id'] == $lead_dates['queryId']){
                                                    $canceled_date = $lead_dates['dateAdded'];
                                                    $canceled_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $cancel_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: No Connect' && $rest['id'] == $lead_dates['queryId']){
                                                    $no_connect_date = $lead_dates['dateAdded'];
                                                    $no_connect_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $no_connect_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Postponed' && $rest['id'] == $lead_dates['queryId']){
                                                    $postponed_date = $lead_dates['dateAdded'];
                                                    $postponed_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $postponed_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                                if ($lead_dates['details'] == 'Query Status Changed: Changes' && $rest['id'] == $lead_dates['queryId']){
                                                    $changes_date = $lead_dates['dateAdded'];
                                                    $changes_id = $lead_dates['queryId'];
                                                    $get_agent_name = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="' . $lead_dates['userId'] . '"');
                                                    $agent_names = mysqli_fetch_array($get_agent_name);
                                                    if ($lead_dates['userId'] != 0){
                                                        $changes_agent = $agent_names['firstName'] . ' ' . $agent_names['lastName'] ?? null;
                                                    }
                                                }
                                            }
                                            ?>

                                            <tr>
                                                <td width="14%" align="left" valign="top" style="padding-right:20px;">
                                                    <div style="font-size:15px; font-weight:500;line-height: 16px; margin-bottom:3px; font-weight:600;"><a style="color: blue !important;" href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>"><?php echo encode($rest['id']); ?></a></div>
                                                </td>
                                                <td align="left" valign="top"><?php echo getstatus($rest['statusId']); ?></td>
                                                <td align="left" valign="top" style="text-transform:uppercase;"><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
                                                <td align="left" valign="top"><?php echo stripslashes($clientData['mobile']); ?></td>
                                                <td align="left" valign="top"><?php echo stripslashes($clientData['email']); ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $lead_id){
                                                        echo date('d-m-Y', strtotime($lead_creation_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top" style="text-transform:uppercase;"><?php echo date('d-m-Y', strtotime($rest['updateDate'])); ?></td>
                                                <td align="left" valign="top" style="text-transform:uppercase;"><?php
                                                    $string = '';
                                                    $string = preg_replace('/\.$/', '', $rest['destinationId']);
                                                    $array = explode(',', $string);
                                                    foreach($array as $value)
                                                    { if ($value != 0){
                                                        echo  getCityName($value);
                                                    }else{
                                                        echo '-';
                                                    }  }?></td>
                                                <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['startDate'])) .  ' Till ' . date('d-m-Y', strtotime($rest['endDate'])); ?></td>
                                                <td align="left" valign="top"><div style="font-size:13px; line-height: 16px;"><?php echo $rest['adult']; ?> <span style="color:#686868; font-size:11px;">Adult</span> <?php echo $rest['child']; ?> <span style="color:#686868; font-size:11px;">Child</span> <?php echo $rest['infant']; ?> <span style="color:#686868; font-size:11px;">Infant</span></div></td>
                                                <td align="left" valign="top"><?php echo stripslashes($rest['day']); ?></td>
                                                <td align="left" valign="top"><?php echo stripslashes($rest['budgetId']); ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $active_id){
                                                        echo date('d-m-Y', strtotime($active_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($active_agent != ''){
                                                        echo $active_agent;
                                                        $active_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php  if ($rest['id'] == $no_connect_id){
                                                        echo date('d-m-Y', strtotime($no_connect_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($no_connect_agent != ''){
                                                        echo $no_connect_agent;
                                                        $no_connect_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $follow_up_id){
                                                        echo date('d-m-Y', strtotime($follow_up_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($follow_up_agent != ''){
                                                        echo $follow_up_agent;
                                                        $follow_up_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $postponed_id){
                                                        echo date('d-m-Y', strtotime($postponed_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($postponed_agent != ''){
                                                        echo $postponed_agent;
                                                        $postponed_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $proposal_send_id){
                                                        echo date('d-m-Y', strtotime($proposal_send_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($proposal_send_agent != ''){
                                                        echo $proposal_send_agent;
                                                        $proposal_send_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $changes_id){
                                                        echo date('d-m-Y', strtotime($changes_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($changes_agent != ''){
                                                        echo $changes_agent;
                                                        $changes_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $hot_lead_id){
                                                        echo date('d-m-Y', strtotime($hot_lead_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($hot_lead_agent != ''){
                                                        echo $hot_lead_agent;
                                                        $hot_lead_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $confirmed_id){
                                                        echo date('d-m-Y', strtotime($confirmed_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($confirmed_agent != ''){
                                                        echo $confirmed_agent;
                                                        $confirmed_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td align="left" valign="top"><?php if ($rest['id'] == $canceled_id){
                                                        echo date('d-m-Y', strtotime($canceled_date));
                                                    }else{
                                                        echo '-';
                                                    }?></td>
                                                <td align="left" valign="top"><?php if ($cancel_agent != ''){
                                                        echo $cancel_agent;
                                                        $cancel_agent = '';
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?></td>
                                            </tr>

                                            <?php  $totalno++; } ?>
                                        </tbody>
                                    </table>
                                    <?php if ($totalno == 1) { ?>
                                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Query</div>
                                    <?php } else { ?>
                                        <div class="mt-3 pageingouter">
                                            <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
                                            <div class="pagingnumbers"><?php echo $paging; ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--end col-->
                <!-- end row -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>	</div>
<script>
    $( function() {
        $( "#startDate" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $( "#endDate" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
    } );

    // function fnExcelReport()
    // {
    //     var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    //     var textRange; var j=0;
    //     tab = document.getElementById('headerTable'); // id of table

    //     for(j = 0 ; j < tab.rows.length ; j++)
    //     {
    //         tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
    //         //tab_text=tab_text+"</tr>";
    //     }

    //     tab_text=tab_text+"</table>";
    //     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    //     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    //     tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    //     var ua = window.navigator.userAgent;
    //     var msie = ua.indexOf("MSIE ");

    //     if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    //     {
    //         txtArea1.document.open("txt/html","replace");
    //         txtArea1.document.write(tab_text);
    //         txtArea1.document.close();
    //         txtArea1.focus();
    //         sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    //     }
    //     else                 //other browser not tested on IE 11
    //         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

    //     return (sa);
    // }
const totalPageCount = 6; // Total number of pages

function fetchDataForPage(pageNumber) {
    return fetch(`https://tripzygo.travel/crm/api/fetch_pagedata.php?page=${pageNumber}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        });
}

function fetchAllData() {
    const fetchPromises = [];
    for (let i = 1; i <= totalPageCount; i++) {
        fetchPromises.push(fetchDataForPage(i));
    }
    return Promise.all(fetchPromises);
}

function fnExcelReport() {
    var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
    
    // Get the table headings from the first page of data (assuming the headings are consistent across all pages)
    fetchDataForPage(1)
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                Object.keys(data[0]).forEach(key => {
                    tab_text += "<th>" + key + "</th>"; // Add table header row
                });
                tab_text += "</tr>";

                // Fetch all data and populate the table
                fetchAllData()
                    .then(dataArray => {
                        dataArray.forEach(data => {
                            if (Array.isArray(data)) {
                                data.forEach(item => {
                                    tab_text += "<tr>";
                                    Object.keys(item).forEach(key => {
                                        tab_text += "<td>" + (item[key] ? item[key] : '') + "</td>"; // Handle null or undefined values
                                    });
                                    tab_text += "</tr>";
                                });
                            }
                        });

                        tab_text += "</table>";

                        var blob = new Blob([tab_text], { type: 'application/vnd.ms-excel' });
                        var url = window.URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'download.xls';
                        a.click();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } else {
                console.error('Error: No data found.');
            }
        })
        .catch(error => {
            console.error('Error fetching table headings:', error);
        });
}



</script>


