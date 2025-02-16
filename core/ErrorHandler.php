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
            $errMsg = static::formatErrorMsg($e, "\033[31m[%s] Error: \33[0m %s in %s on Line %d\n");
            $trace = $e->getTraceAsString();
        } else {
            $errMsg = "\033[31m Unepected Error. check error log for details \33[0m\n";
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
        echo $e->getMessage();
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
}
