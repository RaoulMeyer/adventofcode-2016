<?php

ini_set('memory_limit', '1G');

$input = trim(file_get_contents("input"));

$presents = array();

for ($i = 0; $i < $input; $i++) {
    $presents[$i] = true;
}

while(true) {
    for ($i = 0; $i < $input; $i++) {
        if (!$presents[$i]) {
            continue;
        }

        $j = ($i + 1) % $input;
        while (!$presents[$j]) {
            $j = ($j + 1) % $input;
        }

        if ($j === $i) {
            echo $j + 1;
            die();
        }

        $presents[$j] = false;
    }
}