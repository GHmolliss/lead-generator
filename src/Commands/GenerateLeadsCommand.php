<?php

declare(strict_types=1);

namespace LeadGenerator\Commands;

require_once __DIR__ . '/../../vendor/autoload.php';

use LeadGenerator\Generator;
use LeadGenerator\Lead;
use LeadGenerator\Services\OrderProcessor;

pcntl_async_signals(true);

$generator = new Generator();
$orderProcessor = new OrderProcessor();

$maxProcesses = 50;
$activeProcesses = 0;

$generator->generateLeads(10000, function (Lead $lead) use ($orderProcessor, &$activeProcesses, $maxProcesses) {
    while ($activeProcesses >= $maxProcesses) {
        pcntl_wait($status);
        pcntl_signal_dispatch();

        $activeProcesses--;

        usleep(10000);
    }

    $pid = pcntl_fork();

    echo "pid={$pid}" . PHP_EOL;

    if ($pid === -1) {
        die('could not fork');
    } elseif ($pid) {
        $activeProcesses++;
    } else {
        echo "start leadId={$lead->id}" . PHP_EOL;

        $orderProcessor->process($lead);

        echo "end leadId={$lead->id}" . PHP_EOL;

        exit(0);
    }
});

while ($activeProcesses > 0) {
    pcntl_wait($status);
    pcntl_signal_dispatch();

    $activeProcesses--;
}
