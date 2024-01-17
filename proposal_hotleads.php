<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';



 
   
    $query1 ="SELECT
   
    su.firstName AS username,
    COUNT(CASE WHEN qm.statusId = 8 AND DATE(qm.status_updateDate) >= CURDATE() - INTERVAL 3 DAY THEN qm.id END) AS total_proposal,
    COUNT(CASE WHEN qm.statusId = 4 THEN qm.id END) AS total_hot_leads
FROM
    queryMaster qm
LEFT JOIN
    sys_userMaster su ON qm.assignTo = su.id
WHERE
    (qm.statusId = 8 AND DATE(qm.status_updateDate) >= CURDATE() - INTERVAL 3 DAY)
    OR (qm.statusId = 4 AND DATE(qm.status_updateDate) >= CURDATE() - INTERVAL 3 DAY)
GROUP BY
    qm.assignTo, su.firstName;";
    
    $result1 = mysqli_query(db(), $query1);
    
    // Fetch all rows as an associative array
    $queries1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    
   
    
    $htmlTable .= "<table border='1'>";
    $htmlTable .= "<tr><th>Name</th><th>Total Hot Leads</th><th>Total Propsal Sent</th></tr>";

    
    foreach ($queries1 as $query) {
        // if($query['user_name']!='Manish'){
            
        $htmlTable .= "<tr>";
        
        $htmlTable .= "<td>" . $query['username'] . "</td>";
        
        $htmlTable .= "<td>" . $query['total_hot_leads'] . "</td>";
         $htmlTable .= "<td>" . $query['total_proposal'] . "</td>";
        

        $htmlTable .= "</tr>";
    //   }
    }
    
        $htmlTable .= "</table>";
        
        // $ccmail ='Neerajvani@tripzygo.in,nitinrana@tripzygo.in,manishyadav@tripzygo.in';
        
       
        $to ='sonamrai@travbox.in';
        
       
        $subject = 'Data of Total Propasal & Hot Leads';
        send_attachment_mail($fromemail, $to, $subject, $htmlTable,$ccmail,NULL);
        
        //echo "Email sent successfully!";

    ?>
    






