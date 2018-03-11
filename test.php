<?php

function do_maths($expression) {
  eval('$o = ' . preg_replace('/[^0-9\+\-\*\/\(\)\.]/', '', $expression) . ';');
  return $o;
}

echo do_maths('(10*5)+5+(10*5)');


?>
