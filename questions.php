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
<!-- Navbar -->
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item">
      <p class="title is-4">examino</p>
    </a>


  </div>

  <nav class="navbar-menu">
  <a class="navbar-item " href="./examslist.php">
         papers
    </a>

  </nav>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="./getschedule.php">
            <strong>Schedule</strong>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- form -->
  <form action="./pdf.php" method="post" class="section">
  <div class="columns">
    
        
   <div class="column">
      <?php

    echo "
        <input type='text' name='course_id' value=\"$_POST[course_id]\" hidden >
        <input type='text' name='branch_id' value=\"$_POST[branch_id]\" hidden >
        <input type='text' name='branch_name' value=\"$_POST[branch_name]\" hidden >
        <input type='text' name='exam_date' value=\"$_POST[exam_date]\" hidden >
        <input type='text' name='start_time' value=\"$_POST[start_time]\" hidden >
        <input type='text' name='end_time' value=\"$_POST[end_time]\" hidden >
        <input type='text' name='faculty_name' value=\"$_POST[faculty_name]\" hidden >
        <input type='text' name='noq' value=\"$_POST[noq]\" hidden >
        ";

for ($i = 1; $i <= $_POST["noq"]; $i++) {
    echo "
            <div class='columns box '>
            <div class='column is-three-quarters' >
         Q $i : <input type='text' class='input is-small ' name=\"quest$i\" required >
         </div>
         <div class='column is-one-quarter'>
         marks : <input type='number' class='input is-small ' min=1 name=\"mark$i\" required >
            </div>
            </div>

            ";
}
?>
   
         <div class="is-flex is-justify-content-center">
         <div class="buttons">
                    <button class="button is-success is-rounded" type="submit">
                        Generate
                    </button>

                    <button class="button is-danger is-rounded">
                    Reset</button>
        </div>
         </div>
         </div>
</div>
</form>
</div>
</body>

</html>