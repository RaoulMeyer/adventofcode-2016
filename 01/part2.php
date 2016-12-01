<?php

$input = file_get_contents("input");

$moves = array_map(
    function($move) { return trim($move); },
    explode(",", $input)
);

$finalPosition = getPosition($moves);

$distance = abs($finalPosition[0]) + abs($finalPosition[1]);

echo $distance;

function getPosition($moves, $passedPositions = array(), $x = 0, $y = 0, $direction = 0) {
    if (empty($moves)) {
        return array($x, $y);
    }

    $oldX = $x;
    $oldY = $y;

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

    $newPassedPositions = getPassedPositions($oldX, $oldY, $x, $y);

    foreach ($newPassedPositions as $newPassedPosition) {
        foreach ($passedPositions as $passedPosition) {
            if ($newPassedPosition[0] == $passedPosition[0] && $newPassedPosition[1] == $passedPosition[1]) {
                return $newPassedPosition;
            }
        }
    }

    $passedPositions = array_merge($passedPositions, $newPassedPositions);

    return getPosition($moves, $passedPositions, $x, $y, $direction);
}

function getPassedPositions($oldX, $oldY, $x, $y) {
    $positions = array();
    if ($oldX > $x || $oldY > $y) {
        for ($i = $y; $i <= $oldY; $i++) {
            for ($j = $x; $j <= $oldX; $j++) {
                $positions[] = array($j, $i);
            }
        }
    } else {
        for ($i = $oldY; $i <= $y; $i++) {
            for ($j = $oldX; $j <= $x; $j++) {
                $positions[] = array($j, $i);
            }
        }
    }

    foreach ($positions as $index => $position) {
        if ($position[0] === $oldX && $position[1] === $oldY) {
            unset($positions[$index]);
            break;
        }
    }

    return $positions;
}