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


$query = "SELECT documents.R_id, documents.name, documents.active FROM documents";
$result = mysqli_query($dbc, $query);
while($row = mysqli_fetch_array($result)){
  echo '<label class="checkbox-inline">';
    if($row['active']==1){
    echo'<input name="documents[]" type="checkbox" change="0" value="'.$row[R_id].' ">'.$row['name'];
  }else{
    echo'<input name="documents[]" type="checkbox" checked="true" change="0" value="'.$row[R_id].'">'.$row['name'];
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



?>
