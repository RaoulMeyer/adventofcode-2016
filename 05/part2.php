<?php

$input = trim(file_get_contents("input"));

$output = array();

$allowedChars = array('0', '1', '2', '3', '4', '5', '6', '7');

$increment = 0;
while(count($output) < 8) {
    while(substr(md5($input . $increment), 0, 5) !== '00000') {
        $increment++;
    }

    $position = substr(md5($input . $increment), 5, 1);
    $letter = substr(md5($input . $increment), 6, 1);

    if (in_array($position, $allowedChars, true) && !isset($output[$position])) {
        $output[$position] = $letter;
    }

    $increment++;
}

ksort($output);

echo implode("", $output);