<?php

declare(strict_types=1);

namespace LeadGenerator\Helpers;

final class PathHelper
{
    public static function getRootPath(): string
    {
        return __DIR__ . '/../../';
    }

    public static function getLogPath(): string
    {
        return self::getRootPath() . 'var/logs/';
    }

    public static function getLogOrderGeneratePath(): string
    {
        return self::getLogPath() . 'orderGenerate/log.txt';
    }
}