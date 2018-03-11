<?php
    
    function inwichfils($word){
        include 'connect.php';
        $empty=0;
        $query = "SELECT id FROM `invertedindex` WHERE word='".$word."'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        if(is_array($row)){
            $currentid = $row['id'];
        }else{
            $empty=1;
        }
        
        if($empty==0){
            $alldocs=[];
            $query1 = "SELECT postingfile.fileid
            FROM postingfile
            INNER JOIN documents ON postingfile.wordid=$currentid AND documents.active=1 ";
            $result1 = mysqli_query($dbc, $query1);
            while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                $alldocs[$row1['fileid']]=$row1['fileid'];
                
            }
            $dbc->close();
            
            return array_keys($alldocs);
        }else{
            $dbc->close();
            return false;
        }
        
    }
    function alldoclist(){
        include 'connect.php';
        $totaldocs=[];
        $query = "SELECT R_id FROM documents where active=1";
        $result1 = mysqli_query($dbc, $query);
        while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
            $totaldocs[]=$row1['R_id'];
        }
        $dbc->close();
        return $totaldocs;
    }
    
    function relativewords($word){
        include 'connect.php';
        $words=[];
        $query = "SELECT word FROM invertedindex
        WHERE word LIKE '".$word."'";
        $result1 = mysqli_query($dbc, $query);
        while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
            $words[]=$row1['word'];
        }
        $dbc->close();
        return $words;
    }
    
    function lookupWord($word,$searchin)
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
            $alldocs=[];
            $query1 = "SELECT postingfile.fileid, postingfile.tf, documents.name, documents.description, documents.title
            FROM postingfile
            INNER JOIN documents ON postingfile.wordid=$currentid and documents.R_id =postingfile.fileid and documents.active=1 ";
            $result1 = mysqli_query($dbc, $query1);
            while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                $idf=round(1 + log($totaldocnumbers/$docnumbers),9);
                $finalresult[$row1['fileid']]=round($idf*$row1['tf'],9);
                $alldocs[]=array('fileid'=>$row1['fileid'],'name'=>$row1['name'],'title'=>$row1['title'],'description'=>$row1['description']);
                
                }
            $dbc->close();
            $docs=[];
            foreach($finalresult as $doc=>$val){
                $docs[]=$doc;
            }
            //print_r ($alldocs);
            $array=array(0=>$idf,1=>$finalresult,2=>$alldocs);
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
        arsort($rankedarray);
       return $rankedarray;
    }
    function search($words,$searchin=0)
    {
        
        $searchwords=[];
        $wordidf=[];
        $totalcount=0;
        $wordsweight=[];
        $alldocs=[];
        foreach($words as $word){
            $totalcount++;
            if(!array_key_exists($word, $searchwords)){
                $array=lookupWord($word,$searchin);
                $wordidf[$word]=$array[0];
                $searchwords[$word]=1;
                if (!empty($array[2])){
                    $allresult[$word]=$array[1];
                    $alldocs=array_unique(array_merge($alldocs,$array[2]), SORT_REGULAR);
                    
                }else
                    $allresult[$word]=[];
                
                
            }
            else
                $searchwords[$word]++;

        }
        $newalldocs=[];
        foreach($alldocs as  $key=>$value )
        $newalldocs[$value['fileid']]=$value;
        
        foreach( $searchwords as $word=>$count)
            $wordsweight[$word]=round(($count/$totalcount)*$wordidf[$word],9);
        
        //$allresult of each word with the file list and its weight
        //$alldocs list of all the used docs
        //$wordsweight the weight of each word in Query

        $ranked=ranking($allresult,array_keys($newalldocs),$wordsweight);
        $array=array(0=>$ranked,1=>$newalldocs);
        return $array;
    }
    
    function  simplesearch($words){
        $data = file_get_contents('stoplist.txt');
        preg_match_all('/(\w+)/', $data, $matches, PREG_SET_ORDER);
        $stoplist=[];
        foreach($matches as $match)
        $stoplist=array_unique(array_merge($stoplist,$match), SORT_REGULAR);
        $newwordlist=[];
        foreach($words as $word){
            $lastchar=substr($word, -1,1);
            $firstchar=substr($word, 0,1);
            if((!in_array($word,$stoplist,TRUE))){
                
                if( (($firstchar=="'")&&($lastchar=="'")) ||(($firstchar=='"')&&($lastchar=='"')) ){
                    $word=substr($word, 1,strlen($word)-2);
                }
                
                $newwordlist[]=$word;
                
            }
            
        }
        
        $array=search($newwordlist);
        return $array;
    }
    
    function andfunc($arr1,$arr2){
        return array_intersect($arr1,$arr2);
    }
    function orfunc($arr1,$arr2){
        return array_unique(array_merge($arr1,$arr2), SORT_REGULAR);
    }
    
    function advancedsearch($strings){
        
        //$totaldocs=alldoclist();
        foreach($strings as key $string){
            //echo $string;
        }
        
        //$arr1=inwichfils('act');
        //$arr2=inwichfils('tree');
        
    }
    
    //advancedsearch();
    function wildecard($words){
        $allwords=[];
        foreach($words as $word){
            if(strpos($word,'%')!=FALSE)
                $allwords=array_merge($allwords,relativewords($word));
            else
                $allwords=array_merge($allwords,array($word));
        }
        $array=simplesearch($allwords);
        return $array;
    }

    //simplesearch(array('will','act','his','all'));
    //simplesearch(array('will','act','"his"','all'));
    //simplesearch(array('hit','act','"his"','all'));
    //wildecard(array('ac%','act','"all"','hit','will'));
?>
