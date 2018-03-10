<?php
include 'connect.php';
if(isset($_POST['documents'])){
  foreach ($_POST['documents'] as $key => $value) {
    $query="UPDATE documents SET active=$value WHERE R_id=$key";
     $result = mysqli_query($dbc, $query);
  }
}
?>
