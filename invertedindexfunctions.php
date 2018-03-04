<?php
    
include 'connect.php';


function lookupWord($invertedIndex, $word)
{
    return array_key_exists($word, $invertedIndex) ? $invertedIndex[$word] : false;
}


    
    foreach(['Thank', 'NOTE', 'circumstance', 'TERMS'] as $word)
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
?>
