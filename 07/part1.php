<?php

$input = file_get_contents("input");

$ips = explode("\n", $input);

$tlsIps = 0;

foreach ($ips as $ip) {
    $ip = trim($ip);
    $filteredIp = trim(preg_replace('@\[.*?\]@', " ", $ip));

    preg_match_all('@\[.*?\]@', $ip, $matches);
    foreach ($matches[0] as $match) {
        if (containsAbba($match)) {
            continue 2;
        }
    }

    if (containsAbba($filteredIp)) {
        $tlsIps++;
    }
}

echo $tlsIps;

function containsAbba($word) {
    $letters = str_split($word);
    for ($i = 0; isset($letters[$i + 3]); $i++) {
        if ($letters[$i] == $letters[$i + 3] && $letters[$i + 1] == $letters[$i + 2] && $letters[$i] != $letters[$i + 1]) {
            return true;
        }
    }
}
