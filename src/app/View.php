<?php

namespace Khanguyennfq\CarForRent\app;

class View
{
    /**
     * @param string $template
     * @return string|false
     */
    public static function render(string $view, array $data = null): void
    {
        require __DIR__ . "/../view/$view.php";
    }
    public static function redirect($url): void
    {
        header("location: $url");
    }
}
