<?php

$input = trim(file_get_contents("input"));

$x = 1;
$y = 1;

$targetX = 31;
$targetY = 39;

$squareQueue = array();
array_unshift($squareQueue, array($x, $y, 0));

$alreadyProcessed = array();

while (true) {
    $currentSquare = array_pop($squareQueue);

    if ($currentSquare[0] === $targetX && $currentSquare[1] === $targetY) {
        echo $currentSquare[2];
        die();
    }

    foreach (findValidAdjacentSquares($currentSquare[0], $currentSquare[1], $input) as $square) {
        if (isset($alreadyProcessed[$square[0] . ',' . $square[1]])) {
            continue;
        }
        $alreadyProcessed[$square[0] . ',' . $square[1]] = true;

        $square[2] = $currentSquare[2] + 1;
        array_unshift($squareQueue, $square);
    }
}

function findValidAdjacentSquares($x, $y, $input) {
    $validSquares = array();
    if (isValidSquare($x + 1, $y, $input)) {
        $validSquares[] = array($x + 1, $y, -1);
    }
    if (isValidSquare($x, $y + 1, $input)) {
        $validSquares[] = array($x, $y + 1, -1);
    }
    if (isValidSquare($x - 1, $y, $input)) {
        $validSquares[] = array($x - 1, $y, -1);
    }
    if (isValidSquare($x, $y - 1, $input)) {
        $validSquares[] = array($x, $y - 1, -1);
    }

    return $validSquares;
}

function isValidSquare($x, $y, $input) {
    if ($x < 0 || $y < 0) {
        return false;
    }

    $temp = $x*$x + 3*$x + 2*$x*$y +$y + $y*$y + $input;

    return substr_count(strval(decbin($temp)), "1") % 2 === 0;
}