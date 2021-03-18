<?php
error_reporting(0);
$database = $table = "";
$conn ="";
$status = "no";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $database = $_GET['db'];
  $table = $_GET['tb'];
  $conn = new mysqli("localhost","root","",$database);

    // Check connection
    if ($conn -> connect_errno) {
      header("Location:index.php?answer=no");
    }else{
    $status = "yes";
    }   
 }


  if($status == "yes"){

      $sql = "UPDATE $table SET ";  
      $set =array_slice($_GET,3);  
      
      foreach ($set as $key => $value) {
        $sql .= $key."='".$value."'";
        if(end($set) != $value)
          $sql .= ", ";
        else
          $sql .= " ";
      }

      $where = array_slice($_GET,2,1);
      foreach ($where as $key => $value) {
        $sql .= "where ".$key."='".$value."'";
      }    

      if ($conn->query($sql) === TRUE) {
          header("Location:index.php?database=$database&table=$table&answer=yes");
      } else {
          header("Location:index.php?database=$database&table=$table&answer=no");
      } 

  }else{
       header("Location:index.php?database=$database&table=$table&answer=no");
       }
  $conn->close();
?>