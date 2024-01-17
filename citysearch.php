<?php
// Assuming $conn is your database connection
include 'inc.php';


if (isset($_POST['searchTerm'])) {
        $searchTerm = $_POST['searchTerm'];
    if (strlen($searchTerm) >= 3) {
        $conn = db();
        
        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT id as cityId, name as cityName FROM cityMaster WHERE name LIKE ?;";
        $stmt = $conn->prepare($sql);
        
        // Add a wildcard '%' to search for partial matches
        $searchTerm = $searchTerm . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        
        $result = $stmt->get_result();
    
        // Process the result
        $cityNames = array();
    
        while ($row = $result->fetch_assoc()) {
            // Collect city names in an array
            $cityNames[] = $row;
        }
    
        // Output JSON-encoded array
        echo json_encode($cityNames);
    
        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    }

?>

