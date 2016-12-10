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

                if ($words[5] == 'bot') {
                    if (!isset($chipByBot[$words[6]])) {
                        $chipByBot[$words[6]] = array();
                    }
                    array_unshift($chipByBot[$words[6]], $low);
                } else {
                    if (!isset($output[$words[6]])) {
                        $output[$words[6]] = array();
                    }
                    array_unshift($output[$words[6]], $low);
                }

                if ($words[10] == 'bot') {
                    if (!isset($chipByBot[$words[11]])) {
                        $chipByBot[$words[11]] = array();
                    }
                    array_unshift($chipByBot[$words[11]], $high);
                } else {
                    if (!isset($output[$words[11]])) {
                        $output[$words[11]] = array();
                    }
                    array_unshift($output[$words[11]], $high);
                }

                if (!empty($output[0]) && !empty($output[1]) && !empty($output[2])) {
                    echo $output[0][0] * $output[1][0] * $output[2][0] . "\n";
                    die();
                }
            }
        }
    }
}
