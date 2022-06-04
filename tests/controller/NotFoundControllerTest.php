<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\controller\NotFoundController;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\app\View;

class NotFoundControllerTest extends TestCase
{
    public function testIndex()
    {
        $notFoundController = new NotFoundController();
        $notFoundController = $notFoundController->index();
        $view = new View();
        $expected = $view::render('NotFoundPage');
        $this->assertEquals($expected, $notFoundController);
    }
}
