<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EXamino</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="section">
    <p class="title is-5 box is-flex is-justify-content-space-between">
     examino
      <a href="/">go back</a>
    </p>
 <div class="columns ">
<form method="POST" action="./examschedule.php" class="column ">
<div class="box ">
<div class="title is-4">Download</div>
<?php
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

$result =  $conn->query("select * from exams");
if ($result->num_rows > 0) {
    // output data of each row
    echo "
    
    <div class='select'>
        <select name='ext_p'> ";
    while($row = $result->fetch_assoc()) {
        echo "<option value=\"$row[id]\">$row[course_id] : $row[branch_name]</option>";
    }
    echo " </select> </div><input class='button is-success' type='submit' value='View'>";
  } else {
    echo "NO EXAMS FOUND";
  }
$conn->close();
?>
</div>
</form>

<!-- <form method="post" action="uploadexcel.php" enctype="multipart/form-data"  class="column"> -->
<form method="post" action="examschedule.php" enctype="multipart/form-data"   class="column">
<div class="box  is-flex-direction-row is-justify-content-space-between">
<div class="title is-4">Upload</div>
<?php
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

$result =  $conn->query("select * from exams");
if ($result->num_rows > 0) {
    // output data of each row
    echo "
    <div class='select '>
        <select name='pp_id'> ";
    while($row = $result->fetch_assoc()) {
        echo "<option value=\"$row[id]\">$row[course_id] : $row[branch_name]</option>";
    }
    echo " </select> </div> <input class='input' name='myfile'  type='file' ><input class='button is-success' type='submit' name='check' value='verify'>";
  } else {
    echo "NO EXAMS FOUND";
  }

?>

</div>
</form>
</div>
</div>
</div>
<div class="section">
<p class="title is-4">Excel Viewer</p>
<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$sheet = array();
$branch = "";
$course = "";
$noq="";

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

//For Veiwing a sheet to be generated
  if(isset($_POST["ext_p"])){

   echo '
   <form class="box" style="overflow-x:scroll" method="post" action="downloadexcel.php">';
    $header = array("student_id","student_name","course_id" ,"branch_id");

    $result =  $conn->query("select * from exams where id =".$_POST["ext_p"]);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
          // array_push($header,$row["branch_id"],$row["course_id"],$row["branch_name"]);
          $branch = $row["branch_id"];
          $course = $row["course_id"];
          $noq=$row["noq"];
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
        
      }
      else{
        echo "INTERNAL ERROR no students";
      }


    }
    else{
      echo "INTERNAL ERROR";
    }

      echo "<table class=\"table\">";
      foreach($sheet as $row){
        echo "<tr>";
        foreach($row as $col){
          echo "<td>";
          echo $col;
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</table>"; 
echo "<input type='text' name='ext_p' value=\"$_POST[ext_p]\" hidden/>";
echo "<input type='submit' class='button is-success' value='save' name='download'/>";

  }

  // Reading from an uploaded excel file
  if(isset($_POST["pp_id"])){

    echo '
    <form class="box" style="overflow-x:scroll" method="post" action="examschedule.php">';
    $filepath = $_FILES['myfile']['tmp_name'];
    $target_file = "./uploads/" . basename($_FILES["myfile"]["name"]);

    if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)){


      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
      $reader->setReadDataOnly(TRUE);
      $spreadsheet = $reader->load($target_file);

      $worksheet = $spreadsheet->getActiveSheet();
      // Get the highest row number and column letter referenced in the worksheet
      $highestRow = $worksheet->getHighestRow(); // e.g. 10
      $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
      // Increment the highest column letter
      $highestColumn++;



      echo '<table class="table">' . "\n";
      for ($row = 1; $row <= $highestRow; ++$row) {
          echo '<tr>' . PHP_EOL;
          for ($col = 'A'; $col != $highestColumn; ++$col) {
              echo '<td>' .
                  $worksheet->getCell($col . $row)
                      ->getValue() .
                  '</td>' . PHP_EOL;
          }
          echo '</tr>' . PHP_EOL;
      }
      echo '</table>' . PHP_EOL;
      
      echo "<input type='text' name='file' value=\"$target_file\" hidden/>";
      echo "<input type='submit' class='button is-success' value='save' name='download'/>";
     
    } else {
        echo '<div class="notification is-danger">
        <button class="delete"></button>
          An Error Occcurred <strong>retry!</strong> </div>';
      }
     
  }

  if( isset($_POST["file"])){
    $file =  $_POST["file"];
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
    $reader->setReadDataOnly(TRUE);
    $spreadsheet = $reader->load($file);

    $worksheet = $spreadsheet->getActiveSheet();
    // Get the highest row number and column letter referenced in the worksheet
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = "BB"; // e.g 'F'
    // Increment the highest column letter
    $highestColumn++;

    $query_base = "replace into marks(student_roll,student_name,course_id,branch_id";
    for($i = 1 ;$i<51;$i++)
    {
      $query_base = $query_base.",m$i";
    }
    $query_base = $query_base.") ";
    $flag = 1;
    for ($row = 2; $row <= $highestRow; ++$row) {
        $var_query = "values(";
        for ($col = 'A'; $col != $highestColumn; ++$col) {

             if($col == 'A'){
              $var_query = $var_query.'"'.$worksheet->getCell($col . $row)
              ->getValue().'"' ;
             }
             else {
              $var_query = $var_query.',"'.$worksheet->getCell($col . $row)
              ->getValue().'"' ;
             }
        }
        $var_query = $var_query.")";
      
        $final_query = $query_base.$var_query;
        if($conn->query($final_query)){
          $flag =1;
        } else {
          $flag = 0 ;
          echo $conn->error.$final_query;
          break;
        }
        
      }
      if($flag = 1){
        echo '
        <div class="notification is-success">
        <button class="delete"></button>
        Success!!
        </div>
        ';
      } else {
        echo '
        <div class="notification is-danger">
        <button class="delete"></button>
        Error Something went wrong!!
        </div>
        ';
      }
   
  }
  
  $conn->close();

  
        
?>
</div>
</div>
</body>
</html>
