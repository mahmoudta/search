<?php
include 'connect.php';


  session_start();
  if(!isset($_SESSION["name"]))
    header('Location:'.URL.'index.php');


 ?>
