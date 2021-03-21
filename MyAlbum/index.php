<?php session_start(); ?>
<?php error_reporting(0); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="https://github.com/coach01/">
    <meta name="generator" content="Sublime Text 3">
    <title>My Album · Bootstrap v5.0</title>

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
    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
          <?php if(isset($_COOKIE["user"]) || isset($_SESSION["user"])):?>
            <li><a href="logout.php" class="text-white">Logout</a></li>                
          <?php else: ?>        
            <li><a href="login.php" class="text-white">Login</a></li>
          <?php endif; ?>
            <li><a href="mailto:example@example.ex" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="index.php" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Album
          <?php if(isset($_COOKIE["user"])) echo " User : ". $_COOKIE["user"];?>
          <?php if(isset($_SESSION["user"])) echo " User : ". $_SESSION["user"];?> 
        </strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>
        <div class="row">
           <div class="col">
                <?php 
                 if(isset($_GET['status']) && !empty($_GET['status'])){
                    if($_GET['upload'] == "yes"){
                      echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
                            <strong>Success!</strong> ".$_GET['status']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button
                             </div>";

                    }else{
                      echo "<div class='alert alert-danger alert-dismissible fade show'  role='alert'>
                            <strong>Error : </strong> ".$_GET['status']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button
                             </div>";
                    }                  
                 }
            
            ?>
            </div>
        </div>
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
        <?php if(isset($_COOKIE["user"]) || isset($_SESSION["user"])):?>
         <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#toolModal" onmousedown="setForm()">Create New</button>               
        <?php else: ?>        
          <a href="login.php" class="btn btn-success my-2"> Signin</a>
        <?php endif; ?>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
<?php 
  $fieldinfo = "";
  $conn = new mysqli("localhost","root","","myalbum");
  $sql = "SELECT * FROM albums ORDER BY AlbumDateTime DESC";
  if ($result = $conn->query($sql)) {
      $fieldinfo=$result->fetch_fields();
      //print_r($fieldinfo);

      while ($row = $result -> fetch_assoc()) {
        echo '<div class="col">';
        echo '<div class="card shadow-sm">';
        echo '<div class="bd-placeholder-img card-img-top" role="img" aria-label="Placeholder: Thumbnail">';
        echo "<img src='images/".$row[$fieldinfo[3]->name]."' alt ='".$row[$fieldinfo[3]->name]."' width='100%' height='225'/>";
        echo "</div>";
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row[$fieldinfo[1]->name].'</h5>';
         echo '<p class="card-text">'.substr($row[$fieldinfo[2]->name], 0,150).'</p>';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo "<div class='btn-group' id='".$row[$fieldinfo[0]->name]."''>";
        if(isset($_COOKIE["user"]) || isset($_SESSION["user"])):        
        echo "<a href='process.php?process=Delete&albumid=".$row[$fieldinfo[0]->name]."&imgName=".$row[$fieldinfo[3]->name]."' type='button' class='btn btn-sm btn-outline-secondary'>Delete</a>";
        echo '<button type="button" data-bs-toggle="modal" data-bs-target="#toolModal" class="btn btn-sm btn-outline-secondary" onmousedown="loadAlbum('.$row[$fieldinfo[0]->name].')">Edit</button>';
        endif;
        echo '</div>';
        $writentime=strtotime($row[$fieldinfo[4]->name]);
        echo '<small class="text-muted"> Date: '.date("M d Y").'</small>';   
        echo '</div>';
        echo '</div>';
        echo '</div>';        
        echo '</div>';
      }                
  }
  $conn->close();
 
?>

      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="toolModal" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="toolModalLabel">Create - Update Album</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form id="toolForm" action="process.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="albumid" class="form-label">AlbumID</label>
              <input type="text" class="form-control" name="albumid" id="albumid">
            </div>
            <div class="mb-3">
              <label for="albumhead" class="form-label">Album Head</label>
              <input type="text" class="form-control" id="albumhead" name="albumhead" required>
            </div>
            <div class="mb-3">
              <label for="albumcontent" class="form-label">Album Content - <small>Max:145 Charachters </small></label>
              <textarea class="form-control" id="albumcontent" name="albumcontent" rows="5" required maxlength="145"></textarea>
            </div>
            <div class="mb-3">
              <label for="albumimage" class="form-label">Album Image</label>
              <input type="file" class="form-control" id="albumimage" name="albumimage">
            </div>          
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
        <input  type="submit" name="process" value="Update" form="toolForm">
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col" id="printArea">
  </div>
</div>
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>

    <script type="text/javascript">

    function loadAlbum(txt) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            updateForm(obj);
        }
      };
      xhttp.open("POST", "process.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("process=fetch&albumid=" + txt);
    }

     function updateForm(obj) {
        var newForm = document.getElementById("toolForm");          

        newForm.getElementsByTagName("input")[0].readOnly = true;
        newForm.getElementsByTagName("input")[2].removeAttribute("required"); 


        for (let i = 0; i < obj.length; i++) {
            if(i != obj.length-1)
             newForm.getElementsByTagName("input")[i].value = "";
            else
             newForm.getElementsByTagName("textarea")[0].innerHTML = "";
        }
        for (let i = 0; i < obj.length; i++) {
            if(i != obj.length-1)
             newForm.getElementsByTagName("input")[i].value = obj[i];
            else
             newForm.getElementsByTagName("textarea")[0].innerHTML = obj[i];
        }
        document.querySelector(".modal-footer").lastElementChild.value = "Update";
        document.querySelector(".modal-footer").lastElementChild.className = "btn btn-success";
    }
    function setForm() {
        var newForm = document.getElementById("toolForm");
        newForm.getElementsByTagName("input")[0].readOnly = true;

        var att = document.createAttribute("required"); 
        att.value = "required"; 
        newForm.getElementsByTagName("input")[2].setAttributeNode(att); 


        for (let i = 0; i < 3; i++) {
          if(i != 2)
            newForm.getElementsByTagName("input")[i].value = "";
          else
            newForm.getElementsByTagName("textarea")[0].innerHTML = "";
        }

        document.querySelector(".modal-footer").lastElementChild.value = "Create";
        document.querySelector(".modal-footer").lastElementChild.className = "btn btn-primary";


    }
    </script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
