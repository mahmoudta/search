<?php
include 'connect.php';
include 'invertedindex.php';
include 'config.php';
session_start();
  if(!isset($_SESSION['user'])){
    header('location:'.URL);
    exit();
}
if($_GET['parse']){getfiles();}
function getfiles(){
$dir = getcwd().'/source'.'/';
$files = scandir($dir);
$size =count($files);
$cleanarray = [];
foreach ($files as $key => $value) {
  if($value !="." && $value != ".." && $value != ".DS_Store"){
    $cleanarray[] = 'source/'.$value;
  }
}
if($cleanarray){
buildInvertedIndex($cleanarray);
}else{
  echo "No Files To add";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Advent+Pro" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Final project</title>

  <!-- Bootstrap -->
  <link href="include/css/bootstrap.min.css" rel="stylesheet">
  <link href="include/style.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<header>
  <nav>
    <div class="brand">
        <span>Search Engine</span>
    </div>
    <div class="form">
      <form action=" " method="post" id="search-post">
        <div class="form-inputs">
        <input class="form-control" type="text" id="search" placeholder="Search here">
        <button class="btn btn-default" type="submit" name="search-button">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </div>
      </form>
    </div>
    <div class="user">
      <?php
      if(!isset($_SESSION['user'])){
        echo '<button name="sign-in-button"><span class="glyphicon glyphicon-log-in"></span> Log in</button>';
      }else{
        echo '<button name="sign-out-button"><span class="glyphicon glyphicon-log-in"></span> Log out</button>';
      }
       ?>
    </div>
    <div class="sign-in">
      <form class="form-horizontal" action="/" method="post">
        <div class="form-group row ">
          <label class="control-label col-sm-3" for="username">Username:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Enter username" name="username">
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3" for="password">Password:</label>
          <div class="col-sm-8">
            <input type="password" class="form-control"  placeholder="Enter password" name="password">
          </div>
        </div>

        <div class="form-group row ">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </nav>
  <div class="advanced-search">
    <button >Advanced Search</button>
  </div>
</header>
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
