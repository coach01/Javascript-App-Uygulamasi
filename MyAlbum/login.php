<?php
session_start();
$emailErr = $userPswdErr = "";
$email = $userPswd = "";
$cBox = "";
$process = "yes";
$_COOKIE["status"] = "no";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"]) && isset($_POST["email"])) {
    $emailErr = "Email is required";
    $process = "no";
  } else {
    $email = clear($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $process = "no";
    }
  }
  
  if (empty($_POST["password"])) {
    $userPswdErr = "password is required";
    $process = "no";
  } else {
    $userPswd = clear($_POST["password"]);
  }

  if (isset($_POST["remember"]) && !empty($_POST["remember"])  ) {
     if($_POST["remember"] == "yes")
       $cBox = "checked";
     else
       $cBox = "";
  }



  if($process = "yes"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myalbum";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      header("Location:index.php?upload=no&status=Database connection error");   
      die();
    }
    $sql = "SELECT MemberId,FirstName,LastName,Email,Password FROM members";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          if($row["Email"] == $email && $row["Password"] == $userPswd){
              if($cBox == "checked"){
                setcookie("status", "ok",time() + (86400 * 30), "/"); 
                setcookie("memberid",$row['MemberId'] ,time() + (86400 * 30), "/"); 
                setcookie("user",$row['FirstName']." ".$row['LastName'] ,time() + (86400 * 30), "/");                
              }else{

                $_SESSION["status"] = "ok";
                $_SESSION["memberid"] = $row['MemberId'];
                $_SESSION["user"] = $row['FirstName']." ".$row['LastName'];
              }

              $conn -> close();
              header("Location:index.php");
          }
        }

   }
}

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="https://github.com/coach01/">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="style/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <label for="inputEmail" class="visually-hidden">Email address</label><span class="badge badge-danger"><?php echo $emailErr;?></span>
    <input type="email" id="email" name="email" class="form-control" value="<?php echo $email;?>" required autofocus>
    <label for="inputPassword" class="visually-hidden">Password</label><span class="badge badge-danger"><?php echo $userPswdErr;?></span>
    <input type="password" name="password" id="password" class="form-control" value="<?php echo $userPswd;?>" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" name="remember" <?php echo $cBox; ?> value="yes"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted"><a href="index.php">Return Main Page</a></p>    
    <p class="mt-5 mb-3 text-muted">&copy; 2017– <?php echo date("Y"); ?></p>
  </form>

</main>


    
  </body>
</html>
