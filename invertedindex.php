<?php
    function buildInvertedIndex($filenames)
    {
      include 'connect.php';
        $invertedIndex = [];
        $stoplist = file_get_contents('stoplist.txt');
        $stop = preg_replace("/[']+/",' ',trim($stoplist));
        foreach($filenames as $filename)
        {
            $checker=0;
            $data = file_get_contents($filename);
            
            $main = getcwd();
            $oldfilename = $main.'/'.$filename;
            list($garbage,$newfile) = explode('/',$filename);/*newfile = text.html*/
            $newfile = 'data'.'/'.$newfile;
            $filename = $newfile;
            $newfil = $main.'/'.$newfile;
            rename($oldfilename,$newfile);
            
            //get title and description
            $start = strpos($data, '<p>');
            $end = strpos($data, '</p>', $start);
            $description = substr($data, $start, $end-$start+4);
            $description = html_entity_decode(strip_tags($description));

            $start = strpos($data, '<h1>');
            $end = strpos($data, '</h1>', $start);
            $title = substr($data, $start, $end-$start+4);
            $title = html_entity_decode(strip_tags($title));
            mysqli_begin_Transaction($dbc);
            $stmt = $dbc->prepare("INSERT INTO documents (name,title,description) VALUES (?,?,?)");
            $stmt->bind_param("sss",$filename,$title,$description);
            $stmt->execute();
            $affected_rows =mysqli_stmt_affected_rows($stmt);
            if($affected_rows == 1){
                $dbc->commit();
                // echo 'added with succses';
            }else{
                $dbc->rollback();
                echo 'file'.$filename.' is already used<br />';
                $checker=1;
                echo mysqli_error();
            }
            if($checker==0){
            $stmt = $dbc->prepare("SELECT `R_id` FROM `documents` WHERE `name` = ?");
            $stmt->bind_param("s",$filename);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->fetch();
            $myrow = $result->fetch_assoc();
            $Rid=$myrow['R_id'];


            //echo $stoplist;
            if($data === false) die('Unable to read file: ' . $filename);
            $data=strip_tags($data);
            preg_match_all('/(\w+)/', $data, $matches, PREG_SET_ORDER);

            foreach($matches as $match)
            {
                $word = strtolower($match[0]);
                if(strpos($stop,$word) === false){
                    if(!array_key_exists($word, $invertedIndex)){ $invertedIndex[$word] = [];}
                    if(!array_key_exists($Rid, $invertedIndex[$word])) {
                        $invertedIndex[$word][$Rid]= [];
                        $invertedIndex[$word][$Rid]= 1;
                    }else{$invertedIndex[$word][$Rid]++;}
                }
            }
            }
        }

        foreach($invertedIndex as $word => $value)
        {
            mysqli_begin_Transaction($dbc);
            $stmt = $dbc->prepare("INSERT INTO invertedindex (word,hits) VALUES (?,0)");
            $stmt->bind_param("s",$word);
            $stmt->execute();
            $affected_rows =mysqli_stmt_affected_rows($stmt);
            if($affected_rows == 1){
                $dbc->commit();
                // echo 'added with succses';
            }else{
                $dbc->rollback();
            }
            
            $stmt = $dbc->prepare("SELECT `id` FROM `invertedindex` WHERE `word` = ?");
            $stmt->bind_param("s",$word);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->fetch();
            $myrow = $result->fetch_assoc();
            $wordid=$myrow['id'];
            
            $files=0;
            foreach($invertedIndex[$word] as $fileid => $value){
                $files++;
                    $stmt = $dbc->prepare("INSERT INTO postingfile (fileid,hits,wordid) VALUES (?,?,?)");
                    $stmt->bind_param("iii",$fileid,$invertedIndex[$word][$fileid],$wordid);
                    $stmt->execute();
                    $affected_rows =mysqli_stmt_affected_rows($stmt);
                    if($affected_rows == 1){
                        $dbc->commit();

                    }else{
                        echo 'Error Occurred3<br />';
                        echo mysqli_error();
                    }
            }
            $stmt = $dbc->prepare("update invertedindex set hits=hits+?  where word = ?");
            $stmt->bind_param("is",$files, $word);
            $stmt->execute();
            $affected_rows =mysqli_stmt_affected_rows($stmt);
            if($affected_rows == 1){
                $dbc->commit();
                // echo 'added with succses';
                
            }else{
                
                echo 'Error Occurred0<br />';
                echo mysqli_error();
            }

        }
            $dbc->close();
            $stmt->close();
    }
?>
