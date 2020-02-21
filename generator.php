<?php
function gen() {
    $ret = (yield 'yield1');
    var_dump('FIRST: ' . $ret);
    $ret = (yield 'yield2');
    var_dump('SECOND: ' . $ret);
}

$gen = gen();
var_dump($gen->current());   
$gen->send('TEST1'); 
var_dump($gen->current());   
var_dump($gen->current());                        
// $gen->send('TEST2'); 
                            