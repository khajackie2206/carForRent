<?php

namespace Khanguyennfq\CarForRent\tests\core;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Route;
use Khanguyennfq\CarForRent\controller\LoginController;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testGetRoute()
    {
        Route::get('/login', [LoginController::class,'index']);
        $route = Route::$routes;
        $result = $route['GET']['/login'];
        $expected = [LoginController::class,'index'];
        $this->assertEquals($expected, $result);
    }
    public function testPostRoute()
    {
        Route::post('/login', [LoginController::class,'login']);
        $route = Route::$routes;
        $result = $route['POST']['/login'];
        $expected = [LoginController::class,'login'];
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
