<?php

namespace Khanguyennfq\CarForRent\core;

use Khanguyennfq\CarForRent\controller\NotFoundController;

class Route
{
    /**
     * @var array
     */
    public static array $routes = [];

    /**
     * @param  $uri
     * @param  $callback
     * @return void
     */
    public static function get(string $uri, mixed $callback): void
    {
        self::$routes['GET'][$uri] = $callback;
    }
    public static function post(string $uri, mixed $callback): void
    {
        self::$routes['POST'][$uri] = $callback;
    }

    /**
     * @return mixed
     */
    public static function handle(): mixed
    {
        $request = new Request();
        $notFoundController = new NotFoundController();
        $path = $request->getPath();
        $method = $request->getMethod();
        $response = self::$routes[$method][$path] ?? false;
        if (!$response) {
            return $notFoundController->index();
        }
        return call_user_func($response);
    }
    public static function redirect(string $path)
    {
        header('Location: ' . $path);
    }
}
