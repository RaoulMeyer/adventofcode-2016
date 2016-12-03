<?php

$input = file_get_contents("input");

$possibleTriangles = explode("\n", $input);

echo count(array_filter($possibleTriangles, function($possibleTriangle) {
    $s = array_values(array_filter(explode(" ", $possibleTriangle), function($side) { return !empty($side); }));

    return ($s[0] + $s[1]) > $s[2] && ($s[0] + $s[2]) > $s[1] && ($s[1] + $s[2]) > $s[0];
}));

