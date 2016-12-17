<?php

$input = trim(file_get_contents("input"));

$_GET['shortest'] = 10000;

tryAllMoves($input, '', 0, 0);
echo $_GET['shortest_path'];

function tryAllMoves($input, $currentPath, $x, $y) {
    if (strlen($currentPath) > $_GET['shortest']) {
        return;
    }

    if ($x === 3 && $y === 3) {
        if (strlen($currentPath) <= $_GET['shortest']) {
            $_GET['shortest'] = strlen($currentPath);
            $_GET['shortest_path'] = $currentPath;
        }
        return;
    }

    $hash = md5($input . $currentPath);
    list($up, $down, $left, $right) = movesPossible($hash, $x, $y);

    if ($up) {
        tryAllMoves($input, $currentPath . 'U', $x, $y - 1);
    }
    if ($down) {
        tryAllMoves($input, $currentPath . 'D', $x, $y + 1);
    }
    if ($left) {
        tryAllMoves($input, $currentPath . 'L', $x - 1, $y);
    }
    if ($right) {
        tryAllMoves($input, $currentPath . 'R', $x + 1, $y);
    }
}

function movesPossible($hash, $x, $y) {
    $hashChars = str_split($hash);
    $up = $down = $left = $right = false;
    $possibleMoves = array('b', 'c', 'd', 'e', 'f');

    if (in_array($hashChars[0], $possibleMoves) && $y > 0) {
        $up = true;
    }
    if (in_array($hashChars[1], $possibleMoves) && $y < 3) {
        $down = true;
    }
    if (in_array($hashChars[2], $possibleMoves) && $x > 0) {
        $left = true;
    }
    if (in_array($hashChars[3], $possibleMoves) && $x < 3) {
        $right = true;
    }

    return array($up, $down, $left, $right);
}