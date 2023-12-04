<?php
include "inc.php";
include "config/mail.php";

date_default_timezone_set('Asia/Calcutta');
require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

//Function to retrieve queries for a specific date
function getQueriesForMonth($date)
{
    $query1 = "SELECT
            qM.id AS query_id,
            qM.name AS cust_name,
            qStM.name AS current_status,
            CONCAT(s_uM.firstname, ' ', s_uM.lastname) AS assigned_to,
            qSoM.name AS lead_source,
            qM.dateadded AS date_added
            FROM
            queryMaster AS qM
            INNER JOIN queryStatusMaster AS qStM ON qM.statusid = qStM.id
            INNER JOIN sys_userMaster AS s_uM ON qM.assignTo = s_uM.id
            INNER JOIN querySourceMaster AS qSoM ON qM.leadsource = qSoM.id
            WHERE DATE(qM.dateadded) BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND CURDATE()";

    $query2 = "SELECT
            IFNULL(qSoM.name, 'Total') AS `Source Name`,
            COUNT(*) AS `Total Leads - MTD`,
            SUM(CASE WHEN qStM.name = 'New' THEN 1 ELSE 0 END) AS `New Lead`,
            COUNT(*) - SUM(CASE WHEN qM.assignTo = 1 THEN 1 ELSE 0 END) AS `Assigned`,
            SUM(CASE WHEN qM.assignTo = 1 THEN 1 ELSE 0 END) AS `Not Assigned`,
            SUM(CASE WHEN qStM.name = 'Active' THEN 1 ELSE 0 END) AS `Active`,
            SUM(CASE WHEN qStM.name = 'Hot Lead' THEN 1 ELSE 0 END) AS `Hot Lead`,
            SUM(CASE WHEN qStM.name = 'Follow Up' THEN 1 ELSE 0 END) AS `Follow Up`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Follow Up' THEN 1 ELSE 0 END) / COUNT(*))*100,1),' %') AS `Follow Up %`,
            SUM(CASE WHEN qStM.name = 'Proposal Sent' THEN 1 ELSE 0 END) AS `Proposal Sent`,
            SUM(CASE WHEN qStM.name = 'Cancelled' THEN 1 ELSE 0 END) AS `Cancelled`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Cancelled' THEN 1 ELSE 0 END) / COUNT(*))*100,1),' %') AS `Cancelled %`,
            SUM(CASE WHEN qStM.name = 'No Connect' THEN 1 ELSE 0 END) AS `No Connect`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'No Connect' THEN 1 ELSE 0 END) / COUNT(*))*100,1),' %') AS `No Connect %`,
            SUM(CASE WHEN qStM.name = 'Confirmed' THEN 1 ELSE 0 END) AS `Confirmed`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Confirmed' THEN 1 ELSE 0 END) / COUNT(*))*100,1),' %') AS `Confirmed %`
        FROM
            queryMaster AS qM
        INNER JOIN queryStatusMaster AS qStM ON qM.statusid = qStM.id
        INNER JOIN sys_userMaster AS s_uM ON qM.assignTo = s_uM.id
        INNER JOIN querySourceMaster AS qSoM ON qM.leadsource = qSoM.id
        WHERE
            DATE(qM.dateadded) BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND CURDATE()
        GROUP BY
            qSoM.name
        WITH ROLLUP";

    $query3 = "SELECT
            IFNULL(s_uM.id, 'Total') AS `Assigned To (Id)`,
            IFNULL(CONCAT(s_uM.firstname, ' ', s_uM.lastname), 'Total') AS `Assigned To`,
            COUNT(*) AS `Total Leads - MTD`,
            SUM(CASE WHEN qStM.name = 'New' THEN 1 ELSE 0 END) AS `New Lead`,
            SUM(CASE WHEN qStM.name = 'Active' THEN 1 ELSE 0 END) AS `Active`,
            SUM(CASE WHEN qStM.name = 'Hot Lead' THEN 1 ELSE 0 END) AS `Hot Lead`,
            SUM(CASE WHEN qStM.name = 'Follow Up' THEN 1 ELSE 0 END) AS `Follow Up`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Follow Up' THEN 1 ELSE 0 END) / SUM(CASE WHEN qM.assignTo IS NOT NULL THEN 1 ELSE 0 END))*100,1),' %') AS `Follow Up %`,
            SUM(CASE WHEN qStM.name = 'Proposal Sent' THEN 1 ELSE 0 END) AS `Proposal Sent`,
            SUM(CASE WHEN qStM.name = 'Cancelled' THEN 1 ELSE 0 END) AS `Cancelled`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Cancelled' THEN 1 ELSE 0 END) / SUM(CASE WHEN qM.assignTo IS NOT NULL THEN 1 ELSE 0 END))*100,1),' %') AS `Cancelled %`,
            SUM(CASE WHEN qStM.name = 'Postponed' THEN 1 ELSE 0 END) AS `Postponed`,
            SUM(CASE WHEN qStM.name = 'No Connect' THEN 1 ELSE 0 END) AS `No Connect`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'No Connect' THEN 1 ELSE 0 END) / SUM(CASE WHEN qM.assignTo IS NOT NULL THEN 1 ELSE 0 END))*100,1),' %') AS `No Connect %`,
            SUM(CASE WHEN qStM.name = 'Confirmed' THEN 1 ELSE 0 END) AS `Confirmed`,
            CONCAT(ROUND((SUM(CASE WHEN qStM.name = 'Confirmed' THEN 1 ELSE 0 END) / SUM(CASE WHEN qM.assignTo IS NOT NULL THEN 1 ELSE 0 END))*100,1),' %') AS `Confirmed%`
        FROM
            queryMaster AS qM
        INNER JOIN queryStatusMaster AS qStM ON qM.statusid = qStM.id
        INNER JOIN sys_userMaster AS s_uM ON qM.assignTo = s_uM.id
        INNER JOIN querySourceMaster AS qSoM ON qM.leadsource = qSoM.id
        WHERE
            DATE(qM.dateadded) BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND CURDATE()
        GROUP BY
            s_uM.id
        WITH ROLLUP";

    // $result1 = mysqli_query(db(), $query1);
    $result2 = mysqli_query(db(), $query2);
    $result3 = mysqli_query(db(), $query3);
    $queries1 = array();
    // while ($row = mysqli_fetch_assoc($result1)) {
    //     $queries1[] = $row;
    // }
    $queries1 = array();
    while ($row = mysqli_fetch_assoc($result2)) {
        $queries2[] = $row;
    }
    $queries1 = array();
    while ($row = mysqli_fetch_assoc($result3)) {
        $queries3[] = $row;
    }

    for ($i = 0; $i < count($queries3); $i++) {
        if ($queries3[$i]['Assigned To (Id)'] == '1') {
            $queries3[$i]['Assigned To'] = 'Not Assigned';
        }

        if ($queries3[$i]['Assigned To (Id)'] == 'Total') {
            $queries3[$i]['Assigned To'] = 'Total';
        }
    }
    
    $totalIndex = count($queries3) - 1;

    usort($queries3, function($a, $b) use ($totalIndex) {
        // Exclude the last index from sorting
        if ($a['Assigned To (Id)'] === 'Total' || $b['Assigned To (Id)'] === 'Total') {
            return 0;
        }
    
        $confirmedAPercentage = (float) str_replace('%', '', $a['Confirmed%']);
        $confirmedBPercentage = (float) str_replace('%', '', $b['Confirmed%']);
    
        return $confirmedBPercentage <=> $confirmedAPercentage;
    });

