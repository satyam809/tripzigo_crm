<?php
include '../config/database.php';
header('Content-Type: application/json');

if (isset($_GET['attandancedays'])) {
    $conn = db();
    if (!$conn) {
        echo json_encode(['error' => 'Database connection error: ' . mysqli_connect_error()]);
        exit();
    }

    $userCondition = isset($_GET['user_id']) && $_GET['user_id'] != '' ? " AND id = '" . mysqli_real_escape_string($conn, $_GET['user_id']) . "'" : '';

    $sql = "SELECT id, firstName, lastName FROM sys_userMaster WHERE status = 1 $userCondition";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(['error' => 'Error executing query: ' . mysqli_error($conn)]);
        exit();
    }

    $data = [];
    $attandancedays = $_GET['attandancedays'];
    $day = ($attandancedays == 1) ? 0 : (($attandancedays == 2) ? 7 : (($attandancedays == 3) ? getThisMonthTotalDays() : getLastMonthsTotalDays()));

    $searchDates = [];
    if ($day == 0) {
        $searchDates[] = date('Y-m-d');
    } else {
        for ($i = 1; $i <= $day; $i++) {
            $searchDates[] = date('Y-m-d', strtotime("-$i days"));
        }
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $userId = $row['id'];
        foreach ($searchDates as $date) {
            $userLogsQuery = mysqli_query($conn, "SELECT * FROM userLogs WHERE userid = '$userId' AND DATE(cLogin) = '$date'");
            $userLogs = [];
            while ($logRow = mysqli_fetch_assoc($userLogsQuery)) {
                $userLogs[] = $logRow;
            }
            if (count($userLogs) > 0) {
                $loginTimestamps = array_map(function ($log) {
                    return strtotime($log['cLogin']);
                }, $userLogs);
                // Find the minimum 'cLogin' timestamp
                $minLoginTimestamp = min($loginTimestamps);

                $start_time = $minLoginTimestamp;
                $end_time = strtotime(empty($userLogs[0]['checkoutTime']) ? date('Y-m-d H:i:s') : $userLogs[0]['checkoutTime']);
                //echo $end_time;die;
                // Set 9 PM as the cutoff time
                $cuttoff_time = strtotime(date('Y-m-d 21:00:00'));

                // If the end time is after 9 PM, limit it to 9 PM
                if ($end_time > $cuttoff_time) {
                    $end_time = $cuttoff_time;
                }

                // Calculate the total login time within the limit of 9 PM
                $totalLoginTime = $end_time - $start_time;
                $sqlBreak = "SELECT SUM(minutes) AS totalBreakMinutes FROM useractivities WHERE activity_type = 1 AND user_id = '$userId' AND add_date = '$date'";
                $breakResult = mysqli_query($conn, $sqlBreak);
                $totalBreakMinutes = 0;

                if ($breakResult) {
                    $breakRow = mysqli_fetch_assoc($breakResult);
                    $totalBreakMinutes = $breakRow['totalBreakMinutes'];
                }

                $totalWorkingMinutes = round(($totalLoginTime / 60) - $totalBreakMinutes, 2);

                $userData = [
                    'id' => $userId,
                    'firstName' => $row['firstName'],
                    'lastName' => $row['lastName'],
                    'totalWorkingMinutes' => $totalWorkingMinutes,
                    'totalBreakMinutes' => $totalBreakMinutes,
                    'userLogs' => $userLogs
                ];

                $data[$date][] = $userData;
            }
        }
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Attendance days not specified']);
}

function getThisMonthTotalDays()
{
    $currentMonth = date('m');
    $currentYear = date('Y');
    return cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
}

function getLastMonthsTotalDays()
{
    $lastMonth = date('m') - 1;
    $lastMonthYear = date('Y');

    if ($lastMonth == 0) {
        $lastMonth = 12;
        $lastMonthYear--;
    }

    return cal_days_in_month(CAL_GREGORIAN, $lastMonth, $lastMonthYear);
}
