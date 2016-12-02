<?php

$input = file_get_contents("input");

$numbers = explode("\n", $input);

$positionToNumber = array(
    array(
        1,
        4,
        7,
    ),
    array(
        2,
        5,
        8
    ),
    array(
        3,
        6,
        9
    )
);

$startX = 1;
$startY = 1;

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

    if ($move === 'U') {
        $y = max(0, $y - 1);
    } elseif ($move === 'D') {
        $y = min(2, $y + 1);
    } elseif ($move === 'L') {
        $x = max(0, $x - 1);
    } elseif ($move === 'R') {
        $x = min(2, $x + 1);
    }

    return getNumber($moves, $x, $y);
}