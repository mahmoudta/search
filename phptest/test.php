<?php
    
    function buildInvertedIndex($filenames)
    {
        $invertedIndex = [];
        
        foreach($filenames as $filename)
        {
            $data = file_get_contents($filename);
            
            if($data === false) die('Unable to read file: ' . $filename);
            
            preg_match_all('/(\w+)/', $data, $matches, PREG_SET_ORDER);
            
            foreach($matches as $match)
            {
                $word = strtolower($match[0]);
                
                if(!array_key_exists($word, $invertedIndex)){ $invertedIndex[$word] = [];}
                if(!array_key_exists($filename, $invertedIndex[$word])) {
                    //$invertedIndex[$word][]= $filename;
                    $invertedIndex[$word][$filename]= [];
                    $invertedIndex[$word][$filename]= 1;
                }else{$invertedIndex[$word][$filename]++;}
            }
        }
        
        return $invertedIndex;
    }

function lookupWord($invertedIndex, $word)
{
    return array_key_exists($word, $invertedIndex) ? $invertedIndex[$word] : false;
}

$invertedIndex = buildInvertedIndex(['file1.txt','file2.txt']);
    
    foreach(['beat', 'used', 'show', 'already'] as $word)
    {
        $word = strtolower($word);
        $matches = lookupWord($invertedIndex, $word);
        if($matches !== false)
        {
            echo "<p>Found the word \"$word\" in the following files: " . implode(', ', $matches) . "</p>";
        }
        else
        {
            echo "<p>Unable to find the word \"$word\" in the index</p>";
        }
    }
    
    foreach($invertedIndex as $word => $value)
    {
        foreach($invertedIndex[$word] as $filename => $value){
            echo "<p>".$word."->".$filename."->".$invertedIndex[$word][$filename]."</p>";
        }
        
    }
?>
