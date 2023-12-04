<?php
//session_start(); // Start the session if not started

include 'config/database.php';

if (!empty($_POST['activity']) && $_POST['activity'] == 'start') {
    $add_date = date('Y-m-d');
    $user_id = $_SESSION['userid'];
    $activityType = mysqli_real_escape_string(db(), $_POST['activityType']);

    $insertSql = "INSERT INTO useractivities (user_id, add_date, start_time, activity_type) VALUES ('$user_id', '$add_date', CURTIME(), '$activityType')";

    $result = mysqli_query(db(), $insertSql);

    if ($result) {
        $lastInsertedId = mysqli_insert_id(db()); // Get the last inserted ID
        $selectSql = "SELECT * FROM useractivities WHERE id = $lastInsertedId"; // Assuming 'id' is the primary key/auto-incremented column
        $selectResult = mysqli_query(db(), $selectSql);

        if ($selectResult && mysqli_num_rows($selectResult) > 0) {
            $insertedData = mysqli_fetch_assoc($selectResult);
            echo json_encode(['status' => true, 'message' => 'Break Time Inserted', 'data' => $insertedData]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Error retrieving inserted data']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => mysqli_error(db())]);
    }
}

if (!empty($_POST['activity']) && $_POST['activity'] == 'stop') {
    $user_id = $_SESSION['userid'];
    $add_date = date('Y-m-d');
    $activityType = mysqli_real_escape_string(db(), $_POST['activityType']);
    $insertedId = mysqli_real_escape_string(db(), $_POST['insertedId']);

    $total_min = calculate_total_min($user_id, $insertedId, $add_date, $activityType);

    $updateSql = "UPDATE useractivities SET minutes = '$total_min', end_time = CURTIME() WHERE user_id = '$user_id' AND id = '$insertedId' AND add_date = '$add_date' AND activity_type = '$activityType'";

    $result = mysqli_query(db(), $updateSql);

    if ($result) {
        // Retrieve updated data from the database
        $selectUpdatedDataSql = "SELECT * FROM useractivities WHERE id = '$insertedId'";
        $updatedDataResult = mysqli_query(db(), $selectUpdatedDataSql);

        if ($updatedDataResult && mysqli_num_rows($updatedDataResult) > 0) {
            $updatedData = mysqli_fetch_assoc($updatedDataResult);
            echo json_encode(['status' => true, 'message' => 'Break Time Updated', 'data' => $updatedData]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Error retrieving updated data']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => mysqli_error(db())]);
    }
}

if (!empty($_POST['working_hour']) && $_POST['working_hour'] == 1) {
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        $userId = mysqli_real_escape_string(db(), $_SESSION['userid']);

        // Calculate total login minutes for the user
        $sql = "SELECT totalMinutes 
                FROM userLogs 
                WHERE checkoutTime IS NOT NULL 
                AND userId = '$userId' 
                AND DATE(cLogin) = DATE(NOW())";

        $result = mysqli_query(db(), $sql) or die(mysqli_error(db()));
        $row = mysqli_fetch_assoc($result);
        $totalLoginMinutes = $row['totalMinutes'];
        //print_r($row['totalMinutes']);die;
        // Calculate total break minutes for the user for the current date
        $add_date = date('Y-m-d');
        $add_date = mysqli_real_escape_string(db(), $add_date);

        $sql2 = "SELECT SUM(minutes) AS totalBreakMinutes 
                 FROM userActivities 
                 WHERE activity_type = 1 AND user_id = '$userId' 
                 AND add_date = '$add_date'";

        $result2 = mysqli_query(db(), $sql2);

        if ($result2) {
            $row2 = mysqli_fetch_assoc($result2);
            $totalBreakMinutes = $row2['totalBreakMinutes'];

            // Calculate total working minutes by subtracting break minutes from login minutes
            $totalWorkingMinutes = $totalLoginMinutes - $totalBreakMinutes;
            echo json_encode(['status' => true, 'data' => $totalWorkingMinutes]);
        } else {
            echo json_encode(['status' => false, 'Error' => "Error executing query: " . mysqli_error(db())]);
        }
    }
}

function calculate_total_min($user_id, $insertedId, $add_date, $activityType)
{
    // Retrieve the start time from the database
    $getSql = "SELECT start_time FROM useractivities WHERE user_id = '$user_id' AND id = '$insertedId' AND add_date = '$add_date' AND activity_type = '$activityType'";
    $start_time_result = mysqli_query(db(), $getSql);

    if ($start_time_result && mysqli_num_rows($start_time_result) > 0) {
        $row = mysqli_fetch_assoc($start_time_result);
        $start_time = $row['start_time'];

        // Calculate total minutes
        $start = strtotime($start_time);
        $end = strtotime(date('H:i:s'));
        $difference_in_seconds = $end - $start;
        $total_minutes = $difference_in_seconds / 60;

        return $total_minutes;
    } else {
        return 0; // Return 0 if start time not found or query fails
    }
}
