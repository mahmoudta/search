<?php
include 'connect.php';
include 'invertedindexfunctions.php'

if(isset($_POST['search'])){
  $data = explode(",", $_POST['search']);
  printResult(simplesearch($data));
}

function printResult($result){
  if(emty($result[0])){
    echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>';
    foreach($data as $d){
         echo $d;
    }
    echo '</b></p></div>';

  }else{
      foreach ($result[0] as $key => $value) {
          echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a href="'.$result[1][$key]['name'].'"><h3>';
          echo $result[1][$key]['title']."</h3></a><p>".$result[1][$key]['description']."</p></div>";
      }
}/*else*/
}
?>
