<?php
function logger($fileName) {
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}

$logger = logger('log');
$logger->send('Foo');
$logger->send('Bar');
//echo $logger->valid();
//$logger->send('exit');
