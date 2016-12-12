<?php

$input = file_get_contents("input");

$lines = explode("\n", $input);

$register = array(
    'a' => 0,
    'b' => 0,
    'c' => 0,
    'd' => 0
);

for ($line = 0; isset($lines[$line]); $line++) {
    $words = explode(" ", trim($lines[$line]));

    if ($words[0] === 'cpy') {
        if (ctype_digit($words[1])) {
            $register[$words[2]] = $words[1];
        } else {
            $register[$words[2]] = $register[$words[1]];
        }
    }

    if ($words[0] === 'inc') {
        $register[$words[1]]++;
    }
    if ($words[0] === 'dec') {
        $register[$words[1]]--;
    }

    if ($words[0] === 'jnz') {
        $continue = false;
        if (ctype_digit($words[1])) {
            if ($words[1] != 0) {
                $continue = true;
            }
        } else {
            if ($register[$words[1]] != 0) {
                $continue = true;
            }
        }

        if ($continue) {
            $line += $words[2] - 1;
        }
    }
}

echo $register['a'];