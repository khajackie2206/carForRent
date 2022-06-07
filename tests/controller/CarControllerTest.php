<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\controller\CarController;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\service\UploadFileService;
use Khanguyennfq\CarForRent\transfer\CarTransfer;
use Khanguyennfq\CarForRent\validation\CarValidator;
use PHPUnit\Framework\TestCase;

class CarControllerTest extends TestCase
{

    /**
     * @return void
     * @runInSeparateProcess
     */
    public function testIndex()
    {
        $responseMock = new Response();
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $carService = $this->getMockBuilder(CarService::class)->disableOriginalConstructor()->getMock();
        $uploadFileService = $this->getMockBuilder(UploadFileService::class)->disableOriginalConstructor()->getMock();
        $carTransfer = $this->getMockBuilder(CarTransfer::class)->disableOriginalConstructor()->getMock();
        $carValidator = $this->getMockBuilder(CarValidator::class)->disableOriginalConstructor()->getMock();
        $carController = new CarController($responseMock, $requestMock, $carService, $uploadFileService, $carValidator, $carTransfer);
        $carController = $carController->showForm();
        $response = new Response();
        $expected = $response->view('AddCar');
        $this->assertEquals($expected, $carController);
    }
}
