<?php
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["fileupload"]["name"]);


  if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)){
      readfile($target_file);
  }

?>