<?php
include 'connect.php';
$query = "SELECT * FROM `invertedindex` WHERE word='".$_POST['search']."'";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if(is_array($row)){
  $run = $row['hits'];
  $currentid = $row['postingid'];
}else{
  echo "<p>No Files Found</p>";
}



while($run != 0){
  $query1 = "SELECT postingfile.fileid, postingfile.nextid, documents.name , documents.title, documents.description
  FROM postingfile
  INNER JOIN documents ON postingfile.id =$currentid and documents.R_id =postingfile.fileid";
  $result1 = mysqli_query($dbc, $query1);
  $row1 = mysqli_fetch_array($result1);
  if(is_array($row1)){
    echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a href="'.$row1[name].'"><h3>';
    echo $row1['title']."</h3></a><p>".$row1['description']."</p></div>";
  }
  $currentid = $row1['nextid'];
  $run--;
}

?>
