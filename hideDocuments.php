<?php
include 'connect.php';
if(isset($_POST['documents'])){
  $count=0;
  foreach ($_POST['documents'] as $key => $value) {
    $query="UPDATE documents SET active=$value WHERE R_id=$key";
     $result = mysqli_query($dbc, $query);
     $count++;
  }
  echo $count." Document/s has been updated";
}
?>
