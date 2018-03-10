<?php

    function lookupWord($word,$without)
    {
        include 'connect.php';
        $empty=0;
        $query = "SELECT * FROM `invertedindex` WHERE word='".$word."'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        if(is_array($row)){
            $currentid = $row['id'];
            $docnumbers=$row['hits'];
        }else{
        $empty=1;
        }
        
        $query = "SELECT COUNT(*) AS totaldocnumbers FROM documents";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        if(is_array($row)){
            $totaldocnumbers= $row['totaldocnumbers'];
        }
        if($empty==0){
            $i=0;
            $finalresult=[];
            $query1 = "SELECT postingfile.fileid, postingfile.tf
            FROM postingfile
            INNER JOIN documents ON postingfile.wordid=$currentid and documents.R_id =postingfile.fileid ";
            $result1 = mysqli_query($dbc, $query1);
            while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                $idf=round(1 + log($totaldocnumbers/$docnumbers),9);
                $finalresult[$row1['fileid']]=round($idf*$row1['tf'],9);
                }
            $dbc->close();
            $docs=[];
            foreach($finalresult as $doc=>$val){
                $docs[]=$doc;
            }
            $array=array(0=>$idf,1=>$finalresult,2=>$docs);
            return $array;
        }else{
            $dbc->close();
            return false;
        }
    }
    function ranking($allresult,$alldocs,$wordsweight)
    {

        $rankedarray=[];
        $query=0;
        foreach($wordsweight as $word=>$value)
            $query+=round(pow($value, 2),9);
        $query=round(sqrt($query),9);
        foreach($alldocs as $doc){
            $dot=0;
            $doccal=0;
            foreach($wordsweight as $word=>$value){
                $dot+=($value*$allresult[$word][$doc]);
                $doccal+=round(pow($allresult[$word][$doc], 2),9);
            }
            $doccal=round(sqrt($doccal),9);
            
            $rankedarray[$doc]=round($dot/($doccal*$query),9);
        }
       return $rankedarray;
    }
    function simplesearch($string)
    {

        preg_match_all('/(\w+)/', $string, $words, PREG_SET_ORDER);
        $searchwords=[];
        $wordidf=[];
        $totalcount=0;
        $wordsweight=[];
        $alldocs=[];
        foreach($words as $word){
            $totalcount++;
            $word = strtolower($word[0]);
            if(!array_key_exists($word, $searchwords)){
                $array=lookupWord($word,0);
                $allresult[$word]=$array[1];
                $wordidf[$word]=$array[0];
                $alldocs=array_unique(array_merge($alldocs,$array[2]), SORT_REGULAR);
                $searchwords[$word]=1;
                
            }
            else
                $searchwords[$word]++;
            
        }
        foreach( $searchwords as $word=>$count)
            $wordsweight[$word]=round(($count/$totalcount)*$wordidf[$word],9);
        //$allresult of each word with the file list and its weight
        //$alldocs list of all the used docs
        //$wordsweight the weight of each word in Query
        ranking($allresult,$alldocs,$wordsweight);
         //print_r($allresult);
    }
    
   
    function testranking(){
        $allresult=array('life'=>array(1=>0.140550715,2=>0.200786736),'learning'=>array(1=>0.140550715,3=>0.468502384));
            $alldocs=array(0=>1,1=>2,2=>3);
            $wordsweight=array('life'=>0.702753576,'learning'=>0.702753576);
        ranking($allresult,$alldocs,$wordsweight);
    }
    //testranking();
    simplesearch("will a act");
?>
