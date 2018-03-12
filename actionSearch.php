<?php
include 'connect.php';
include 'invertedindexfunctions.php';

if(isset($_POST['search'])){
  $data_array = explode(",", $_POST['search']);
  // simplesearch($data_array);
  printResult(simplesearch($data_array),$data_array);
}

if(isset($_POST['advancedsearch'])){
  $data_array = explode(",", $_POST['advancedsearch']);
  $expression = implode(" ",$data_array);
  // $expression = 'will * ( act + divine ) + will';
 $copy = preg_split('/ /', $expression, -1 /*PREG_SPLIT_OFFSET_CAPTURE*/);
 $maincopy = $copy;
 $sign =array('*' , '-', '(', '+', ')', '[',']','{','}');


 // $words=[];
  foreach ($copy as $value) {
    if(!in_array($value,$sign)) {
       $words=inwichfils($value);
       $words = implode(" ",$words);
      $copy = str_replace($value,$words,$copy);
    }
  }

   $copy=check_qoutes_and_solve($copy);
   $copy = final_step_cal($copy);
 if(!empty($copy)){
   foreach ($copy as $value) {
   $query= "SELECT * from documents where documents.R_id= $value and documents.active=1";
   $result = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($result);
   echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a target="_blank" href="'.$row['name'].'"><h3>';
   echo $row['title']."</h3></a><p>".$row['description']."</p></div>";
 }}else{
   echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>';
   foreach($data_array as $d){
        echo $d." " ;
   }
   echo '</b></p></div>';
 }
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
