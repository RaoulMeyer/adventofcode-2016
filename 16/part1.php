<?php

$input = trim(file_get_contents("input"));

$diskLength = 272;

$output = $input;

while (strlen($output) < $diskLength) {
    $reverse = str_replace('x', '1', str_replace('1', '0', str_replace('0', 'x', strrev($output))));
    $output .= '0' . $reverse;
}

$checksum = substr($output, 0, $diskLength);

while(strlen($checksum) % 2 == 0) {
    $pairs = str_split($checksum, 2);
    $checksum = '';
    foreach ($pairs as $pair) {
        if (substr_count($pair, '1') == 1) {
            $checksum .= '0';
        } else {
            $checksum .= '1';
        }
    }
}

var_dump($checksum);