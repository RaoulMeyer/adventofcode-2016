<?php

$input = file_get_contents("input");

$lines = explode("\n", $input);

$possibleTriangleTrios = array_chunk($lines, 3);

$actualTriangles = 0;

foreach ($possibleTriangleTrios as $possibleTriangleTrio) {
    $a = filterInput($possibleTriangleTrio[0]);
    $b = filterInput($possibleTriangleTrio[1]);
    $c = filterInput($possibleTriangleTrio[2]);

    for ($i = 0; $i < 3; $i++) {
        if (($a[$i] + $b[$i]) > $c[$i] && ($a[$i] + $c[$i]) > $b[$i] && ($b[$i] + $c[$i]) > $a[$i]) {
            $actualTriangles++;
        }
    }
}

echo $actualTriangles;

function filterInput($input) {
    return array_values(array_filter(explode(" ", $input), function($side) { return !empty($side); }));
}
