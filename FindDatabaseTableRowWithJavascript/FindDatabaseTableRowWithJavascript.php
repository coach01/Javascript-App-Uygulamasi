<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="https://github.com/coach01">
    <meta name="description" content="Create Form">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Find Database Table Row With Javascript</title>

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
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" onkeyup="findRow(this.value)">
                                    <!--<button class="btn btn-outline-light mx-1" type="button" onclick="findRow(this.previousElementSibling.value)">Search</button>-->
                                    <button class="btn btn-outline-light mx-1" type="button" onclick="clearRow(this.parentElement)">Clear</button>

                                </form>
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
                       echo "<tr>";
                      foreach ($fieldinfo as $val) {
                        echo "<td headers=\"".$val -> name."\">". $row[$val -> name]."</td>";
                      }
                      echo "</tr>";
                    }

                  } else {
                      echo "<tr><td colspan='".$colspan."'>0 results</td></tr>";
                  }
                      echo "</tbody></table>";

                  $conn -> close();
                  endif;
                  ?>
                       </tbody>
                     </table>
                   </div>
                  </div>
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
    function findRow(txt) {
        if (txt != "") {
            txt = txt.trim();
            txt = txt.toLowerCase();

            var tbody = document.getElementsByTagName("tbody")[0];
            for (var i = 0; i < tbody.childElementCount; i++) {
                for (var j = 0; j < tbody.children[i].childElementCount; j++) {

                    //document.getElementById("footer").innerHTML += typeof tbody.children[i].children[j].childNodes[0].nodeValue;
                    if (tbody.children[i].children[j].childNodes[0] == undefined) {
                        continue;


                    }else {
                        var td = tbody.children[i].children[j].childNodes[0].nodeValue.toLowerCase();
                        if (txt == td) {
                            tbody.children[i].setAttribute("class", "table-dark");
                        }
                    }

                }
            }
        }

    }

    function clearRow(parent) {
        parent.firstElementChild.value = "";
        var tbody = document.getElementsByTagName("tbody")[0];
        for (var i = 0; i < tbody.childElementCount; i++) {
            tbody.children[i].removeAttribute("class");
        }
    }
    </script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
