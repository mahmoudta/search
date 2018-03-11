<?php
include 'connect.php';
include 'invertedindex.php';
include 'config.php';
session_start();
  if(!isset($_SESSION['user'])){
    header('location:'.URL);
    exit();
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
  <div class="container-fluid">
    <nav>
      <div class="brand">
          <span>Search Engine</span>
      </div>
      <div class="myform">
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
      <button id="advanced">Admin advanced Tools</button>
    </div>
  </div>

</header>
<body>
  <div class="container">
<div class="col-xs-12 " id="advanced_tools">
  <span>Tools:</span>
  <div class="col-xs-12" id="admin-tools">
  <button class="btn btn-primary" type="button" id="Parse" name="Parse"> Parse new files</button>
  <label></label>
  <div class="col-xs-12 hide-document">
  <span><b>check the documents you want to hide:</b></span>
  <form action="" method="post" id="hiding">
<?php
$query = "SELECT documents.R_id, documents.name, documents.active FROM documents";
$result = mysqli_query($dbc, $query);
while($row = mysqli_fetch_array($result)){
  echo '<label class="checkbox-inline">';
    if($row['active']==1){
    echo'<input name="documents[]" type="checkbox" change="0" value="'.$row[R_id].' ">'.$row['name'];
  }else{
    echo'<input name="documents[]" type="checkbox" checked="true" change="0" value="'.$row[R_id].'">'.$row['name'];
  }
  echo'</label>';
}
?>
<button class="btn btn-danger" class="col-md-1 col-md-offset-1" type="submit" name="hide"> hide document</button>
<span id="message"></span>
 </form>
   <hr>
</div>
</div>
<span>Advanced Search:</span>
<form class="form form-inline" action="" method="post" id="advancedsearch">
  <div class="form-group col-xs-12">
    <label class="col-xs-3" for="operand">OPERANDS SEARCH:</label>
    <input type="text" class="form-control col-xs-6" id="operand" name="operand" placeholder=" ( term And term ) OR term">
      <button type="submit" class="btn btn-default col-xs-2 col-xs-offset-1">Search</button>
  </div>
</form>

<form class="form form-inline" method="post" id="wildSearch" action="">
<div class="form-group col-xs-12">
  <label class="col-xs-3" for="wildcard">WILDCARD SEARCH:</label>
  <input type="text" class="form-control col-xs-6" id="wildcard" name="wildcard" placeholder=" term*">
    <button type="submit" class="btn btn-default col-xs-2 col-xs-offset-1">Search</button>
</div>
</form>
</div>

  <div id="result">
  </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="include/js/bootstrap.min.js"></script>
<script src="include/main.js"></script>


<?php
mysqli_free_result($result);

mysqli_close($dbc);
?>
  </body>
</html>
