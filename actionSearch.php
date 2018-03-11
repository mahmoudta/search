<?php
include 'invertedindexfunctions.php';

if(isset($_POST['search'])){
  $data_array = explode(",", $_POST['search']);
  // simplesearch($data_array);
  printResult(simplesearch($data_array),$data_array);
}

if(isset($_POST['advancedsearch'])){
  $data_array = explode(",", $_POST['advancedsearch']);
  printResult(advancedsearch($data_array,$_POST['send']),$data_array);
}

if(isset($_POST['wildcard'])){
  $data_array = explode(",", $_POST['wildcard']);
  printResult(wildecard($data_array),$data_array);
}

function printResult($result,$search){
  if(empty($result[0])){
    echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>';
    foreach($search as $d){
         echo $d." " ;
    }
    echo '</b></p></div>';

  }else{
      foreach ($result[0] as $key => $value) {
          echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a target="_blank" href="'.$result[1][$key]['name'].'"><h3>';
          echo $result[1][$key]['title']."</h3></a><p>".$result[1][$key]['description']."</p></div>";
      }
}/*else*/
}

mysqli_free_result($result);
mysqli_close($dbc);

?>
