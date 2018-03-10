<?php


function printResult($result){
  if(empty($result[0])){
    echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>';
    foreach($data_array as $d){
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

function act(){
  include 'invertedindexfunctions.php';

  $data_array = explode(",", $_POST['search']);
  simplesearch($data_array);
  printResult(simplesearch($data_array));
}

act();
?>
