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
  // echo "<br>";
  // print_r ($copy);
?>
<!-- will
[2,4]*[2,6]+[sss];

array_instrect(array[1],array[2]);
[2]+[sss]=[dssdfdsf] -->
