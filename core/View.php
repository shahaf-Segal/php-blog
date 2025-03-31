<?php

namespace Core;

use RuntimeException;

class View
{
    protected static $GLOBALS = [];

    public static function globalShare(string $key, mixed $value): void
    {
        static::$GLOBALS[$key] = $value;
    }
    public static function render(string $template, array $data = [], ?string $layout = null): string
    {
        $data = [...static::$GLOBALS, ...$data];
        $content = static::renderTemplate($template, $data);

        return static::renderLayout($layout, $data, $content);
    }
    public static function renderPartial(string $template, ?array $data = []): string
    {
        return static::renderTemplate("partials/$template", $data);
    }

    protected static function renderTemplate(string $template, array $data): string
    {
        $path = dirname(__DIR__) . '/app/Views/' . $template . '.php';
        if (!file_exists($path)) {
            throw new RuntimeException("Error: Template not found");
        }
        extract([...$data]);

        ob_start();
        require $path;
        return ob_get_clean();
    }


    protected static function renderLayout(?string $template, array $data, string $content): string
    {
        if ($template === null) {
            return $content;
        }

        extract([...$data, 'content' => $content]);
        $path = dirname(__DIR__) . '/app/Views/' . $template . '.php';
        if (!file_exists($path)) {
            throw new RuntimeException("Error: Template not found");
        }

        ob_start();
        require $path;
        return ob_get_clean();
    }
}
