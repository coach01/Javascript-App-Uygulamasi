<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $server = $_POST['server'];//I don't control every posts for if it is empty
  $user =   $_POST['user'];
  $pswd =   $_POST['password'];
  if (empty($pswd)) {
  	$pswd = "";
  }
  $database = $_POST['database'];
  $charSet =  $_POST['character'];
  $collate =  $_POST['collate'];


  // Create connection
  $conn = new mysqli($server, $user, $pswd);
  // Check connection
  if ($conn->connect_error) {
      echo "<div class='alert alert-danger alert-dismissible fade show'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Connection Error : </strong>".$conn->connect_error."</div>";
    die();
  }
  $status = "yes";//control same databases
  if($stmt = $conn->query("SHOW DATABASES")){
    $dbs = $stmt -> fetch_all(MYSQLI_NUM);
    for ($i=0; $i < count($dbs); $i++) { 
      for ($j=0; $j < count($dbs[$i]); $j++) { 
        if($dbs[$i][$j] == strtolower($database)){
          $status = "no";
        }
      }
    }
  }

  if($status == "yes"){
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS $database DEFAULT CHARACTER SET $charSet COLLATE $collate";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Success!</strong> Database created successfully.
        </div>";
    } else {
          echo "<div class='alert alert-danger alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Error : </strong>".$conn->error."</div>";
    }    
  }else{
        echo "<div class='alert alert-warning alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Warning!</strong> Database already exists.</div>";
  }

  $conn->close();
}
?>