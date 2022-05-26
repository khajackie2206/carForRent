<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\controller\CarController;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\app\View;

class CarControllerTest extends TestCase
{
    public function testIndex()
    {
        $carController = new CarController();
        $carController = $carController->index();
        $view = new View();
        $expected = $view::render('HomePage');
        $this->assertEquals($expected, $carController);
    }
}
