<?php 

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$sheet = array();
$branch = "";
$course = "";
if(isset($_POST["download"])){
    $spreadsheet = new Spreadsheet();
    $sh = $spreadsheet->getActiveSheet();
    $header = array("student_id","student_name","course_id" ,"branch_id");
   

    //db strings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exam";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //


    $result =  $conn->query("select * from exams where id =".$_POST["ext_p"]);
    if ($result) {
      while($row = $result->fetch_assoc()){
          $branch = $row["branch_id"];
          $course = $row["course_id"]; 
          $noq=$row["noq"];
        // array_push($header,$row["branch_id"],$row["course_id"],$row["branch_name"]);
      }

      for($i =1; $i<=$noq;$i++){
        array_push($header,"$i");
      }

      array_push($sheet ,$header);


      $students = $conn->query("select * from student where branch_id=\"".$branch."\"");
      

      if ($students) {
    
        while($row = $students->fetch_assoc()){
            $current = array($row["roll"],$row["name"],$course,$branch);
            for($i =1; $i<=$noq;$i++){
              array_push($current,"");
            }
            array_push($sheet , $current);
        }
        
        $sh->fromArray(
            $sheet,
            "",
            'A1'
          );
          
          
          $writer = new Xlsx($spreadsheet);
          ob_end_clean();
          $writer->save("./template/$course.xlsx");
          header('Content-type: application/vnd.ms-excel');
          
          // It will be called downloaded.pdf
          header('Content-Disposition: attachment; filename="'.$course.'.xlsx"');
          
          // The PDF source is in original.pdf
          readfile("./template/$course.xlsx");
          $conn->close();
      }
      else{
        echo "INTERNAL ERROR no students";
      }
    }
    
  } 

  ?>