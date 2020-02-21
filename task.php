<?php

function call_api_a()
{
    yield 'break point 1';
    sleep(2);
    yield 'response';
    var_dump('response');
}


$api_a = call_api_a();
$api_a->send(null);
$api_a->send(null);
