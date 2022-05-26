<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\controller\UserController;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\app\View;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $userController = new UserController();
        $userController = $userController->index();
        $view = new View();
        $expected = $view::render('Login');
        $this->assertEquals($expected, $userController);
    }
}
