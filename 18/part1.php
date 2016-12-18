<?php

$input = trim(file_get_contents("input"));

$row = $input;

$safeTiles = 0;

for ($i = 0; $i < 40; $i++) {
    $safeTiles += substr_count($row, '.');
    $newRow = buildNewRow($row);

    $row = $newRow;
}

echo $safeTiles;

function buildNewRow($row) {
    $newRow = '';
    for ($pos = 0; $pos < strlen($row); $pos++) {
        $leftIsTrap = isset($row[$pos - 1]) && $row[$pos - 1] == '^';
        $rightIsTrap = isset($row[$pos + 1]) && $row[$pos + 1] == '^';

        if (($leftIsTrap && !$rightIsTrap) || ($rightIsTrap && !$leftIsTrap)) {
            $newRow .= '^';
        } else {
            $newRow .= '.';
        }
    }

    return $newRow;
}