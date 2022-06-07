<?php

namespace controller\API;

use Khanguyennfq\CarForRent\controller\API\CarControllerAPI;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\transformer\CarTransformer;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\model\CarModel;
use PHPUnit\Framework\TestCase;

class CarControllerAPITest extends TestCase
{
   public function testListCars()
   {
     $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
     $response = new Response();
     $carTransformerMock = $this->getMockBuilder(CarTransformer::class)->disableOriginalConstructor()->getMock();
     $carServiceMock = $this->getMockBuilder(CarService::class)->disableOriginalConstructor()->getMock();
     $carArray = [
           $this->getCar(2, 'car1', 'image', 2000),
           $this->getCar(3, 'car2', 'image', 3000),
       ];
       $carServiceMock->expects($this->once())->method('listCar')->willReturn($carArray);
       $carController = new CarControllerAPI($requestMock, $response, $carTransformerMock, $carServiceMock);
       $responseResult = $carController->listCars();
       $this->assertEquals(2, count($responseResult->getData()['data']));
       $this->assertEquals(200, $responseResult->getStatusCode());
 }

    private function getCar(int $id, string $name, string $image, int $price): CarModel
    {
        $car = new CarModel();
        $car->setId($id);
        $car->setBrandName($name);
        $car->setThumb($image);
        $car->setCost($price);
        return $car;
    }
}
