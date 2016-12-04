<?php

$input = file_get_contents("input");

$possibleRooms = explode("\n", $input);

foreach ($possibleRooms as $room) {
    $parts = explode("-", $room);

    $lastPart = array_pop($parts);

    list($id, $checksum) = explode("[", $lastPart);
    $checksum = str_replace("]", "", trim($checksum));
    $roomName = implode("", $parts);

    $counts = array_count_values(str_split($roomName));
    arsort($counts);

    $letterPerCount = array();

    foreach ($counts as $letter => $count) {
        $letterPerCount[$count][] = $letter;
    }

    krsort($letterPerCount);

    $counts = array();

    foreach ($letterPerCount as $count => $letters) {
        sort($letters);
        foreach ($letters as $letter) {
            $counts[] = $letter;
        }
    }

    $counts = array_slice($counts, 0, 5, true);

    $actualChecksum = implode("", $counts);

    if ($checksum === $actualChecksum) {
        $decodedRoomName = str_rot(implode(" ", $parts), $id);
        if (strpos($decodedRoomName, 'north') !== false) {
            echo $id;
        }
    }
}

function str_rot($s, $n) {
    static $letters = 'abcdefghijklmnopqrstuvwxyz';
    $n = (int)$n % 26;
    if (!$n) return $s;
    if ($n < 0) $n += 26;
    $rep = substr($letters, $n) . substr($letters, 0, $n);
    return strtr($s, $letters, $rep);
}