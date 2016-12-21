<?php

$input = trim(file_get_contents("input"));

$text = str_split('abcdefgh');

foreach (explode("\n", $input) as $line) {
    $words = explode(" ", trim($line));

    $text = array_values($text);

    switch ($words[0]) {
        case 'swap':
            if ($words[1] === 'position') {
                $a = intval($words[2]);
                $b = intval($words[5]);
                $temp = $text[$a];
                $text[$a] = $text[$b];
                $text[$b] = $temp;
            } else {
                $a = trim($words[2]);
                $b = trim($words[5]);
                $textString = implode("", $text);
                $textString = str_replace(" ", $a, str_replace($a, $b, str_replace($b, " ", $textString)));
                $text = str_split($textString);
            }
            break;
        case 'rotate':
            if ($words[1] === 'based') {
                $index = array_search(trim($words[6]), $text);
                $rotations = $index + 1;
                if ($index >= 4) {
                    $rotations++;
                }
                for ($i = 0; $i < $rotations % count($text); $i++) {
                    array_unshift($text, array_pop($text));
                }
            } else {
                if ($words[1] === 'left') {
                    for ($i = 0; $i < intval($words[2]); $i++) {
                        array_push($text, array_shift($text));
                    }
                } else {
                    for ($i = 0; $i < intval($words[2]); $i++) {
                        array_unshift($text, array_pop($text));
                    }
                }
            }
            break;
        case 'reverse':
            $from = intval($words[2]);
            $to = intval($words[4]);
            $textString = implode("", $text);
            $substring = substr($textString, $from, $to - $from + 1);
            $textString = str_replace($substring, strrev($substring), $textString);
            $text = str_split($textString);
            break;
        case 'move':
            $from = intval($words[2]);
            $to = intval($words[5]);
            $item = array_splice($text, $from, 1);
            array_splice($text, $to, 0, $item);
            break;
    }
}

echo implode("", $text);