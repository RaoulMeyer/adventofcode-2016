<?php

ini_set('memory_limit', '2G');

$input = file_get_contents("input");

$_GET['floorsAlreadyProcessed'] = array();

$floors = array(
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array()
);

foreach (explode("\n", $input) as $floor => $line) {
    $actualFloor = $floor + 1;
    $parts = explode("a ", $line);
    array_shift($parts);

    foreach ($parts as $part) {
        $part = trim(str_replace(" and", "", $part));
        $words = explode(" ", $part);

        $short = '';
        foreach ($words as $word) {
            $short .= strtoupper(substr($word, 0, 2));
        }

        $floors[$actualFloor][] = $short;
    }
}

var_dump($floors);

var_dump(tryAllMoves($floors));

function tryAllMoves($floors, $currentFloor = 1, $stepCount = 0, $preFloorsValue = 0, $prePreFloorsValue = 0) {

    if (empty($floors[1]) && empty($floors[2]) && empty($floors[3])) {
        return $stepCount;
    }

    $minStepCount = 1000000;

    $floorsHash = array_reduce(
        $floors,
        function($acc, $floor) {
            sort($floor);
            $floorHash = array_reduce($floor, function($acc, $part) {
                return $acc . $part;
            },
            '');
            return $acc . ',' . $floorHash;
        },
        ''
    );

    if (isset($_GET['floorsAlreadyProcessed'][$floorsHash])) {
        return $minStepCount;
    }

    $_GET['floorsAlreadyProcessed'][$floorsHash] = 1;

    $floorsValue = floorsValue($floors);

    $prePreFloorsValue = $preFloorsValue;
    $preFloorsValue = $floorsValue;

    $newFloors = array();

    foreach ($floors[$currentFloor] as $index => $item) {
        foreach ($floors[$currentFloor] as $otherIndex => $otherItem) {
            if ($otherIndex > $index) {
                list($lower, $higher) = generatePossibleFloors($floors, array($item, $otherItem), $currentFloor);
                if ($higher !== null) {
                    $newFloors[floorsValue($higher)][] = array($higher, true);
                }
                if ($lower !== null) {
                    $newFloors[floorsValue($lower)][] = array($lower, false);
                }
            }
        }

        list($lower, $higher) = generatePossibleFloors($floors, array($item), $currentFloor);
        if ($higher !== null) {
            $newFloors[floorsValue($higher)][] = array($higher, true);
        }
        if ($lower !== null) {
            $newFloors[floorsValue($lower)][] = array($lower, false);
        }
    }

    krsort($newFloors);

    foreach ($newFloors as $item) {
        foreach ($item as list($newFloor, $up)) {
            $direction = $up ? 1 : -1;
            $minStepCount = min($minStepCount, tryAllMoves($newFloor, $currentFloor + $direction, $stepCount + 1, $preFloorsValue, $prePreFloorsValue));
            if ($minStepCount < 1000000) {
                var_dump($minStepCount);
            }
        }
    }

    return $minStepCount;
}

function generatePossibleFloors($currentFloors, $items, $from) {
    $possibleFloors = array(
        0 => null,
        1 => null
    );

    if ($from != 1) {
        $newFloor = $currentFloors;

        foreach ($items as $item) {
            $pos = array_search($item, $newFloor[$from]);
            unset($newFloor[$from][$pos]);
            $newFloor[$from - 1][] = $item;
        }

        if (isValidFloors($newFloor)) {
            $possibleFloors[0] = $newFloor;
        }
    }

    if ($from != 4) {
        $newFloor = $currentFloors;

        foreach ($items as $item) {
            $pos = array_search($item, $newFloor[$from]);
            unset($newFloor[$from][$pos]);
            $newFloor[$from + 1][] = $item;
        }

        if (isValidFloors($newFloor)) {
            $possibleFloors[1] = $newFloor;
        }
    }

    return $possibleFloors;
}

function isValidFloors($floors) {
    foreach ($floors as $floor) {

        $generatorFound = false;

        foreach($floor as $item) {
            if (substr($item, 2, 2) === 'GE') {
                $generatorFound = true;
            }
        }

        if ($generatorFound) {
            foreach($floor as $item) {
                if (substr($item, 2, 2) === 'MI') {
                    if (array_search(substr($item, 0, 2) . 'GE', $floor) === false) {
                        return false;
                    }
                }
            }
        }
    }

    return true;
}

function floorsValue($floors) {
    return count($floors[1]) + 8 * count($floors[2]) + 32 * count($floors[3]) + 256 * count($floors[4]);
}