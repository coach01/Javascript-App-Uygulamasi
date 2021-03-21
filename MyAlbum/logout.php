<?php
 session_start(); 
if($_SESSION["status"] == "ok"){
  session_unset();
  session_destroy();	
}else{
  setcookie("status", "", time() - 3600, '/');
  setcookie("memberid", "", time() - 3600, '/');
  setcookie("user", "", time() - 3600, '/');	
}

header("Location:index.php");

 ?>