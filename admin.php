<?php
include 'connect.php';
include 'config.php';
session_start();
  if(!isset($_SESSION["user"])){
    header('location:'.URL);
    exit();
}
if($_GET['parse']){getfiles();}
function getfiles(){
$dir = getcwd().'/Source'.'/';
echo $dir."\n";
$files = scandir($dir);
print_r($files);
//echo $files;
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>

    <link href="include/css/bootstrap.min.css" rel="stylesheet">
    <link href="include/style.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
  <button type="button" id="Parse" name="Parse" onclick='location.href="?parse=1"'> Parse new files</button>
  <div id="files">
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="include/js/bootstrap.min.js"></script>
<script src="include/main.js"></script>
  </body>
</html>
