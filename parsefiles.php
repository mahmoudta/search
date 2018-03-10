<?php
include 'invertedindex.php';
if($_POST['parse']){getfiles();}
function getfiles(){
$dir = getcwd().'/source'.'/';
$files = scandir($dir);
$size =count($files);
$cleanarray = [];
foreach ($files as $key => $value) {
  if($value !="." && $value != ".." && $value != ".DS_Store"){
    $cleanarray[] = 'source/'.$value;
  }
}
if($cleanarray){
  $message = count($cleanarray);
  echo "adding ".$message." documents";
buildInvertedIndex($cleanarray);
}else{
  $message='No documents To add';
  echo $message;
}
}
?>
