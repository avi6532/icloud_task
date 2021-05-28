<?php
 require "vendor/autoload.php";
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
$my_paper = $_POST["paper"];
$result =  $conn->query("select * from exams where id =  \"$my_paper\" ");
if ($result == true) {
    // output data of each row
  
    while($row = $result->fetch_assoc()) {
     
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set post vars 

$exam_date = $row["exam_date"];
$course_id = $row["course_id"];
$branch_id = $row["branch_id"];
$branch_name = $row["branch_name"];
$start_time = $row["start_time"];
$end_time = $row["end_time"];
$faculty_name = $row["faculty_name"];
$questions = array(0,50,"");
$marks = array(0,50,1);

for($i = 1;$i<51;$i++){
    if(isset($row["q$i"])){
        $questions[$i-1] = $row["q$i"];
        $marks[$i-1] = $row["m$i"];
    }
}
// $q1 = $row["q1"];
// $q2 = $row["q2"];
// $q3 = $row["q3"];
// $q4 = $row["q4"];
// $q5 = $row["q5"];
// $q6 = $row["q6"];
// $q7 = $row["q7"];
// $q8 = $row["q8"];
// $q9 = $row["q9"];
// $q10 = $row["q10"];
// set document information


// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();

// set some text to print

$pdf->SetFont('times', 'N', 12);

$txt2 = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2,h4{
            text-align: center;
        }
        span{
            text-align:center;
        }

        
    </style>
</head>
<body>
<table>
    <h2>
        Exam:  $course_id
    </h2>
    <h4>
        BRANCH CODE:$branch_id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BRANCH:$branch_name 
    </h4>
 
      <pre>   Date : $exam_date                          Faculty:$faculty_name  </pre>
    
    <h5>
        Start : $start_time &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; End : $end_time
    </h5>
    <h5>
        
    </h5>
    

EOF;

$pdf->WriteHTML( $txt2, true,false,true,false,'');

$n =sizeof($questions);
for($j = 0 ; $j < $n ; $j++){
   if($questions[$j] != ""){
    $index = $j+1;
    $text = <<<EOF
   <pre>Q$index :   $questions[$j]                               
m($marks[$j])</pre>
EOF;

$pdf->WriteHTML( $text, true,false,true,false,'');
   }
   else{
       break;
   }
}


$final_text = <<<EOF
</body>
</html>
EOF;

$pdf->WriteHTML( $final_text, true,false,true,false,'');
// // ---------------------------------------------------------
// <div >
//         <div >
//              Q1 :   $q1 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q2 :   $q2 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q3 :   $q3 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q4 :   $q4 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q5 :   $q5 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q6 :   $q6 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q7 :   $q7 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q8 :   $q8 
//         </div>
//     </div>
//     <div >
//         <div >
//              Q9 :   $q9
//         </div>
//     </div>
//     <div >
//         <div >
//              Q10 :   $q10
//         </div>
//     </div>
//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');
    }
  } else {
    echo "Internal Error";
  }
$conn->close();