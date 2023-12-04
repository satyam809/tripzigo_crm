<?php  
include "config/database.php"; 
include "config/function.php";  
include "config/setting.php";  



if(isset($_POST['username']) && $_POST['username']!='' && $_POST['userpass']!=''){   
    //print_r($_POST); exit;
    $username = clean($_POST['username']); 
    $password = clean($_POST['userpass']); 
    $select = 'email,password,mobile';
    $where = "email='" . $username . "' and  password='" . md5($password) . "'";
    $rs = GetPageRecord($select, 'sys_userMaster', $where);
    //print_r($rs);
    $result =[];
    $data = mysqli_fetch_array($rs);
    if($data)
    {
        $result['data']=$data;
        $result['status']=true;
    }
    else
    {
        $result['data']='';
        $result['status']=false;
    }
    echo json_encode($result);
   

}



    

?>