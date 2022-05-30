<?php

namespace Khanguyennfq\CarForRent\service;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\repository\CarRepository;

class CarService
{
    private CarRepository $carRepository;
    public function __construct(CarRepository $carRepository)
    {
      $this->carRepository = $carRepository;
    }

    public function listCar()
    {
        return $this->carRepository->listCar();
    }
}
