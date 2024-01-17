<?php //print_r($_SESSION);die;
?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
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

    #attandance_wrapper {
        font-size: 14px !important;
    }

    .loader {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-top: 4px solid #333;
        /* Change the color of the loader */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        /* Animation name, duration, timing, and iteration count */
        margin: 25% auto;
        /* Center the loader */
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
            /* Starting rotation */
        }

        100% {
            transform: rotate(360deg);
            /* Ending rotation */
        }
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
                            <div class="card-body" style="padding:0px;font-size:14px !important">

                                <div style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">

                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">


                                        <div class="col-md-3 col-xl-3">
                                            <form onsubmit="attandanceSearch(event)">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td><select name="attandancedays" class="form-control" style="width:220px;">
                                                                    <option value="1" selected="selected">
                                                                        Today's Attandance
                                                                    </option>
                                                                    <option value="2">
                                                                        Last 7 Days Attandance
                                                                    </option>
                                                                    <option value="3">
                                                                        This Month Attandance
                                                                    </option>
                                                                    <option value="4">
                                                                        Last Month Attandance
                                                                    </option>
                                                                </select></td>
                                                            <?php if ($_SESSION['userid'] == 1 || $_SESSION['userid'] == 4060) { ?>
                                                                <td style="padding-left:5px;"><select name="searchusers" class="form-control" style="width:180px;">
                                                                        <option value="">All Users</option>
                                                                        <?php
                                                                        $sql = 'SELECT id,firstName,lastName FROM sys_userMaster where status=1';
                                                                        $result = mysqli_query(db(), $sql) or die(mysqli_error(db()));
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            echo '<option value="' . $row['id'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select></td>
                                                            <?php } ?>
                                                            <td style="padding-left:5px;">
                                                                <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"><i class="fa fa-search" aria-hidden="true"></i>
                                                                    Search
                                                                </button>
                                                            </td>

                                                            <!-- <td style="padding-left:5px;"><a href="display.html?ga=attandancesreport">
                                                                    <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;">Reset
                                                                    </button>
                                                                </a></td>
                                                            <td>&nbsp;</td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="loader"></div>
                                <div id="attandance_report">
                                </div>
                                <!-- <h4 class="card-title" style=" padding:20px 0px; float:left; width:100%; margin-top:0px;" id="showAttandanceReport">Today's Attandance Report</h4>
                                <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0" id="attandance">
                                    <thead>
                                        <tr>
                                            <th colspan="7" align="left" bgcolor="#F5F5F5"><?php echo date('l, j F Y'); ?></th>
                                        </tr>
                                        <tr>
                                            <th width="2%">
                                                <div align="center">Sr.No</div>
                                            </th>
                                            <th width="20%"><strong>Name</strong></th>
                                            <th width="12%">
                                                <div align="center">First&nbsp;Login&nbsp;Time</div>
                                            </th>
                                            <th width="12%">
                                                <div align="center">Sessions</div>
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
                                </table> -->





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
    let session_user_id = "<?php echo $_SESSION['userid']; ?>";
    console.log(session_user_id);

    function showAttandanceReport() {
        let user_id;
        let url;
        if (session_user_id == 1 || session_user_id == 4060) {
            url = `report/attandance.php?attandancedays=1`;
        } else {
            user_id = session_user_id;
            url = `report/attandance.php?attandancedays=1&user_id=${user_id}`;
        }
        $.ajax({
            url: `${url}`,
            method: "GET",
            dataType: "json",
            success: function(data) {
                //console.log(data);
                $(".loader").css("display", "none");
                let html = ``;

                for (let key in data) {
                    if (data.hasOwnProperty(key)) {
                        let dateby = readAbleDateFormate(key);
                        html += `<table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0" id="attandance">
                        <thead>
                            <tr>
                                <th colspan="7" align="left" bgcolor="#F5F5F5">${dateby}</th>
                            </tr>
                            <tr>
                                <th width="2%">
                                    <div align="center">Sr.No</div>
                                </th>
                                <th width="20%"><div align="center">Name</div></th>
                                <th width="12%">
                                    <div align="center">First&nbsp;Login&nbsp;Time</div>
                                </th>
                                <th width="12%">
                                    <div align="center">Logout&nbsp;Time</div>
                                </th>
                                <th width="12%">
                                    <div align="center">Sessions</div>
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
                        <tbody>`;

                        for (let i = 0; i < data[key].length; i++) {
                            let firstLogin = '';
                            let logoutTime = '';
                            let breakTime = convertMinutesToHoursAndMinutes(data[key][i].totalBreakMinutes);
                            let workingTime = '';
                            if (data[key][i].userLogs.length > 0) {
                                let loginTimestamps = data[key][i].userLogs.map(log => new Date(log.cLogin).getTime());
                                let minLoginTime = new Date(Math.min(...loginTimestamps));

                                //console.log(minLoginTime);

                                firstLogin = formatTimeToAMPM(minLoginTime);

                                if (data[key][i].userLogs[0].checkoutTime != null) {
                                    logoutTime = formatTimeToAMPM(new Date(data[key][i].userLogs[0].checkoutTime));
                                    let workingTime = convertMinutesToHoursAndMinutes(data[key][i].totalWorkingMinutes);
                                }
                            }
                            html += `<tr>
                            <td><div align="center">${i + 1}</div></td>
                            <td><div align="center">${data[key][i].firstName} ${data[key][i].lastName}</div></td>
                            <td><div align="center">${firstLogin}</div></td>
                            <td><div align="center">${logoutTime}</div></td>
                            <td><div align="center">${data[key][i].userLogs.length > 0 ? data[key][i].userLogs.length : 0}</div></td>
                            <td>${firstLogin != '' ? '<div align="center"><span class="badge badge-success">Present</span></div>' : '<div align="center"><span class="badge badge-danger">Absent</span></div>'}</td>
                            <td><div align="center">${breakTime}</div></td>
                            <td><div align="center">${workingTime}</div></td>
                        </tr>`;
                        }
                        html += `</tbody></table>`;
                    }
                }
                $("#attandance_report").append(html);
            }
        });
    }

    showAttandanceReport();

    function attandanceSearch(event) {
        event.preventDefault();
        $("#attandance_report").empty();
        $(".loader").css("display", "block");
        let user_id;
        let url;
        let attandancedays = event.target.attandancedays.value;
        let searchusers;
        if (session_user_id == 1 || session_user_id == 4060) {
            searchusers = event.target.searchusers.value;
            url = `report/attandance.php?attandancedays=${attandancedays}&user_id=${searchusers}`;
        } else {
            user_id = session_user_id;
            url = `report/attandance.php?attandancedays=${attandancedays}&user_id=${user_id}`;
        }
        $.ajax({
            url: `${url}`,
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                $(".loader").css("display", "none");
                let html = ``;
                for (let key in data) {
                    if (data.hasOwnProperty(key)) {
                        let dateby = readAbleDateFormate(key);
                        html += `<table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0" id="attandance">
                        <thead>
                            <tr>
                                <th colspan="7" align="left" bgcolor="#F5F5F5">${dateby}</th>
                            </tr>
                            <tr>
                                <th width="2%">
                                    <div align="center">Sr.No</div>
                                </th>
                                <th width="20%"><div align="center">Name</div></th>
                                <th width="12%">
                                    <div align="center">First&nbsp;Login&nbsp;Time</div>
                                </th>
                                <th width="12%">
                                    <div align="center">Logout&nbsp;Time</div>
                                </th>
                                <th width="12%">
                                    <div align="center">Sessions</div>
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
                        <tbody>`;

                        for (let i = 0; i < data[key].length; i++) {
                            let firstLogin = '';
                            let logoutTime = '';
                            let breakTime = convertMinutesToHoursAndMinutes(data[key][i].totalBreakMinutes);
                            let workingTime = '';

                            if (data[key][i].userLogs.length > 0) {
                                let loginTimestamps = data[key][i].userLogs.map(log => new Date(log.cLogin).getTime());
                                let minLoginTime = new Date(Math.min(...loginTimestamps));

                                //console.log(minLoginTime);

                                firstLogin = formatTimeToAMPM(minLoginTime);

                                if (data[key][i].userLogs[0].checkoutTime != null) {
                                    logoutTime = formatTimeToAMPM(new Date(data[key][i].userLogs[0].checkoutTime));
                                    workingTime = convertMinutesToHoursAndMinutes(data[key][i].totalWorkingMinutes);
                                }
                            }
                            html += `<tr>
                            <td><div align="center">${i + 1}</div></td>
                            <td><div align="center">${data[key][i].firstName} ${data[key][i].lastName}</div></td>
                            <td><div align="center">${firstLogin}</div></td>
                            <td><div align="center">${logoutTime}</div></td>
                            <td><div align="center">${data[key][i].userLogs.length > 0 ? data[key][i].userLogs.length : 0}</div></td>
                            <td>
                            ${logoutTime != '' ? '<div align="center"><span class="badge badge-success">Present</span></div>' : '<div align="center"><span class="badge badge-danger">Absent</span></div>'}
                            </td>
                            <td><div align="center">${breakTime}</div></td>
                            <td><div align="center">${workingTime}</div></td>
                        </tr>`;
                        }
                        html += `</tbody></table>`;
                    }
                }
                //$(".loader").remove();
                $("#attandance_report").append(html);
            }
        });

    }

    function formatTimeToAMPM(dateTimeString) {
        const dateTime = new Date(dateTimeString);

        let hours = dateTime.getHours();
        let minutes = dateTime.getMinutes();

        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12;

        minutes = minutes < 10 ? '0' + minutes : minutes;

        const formattedTime = hours + ':' + minutes + ' ' + ampm;

        return formattedTime;
    }

    function convertMinutesToHoursAndMinutes(minutes) {
        if (minutes === 0) return "00:00";

        var hours = Math.floor(minutes / 60);
        var remainingMinutes = Math.floor(minutes % 60);

        var formattedHours = hours < 10 ? "0" + hours : hours;
        var formattedMinutes = remainingMinutes < 10 ? "0" + remainingMinutes : remainingMinutes;

        return formattedHours + ":" + formattedMinutes;
    }

    function readAbleDateFormate(inputDateString) {
        const date = new Date(inputDateString);

        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
        return formattedDate;
    }
</script>