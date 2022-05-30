<?php

namespace Khanguyennfq\CarForRent\core;
use Khanguyennfq\CarForRent\controller\API\LoginControllerAPI;
use Khanguyennfq\CarForRent\controller\CarController;
use Khanguyennfq\CarForRent\controller\LoginController;

class RouteConfig
{
   /**
    *
    */

    /**
     * @return Route[]
     */
   public static function getRoutes(): array
   {
       return array_merge(static::getApiRoutes(), static::getWebRoutes());
   }

    /**
     * @return Route[]
     */
   public static function getWebRoutes(): array
   {
        return [
            Route::get('/', CarController::class,'index'),
            Route::post('/logout', LoginController::class,'logOut'),
            Route::get('/login', LoginController::class,'index'),
            Route::post('/login', LoginController::class,'login'),
            Route::get('/addcar',CarController::class, 'showForm'),
             Route::post('/addcar',CarController::class, 'addCar')
        ];
   }

    /**
     * @return Route[]
     */
   public static function getApiRoutes(): array
   {
       return [
         Route::post('/api/login', LoginControllerAPI::class,'login'),
         Route::get('/api/login', LoginControllerAPI::class,'index')
       ];
   }

}