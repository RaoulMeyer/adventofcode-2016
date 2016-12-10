<?php

$input = file_get_contents("input");

$chipByBot = array();

foreach (explode("\n", $input) as $line) {
    if (strpos($line, "goes") !== false) {
        $words = explode(" ", $line);
        if (!isset($chipByBot[$words[5]])) {
            $chipByBot[$words[5]] = array();
        }
        $chipByBot[$words[5]][] = $words[1];
    }
}

$output = array();

while (true) {
    foreach (explode("\n", $input) as $line) {
        if (strpos($line, "goes") === false) {
            $words = explode(" ", $line);

            if (count($chipByBot[$words[1]]) >= 2) {
                sort($chipByBot[$words[1]]);

                $low = array_shift($chipByBot[$words[1]]);
                $high = array_pop($chipByBot[$words[1]]);

                if ($low == 17 && $high == 61) {
                    echo $words[1] . "\n";
                    die();
                }

                if ($words[5] == 'bot') {
                    if (!isset($chipByBot[$words[6]])) {
                        $chipByBot[$words[6]] = array();
                    }
                    array_unshift($chipByBot[$words[6]], $low);
                }

                if ($words[10] == 'bot') {
                    if (!isset($chipByBot[$words[11]])) {
                        $chipByBot[$words[11]] = array();
                    }
                    array_unshift($chipByBot[$words[11]], $high);
                }
            }
        }
    }
}
