<?php
include "inc.php";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$respArr = [];
$siIndex = $_POST['si_indx'];
$altText = $_POST['altText'];

$upload_target = 'package_image/';

$a = GetPageRecord('sliderPhoto'.$siIndex, 'sys_packageBuilder', 'id="' . $_POST['itnryId'] . '"');
$result = mysqli_fetch_array($a);
$savedImage = $result[0];

if(empty($altText)){
    $respArr = [
        'status' => false,
        'msg' => 'Please Enter Alt Text',
        'savedImg' => $savedImage
    ];

    echo json_encode($respArr);
    die;
}

if(is_array($_FILES['file']) && (count($_FILES['file']) > 0) && ($_FILES['file']['error'] <= 0)){
    $imageFileType = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
    //$allowedImageFileTypeArr = ['jpg','png','jpeg'];
    
    $allowedImageFileTypeArr = ['jpg', 'png', 'jpeg', 'webp'];
    if(!in_array($imageFileType,$allowedImageFileTypeArr)) {
        $respArr = [
            'status' => false,
            'msg' => 'Sorry, only JPG, JPEG, PNG files are allowed.',
            'savedImg' => $savedImage
        ];
    }
    else {
        $fileName = generateRandomString(12).strtotime('Now').'.'.$imageFileType;
        if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_target . $fileName)){

            if(isset($savedImage) && !empty($savedImage)) {
                unlink($upload_target . $savedImage);
            }

            $namevalue ='sliderPhoto'.$siIndex.' = "'.$fileName.'",imgAlt'.$siIndex.' = "'.$altText.'"';
            $where='id='.$_POST['itnryId'];
            $update = updatelisting('sys_packageBuilder',$namevalue,$where);

            if($update == 'yes') {
                $respArr = [
                    'status' => true,
                    'msg' => ''
                ];
            }
            else{
                $respArr = [
                    'status' => false,
                    'msg' => 'Something went wrong!',
                    'savedImg' => $savedImage
                ];
            }
        }
        else{
            $respArr = [
                'status' => false,
                'msg' => 'Something went wrong!',
                'savedImg' => $savedImage
            ];
        }
    }

    echo json_encode($respArr);
    die;
}


?>