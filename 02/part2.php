<?php

$input = file_get_contents("input");

$numbers = explode("\n", $input);

$positionToNumber = array(
    array(
        null,
        null,
        5,
        null,
        null,
    ),
    array(
        null,
        2,
        6,
        'A',
        null
    ),
    array(
        1,
        3,
        7,
        'B',
        'D'
    ),
    array(
        null,
        4,
        8,
        'C',
        null
    ),
    array(
        null,
        null,
        9,
        null,
        null
    )
);

$startX = 0;
$startY = 2;

foreach ($numbers as $number) {
    list($x, $y) = getNumber(str_split($number), $startX, $startY);
    echo $positionToNumber[$x][$y];
    $startX = $x;
    $startY = $y;
}

function getNumber($moves, $x, $y) {
    if (empty($moves)) {
        return array($x, $y);
    }
    $move = array_shift($moves);

    $xEdge = abs(2 - $y);
    $yEdge = abs(2 - $x);

    if ($move === 'U') {
        $y = max($yEdge, $y - 1);
    } elseif ($move === 'D') {
        $y = min(4 - $yEdge, $y + 1);
    } elseif ($move === 'L') {
        $x = max($xEdge, $x - 1);
    } elseif ($move === 'R') {
        $x = min(4 - $xEdge, $x + 1);
    }

    return getNumber($moves, $x, $y);
}