<?php
namespace Khanguyennfq\CarForRent\app;
class View
{
    /**
     * @param string $template
     * @return false|string
     */
    public static function render(string $template): false|string
    {
        return file_get_contents(__DIR__ . "/../view/$template.php");
    }
}
