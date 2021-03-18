<?php
error_reporting(0);
$server = $user = $password = $database = $table = "";
$conn ="";
$status = "no";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //extract($_POST, EXTR_SKIP);
  $server = control_input($_POST["server"]);
  $user = control_input($_POST["user"]);
  $password = control_input($_POST["password"]);
  $database = control_input($_POST["database"]);
  $table = control_input($_POST["table"]);
  if(isset($table) && !empty($table)){
  $conn = new mysqli($server,$user,$password,$database);

    // Check connection
    if ($conn -> connect_errno) {
      echo "<div class='alert alert-danger alert-dismissible fade show'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error: </strong>Please control server, database, user and password values </div>";
    }   
  }
  $status = "yes";
}

function control_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  if($status == "yes"){
      // Create database
      $sql = "UPDATE $table SET ";  
      $set =array_slice($_POST,5,(count($_POST)-6));  
      
      foreach ($set as $key => $value) {
        $sql .= $key."='".$value."'";
        if(end($set) != $value)
          $sql .= ", ";
        else
          $sql .= " ";
      }

      $where = array_slice($_POST,(count($_POST)- 1), 1);
      foreach ($where as $key => $value) {
        $sql .= "where ".$key."='".$value."'";
      }    

      if ($conn->query($sql) === TRUE) {
          echo "<div class='alert alert-success alert-dismissible fade show'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <strong>Success!</strong> Table updated successfully.
          </div>";
      } else {
            echo "<div class='alert alert-danger alert-dismissible fade show'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <strong>Error : </strong>".$conn->error."</div>";
      } 

    }else{
            echo "<div class='alert alert-warning alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Warning!</strong> Please control database,server,user,password,table values.</div>";  
    }

  $conn->close();

// you can develop it yourself.    first cols are ids
?>