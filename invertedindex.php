<?php
    function buildInvertedIndex($filenames)
    {
      include 'connect.php';
        $invertedIndex = [];
        $stoplist = file_get_contents('stoplist.txt');
        $stop = preg_replace("/[']+/",' ',trim($stoplist));
        foreach($filenames as $filename)
        {
            $data = file_get_contents($filename);
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
                echo 'one of the files name is already used<br />';
                echo mysqli_error();
            }

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
            $main = getcwd();
            list($garbage,$newfile) = explode('/',$filename);
            $newfile = $main.'/data'.'/'.$newfile;
            $filename = $main.'/'.$filename;
            echo $file;
            rename($filename,$newfile);
        }

        foreach($invertedIndex as $word => $value)
        {
            $files=0;
            $checker=0;
            $firstid=0;
            $currentid=0;
            foreach($invertedIndex[$word] as $fileid => $value){
                $files++;
                if($checker==0){
                    $stmt = $dbc->prepare("INSERT INTO postingfile (fileid,hits) VALUES (?,?)");
                    $stmt->bind_param("ii",$fileid,$invertedIndex[$word][$fileid]);
                    $stmt->execute();
                    $affected_rows =mysqli_stmt_affected_rows($stmt);
                    if($affected_rows == 1){
                        $dbc->commit();

                    }else{
                        echo 'Error Occurred3<br />';
                        echo mysqli_error();
                    }
                }else{
                    $stmt = $dbc->prepare("INSERT INTO postingfile (fileid,hits,nextid) VALUES (?,?,?)");
                    $stmt->bind_param("iii",$fileid,$invertedIndex[$word][$fileid],$currentid);
                    $stmt->execute();
                    $affected_rows =mysqli_stmt_affected_rows($stmt);
                    if($affected_rows == 1){
                        $dbc->commit();
                        // echo 'added with succses';
                    }else{
                        echo 'Error Occurred4<br />';
                        echo mysqli_error();
                    }
                }
                $stmt = $dbc->prepare("SELECT id FROM `postingfile` WHERE id = @@Identity");
                //$stmt->bind_param("s",$filename);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->fetch();
                $myrow = $result->fetch_assoc();
                $currentid=$myrow['id'];
                //echo "<p>".$word."->".$filename."->".$invertedIndex[$word][$filename]."</p>";
                if($checker==0){
                    $firstid=$currentid;
                }
                $checker=1;
            }
            mysqli_begin_Transaction($dbc);
            $stmt = $dbc->prepare("INSERT INTO invertedindex (word,hits,postingid) VALUES (?,?,?)");
            $stmt->bind_param("sii",$word,$files,$currentid);
            $stmt->execute();
            $affected_rows =mysqli_stmt_affected_rows($stmt);
            if($affected_rows == 1){
                $dbc->commit();
                // echo 'added with succses';
            }else{
                $dbc->rollback();
                $stmt = $dbc->prepare("SELECT postingid FROM `invertedindex` WHERE word = ?");
                $stmt->bind_param("s",$word);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->fetch();
                $myrow = $result->fetch_assoc();
                $postingid=$myrow['id'];
                $stmt = $dbc->prepare("update postingfile set nextid =?  where id = ?");
                $stmt->bind_param("ii", $postingid, $firstid);
                $stmt->execute();
                $affected_rows =mysqli_stmt_affected_rows($stmt);
                if($affected_rows == 1){
                    $dbc->commit();

                }else{

                    echo 'Error Occurred<br />';
                    echo mysqli_error();
                }
                $stmt = $dbc->prepare("update invertedindex set postingid =?,hits=hits+?  where word = ?");
                $stmt->bind_param("iis", $currentid,$files, $word);
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

        }
            $dbc->close();
            $stmt->close();
    }
?>
