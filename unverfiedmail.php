<?php

include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';

// for counter unverfied and scheduled
 $query2="SELECT
    SUM(CASE WHEN paymentStatus = 1 AND payment_verified IS NULL  and  paymentDate > '2023-11-01 00:00:00' THEN 1 ELSE 0 END) AS paid,
    SUM(CASE WHEN paymentStatus = 2 AND paymentDate > '2023-11-01 00:00:00' THEN 1 ELSE 0 END) AS scheduled,
     SUM(CASE WHEN paymentStatus = 1 AND payment_verified IS NULL  and  paymentDate > '2023-11-01 00:00:00' THEN amount ELSE 0 END) AS totalAmount FROM sys_PackagePayment";
    $result_data = mysqli_query(db(), $query2);
    $row_data = mysqli_fetch_assoc($result_data);

 
    $query1 = "SELECT * FROM sys_PackagePayment WHERE paymentStatus=1  and  payment_verified IS NULL   AND paymentDate >= '2023-11-01 00:00:00' ORDER BY paymentDate DESC";
    
    $result1 = mysqli_query(db(), $query1);
    
    // Fetch all rows as an associative array
    $queries1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    
   
    
    // Create HTML table
    //  $htmlTable = "<p><strong>Total Unverified:</strong> " . ($row_data['paid'] + $row_data['scheduled']) . "</p>";
     $htmlTable = "<p><strong>Total Unverified:</strong> " . ($row_data['paid'] ). "</p>";
     $htmlTable .= "<p><strong>Total AMount:</strong> " . ($row_data['totalAmount'] ). "</p>";
    // $htmlTable .= "<p><strong>Paid:</strong> " . $row_data['paid'] . "</p>";
    // $htmlTable .= "<p><strong>Scheduled:</strong> " . $row_data['scheduled'] . "</p>";
    $htmlTable .= "<table border='1'>";
    $htmlTable .= "<tr><th>Payment Id</th><th>Amount</th><th>Payment Date</th><th>Status</th></tr>";

    
    foreach ($queries1 as $query) {
        $htmlTable .= "<tr>";
        $htmlTable .= "<td>" . encode($query['id']) . "</td>";
        $htmlTable .= "<td>" . $query['amount'] . "</td>";
        $htmlTable .= "<td>" . $query['paymentDate'] . "</td>";
        if ($query['paymentStatus'] == 1) {
            $htmlTable .= "<td>Paid</td>";
        } elseif ($query['paymentStatus'] == 2) {
            $htmlTable .= "<td>Scheduled</td>";
        }

        $htmlTable .= "</tr>";
    }
    
        $htmlTable .= "</table>";
        
        $ccmail ='Neerajvani@tripzygo.in,nitinrana@tripzygo.in,manishyadav@tripzygo.in';
        
        //$ccmail = 'satyam@travbox.in, roysona693@gmail.com';
        
       
        $to ='accounts@tripzygo.in';
        $subject = 'Unverfied Payment';
        send_attachment_mail($fromemail, $to, $subject, $htmlTable,$ccmail,NULL);
        
        //echo "Email sent successfully!";

    ?>
    






