<?php

namespace Khanguyennfq\CarForRent\core;

class Application
{

    public Route $route;
    public Request $request;
    public static string $ROOT_DIR;
    public Response $response;
    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->route = new Route($this->request, $this->response);
    }
    public function run()
    {
        return $this->route::handle();
    }
}
