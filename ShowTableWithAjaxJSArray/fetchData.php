<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $server = $_POST['server'];//I don't control every posts for if it is empty
  $user =   $_POST['user'];
  $pswd =   $_POST['password'];
  if (empty($pswd)) {	$pswd = "";  }
  $database = $_POST['database'];
  $table = $_POST['table'];
  
  $conn = new mysqli($server, $user, $pswd,$database);

  if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
  }
 
  $sql = "SELECT * FROM $table";
  $result = $conn -> query($sql);
    if($_POST["content"] == "tbody"){
      // Fetch all
      $dataArray = $result -> fetch_all(MYSQLI_NUM);

      echo json_encode($dataArray);// hey I am sending json array to javascript.you can decode in javascript
    }else{
      $fieldinfo = $result -> fetch_fields();
       echo json_encode($fieldinfo);
    }


  // Free result set
  $result -> free_result();
  $conn->close();
}
?>