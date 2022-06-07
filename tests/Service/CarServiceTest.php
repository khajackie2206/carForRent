<?php

namespace Service;

use Khanguyennfq\CarForRent\Service\CarService;
use Khanguyennfq\CarForRent\Transfer\CarTransfer;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\Repository\CarRepository;
use Khanguyennfq\CarForRent\Model\CarModel;

class CarServiceTest extends TestCase
{
    public function testCreateCar()
    {
        $carMock = $this->getCar(255, 'lambo', 'black', 'img.jpg', 50);
        $carTransfer = new CarTransfer();
        $carTransfer->setBrand('lambo');
        $carTransfer->setColor('black');
        $carTransfer->setThumb('img.jpg');
        $carTransfer->setPrice(50);
        $carRepositoryMock = $this->getMockBuilder(CarRepository::class)->disableOriginalConstructor()->getMock();
        $carRepositoryMock->expects($this->once())->method('addCar')->willReturn(true);
        $carService = new CarService($carRepositoryMock);
        $car = $carService->createCar($carTransfer);
        $this->assertEquals($carMock->getBrandName(), $car->getBrandName());
        $this->assertEquals($carMock->getThumb(), $car->getThumb());
        $this->assertEquals($carMock->getColor(), $car->getColor());
        $this->assertEquals($carMock->getCost(), $car->getCost());
    }
    private function getCar(int $id, string $brand, string $color, string $image, int $price): CarModel
    {
        $car = new CarModel();
        $car->setId($id);
        $car->setBrandName($brand);
        $car->setColor($color);
        $car->setThumb($image);
        $car->setCost($price);
        return $car;
    }
}
