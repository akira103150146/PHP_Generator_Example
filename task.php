<?php

class Scheduler
{
    protected SplQueue $taskQueue;

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    public function addTask(Generator $coroutine)
    {
        $this->taskQueue->enqueue($coroutine);
    }

    public function run()
    {
        $start = microtime(true);

        while ( ! $this->taskQueue->isEmpty()) {
            /** @var Generator $task */
            $task = $this->taskQueue->dequeue();
            $task->send(null);

            if ($task->valid()) {
                $this->taskQueue->enqueue($task);
            }
        }

        echo 'time: ' . (microtime(true) - $start) . PHP_EOL;
    }
}

$scheduler = new Scheduler();

function call_api_a() {
    $start = microtime(true);
    echo 'start_a' . PHP_EOL;

    while (microtime(true) - $start < 2) {
        yield;
    }

    yield 'response_a';
    var_dump('response_a');
}

function call_api_b() {
    $start = microtime(true);
    echo 'start_b' . PHP_EOL;

    while (microtime(true) - $start < 4) {
        yield;
    }

    yield 'response_b';
    var_dump('response_b');
}

function call_api_c() {
    $start = microtime(true);
    echo 'start_c' . PHP_EOL;

    while (microtime(true) - $start < 6) {
        yield;
    }

    yield 'response_c';
    var_dump('response_c');
}

$scheduler->addTask(call_api_a());
$scheduler->addTask(call_api_b());
$scheduler->addTask(call_api_c());

$scheduler->run();

