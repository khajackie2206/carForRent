<?php

namespace Khanguyennfq\CarForRent\core;

use Khanguyennfq\CarForRent\app\View;

class Route
{
    /**
     * @var array
     */
    public static array $routes = [];
    public static Request $request;
    public static Response $response;

    public function __construct(Request $request, Response $response)
    {
        self::$request = $request;
        self::$response = $response;
    }


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
        $container = new Container();
        $path = self::$request->getPath();
        $method = self::$request->getMethod();
        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            self::$response->setStatusCode(404);
            View::render('NotFoundPage');
        }
        if (is_string($callback)) {
             View::render($callback);
        }

        $currentController = $callback[0];
        $action = $callback[1];

        $controller = $container->make($currentController);
        return $controller->$action();
    }

    public static function redirect(string $path)
    {
        header('Location: ' . $path);
    }
}
