<?php

$input = file_get_contents("input");

$ips = explode("\n", $input);

$tlsIps = 0;

foreach ($ips as $ip) {
    $ip = trim($ip);
    $filteredIp = trim(preg_replace('@\[.*?\]@', "  ", $ip));

    preg_match_all('@\[.*?\]@', $ip, $matches);

    $foundBabs = containsAba($filteredIp);
    if (!empty($foundBabs)) {
        foreach ($foundBabs as $bab) {
            foreach ($matches[0] as $hypernet) {
                if (strpos($hypernet, $bab) !== false) {
                    $tlsIps++;
                    continue 3;
                }
            }
        }
    }
}

echo $tlsIps;

function containsAba($word) {
    $matches = array();

    $letters = str_split($word);
    for ($i = 0; isset($letters[$i + 2]); $i++) {
        if ($letters[$i] == $letters[$i + 2] && $letters[$i] != $letters[$i + 1]) {
            $matches[] = $letters[$i + 1] . $letters[$i] . $letters[$i + 1];
        }
    }

    return $matches;
}