// Move the last index (Total) to the end of the array
$totalRow = $dataArray[$totalIndex];
unset($dataArray[$totalIndex]);
$dataArray[] = $totalRow;

    $result = array(
        'Source Wise' => $queries2,
        'Agent Wise' => $queries3
    );
    // echo "<pre>";print_r($queries3);
    return $result;
}

function generateExcelReport($result, $date)
{
    $spreadsheet = new Spreadsheet();

    // Create worksheets dynamically for each array
    $worksheets = ['sourceWise', 'agentWise'];

    $headers = [
        'sourceWise' => ['Source Name', 'Total Leads - MTD', 'New Lead', 'Assigned', 'Not Assigned', 'Active', 'Hot Lead', 'Follow Up', 'Follow Up %', 'Proposal Sent', 'Changes', 'Cancelled', 'Cancelled %', 'Postponed', 'No Connect', 'No Connect %', 'Invalid', 'Confirmed', 'Confirmed %'],
        'agentWise' => ['Assigned To (Id)', 'Assigned To', 'Total Leads - MTD', 'New Lead', 'Assigned', 'Not Assigned', 'Active', 'Hot Lead', 'Follow Up', 'Follow Up %', 'Proposal Sent', 'Changes', 'Cancelled', 'Cancelled %', 'Postponed', 'No Connect', 'No Connect %', 'Invalid', 'Confirmed', 'Confirmed %']
    ];

    $percentageColumns = [
        'sourceWise' => ['I', 'M', 'P', 'S'],
        'agentWise' => ['I', 'M', 'P', 'S']
    ];

    foreach ($worksheets as $worksheetName) {
        $worksheet = $spreadsheet->createSheet();
        $worksheet->setTitle($worksheetName);

        // Set column headers
        $worksheetHeaders = $headers[$worksheetName];
        $worksheetPercentageColumns = $percentageColumns[$worksheetName];
        $columnIndex = 0;
        foreach ($worksheetHeaders as $header) {
            $cell = chr(65 + $columnIndex) . '1'; // A1, B1, C1, ...
            $worksheet->setCellValue($cell, $header);
            $columnIndex++;
        }

        // Get the data array based on the worksheet name
        $dataArray = $result[$worksheetName];

        // Write data to the worksheet
        $row = 2;
        foreach ($dataArray as $query) {
            $columnIndex = 0;
            foreach ($query as $value) {
                $cell = chr(65 + $columnIndex) . $row; // A2, B2, C2, ...
                $worksheet->setCellValue($cell, $value);
                $columnIndex++;
            }
            $row++;
        }
        if ($worksheet->getTitle() == 'agentWise') {
            $worksheet->removeColumn('A');
        }
        // Apply borders to cells
        $lastColumn = $worksheet->getHighestColumn();
        echo $lastColumn;
        $lastRow = $worksheet->getHighestRow();

        for ($i = ord('A'); $i <= ord($lastColumn); $i++) {
            $worksheet->getColumnDimension(chr($i))->setAutoSize(true);
        }

        foreach ($worksheetPercentageColumns as $wpColumn) {
            $worksheet->getStyle($wpColumn . '2:' . $wpColumn . $lastRow)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
        }

        $styleArray = [
            //echo "hello world !";exit;
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $worksheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray($styleArray);
        $worksheet->getStyle('A1:' . $lastColumn . '1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C5D9F1');
        $worksheet->setSelectedCells('A1');
        $worksheet->freezePane('A2');
    }

    $writer = new Xlsx($spreadsheet);
    // $spreadsheet->setActiveSheetIndexByName('Sheet2');
    $date = date('Y-m-d');
    $spreadsheet->removeSheetByIndex(0);

    $filename = './reports/' . $date . '_leads_status_update.xlsx';
    // echo $filename;
    $writer->save($filename);
    //echo $filename; exit;
    return $filename;
}

function generateMailBody($data)
{
    $htmlContent = '<html><body>';
    $htmlContent .= '<style>table { border-collapse: collapse; } th, tr, td { border: 1px solid black; margin: 8px; text-align: center;white-space: nowrap;} tr:nth-child(odd) {background-color: #f2f2f2;} </style>';
    foreach ($data as $key => $values) {
        $htmlContent .= '<h2>' . $key . '</h2>';
        $htmlContent .= '<table style="border: 1px solid black; text-align: center; border-collapse: collapse;">';
        $htmlContent .= '<tr>';
        foreach ($values[0] as $header => $value) {
            $htmlContent .= '<th  style="border: 1px solid black; text-align: center;width: 150px; padding:15px; background-color: #f2f2f2;">' . $header . '</th>';
        }
        $htmlContent .= '</tr>';
        $htmlContent .= '<tr>';
        foreach ($values as $row) {
            $htmlContent .= '<tr>';
            foreach ($row as $value) {
                $htmlContent .= '<td style="border: 1px solid black; text-align: center;width: 150px;">' . $value . '</td>';
            }
            $htmlContent .= '</tr>';
        }
        $htmlContent .= '</table>';
        $htmlContent .= '<br><br><br><br><br>';
    }
    $htmlContent .= '</body></html>';
    return $htmlContent;
}
// $recipients = array('pradeep@tripzygo.in');
// $queriesByDate = array();
// $date1 = "2023-05-02";
// $date = date('Y-m-d', strtotime($date1 . "-1 day"));
// echo $date; exit;

$date = date('Y-m-d');

$result = getQueriesForMonth($date);


$mailbody = generateMailBody($result);
// $filename = generateExcelReport($result, $date);
// echo '<pre>';
// print_r($result);
send_report_mail('info@awtrips.com', 'pradeep@tripzygo.in', 'Daily leads status report - '.$date, $mailbody, 'neerajvani@tripzygo.in, simranvani@tripzygo.in, nitinrana@tripzygo.in, manishyadav@tripzygo.in', '');
