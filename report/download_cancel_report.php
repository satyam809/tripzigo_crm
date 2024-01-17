<?php
include '../config/database.php';
$conn = db();
header('Content-Type: application/json');

$sql = "";

// Check if the start and end dates are provided and not empty
if ($_SESSION['startDate'] != '' && $_SESSION['endDate'] != '' && $_SESSION['query_cancel'] != '') {

    // Construct SQL query with date ranges
    $sql = "SELECT queryMaster.*, sys_userMaster.firstName, sys_userMaster.lastName 
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id 
            WHERE queryMaster.query_cancel = '{$_SESSION['query_cancel']}'
            AND queryMaster.updateDate BETWEEN '{$_SESSION['startDate']}' AND '{$_SESSION['endDate']}' order by queryMaster.id DESC";
            //echo $sql; die;
} else {
    // Fetch all data if no date ranges are provided
    $sql = "SELECT queryMaster.*, sys_userMaster.firstName, sys_userMaster.lastName 
            FROM queryMaster 
            INNER JOIN sys_userMaster ON queryMaster.assignTo = sys_userMaster.id order by queryMaster.id DESC";
}

// Execute the main query
$result = $conn->query($sql);

// Create Excel file
if ($result->num_rows > 0) {
    // Initialize Excel content
    $output = '';
    $output .= "QueryId, Agent Name, Cancel Reason\n"; // Add headers

    while ($row = $result->fetch_assoc()) {
        // Add data rows
        $output .= $row["id"] . "," . $row["firstName"]." " . $row["lastName"] . "," . $row["query_cancel"] . "\n";
        // Add more columns as needed
    }

    // Set headers for download
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="data.csv"');

    // Output the Excel file
    echo $output;
} else {
    echo "0 results";
}

$conn->close();
