<?php

$input = trim(file_get_contents("input"));

$previousAnswer = 2;

for($i = 4; $i <= $input; $i++) {
    $previousAnswer = ($previousAnswer + 1 ) % ($i - 1);
    if($previousAnswer >= floor($i / 2)) $previousAnswer++;
}

echo $previousAnswer;
