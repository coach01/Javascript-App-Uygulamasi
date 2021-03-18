<!DOCTYPE html>
<html lang="en">
<head>
    <title>File System</title>
    <meta charset="utf-8">
    <meta name="author" content="https://github.com/coach01">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h2>File System</h2>
        <p>Create Update Read and Delete file</p>

        <form id="frm01" class="form-inline" action="processFile.php" method="POST">
          <label for="name" class="mr-sm-2">New file name (*.txt):</label>
          <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter file name" id="name" name="name">
          <button type="submit" class="btn btn-primary" name="process" value="create">Create File</button>
        </form>
        <hr/>
        <form id="frm02" action="processFile.php" method="POST">
            <div class="form-group">
                <label for="name">Select file (*.txt):</label>
                <select class="form-control" id="name" name="name" onchange="showContent(this.value)" >                   
                    <option>Select file</option>
<?php 
$files = glob("*.txt");
for ($i=0; $i < count($files); $i++) { 
    echo "<option value='".$files[$i]."'>".$files[$i]."</option>";
}
?>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" rows="10" id="content" name="content"></textarea>
             </div>
            <div class="form-group float-right">
                <button type="submit" class="btn btn-danger"  name="process" value="delete">Delete File</button>
                <button type="submit" class="btn btn-success" name="process" value="update">Update File</button>

             </div>          

        </form>
    </div>
    <script>

        function showContent(txt) {
            var query = "process=fetch&name=" + txt;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML=this.responseText;

                }
            };
            xhttp.open("POST", "processFile.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(query);
        }

    </script>
</body>
</html>
