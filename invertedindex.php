<?php
    
    function buildInvertedIndex($filenames)
    {
        include 'connect.php';
        $invertedIndex = [];
        
        foreach($filenames as $filename)
        {
            $data = file_get_contents($filename);
            
            if($data === false) die('Unable to read file: ' . $filename);
            
            preg_match_all('/(\w+)/', $data, $matches, PREG_SET_ORDER);
            
            foreach($matches as $match)
            {
                $word = strtolower($match[0]);
                mysqli_begin_Transaction($dbc);
                $stmt = $dbc->prepare("INSERT INTO invertedindex (word, matches) VALUES (?, ?)");
                $stmt->bind_param("ss", $word, $filename);
                $stmt->execute();
                $affected_rows =mysqli_stmt_affected_rows($stmt);
                
                if($affected_rows == 1){
                    $dbc->commit();
                   // echo 'added with succses';
                    
                }else{
                    //echo 'Error Occurred<br />';
                    //echo mysqli_error();
                    $dbc->rollback();
                    $query =("update invertedindex set matches = concat(matches,concat('|', $filename)) where word = $word");
                             $response = mysqli_query($dbc, $query);
                             if(!$response){
                                 echo 'Error Occurred<br />';
                                 echo mysqli_error();
                             }
                    
                }
                if(!array_key_exists($word, $invertedIndex)) $invertedIndex[$word] = [];
                if(!in_array($filename, $invertedIndex[$word], true)) $invertedIndex[$word][] = $filename;
            }
        }
    }
    buildInvertedIndex(['file1.txt','file2.txt']);

?>
