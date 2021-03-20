<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if($_POST['field'] == "databases"){
      $conn = new mysqli("localhost","root","");
      if($stmt = $conn->query("SHOW DATABASES")){
      $dbs = $stmt -> fetch_all(MYSQLI_NUM);
      echo json_encode($dbs);
      $conn->close();  
      }   

  }elseif ($_POST['field'] == "tables") {

     if(isset($_POST['table']) && !empty($_POST['table'])){

        $conn = new mysqli("localhost","root","",$_POST['table']);
        if($stmt = $conn->query("SHOW TABLES")){
        $tbls = $stmt -> fetch_all(MYSQLI_NUM);
        echo json_encode($tbls);
        $conn->close();   

      }else{
        header("Location:".$_SERVER['HTTP_REFERER']);
      }
      
     }

  }else{
      echo json_encode(array("Sorun Oluştu."));
  }


}
?>