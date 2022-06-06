<?php

namespace Khanguyennfq\CarForRent\service;

use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\repository\CarRepository;
use Khanguyennfq\CarForRent\transfer\CarTransfer;
use Ramsey\Uuid\Uuid;

class CarService
{
    /**
     * @var CarRepository
     */
    private CarRepository $carRepository;

    /**
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param CarTransfer $carTransfer
     * @return CarModel|null
     */
    public function createCar(CarTransfer $carTransfer): ?CarModel
    {
        $uuid = Uuid::uuid4()->toString();
        $load = [
            $uuid,
            $carTransfer->getBrand(),
            $carTransfer->getPrice(),
            $carTransfer->getColor(),
            $carTransfer->getThumb()
        ];
        if (!$this->carRepository->addCar($load)) {
            return null;
        }
        $car = new CarModel();
        $car->setID($uuid);
        $car->setBrandName($carTransfer->getBrand());
        $car->setColor($carTransfer->getColor());
        $car->setCost($carTransfer->getPrice());
        $car->setThumb($carTransfer->getThumb());
        return $car;
    }

    public function listCar()
    {
        return $this->carRepository->listCar();
    }
}
