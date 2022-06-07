<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\Controller\CarController;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Service\CarService;
use Khanguyennfq\CarForRent\Service\UploadFileService;
use Khanguyennfq\CarForRent\Transfer\CarTransfer;
use Khanguyennfq\CarForRent\Validation\CarValidator;
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
