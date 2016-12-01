<?php

$input = file_get_contents("input");

$moves = array_map(
    function($move) { return trim($move); },
    explode(",", $input)
);

$finalPosition = getPosition($moves);

$distance = abs($finalPosition[0]) + abs($finalPosition[1]);

echo $distance;

function getPosition($moves, $x = 0, $y = 0, $direction = 0) {
    if (empty($moves)) {
        return array($x, $y);
    }

    $move = array_shift($moves);
    $turn = substr($move, 0, 1);
    $amount = substr($move, 1);

    if ($turn === 'R') {
        $direction += 90;
    } else {
        $direction -= 90;
    }

    if ($direction < 0) {
        $direction += 360;
    }

    $direction = $direction % 360;

    if ($direction === 0) {
        $y += $amount;
    } elseif ($direction === 90) {
        $x += $amount;
    } elseif ($direction === 180) {
        $y -= $amount;
    } else {
        $x -= $amount;
    }

    return getPosition($moves, $x, $y, $direction);
}