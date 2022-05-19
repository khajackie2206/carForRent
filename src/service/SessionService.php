<?php

namespace Khanguyennfq\CarForRent\service;

class SessionService
{

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public static function setSession(string $key, $value): void
    {
        $_SESSION["$key"] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function getSession(string $key)
    {
        if (isset($_SESSION["$key"])) {
            return $_SESSION["$key"];
        }
        return null;
    }

    /**
     * @param string $key
     * @return void
     */
    public static function unsetSession(string $key): void
    {
        unset($_SESSION["$key"]);
    }
}
