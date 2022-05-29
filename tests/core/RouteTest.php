<?php

namespace Khanguyennfq\CarForRent\tests\core;

use Khanguyennfq\CarForRent\controller\API\LoginControllerAPI;
use Khanguyennfq\CarForRent\core\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testGetRoute()
    {
        Route::get('/login', [LoginControllerAPI::class,'index']);
        $route = Route::$routes;
        $result = $route['GET']['/login'];
        $expected = [LoginControllerAPI::class,'index'];
        $this->assertEquals($expected, $result);
    }
    public function testPostRoute()
    {
        Route::post('/login', [LoginControllerAPI::class,'login']);
        $route = Route::$routes;
        $result = $route['POST']['/login'];
        $expected = [LoginControllerAPI::class,'login'];
        $this->assertEquals($expected, $result);
    }

    /**
     * @runInSeparateProcess
     * @return void
     */
    public function testRedirect()
    {
        Route::redirect('/');
        $this->assertContains('Location: /', xdebug_get_headers());
    }
}
