<?php

namespace Khanguyennfq\CarForRent\Core;

use Khanguyennfq\CarForRent\Controller\NotFoundController;


class Application
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return false|Route
     */
    public function getRoute()
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getPath();
        $routes = RouteConfig::getRoutes();
        foreach ($routes as $route) {
            if ($route->getMethod() !== $method || $route->getUri() !== $uri) {
                continue;
            }
            return $route;
        }
        return false;
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function run()
    {
        $controllerClassName = NotFoundController::class;
        $actionName = NotFoundController::INDEX_ACTION;
        $route = $this->getRoute();
        if ($route) {
            $controllerClassName = $route->getControllerClassName();
            $actionName = $route->getActionName();
        }
        $container = new Container();
        $controller = $container->make($controllerClassName);
        /**
         * @var Response $response
         */
        $response = $controller->{$actionName}();
        return View::handle($response);
    }
}
