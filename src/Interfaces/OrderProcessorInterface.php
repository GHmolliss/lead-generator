<?php

declare(strict_types=1);

namespace LeadGenerator\Interfaces;

use LeadGenerator\Lead;

interface OrderProcessorInterface
{
    public function process(Lead $lead): void;
}