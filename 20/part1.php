<?php

$input = trim(file_get_contents("input"));

$blockedIPs = array();

foreach (explode("\n", $input) as $line) {
    $parts = explode("-", $line);
    $blockedIPs[] = array(intval($parts[0]), intval($parts[1]));
}

usort($blockedIPs, function($IP1, $IP2) { return $IP1[0] > $IP2[0]; });

$currentMax = 0;

foreach ($blockedIPs as $index => $range) {
    if ($range[0] > $currentMax + 1) {
        echo $currentMax + 1;
        die();
    }

    $currentMax = max($currentMax, $range[1]);
}