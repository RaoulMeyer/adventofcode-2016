<?php

$input = file_get_contents("input");

$possibleRooms = explode("\n", $input);

echo array_reduce(
    $possibleRooms,
    function($sum, $room) {
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
            $sum += $id;
        }

        return $sum;
    },
    0
);