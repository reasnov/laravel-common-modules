<?php

declare(strict_types=1);

namespace Modules\Shared\Traits;

use Illuminate\Support\Facades\Log;

trait Loggable
{
    /**
     * Log a debug message to the 'shared' channel.
     */
    protected function logDebug(string $message, array $context = []): void
    {
        Log::channel('shared')->debug($message, $context);
    }

    /**
     * Log an info message to the 'shared' channel.
     */
    protected function logInfo(string $message, array $context = []): void
    {
        Log::channel('shared')->info($message, $context);
    }

    /**
     * Log a warning message to the 'shared' channel.
     */
    protected function logWarning(string $message, array $context = []): void
    {
        Log::channel('shared')->warning($message, $context);
    }

    /**
     * Log an error message to the 'shared' channel.
     */
    protected function logError(string $message, array $context = []): void
    {
        Log::channel('shared')->error($message, $context);
    }

    /**
     * Log a critical message to the 'shared' channel.
     */
    protected function logCritical(string $message, array $context = []): void
    {
        Log::channel('shared')->critical($message, $context);
    }
}
