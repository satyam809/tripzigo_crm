<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
include "inc.php";  

mysqli_set_charset(db(), "utf8");
$keyword  = $_REQUEST['keyword'];

function GetPageRecord2($select, $tablename, $where)
{
   $sql = "select " . $select . " from " . $tablename . " where " . $where . "";
   //echo $sql; 
   $rs = mysqli_query(db(), $sql) or die(mysqli_error());
   return $rs;
}

if($keyword !='')
{

$rs=GetPageRecord2('userMaster.company,
    userMaster.submitName,
    userMaster.firstName,
    userMaster.lastName,
    userMaster.email,
    userMaster.mobile,
    userMaster.mobileCode,
    (SELECT name FROM cityMaster WHERE id = userMaster.city) AS cityname,
    (SELECT name FROM countryMaster WHERE id = userMaster.country) AS countryname,
    userMaster.addedBy,
    userMaster.dateAdded,
    userMaster.id','userMaster','
    userMaster.userType = 5
    AND (
        userMaster.firstName LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.lastName LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.email LIKE "%'.$_REQUEST['keyword'].'%" 
        OR userMaster.mobile LIKE "%'.$_REQUEST['keyword'].'%" 
        OR (SELECT name FROM cityMaster WHERE id = userMaster.city) LIKE "%'.$_REQUEST['keyword'].'%" 
        OR (SELECT name FROM countryMaster WHERE id = userMaster.country) LIKE "%'.$_REQUEST['keyword'].'%" 
    )order by id desc');

}
else
{
    $rs=GetPageRecord2('*','userMaster',' userType=5 and email!="" and (firstName like "%'.$keyword.'%" or  email like "%'.$keyword.'%" or  mobile like "%'.$keyword.'%") order by company asc limit 0,100');

}



$i=0;
$result = [];
while($rest=mysqli_fetch_array($rs)){ 
  
   
    $result['data'][$i] = $rest;
   

$i++;

}

//echo "<pre>"; print_r($result);
echo json_encode($result);


 
?>

 