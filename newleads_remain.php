<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';



 
    //$query1 = "SELECT count(assignTo)as Total_Leads,(SELECT firstName from sys_userMaster where id=queryMaster.assignTo)as user_name,(select name  from queryStatusMaster where id=queryMaster.statusId)as status from queryMaster where statusId=1 GROUP by assignTo;";
    $query1 ="SELECT COUNT(qm.assignTo) AS Total_Leads,
    COALESCE(su.firstName, 'Unknown') AS user_name,
    COALESCE(qsm.name, 'Unknown') AS status FROM
    queryMaster qm LEFT JOIN sys_userMaster su ON qm.assignTo = su.id
    LEFT JOIN queryStatusMaster qsm ON qm.statusId = qsm.id
    WHERE qm.statusId = 1
    GROUP BY qm.assignTo, su.firstName, qsm.name";
    
    $result1 = mysqli_query(db(), $query1);
    
    // Fetch all rows as an associative array
    $queries1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    
   
    
    $htmlTable .= "<table border='1'>";
    $htmlTable .= "<tr><th>Name</th><th>Total Leads</th></tr>";

    
    foreach ($queries1 as $query) {
        // if($query['user_name']!='Manish'){
            
        $htmlTable .= "<tr>";
        
        $htmlTable .= "<td>" . $query['user_name'] . "</td>";
        
        $htmlTable .= "<td>" . $query['Total_Leads'] . "</td>";
        

        $htmlTable .= "</tr>";
    //   }
    }
    
        $htmlTable .= "</table>";
        
        $ccmail ='Neerajvani@tripzygo.in,nitinrana@tripzygo.in,manishyadav@tripzygo.in';
        
       
        $to ='shubhamgiri@tripzygo.in';
        
       
        $subject = 'Existing Leads for Today';
        send_attachment_mail($fromemail, $to, $subject, $htmlTable,$ccmail,NULL);
        
        //echo "Email sent successfully!";

    ?>
    






