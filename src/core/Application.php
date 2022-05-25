<?php

namespace Khanguyennfq\CarForRent\core;

class Application
{
    /**
     * @var Route
     */
    public Route $route;
    /**
     * @var Request
     */
    public Request $request;
    /**
     * @var string
     */
    public static string $ROOT_DIR;
    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Application
     */
    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->route = new Route($this->request, $this->response);
    }
    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->route::handle();
    }
}
