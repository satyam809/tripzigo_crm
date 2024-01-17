<?php
include '../config/database.php';
$conn = db();
header('Content-Type: application/json');

// DataTables request parameters
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;

//session_start();
$_SESSION['startDate'] = isset($_GET['startDate']) ? date('Y-m-d', strtotime($_GET['startDate'])) : '';
$_SESSION['endDate'] = isset($_GET['endDate']) ? date('Y-m-d', strtotime($_GET['endDate'])) : '';
$_SESSION['query_cancel'] = isset($_GET['query_cancel']) ? $_GET['query_cancel'] : '';

$queryCancel = isset($_GET['query_cancel']) ? $_GET['query_cancel'] : '';
$sql = "";
$countSql = "";

// Check if the start and end dates are provided and not empty
if (isset($_GET['startDate']) && isset($_GET['endDate']) && !empty($_GET['startDate']) && !empty($_GET['endDate']) && $queryCancel != '') {
    $startDate = date('Y-m-d', strtotime($_GET['startDate']));
    $endDate = date('Y-m-d', strtotime($_GET['endDate']));

    // Construct SQL query with date ranges
    $sql = "SELECT queryMaster.*, sys_userMaster.firstName, sys_userMaster.lastName 
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id 
            WHERE queryMaster.query_cancel = '{$queryCancel}'
            AND queryMaster.updateDate BETWEEN '{$startDate}' AND '{$endDate}'";

    $countSql = "SELECT COUNT(*) as count
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id 
            WHERE queryMaster.query_cancel = '{$queryCancel}'
            AND queryMaster.updateDate BETWEEN '{$startDate}' AND '{$endDate}'";
} else {
    // Fetch all data if no date ranges are provided
    $sql = "SELECT queryMaster.*, sys_userMaster.firstName, sys_userMaster.lastName 
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id";

    $countSql = "SELECT COUNT(*) as count
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id";
}

// Apply LIMIT and OFFSET for pagination
$sql .= " order by queryMaster.id DESC LIMIT {$start}, {$length}";

// Execute the main query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the data into an associative array
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free the result set
    mysqli_free_result($result);

    // Get total records count without filtering
    $totalRecords = mysqli_query($conn, "SELECT COUNT(*) as count FROM queryMaster")->fetch_assoc()['count'];
    $recordsFiltered = mysqli_query($conn, $countSql)->fetch_assoc()['count'];

    // Prepare the response as expected by DataTables
    $response = array(
        "draw" => $draw,
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $recordsFiltered,  // Total records with filtering (same as recordsTotal in this case)
        "data" => $data  // Data to be displayed
    );

    // Return the response as JSON
    echo json_encode($response);
} else {
    // Handle errors if the query fails
    echo json_encode(['error' => mysqli_error($conn)]);
}
