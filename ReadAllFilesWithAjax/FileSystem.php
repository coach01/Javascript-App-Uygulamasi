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
        <h1>Read File</h1>
        <hr/>
        <form action="" method="">
            <div class="form-group">
                <label for="name">Select file (*.txt):</label>
                <select class="form-control" id="name" name="name" onchange="showContent(this.value)" >                   
                    <option>Select file</option>
<?php // little php for files
$files = glob("*.txt");
for ($i=0; $i < count($files); $i++) { 
    echo "<option value='".$files[$i]."'>".$files[$i]."</option>";
}
?>
                </select>
            </div>
        </form>
        <div class="row">
            <div class="col" id="printArea">
            </div>
        </div>

        <div id="demo"></div>
    </div>
    <script>

    var counter = 0;
        function showContent(file) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    printContent(this.responseText, file);
                }
            };
            xhttp.open("GET", file, true);
            xhttp.send();
            xhttp = null;

        }
    function printContent(content, file) {

            file = file.slice(0, file.length - 4);
            file = file.toUpperCase();

            var header = document.createElement("h2");
            var textnode = document.createTextNode(file);
            header.appendChild(textnode);
            document.getElementById("printArea").appendChild(header);

            var arr = content.split("\n");

            var para = document.createElement("p");
            for (var i = 0; i < arr.length; i++) {
              var textnode = document.createTextNode(arr[i]);
              para.appendChild(textnode);
              var br = document.createElement("br");
              para.appendChild(br);
            }

            var typ = document.createAttribute("id");
            typ.value = "text" + counter.toString();
            para.attributes.setNamedItem(typ);
            document.getElementById("printArea").appendChild(para);

            counter++;
    }

    </script>
</body>
</html>
