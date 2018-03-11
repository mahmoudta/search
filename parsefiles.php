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
  //echo "adding ".$message." documents";
buildInvertedIndex($cleanarray);

include 'connect.php';
$query111 = "SELECT documents.R_id, documents.name, documents.active FROM documents";
$result111= mysqli_query($dbc, $query111);
while($row6 = mysqli_fetch_array($result111)){
  echo '<label class="checkbox-inline">';
    if($row6['active']==1){
    echo'<input name="documents[]" type="checkbox" change="0" value="'.$row6["R_id"].' ">'.$row6["name"];
  }else{
    echo'<input name="documents[]" type="checkbox" checked="true" change="0" value="'.$row6["R_id"].'">'.$row6['name'];
  }
  echo'</label>';
}
echo '<button class="btn btn-danger" class="col-md-1 col-md-offset-1" type="submit" name="hide"> hide document</button>';
echo'<span id="message"></span>';

}else{
  $message='No documents To add';
  echo $message;
}
}


mysqli_close($dbc);
?>
