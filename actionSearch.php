<?php
include 'connect.php';
$query = "SELECT * FROM `invertedindex` WHERE word='".$_POST['search']."'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if(is_array($row)){
  $run = $row['hits'];
  $currentid = $row['id'];
}else{
   echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><p>No results found for <b>'.$_POST['search'].'</b></p></div>';
}

$query1 = "SELECT postingfile.fileid, postingfile.hits, documents.name, documents.title, documents.description
FROM postingfile
INNER JOIN documents ON postingfile.wordid=$currentid and documents.R_id =postingfile.fileid ";
$result1 = mysqli_query($dbc, $query1);
// $row1 = mysqli_fetch_array($result1);

while ($row1 = mysqli_fetch_array($result1)) {
  echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a href="'.$row1['name'].'"><h3>';
  echo $row1['title']."</h3></a><p>".$row1['description']."</p></div>";
}

  // if(is_array($row1)){
  //   echo '<div class="col-xs-12 col-md-7 col-md-offset-2"><a href="'.$row1['name'].'"><h3>';
  //   echo $row1['title']."</h3></a><p>".$row1['description']."</p></div>";
  // }
  // $currentid = $row1['nextid'];
  // $run--;
// }

?>
