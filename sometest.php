<?php
include 'invertedindexfunctions.php';

 $expression = 'will * ( act + divine ) + will';
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
  $query= "SELECT * from documents where documents.R_id='$value'";
  $result = mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($result);
  echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a target="_blank" href="'.$row['name'].'"><h3>';
  echo $row['title']."</h3></a><p>".$row['description']."</p></div>";
}}else{
  echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>';
  foreach($search as $d){
       echo $d." " ;
  }
  echo '</b></p></div>';
}
?>
