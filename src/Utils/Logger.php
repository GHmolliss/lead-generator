<?php

declare(strict_types=1);

namespace LeadGenerator\Utils;

use LeadGenerator\Helpers\PathHelper;

final class Logger
{
    private static $isLogOrderGeneratePath = false;

    public static function log(string $message): void
    {
        if (!self::$isLogOrderGeneratePath) {
            self::createLogPath(PathHelper::getLogOrderGeneratePath());
            self::$isLogOrderGeneratePath = true;
        }

        file_put_contents(PathHelper::getLogOrderGeneratePath(), $message . PHP_EOL, FILE_APPEND);
    }

    private static function createLogPath(string $path): void
    {
        $dirPath = dirname($path);

        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
        }
    }
}
