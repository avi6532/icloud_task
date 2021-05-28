<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>examino</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="section">
    <p class="title is-5 box is-flex is-justify-content-space-between">
     examino
      <a href="/">go back</a>
    </p>

<div class="columns is-centered">
<div class="column is-flex is-justify-content-center">
<div class="box">
<?php

$exam_date ="";
$course_id ="";
$branch_id ="";
$branch_name = "";
$questions = array_fill(0,50,"");
$marks = array_fill(0,50,"");
// $q1 = "";
// $q2 = "";
// $q3 = "";
// $q4 = "";
// $q5 = "";
// $q6 = "";
// $q7 = "";
// $q8 = "";
// $q9 = "";
// $q10 = "";
// $q11 = "";
// $q12 = "";
// $q13 = "";
// $q14 = "";
// $q15 = "";
// $q16 = "";
// $q17 = "";
// $q18 = "";
// $q19 = "";
// $q20 = "";
// $q21 = "";
// $q22 = "";
// $q23 = "";
// $q24 = "";
// $q25 = "";
// $q26 = "";
// $q27 = "";
// $q28 = "";
// $q29 = "";
// $q30 = "";
// $q31 = "";
// $q32 = "";
// $q33 = "";
// $q34 = "";
// $q35 = "";
// $q36 = "";
// $q37 = "";
// $q38 = "";
// $q39 = "";
// $q40 = "";
// $q41 = "";
// $q42 = "";
// $q43 = "";
// $q44 = "";
// $q45 = "";
// $q46 = "";
// $q47 = "";
// $q48 = "";
// $q49 = "";
// $q50 = "";

if($_POST){
  
$exam_date = $_POST["exam_date"];
$course_id = $_POST["course_id"];
$branch_id = $_POST["branch_id"];
$branch_name = $_POST["branch_name"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$faculty_name = $_POST["faculty_name"];
$noq=$_POST["noq"];
// $q1 = $_POST["quest1"];
// $q2 = $_POST["quest2"];
// $q3 = $_POST["quest3"];
// $q4 = $_POST["quest4"];
// $q5 = $_POST["quest5"];
// $q6 = $_POST["quest6"];
// $q7 = $_POST["quest7"];
// $q8 = $_POST["quest8"];
// $q9 = $_POST["quest9"];
// $q10 = $_POST["quest10"];

for($i = 1 ;$i < 51 ;$i++){
  $index = $i - 1 ;
  if(isset($_POST["quest$i"])){
    $questions[$index] = $_POST["quest$i"];
  }
}

for($i = 1 ;$i < 51 ;$i++){
  $index = $i - 1 ;
  if(isset($_POST["mark$i"])){
    $marks[$index] = $_POST["mark$i"];
  }
}
}

// -- use exam;
// create table exams( id int  PRIMARY key AUTO_INCREMENT, ename varchar(30) not null UNIQUE  , eid varchar(20) not null UNIQUE , 
// q1 varchar(100) not null,q2 varchar(100) not null,q3 varchar(100) not null,q4 varchar(100) not null,
// q5 varchar(100) not null,q6 varchar(100) not null,q7 varchar(100) not null,q8 varchar(100) not null,
// q9 varchar(100) not null,q10 varchar(100) not null);
// $sql = "insert into exams(ename,eid,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10) values(\"PHP\",\"P101\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\")";
// GRANT ALL PRIVILEGES ON `exam`.* TO 'php'@'localhost' WITH GRANT OPTION; 
$servername = "localhost";
$username = "root";
$dbname = "exam";
$password = "";



// Create connection

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

if($_POST){
  $conn = new mysqli($servername, $username,$password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "insert into exams(course_id,branch_id,branch_name,faculty_name,exam_date,start_time,end_time,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10";
for($k = 11 ; $k < 51 ; $k++){
  $sql = $sql.",q".$k;
}
for($k = 1 ; $k < 51 ; $k++){
  $sql = $sql.",m".$k;
}
$sql = $sql.",noq) values(\"$course_id\",\"$branch_id\",\"$branch_name\",\"$faculty_name\",\"$exam_date\",
\"$start_time\",\"$end_time\",
 \"$questions[0]\",\"$questions[1]\",\"$questions[2]\",\"$questions[3]\",\"$questions[4]\",
 \"$questions[5]\",\"$questions[6]\",\"$questions[7]\",\"$questions[8]\",\"$questions[9]\"";

 for($k = 10 ; $k < 50 ; $k++){
   $sql = $sql.",\"".$questions[$k]."\"";
 }
 for($k = 0 ; $k < 50 ; $k++){
  $sql = $sql.",\"".$marks[$k]."\"";
}
 $sql = $sql.",\"$noq\")";

  if ($conn->query($sql) === TRUE) {
    echo '
        <div class="notification is-success">
        <button class="delete"></button>
              Exam added successfully
              <a class="button is-light" href="./examslist.php"> Generate PDF</a>
        </div>
        ';
  } else {
    echo $sql."an Error occurred please try again<br>".$conn->error;
    echo "<a href=\"./index.php\">Go Back </a>";
  }
  $conn->close();
}
else{
  echo "WELL NO  GET REQUEST ALOWED";
}
// $result =  $conn->query("select * from exams");
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["eid"]. " - Name: " . $row["ename"].  "<br>";
//       for($i=1;$i<11;$i++){
//             $qid = "q".$i;
//             echo "Q1 :".$row[$qid]." <br>";
//       }
//     }
//   } else {
//     echo "0 results";
//   }


?>
</div>
</div>
</div>
</div>
</body>
</html>