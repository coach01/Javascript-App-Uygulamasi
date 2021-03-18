<?php error_reporting(0);?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="https://github.com/coach01">
    <meta name="description" content="Create Form">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Click Database Table Row And Update</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">



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

</head>
<body>
    <main>
        <div class="row">
           <div class="col">
                <?php 
                if(isset($_GET['answer']) && !empty($_GET['answer'])){
                    if($_GET['answer'] == "yes"){
                      echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
                            <strong>Success!</strong> Table updated successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button
                             </div>";

                    }else{
                      echo "<div class='alert alert-danger alert-dismissible fade show'  role='alert'>
                            <strong>Error : </strong> Something went wrong
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button
                             </div>";

                    }
                }
            
            ?>
            </div>
        </div>
        <div class="py-3 bg-light">
            <div class="container-fluid">

                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF']; ?>">DMS</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <?php 
                                      $conn = new mysqli("localhost","root","");
                                      if($stmt = $conn->query("SHOW DATABASES")){
                                      $dbs = $stmt -> fetch_all(MYSQLI_NUM);
                                      $conn->close();
                                      //print_r($dbs);
                                      for ($i=0; $i < count($dbs); $i++) { 
                                        $conn = new mysqli("localhost","root","",$dbs[$i][0]);
                                        //echo $index;
                                        if($stmt = $conn->query("SHOW TABLES")){
                                        $tbls = $stmt -> fetch_all(MYSQLI_NUM);
                                        for ($j=0; $j < count($tbls); $j++) { 
                                            if(count($tbls) == 1){
                                            echo "<li class='nav-item'>";
                                            echo "<a class='nav-link active' aria-current='page' href='".$_SERVER["PHP_SELF"]."?database=".$dbs[$i][0]."&table=".$tbls[$j][0]."'>".strtoupper($dbs[$i][0])."</a>";
                                            echo "</li>";
                                          }else if(count($tbls) > 1){
                                            echo '<li class="nav-item dropdown">';
                                                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                                                echo strtoupper($dbs[$i][0]);
                                                echo "</a>";
                                                echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                                for ($j=0; $j < count($tbls); $j++) { 
                                                   echo "<li><a class='dropdown-item' href='".$_SERVER["PHP_SELF"]."?database=".$dbs[$i][0]."&table=".$tbls[$j][0]."'>".ucfirst($tbls[$j][0])."</a></li>";
                                                }
                                                echo "</ul>";
                                                echo "</li>";
                                          }else{

                                           } 
                                         }

                                        }
                                        $conn->close();  
                                      }
                                  }
                                ?>
                                </ul>

                            </div>
                        </div>
                    </nav>
                </header>
                <div class="row">
                    <div class="col">
                        <h4>
                            <?php 
                            if(isset($_GET['database'])){echo strtoupper($_GET['database']) ?? "";} ?>                                
                        </h4> 
                          <h5>
                            <?php 
                            if(isset($_GET['table'])){echo ucfirst($_GET['table']) ?? "";} ?>                                
                        </h5> 

                    </div>
                </div>



                  <div class="row">
                    <div class="col">
                      <div class="table-responsive">
                       <table class="table table-light table-hover">
                        <thead>
                          <tr>
                <?php 

                    $database = $table = $fieldinfo = "";
                    $colspan = 0;
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['database']) && isset($_GET['table'])):
                    $database = $_GET['database'];
                    $table = $_GET['table'];
                    $conn = new mysqli("localhost", "root", "", $database);
                    $sql = "SELECT * FROM $table";
                    if ($result = $conn->query($sql)) {
                        //for every table .Table created as automatic
                        $fieldinfo = $result -> fetch_fields();
                        $colspan = 0;
                        foreach ($fieldinfo as $val) {
                          echo "<th id=".$val -> name."\">".ucfirst($val -> name) ."</th>";
                          $colspan++;
                        }                        
                    }

                ?>
                        </tr>
                      </thead>
                      <tbody>
                  <?php 

                  if (!empty($fieldinfo)) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       echo "<tr onmousedown='updateRow(this)' data-bs-toggle='modal' data-bs-target='#exampleModal'>";
                      foreach ($fieldinfo as $val) {
                        echo "<td headers=\"".$val -> name."\">". $row[$val -> name]."</td>";
                      }
                      echo "</tr>";
                    }

                  } else {
                      echo "<tr><td colspan='".$colspan."'>0 results</td></tr>";
                  }
                      echo "</tbody></table>";


                  ?>
                       </tbody>
                     </table>
                   </div>
                  </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
         if (!empty($fieldinfo)) {
          echo "<input type='text' class='form-control d-none' form='newForm' value='".$database."' name='db'>";
          echo "<input type='text' class='form-control d-none' form='newForm' value='".$table."' name='tb'>";
         echo "<form id='newForm' method='get' action='update.php'>";

                      foreach ($fieldinfo as $val) {
                        echo "<div class='mb-3'>";
                        echo "<label for='".$val -> name."' class='form-label'>".$val -> name."</label>";
                        echo "<input type='text' class='form-control mb-3' id='".$val -> name."' value='' name='".$val -> name."'>";
                        echo "</div>";
                      }

                  } else {
                      echo "";
                  }
        echo  "</form>";

         ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary" form="newForm">Save changes</button>
      </div>
      <?php 
        $conn -> close();
        endif;
       ?>
    </div>
  </div>
</div>
    </main>

    <footer class="text-muted py-5" id="footer">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Framework is from &copy; Bootstrap</p>
            <p class="mb-0"><a href="https://github.com/coach01">Visit my Github repo</a>.</p>
        </div>
    </footer>

    <script type="text/javascript">
    
     function updateRow(obj) {
        var newForm = document.getElementById("newForm");
        newForm.getElementsByTagName("input")[0].readOnly = true;
        for (let i = 0; i < obj.childElementCount; i++) {
             newForm.getElementsByTagName("input")[i].value = "";
        }
        for (let i = 0; i < obj.childElementCount; i++) {
           if (obj.children[i].childNodes[0] == undefined){
                continue;
           }else{
             newForm.getElementsByTagName("input")[i].value = obj.children[i].childNodes[0].nodeValue;
           }
        }

    }
    
    </script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
