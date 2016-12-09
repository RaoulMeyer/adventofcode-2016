<?php

$input = file_get_contents("input");

echo processData($input);

function processData($string) {
    if (strpos($string, "(") === false) {
        return strlen($string);
    }

    $firstNextBracket = strpos($string, "(");
    $firstNextClosingBracket = strpos($string, ")");
    $outputLength = $firstNextBracket;

    list($size, $count) = explode("x", substr($string, $firstNextBracket + 1, $firstNextClosingBracket - $firstNextBracket - 1));

    $subOutputLength = processData(substr($string, $firstNextClosingBracket + 1, $size));
    $outputLength += $count * $subOutputLength;

    $remainingString = substr($string, $firstNextClosingBracket + $size + 1);

    return $outputLength + processData($remainingString);
}