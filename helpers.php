<?php

use Core\View;

if (!function_exists('renderPartial')) {
    function renderPartial(string $template, ?array $data): string
    {
        return View::renderPartial($template, $data);
    }
}
