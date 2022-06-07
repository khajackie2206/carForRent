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

    /*public function testAddCar()
    {
        $response = new Response();
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'brand' => 'lambo',
            'price' => 500,
            'color' => 'black'
        ]);
        $requestMock->expects($this->once())->method('getFiles')->willReturn([
            'name' =>  'image_2022-06-02_13-25-25.png',
            'full_path' => 'image_2022-06-02_13-25-25.png',
            'type' => 'image/png',
             'tmp_name' => '/tmp/phpGgsmRt',
             'error' => 0,
             'size' => 94308
        ]);
        $carTransferMock = $this->getMockBuilder(CarTransfer::class)->disableOriginalConstructor()->getMock();
        $carService = $this->getMockBuilder(CarService::class)->disableOriginalConstructor()->getMock();
        $uploadFileService = $this->getMockBuilder(UploadFileService::class)->disableOriginalConstructor()->getMock();
        $carValidatorMock = $this->getMockBuilder(CarValidator::class)->disableOriginalConstructor()->getMock();
        $carValidatorMock->expects($this->once())->method('validateCar')->willReturn([]);
        $carController = new CarController($response, $requestMock, $carService, $uploadFileService, $carValidatorMock, $carTransferMock);
        $carController = $carController->addCar();
        $responseExpected = new Response();
        $responseExpected->setTemplate('AddCar');
        $this->assertEquals($responseExpected->getTemplate(),$carController->getTemplate());
    }*/
}
