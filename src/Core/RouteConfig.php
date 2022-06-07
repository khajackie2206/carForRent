<?php

namespace Khanguyennfq\CarForRent\Core;

use Khanguyennfq\CarForRent\Controller\API\LoginControllerAPI;
use Khanguyennfq\CarForRent\Controller\CarController;
use Khanguyennfq\CarForRent\Controller\LoginController;
use Khanguyennfq\CarForRent\Controller\API\CarControllerAPI;
use Khanguyennfq\CarForRent\Controller\RegisterController;

class RouteConfig
{
    /**
     * @return Route[]
     */
    public static function getRoutes(): array
    {
        return array_merge(static::getApiRoutes(), static::getWebRoutes());
    }

    /**
     * @return array
     */
    public static function getWebRoutes(): array
    {
        return [
            Route::get('/', CarController::class, 'index'),
            Route::post('/logout', LoginController::class, 'logOut'),
            Route::get('/login', LoginController::class, 'index'),
            Route::post('/login', LoginController::class, 'login'),
            Route::get('/addcar', CarController::class, 'showForm'),
            Route::post('/addcar', CarController::class, 'addCar'),
            Route::get('/register', RegisterController::class, 'index'),
            Route::post('/register', RegisterController::class, 'addUser')
        ];
    }

    /**
     * @return array
     */
    public static function getApiRoutes(): array
    {
        return [
            Route::post('/api/login', LoginControllerAPI::class, 'login'),
            Route::get('/api/cars', CarControllerAPI::class, 'listCars'),
        ];
    }
}
