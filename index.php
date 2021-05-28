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
  <form action="./questions.php" method="post" class="section">
  <div class="columns">
    <div class="column">
      <div class="columns">
                  <div class="column">
                  <div class=" box">
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Course Id</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" name="course_id" type="text" placeholder="Course ID" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Branch Name</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" name="branch_name" type="text" placeholder="Branch Name" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Branch Id</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" name="branch_id" type="text" placeholder="Branch Id" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Faculty Name</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" name="faculty_name" type="text" placeholder="Faculty Name"  required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Exam date</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" type="date" name="exam_date"  placeholder="Exam Date" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">Start Time</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" type="time" name="start_time"   placeholder="Exam Date" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">End Time</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" type="time" name="end_time"  placeholder="Exam Date" required>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="field is-horizontal">
                        <div class="field-label is-normal">
                           <label class="label">No of Questions</label>
                        </div>
                        <div class="field-body">
                           <div class="field">
                              <p class="control">
                              <input class="input" type="number"   min="1" max="50" name="noq"  placeholder="No of questions" required>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
      </div>
   <div class="columns">
         <div class="column">
         <div class="is-flex is-justify-content-center">
         <div class="buttons">
         <button class="button is-success is-rounded" type="submit">
            Generate
         </button>

         <input class="button is-danger is-rounded" type="reset">
         </input>
        </div>
         </div>
         </div>
   </div>
</div>
   <!-- <div class="column"> -->
      <?php
// for ($i = 1; $i < 11; $i++) {
//     echo "
//             <div class='box'>
//             <div class='block' >
//          Q $i : <input type='text' class='input is-small ' name=\"quest$i\" required >
//             </div>
//             </div>

//             ";
// }
?>
   <!-- </div> -->
</div>
</form>
</div>
</body>

</html>