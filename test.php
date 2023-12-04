<?php
if ($_POST['action'] == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.callerdesk.io/api/addmember_V2?authcode=5f4d824d89e9063bc5085aefeae669c6&member_name='samir'&member_num=9724541005&access=2&active=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo json_encode($response);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="test.php" method="post">
    <button type="submit">Post</button>
    <input type="hidden" value="add" name="action">
</form>
</body>
</html>
