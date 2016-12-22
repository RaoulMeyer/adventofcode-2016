<?php

$input = trim(file_get_contents("input"));

$nodes = array();

foreach (explode("\n", $input) as $line) {
    if (substr($line, 0, 1) !== '/') {
        continue;
    }

    $parts = array_values(array_filter(explode(" ", $line)));

    $coords = explode("-", $parts[0]);
    $x = intval(substr($coords[1], 1));
    $y = intval(substr($coords[2], 1));

    if ($y === 0) {
        echo "\n";
    }

    $size = intval(substr($parts[1], 0, -1));
    $used = intval(substr($parts[2], 0, -1));
    $avail = intval(substr($parts[3], 0, -1));
    $percentage = intval(substr($parts[4], 0, -1));

    $nodes[] = array($x, $y, $size, $used, $avail, $percentage);
    if ($used == 0) {
        echo 'O';
    } elseif ($x === 31 && $y === 0) {
        echo 'T';
    } elseif ($used <= 89) {
        echo '.';
    } else {
        echo '#';
    }
}