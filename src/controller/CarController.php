<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\repository\CarRepository;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\CarModel;
class CarController
{
    private $carRepository;
    private $response;

    public function __construct(CarRepository $carRepository, Response $response)
    {
        $this->carRepository = $carRepository;
        $this->response = $response;
    }

    public function index(): Response
    {
           return $this->response->view('HomePage');
    }
}
