<?php

namespace Khanguyennfq\CarForRent\app;

class View
{
    /**
     * @param string $view
     * @param array|null $data
     * @return bool
     */
    public static function render(string $view, array $data = null): bool
    {
        require __DIR__ . "/../view/$view.php";
        return true;
    }

    public static function redirect(string $url): bool
    {
        header("location: $url");
        return true;
    }
}
