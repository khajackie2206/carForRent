<?php

namespace Khanguyennfq\CarForRent\app;

class View
{
    /**
     * @param string $template
     * @return string|false
     */
    public static function render(string $template, array $data = null): void
    {
        require __DIR__ . "/../view/$template.php";
    }
    public static function redirect($url): void
    {
        header("location: $url");
    }
}
