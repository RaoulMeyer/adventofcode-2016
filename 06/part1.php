<?php

$input = file_get_contents("input");

$occurencesPerLetter = array();

foreach (explode("\n", $input) as $word) {
    $letters = str_split(trim($word));
    foreach ($letters as $position => $letter) {
        if (!isset($occurencesPerLetter[$position][$letter])) {
            $occurencesPerLetter[$position][$letter] = 0;
        }

        $occurencesPerLetter[$position][$letter]++;
    }
}

foreach ($occurencesPerLetter as $occurences) {
    echo array_search(max($occurences), $occurences);
}