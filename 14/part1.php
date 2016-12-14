<?php

$input = trim(file_get_contents("input"));

$keys = array();

$i = 0;
while (count($keys) < 64) {
    $hash = str_split(md5Cached($input . $i));

    for ($pos = 0; isset($hash[$pos + 2]); $pos++) {
        if ($hash[$pos] === $hash[$pos + 1] && $hash[$pos + 1] === $hash[$pos + 2]) {
            $char = $hash[$pos];
            for ($j = 1; $j <= 1000; $j++) {
                $testHash = md5Cached($input . ($i + $j));

                if (strpos($testHash, str_repeat($char, 5)) !== false) {
                    $keys[$i] = array(implode("", $hash), $testHash, $char);
                    break 2;
                }
            }
            break;
        }
    }

    $i++;
}

echo $i - 1;

function md5Cached($input) {
    if (isset($_GET[$input])) {
        return $_GET[$input];
    }

    $_GET[$input] = md5($input);

    return md5($input);
}