<?php

function read_file(string $filename) {
    $file = fopen($filename, 'r');

    while(! feof($file)) {
        yield fgets($file);
    }
    fclose($file);
}

foreach (read_file('test.abc') as $line) {
    echo $line . PHP_EOL;
}