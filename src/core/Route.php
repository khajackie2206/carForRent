<?php

namespace Khanguyennfq\CarForRent\core;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\app\View;

class Route
{

    protected string $method;
    protected string $uri;
    protected string $controllerClassName;
    protected string $actionName;

    public function __construct(string $method, string $uri, string $controllerClassName, string $actionName)
    {
        $this->setMethod($method);
        $this->setUri($uri);
        $this->setControllerClassName($controllerClassName);
        $this->setActionName($actionName);
    }
    public static function post(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodPost, $uri, $controllerClassName, $actionName);
    }

    public static function get(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodGet, $uri, $controllerClassName, $actionName);
    }

    public function match(string $method, string $uri): bool
    {
        return $this->getMethod() === $method && $this->getUri() === $uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getControllerClassName(): string
    {
        return $this->controllerClassName;
    }

    public function setControllerClassName(string $controllerClassName): void
    {
        $this->controllerClassName = $controllerClassName;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function setActionName(string $actionName): void
    {
        $this->actionName = $actionName;
    }
}
