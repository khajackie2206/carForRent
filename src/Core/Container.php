<?php

namespace Khanguyennfq\CarForRent\Core;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionException;

/**
 * @link https://viblo.asia/p/tu-build-1-dependency-injection-container-voi-php-gDVK2mye5Lj
 */
class Container
{
    protected array $instances = [];

    /**
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete = null): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }
        $this->instances[$abstract] = $concrete;
    }

    /**
     * Lấy ra instance từ Container
     *
     * @param $abstract
     * @param array $parameters
     * @return mixed|object
     * @throws ReflectionException
     */
    public function make(string $abstract, array $parameters = [])
    {
        if (!isset($this->instances[$abstract])) {
            $this->bind($abstract);
        }

        return $this->resolve($this->instances[$abstract], $parameters);
    }

    /**
     * @param $concrete
     * @param $parameters
     * @return mixed|object
     * @throws ReflectionException
     */
    protected function resolve($concrete, $parameters)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this, $parameters);
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return $reflector->newInstance();
        }

        $parameters = $constructor->getParameters();

        $dependencies = $this->resolveDependencies($parameters);


        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @param $parameters
     * @return array
     * @throws Exception
     */
    protected function resolveDependencies($parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
//            $dependency = $parameter->getClass();
            $dependency = new ReflectionClass($parameter->getType()->getName());
            if (!is_null($dependency)) {
                $dependencies[] = $this->make($dependency->name);
                continue;
            }
            if ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
                continue;
            }
            throw new Exception("Can not resolve dependency {$parameter->name}");
        }

        return $dependencies;
    }
}
