<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["process"])) {

	$process = $_POST["process"];
	if(!empty($_POST["name"]) && isset($_POST["name"])){

		if ($process == "fetch") {
		    if (file_exists($_POST["name"])) {
			    $myfile = fopen($_POST["name"], "r") or die("Unable to open file!");
				echo fread($myfile,filesize($_POST["name"]));
				fclose($myfile);
			}else{
				echo "";
			}
		}elseif($process == "update"){

				if (file_exists($_POST["name"])) {
			    $myfile = fopen($_POST["name"], "w") or die("Unable to open file!");
				fwrite($myfile, $_POST["content"]);
				fclose($myfile);
				header("location:FileSystem.php");
				}else{
				header("location:FileSystem.php");					
				}
		}elseif($process == "delete"){
				if (file_exists($_POST["name"])) {
				unlink($_POST["name"]);
				header("location:FileSystem.php");//maybe you give message	
			   }else{
				header("location:FileSystem.php");//maybe you give message				
				}	
		}elseif($process == "create"){
				if (!file_exists($_POST["name"])) {
				$myfile = fopen($_POST["name"], "x+") or die("Unable to open file!");         
                fwrite($myfile, "Created");
                fclose($myfile);
				header("location:FileSystem.php");	
			   }else{
				header("location:FileSystem.php");					
				}	
		}				
  	}
}

?>
