<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Examino</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item">
      <p class="title is-4">examino</p>
    </a>


  </div>

  <nav class="navbar-menu">
  <a class="navbar-item " href="/">
         Home
    </a>

  </nav>

   
  </div>
</nav>

<div class="columns is-centered">
<div class="column is-flex is-justify-content-center">
<div class="box">

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
    echo "<form method='POST' action='./generate.php'> 
    <div class='select'>
        <select name='paper'> ";
    while($row = $result->fetch_assoc()) {
        echo "<option value=\"$row[id]\">$row[course_id] : $row[branch_name]</option>";
    //   echo "id: " . $row["eid"]. " - Name: " . $row["ename"].  "<br>";
    //   for($i=1;$i<11;$i++){
    //         $qid = "q".$i;
    //         echo "Q1 :".$row[$qid]." <br>";
    //   }
    }
    echo " </select> </div><input class='button is-success' type='submit' value='Download'>
    </form>";
  } else {
    echo "NO EXAMS FOUND";
  }
$conn->close();
?>
</div>
</div>
</div>
</div>
</body>
</html>