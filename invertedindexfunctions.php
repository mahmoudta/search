<?php

    function lookupWord($word,$without)
    {
        include 'connect.php';
    $empty=0;
        $query = "SELECT * FROM invertedindex WHERE word='".$word."'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
    if(is_array($row)){
        $run = $row['hits'];
        $currentid = $row['postingid'];
    }else{
        $empty=1;
    }


    if($empty==0){
        $i=0;
        while($run != 0){
            $query1 = "SELECT postingfile.fileid, postingfile.hits, postingfile.nextid, documents.name , documents.title, documents.description
                        FROM postingfile
                        INNER JOIN documents ON postingfile.id =$currentid and documents.R_id =postingfile.fileid";
            $result1 = mysqli_query($dbc, $query1);
            $row1 = mysqli_fetch_array($result1);
            if(is_array($row)){
                $finalresult[$i]=array('name' => $row1['name'], 'hits' => $row1['hits'], 'title' => $row1['title'], 'description' => $row1['description']);
                $i++;
            }
            $currentid = $row1['nextid'];
            $run--;
        }
        return $finalresult;
    }
    else{
         return false;
    }

    }
function simplesearch($string)
{
    preg_match_all('/(\w+)/', $string, $words, PREG_SET_ORDER);
    $i=0;
    foreach($words as $word){
        $word = strtolower($word[0]);
        $array[$i]=lookupWord($word,0);
        $i++;
    }
    print_r($array);
}
    simplesearch("will act a love");
    
    
    
    
    
    
    
//    foreach(['Thank', 'NOTE', 'circumstance', 'TERMS'] as $word)
//    {
//        $word = strtolower($word);
//        $matches = lookupWord($invertedIndex, $word);
//        if($matches !== false)
//        {
//            echo "<p>Found the word \"$word\" in the following files: " . implode(', ', $matches) . "</p>";
//        }
//        else
//        {
//            echo "<p>Unable to find the word \"$word\" in the index</p>";
//        }
//    }
?>
