<?php

namespace Core;

use ErrorException;
use Throwable;

class ErrorHandler
{
    public static function handleError($level, $message, $file, $line): void
    {
        $exception = new ErrorException($message, 0, $level, $file, $line);
        self::handleException($exception);
    }
    //also stores the error in the error log
    public static function handleException(Throwable $e): void
    {
        static::logError($e);
        if (php_sapi_name() === 'cli') {
            static::renderCLliError($e);
        } else {
            static::renderErrorPage($e);
        }
    }
    private static function renderCLliError(Throwable $e): void
    {
        $isDebug = App::get('config')['app']['debug'] ?? false;
        if ($isDebug) {
            $errMsg = static::formatErrorMsg($e, "\033[31m[%s] %s: \33[0m  %s in %s on Line %d\n");
            $trace = $e->getTraceAsString();
        } else {
            $errMsg = "\033[31m Unexpected Error. check error log for details \33[0m\n";
            $trace = "";
        }
        fwrite(STDERR, $errMsg);
        if ($trace) {
            fwrite(STDERR, "\n Stack Trace: $trace\n");
        }
        exit(1);
    }
    private static function renderErrorPage(Throwable $e): void
    {
        $isDebug = App::get('config')['app']['debug'] ?? false;
        if ($isDebug) {
            $errorMessage = static::formatErrorMsg($e, "[%s] %s:  %s in %s on Line %d\n");
            $trace = $e->getTraceAsString();
        } else {
            $errorMessage = "Unexpected Error. check error log for details";
            $trace = "";
        }
        http_response_code(500);

        echo View::render(
            'errors/500',
            [
                'errorMessage' => $errorMessage,
                'trace' => $trace,
                'isDebug' => $isDebug
            ],
            'layouts/main'
        );
        exit();
    }
    private static function formatErrorMsg(Throwable $e, string $format): string
    {
        return sprintf(
            $format,
            date('Y-m-d H:i:s'),
            get_class($e),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine()
        );
    }
    private static function logError(Throwable $e): void
    {
        $logMessage = static::formatErrorMsg($e, "[%s] %s: %s in %s on Line %d\n");
        error_log($logMessage, 3, App::get('config')['app']['error_log']);
    }
}
