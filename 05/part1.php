<?php

$input = file_get_contents("input");

$output = '';

$increment = 0;
for ($i = 0; $i < 8; $i++) {
    while(substr(md5('ojvtpuvg' . $increment), 0, 5) !== '00000') {
        $increment++;
    }

    $output .= substr(md5('ojvtpuvg' . $increment), 5, 1);
    $increment++;
}

echo $output;
