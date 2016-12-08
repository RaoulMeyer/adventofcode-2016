<?php

$input = file_get_contents("input");

$instructions = explode("\n", $input);

$screen = new Screen(50, 6);

foreach ($instructions as $instruction) {
    if (strpos($instruction, "column") !== false) {
        $temp = explode("=", $instruction);
        $parts = explode(" ", $temp[1]);
        $screen->rotateColumn($parts[0], $parts[2]);
    } else if (strpos($instruction, "row") !== false) {
        $temp = explode("=", $instruction);
        $parts = explode(" ", $temp[1]);
        $screen->rotateRow($parts[0], $parts[2]);
    } else {
        $temp = explode(" ", $instruction);
        $parts = explode("x", $temp[1]);
        $screen->rect($parts[0], $parts[1]);
    }
}

echo $screen->getPixelsLit();

class Screen {

    private $data;

    public function __construct($width, $height) {
        for ($i = 0; $i < $width; $i++) {
            $column = array();
            for ($j = 0; $j < $height; $j++) {
                $column[] = false;
            }
            $this->data[] = $column;
        }
    }

    public function getPixelsLit() {
        $lit = 0;
        foreach ($this->data as $column) {
            foreach ($column as $pixel) {
                if ($pixel) {
                    $lit++;
                }
            }
        }

        return $lit;
    }

    public function rect($width, $height) {
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $this->data[$i][$j] = true;
            }
        }
    }

    public function rotateColumn($columnNumber, $amount) {
        for ($i = 0; $i < $amount; $i++) {
            $lastItem = array_pop($this->data[$columnNumber]);
            array_unshift($this->data[$columnNumber], $lastItem);
        }
    }

    public function rotateRow($rowNumber, $amount) {
        $row = array();
        foreach ($this->data as $column) {
            $row[] = $column[$rowNumber];
        }

        for ($i = 0; $i < $amount; $i++) {
            $lastItem = array_pop($row);
            array_unshift($row, $lastItem);
        }

        foreach ($this->data as $columnNumber => $column) {
            $this->data[$columnNumber][$rowNumber] = $row[$columnNumber];
        }
    }
}