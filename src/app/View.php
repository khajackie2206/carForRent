<?php

namespace Khanguyennfq\CarForRent\app;

class View
{
    /**
     * @param string $template
     * @return string|false
     */
    public static function render(string $view, array $data = null): bool
    {
        require __DIR__ . "/../view/$view.php";
        return true;
    }
    public static function redirect($url): bool
    {
        header("location: $url");
        return true;
    }
}
