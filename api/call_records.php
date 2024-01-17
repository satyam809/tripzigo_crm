<?php
include "../config/database.php";
include "../config/function.php";
include "../config/setting.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');

$conn = db();

// Function to verify JWT
function verifyJWT($token, $secretKey)
{
    list($header, $payload, $signature) = explode('.', $token);
    $expectedSignature = base64_encode(hash_hmac('sha256', "$header.$payload", $secretKey, true));
    return hash_equals($signature, $expectedSignature);
}

// Check if the API endpoint is called
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the token from the authorization header
    //$token = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null;
    $headers = apache_request_headers();
    $token = isset($headers['Authorization']) ? trim(str_replace('Bearer', '', $headers['Authorization'])) : null; // added by satyam

    // Check if the token is present and valid
    if ($token && verifyJWT($token, 'your_secret_key')) {
        // Token is valid, proceed with processing the request

        // Assuming you receive JSON data
        $inputData = json_decode(file_get_contents("php://input"), true);

        // Validate and sanitize the input data as needed

        // Insert call records into the database
        foreach ($inputData as $callRecord) {
            $phoneNumber = $callRecord['phoneNumber'];
            $callType = $callRecord['callType'];
            $callDate = date('Y-m-d H:i:s', strtotime($callRecord['callDate']));
            $callDuration = $callRecord['callDuration'];
            $userPhoneNumber = $callRecord['userPhoneNumber'];

            $sql = "INSERT INTO callrecords (phoneNumber, callType, callDate, callDuration, userPhoneNumber) 
                    VALUES ('$phoneNumber', '$callType', '$callDate', '$callDuration', '$userPhoneNumber')";

            // Execute the query
            if ($conn->query($sql) !== TRUE) {
                // Respond with an error, or log the error as needed
                continue; // Continue to the next iteration if an error occurs
            }
        }

        // Respond with success
        $response = array("status" => "success", "message" => "Call records added successfully");
        echo json_encode($response);
    } else {
        // Unauthorized: Invalid token
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
    }
} else {
    // Respond with an error for unsupported request method
    $response = array("status" => "error", "message" => "Unsupported request method");
    echo json_encode($response);
}

// Close the database connection
$conn->close();
