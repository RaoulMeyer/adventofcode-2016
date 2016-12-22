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

    $size = intval(substr($parts[1], 0, -1));
    $used = intval(substr($parts[2], 0, -1));
    $avail = intval(substr($parts[3], 0, -1));
    $percentage = intval(substr($parts[4], 0, -1));

    $nodes[] = array($x, $y, $size, $used, $avail, $percentage);
}

$foundPairs = 0;

foreach ($nodes as $possiblyViableNode) {
    foreach ($nodes as $otherNode) {
        if ($possiblyViableNode[0] === $otherNode[0] && $possiblyViableNode[1] === $otherNode[1]) {
            continue;
        }

        if ($possiblyViableNode[3] === 0) {
            continue;
        }

        if ($possiblyViableNode[3] > $otherNode[4]) {
            continue;
        }

        $foundPairs++;
    }
}

echo $foundPairs;