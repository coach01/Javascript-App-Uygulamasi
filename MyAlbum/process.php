<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if($_POST['process'] == "fetch"){
      $conn = new mysqli("localhost","root","","myalbum");
      $sql = "SELECT AlbumID,AlbumHead,AlbumContent From albums WHERE AlbumID=".$_POST['albumid'];
      if($stmt = $conn->query($sql)){
      $albm = $stmt -> fetch_row();
      echo json_encode($albm);
      $conn->close();  
      }   

  }//end of fetch
  elseif ($_POST['process'] == "Update") {

     if(!empty($_POST['albumhead']) && !empty($_POST['albumcontent']) && !empty($_POST['albumid'])){
        if(!empty($_FILES["albumimage"]["name"])){
          $target_dir = "images/";
          $createDatetime = date("Ymd_hms");
          $file =  "IMG_".$createDatetime."_".mt_rand(1,1000).".".pathinfo($_FILES["albumimage"]["name"],PATHINFO_EXTENSION);
          $target_file = $target_dir . $file;
          $fileStatus = "Album Updated";
          $upload = true;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          if(isset($_FILES["albumimage"]["name"])) {
            $checkImage = getimagesize($_FILES["albumimage"]["tmp_name"]);
            if($checkImage !== false) {
              $upload = true;
            } else {
              $fileStatus = "File is not an image.";
              $upload = false;
            }
          }


          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            $fileStatus = "Sorry, You can select JPG, JPEG, PNG & GIF files";
            $upload = false;
          }


          if ($upload == false) {
            $fileStatus = "Sorry, Your file was not uploaded.";

          } else {
            if (move_uploaded_file($_FILES["albumimage"]["tmp_name"], $target_file)) {


              $conn = new mysqli("localhost","root","","myalbum");
              $sql = "UPDATE albums SET AlbumHead='".$_POST['albumhead']."',AlbumContent='".$_POST['albumcontent']."',AlbumImage='".$file."' WHERE AlbumID=".$_POST['albumid'];
              $conn->query($sql);
              $conn->close(); 
              header("Location:index.php?upload=yes&status=".$fileStatus);

            } else {

              $fileStatus = "Sorry, there was an error uploading your file.";
            header("Location:index.php?upload=no&status=".$fileStatus);
            }
          }

        }else{
              $conn = new mysqli("localhost","root","","myalbum");
              $sql = "UPDATE albums SET AlbumHead='".$_POST['albumhead']."',AlbumContent='".$_POST['albumcontent']."' WHERE AlbumID=".$_POST['albumid'];
              $conn->query($sql);
              $conn->close();    
              header("Location:index.php?upload=yes&status=Album Updated");       
        }

    }

  }//end of Update
  else if($_POST['process'] == "Create"){
    echo "Hello";
    if(!empty($_POST['albumhead']) && !empty($_POST['albumcontent']) && !empty($_FILES["albumimage"]["name"])){

        $target_dir = "images/";
        $createDatetime = date("Ymd_hms");
        $file =  "IMG_".$createDatetime."_".mt_rand(1,1000).".".pathinfo($_FILES["albumimage"]["name"],PATHINFO_EXTENSION);
        $target_file = $target_dir . $file;
        $fileStatus = "";
        $upload = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_FILES["albumimage"]["name"])) {
          $checkImage = getimagesize($_FILES["albumimage"]["tmp_name"]);
          if($checkImage !== false) {
            $upload = true;
          } else {
            $fileStatus = "File is not an image.";
            $upload = false;
          }
        }


        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          $fileStatus = "Sorry, You can select JPG, JPEG, PNG & GIF files";
          $upload = false;
        }


        if ($upload == false) {
          $fileStatus = "Sorry, Your file was not uploaded.";

        } else {
          if (move_uploaded_file($_FILES["albumimage"]["tmp_name"], $target_file)) {

            $conn = new mysqli("localhost","root","","myalbum");
            $sql = "INSERT INTO albums(AlbumHead,AlbumContent,AlbumImage) VALUES('".$_POST['albumhead']."','".$_POST['albumcontent']."','".$file."')";
            $conn->query($sql);
            $conn->close(); 

          } else {

            $fileStatus = "Sorry, there was an error uploading your file.";

          }
        }
        if ($upload == true) {
          header("Location:index.php?upload=yes&status= New album was created");
        }else{
          header("Location:index.php?upload=no&status=".$fileStatus);
        }

    }else{
      header("Location:index.php?status=Input fields can not be empty");
    }

  }//end of create
  else{
      header("Location:index.php?status=Something went wrong");  
  }
}//end of $_SERVER["REQUEST_METHOD"]
else if($_SERVER["REQUEST_METHOD"] == "GET"){
  if ($_GET['process'] == "Delete") {
     $album_id = $_GET["albumid"];
     $img_name = $_GET["imgName"];

     $conn = new mysqli("localhost","root","","myalbum");
     $sql = "DELETE FROM albums WHERE AlbumID='".$album_id."'";
     $conn->query($sql);
     $conn->close(); 
     unlink("images/".$img_name);
     header("Location:index.php?upload=yes&status= Album was deleted");
  }
}
?>