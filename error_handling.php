<?php
function errorHandler(Throwable $e)
{
    $err_msg = "(" . get_class($e) . ")" . $e->getMessage() .
        " in file" . $e->getFile() . " on line" . $e->getLine();

    error_log($err_msg);

    serverError("An error occurred, please try again later");
}
