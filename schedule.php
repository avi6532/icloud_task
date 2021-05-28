<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('C')->setAutoSize(false);
$sheet->getColumnDimension('C')->setWidth('20');
$sheet->getColumnDimension('D')->setAutoSize(false);
$sheet->getColumnDimension('D')->setWidth('20');
$sheet->getColumnDimension('B')->setAutoSize(false);
$sheet->getColumnDimension('B')->setWidth('20');
$sheet->getColumnDimension('A')->setAutoSize(false);
$sheet->getColumnDimension('A')->setWidth('20');
$sheet->setCellValue("A1", "Course ID");
$sheet->setCellValue("B1", "Branch Id");
$sheet->setCellValue("C1", "Branch Name");
$sheet->setCellValue("D1", "Date");

$i = 2;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam";


//generate PDF 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result =  $conn->query("select * from exams order by exam_date ");
if ($result == true) {
    // output data of each row
  
    while($row = $result->fetch_assoc()) {
        $sheet->setCellValue("A$i", "$row[course_id]");
        $sheet->setCellValue("B$i", "$row[branch_id]");
        $sheet->setCellValue("C$i", "$row[branch_name]");
        $sheet->setCellValue("D$i", "$row[exam_date]");
        $i++;
    }
}

$writer = new Xlsx($spreadsheet);
$writer->save("Schedule.xlsx");

// We'll be outputting a PDF
header('Content-type: application/xlsx');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="schedule.xlsx"');

// The PDF source is in original.pdf
readfile('Schedule.xlsx');
echo "Your Schedule is downloaded";