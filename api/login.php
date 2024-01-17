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
// jwt_auth_mysqli.php

function generateJWT($payload, $secretKey)
{
    $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64_encode(json_encode($payload));
    $signature = base64_encode(hash_hmac('sha256', "$header.$payload", $secretKey, true));
    return "$header.$payload.$signature";
}

// function verifyJWT($token, $secretKey)
// {
//     list($header, $payload, $signature) = explode('.', $token);
//     $expectedSignature = base64_encode(hash_hmac('sha256', "$header.$payload", $secretKey, true));
//     return hash_equals($signature, $expectedSignature);
// }

$user = null;

try {
    // Connect to the database using mysqli
    //$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"));

        $inputUsername = $data->username;
        $inputPassword = $data->password;
        // Handle the login request
        // $inputUsername = $_POST['username'];
        // $inputPassword = $_POST['password'];
        // echo $_POST['username']; exit;
        // Sanitize input data if needed
        $inputUsername = $conn->real_escape_string($inputUsername);

        // Retrieve user data from the database based on the username
        $query = "SELECT id, email, password FROM  sys_userMaster WHERE email = '$inputUsername'";
        //echo $query; exit;
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (md5($inputPassword) == $user['password']) {
                // Password is correct
                $jwt = generateJWT(['id' => $user['id'], 'username' => $user['email']], 'your_secret_key');
                echo json_encode(['token' => $jwt, 'message' => 'Login Successfully', 'status' => true]);
            } else {
                // Invalid credentials
                http_response_code(401);
                echo json_encode(['error' => 'Invalid credentials']);
            }
        } else {
            // User not found
            http_response_code(401);
            echo json_encode(['error' => 'User not found']);
        }
    } 
    // elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //     // Handle the protected route request
    //     //print_r($_SERVER); 
    //     // Handle the protected route request
    //     $token = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] : (isset($_SERVER['REDIRECT_REMOTE_USER']) ? $_SERVER['REDIRECT_REMOTE_USER'] : null));

    //     if ($token && verifyJWT($token, 'your_secret_key')) {
    //         $decoded = json_decode(base64_decode(explode('.', $token)[1]));
    //         echo json_encode(['message' => 'Protected route accessed', 'user' => $decoded]);
    //     } else {
    //         // Unauthorized: Invalid token
    //         http_response_code(401);
    //         echo json_encode(['error' => 'Unauthorized']);
    //     }
    // }
} finally {
    // Close the database connection
    $conn->close();
}
