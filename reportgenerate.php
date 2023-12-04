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
    $query = "SELECT
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

    $result = mysqli_query(db(), $query);
    $queries = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $queries[] = $row;
    }
    
    //echo "<pre>";print_r($queries);
    return $queries;
    
}

function generateExcelReport($queries, $date)
{
    $spreadsheet = new Spreadsheet();
    // $spreadsheet->removeSheetByIndex(0); // Remove the first sheet

    
    $worksheet = $spreadsheet->createSheet();
    $worksheet->setTitle($date);
    $worksheet->setCellValue('A1', 'query_id');
    $worksheet->setCellValue('B1', 'cust_name');
    $worksheet->setCellValue('C1', 'current_status');
    $worksheet->setCellValue('D1', 'assigned_to');
    $worksheet->setCellValue('E1', 'lead_source');
    $worksheet->setCellValue('F1', 'date_added');

    $row = 2;
    foreach ($queries as $query) {
        $worksheet->setCellValue('A' . $row, $query['query_id']);
        $worksheet->setCellValue('B' . $row, $query['cust_name']);
        $worksheet->setCellValue('C' . $row, $query['current_status']);
        $worksheet->setCellValue('D' . $row, $query['assigned_to']);
        $worksheet->setCellValue('E' . $row, $query['lead_source']);
        $worksheet->setCellValue('F' . $row, $query['date_added']);
        $row++;
    }

    // Set auto width for all columns
    $worksheet->getColumnDimension('A')->setAutoSize(true);
    $worksheet->getColumnDimension('B')->setAutoSize(true);
    $worksheet->getColumnDimension('C')->setAutoSize(true);
    $worksheet->getColumnDimension('D')->setAutoSize(true);
    $worksheet->getColumnDimension('E')->setAutoSize(true);
    $worksheet->getColumnDimension('F')->setAutoSize(true);
    // Repeat this for other columns as needed

    // Apply borders to cells
    $lastColumn = $worksheet->getHighestColumn();
    $lastRow = $worksheet->getHighestRow();

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
    $worksheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C5D9F1');
    $worksheet->setSelectedCells('A1');
    $worksheet->freezePane('A2');
    
    $writer = new Xlsx($spreadsheet);
    // $spreadsheet->setActiveSheetIndexByName('Sheet2');
    $date = date('Y-m-d');
    $filename = './reports/' . $date . '_leads_status_update.xlsx';
    // echo $filename;
    $writer->save($filename);
   //echo $filename; exit;
    return $filename;
}

// $recipients = array('pradeep@tripzygo.in');
// $queriesByDate = array();
// $date1 = "2023-05-02";
// $date = date('Y-m-d', strtotime($date1 . "-1 day"));
// echo $date; exit;

$date = date('Y-m-d');

$queries = getQueriesForMonth($date);


$filename = generateExcelReport($queries, $date);
// echo '<pre>';
// print_r($queriesByDate);
send_report_mail('info@awtrips.com', 'pradeep@tripzygo.in', 'Daily leads status report', 'Here is the daily leads status report', 'sonamrai@tripzygo.in, akashtenguria@tripzygo.in', $filename);

