<?php


function throw404(): void
{
    http_response_code(404);
    echo '404 Not Found';
    exit;
}

function badRequest(string $message = '404 Not Found'): void
{
    http_response_code(404);
    echo  $message;
    exit;
}

function serverError(string $message = '500 Internal Server Error'): void
{
    http_response_code(500);
    echo $message;
    exit;
}
