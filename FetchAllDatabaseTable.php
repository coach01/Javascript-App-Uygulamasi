<?php
error_reporting(0);
$server = $user = $password = $database = $table = "";
$conn = $fieldinfo ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $server = control_input($_POST["server"]);
  $user = control_input($_POST["user"]);
  $password = control_input($_POST["password"]);
  $database = control_input($_POST["database"]);
  $table = control_input($_POST["table"]);
  if(isset($table) && !empty($table)){
  $conn = new mysqli($server,$user,$password,$database);

	if ($conn -> connect_errno) {
    echo "<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Error: </strong>Please control server, database, user and password values </div>";
	}  	
  }

}

function control_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MySQL Example</title>
  <meta charset="utf-8">
  <meta name="author" content="https://github.com/coach01/Javascript-App">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	  <!-- Brand/logo -->
	  <a class="navbar-brand" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">MySQL</a>
	  
	  <!-- Links -->
	  <ul class="navbar-nav">
	    <li class="nav-item">
	      <a class="nav-link" href="#">Link 1</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#">Link 2</a>
	    </li>
	  </ul>
	</nav>

	<div class="jumbotron text-center">
	  <h1>MySQL Example</h1>
	  <p>We try MySQL Function</p>
	</div>

	  <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    <label for="server" class="mb-2 mr-sm-2">Server:</label>
	    <input type="text" class="form-control mb-2 mr-sm-2" id="server" placeholder="Enter server" name="server" value="<?php echo $server; ?>">
	    <label for="user" class="mb-2 mr-sm-2">User:</label>
	    <input type="text" class="form-control mb-2 mr-sm-2" id="user" placeholder="Enter user" name="user" value="<?php echo $user; ?>">
	    <label for="db" class="mb-2 mr-sm-2">Password:</label>
	    <input type="password" class="form-control mb-2 mr-sm-2" id="password" placeholder="Enter password" name="password" value="">	  	
	    <label for="database" class="mb-2 mr-sm-2">Database:</label>
	    <input type="text" class="form-control mb-2 mr-sm-2" id="database" placeholder="Enter database" name="database" value="<?php echo $database; ?>">
	    <label for="table" class="mb-2 mr-sm-2">Table:</label>
	    <input type="text" class="form-control mb-2 mr-sm-2" id="table" placeholder="Enter table" name="table" value="<?php echo $table; ?>">   
	    <button type="submit" class="btn btn-primary mb-2">Fetch</button>
	  </form>

<?php 
	if(isset($conn) && !empty($conn)):
	$sql = "SELECT * FROM $table";
	$result = $conn->query($sql);
 ?>
    <div class="table-responsive">
    <table class="table table-dark table-hover">
    <thead>
<?php //for every table .Table created as automatic
  $fieldinfo = $result -> fetch_fields();
  echo "<tr>";
  foreach ($fieldinfo as $val) {
    echo "<th>".ucfirst($val -> name) ."</th>";
  }
  echo "</tr>";
?>
    </thead>
    <tbody>
<?php 
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	   echo "<tr>";
	  foreach ($fieldinfo as $val) {
	    echo "<td>". $row[$val -> name]."</td>";
	  }
	  echo "</tr>";
  }

} else {
    echo "<tr><td colspan='4'>0 results</td></tr>";
}
    echo "</tbody></table>";

    echo "<div class='alert alert-info alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Info!</strong> ".$conn -> affected_rows." records affected by query</div>";

$conn -> close();
endif;
?>

</div>
	<div class="jumbotron text-center">
	  <p>Every programmer is valuable.</p>
	</div>  

</div>

</body>
</html>
