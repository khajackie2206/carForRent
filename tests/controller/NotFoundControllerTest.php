<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\controller\NotFoundController;
use Khanguyennfq\CarForRent\core\Request;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\core\Response;

class NotFoundControllerTest extends TestCase
{
    public function testIndex()
    {
        $request = new Request();
        $response = new Response();
        $notFoundController = new NotFoundController($request, $response);
        $notFoundController = $notFoundController->index();
        $response = new Response();
        $expected = $response->view('NotFoundPage');
        $this->assertEquals($expected, $notFoundController);
    }
}
