<?php

declare(strict_types=1);

namespace LeadGenerator\Services;

use LeadGenerator\Interfaces\OrderProcessorInterface;
use LeadGenerator\Lead;
use LeadGenerator\Utils\Logger;
use Throwable;

final class OrderProcessor implements OrderProcessorInterface
{
    public function process(Lead $lead): void
    {
        try {
            sleep(2);

            Logger::log("{$lead->id} | {$lead->categoryName} | " . date('Y-m-d H:i:s'));
        } catch (Throwable $th) {
            // Обработка исключений
        }
    }
}