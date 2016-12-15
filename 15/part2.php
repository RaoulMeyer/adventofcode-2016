<?php

$input = trim(file_get_contents("input"));

$maxPos = 0;
$discs = array();
foreach (explode("\n", $input) as $line) {
    $words = explode(" ", $line);

    $discs[] = array(str_replace(".", "", $words[11]), $words[3]);
    $maxPos = max($maxPos, $words[3]);
}

$discs[] = array(0, 11);

$startTime = 0;
while (true) {
    $startTime++;

    $time = $startTime;
    foreach ($discs as $key => $disc) {
        $time++;
        if (($disc[0] + $time) % $disc[1] !== 0) {
            continue 2;
        }
    }
    echo $startTime;
    break;
}