<?php

namespace Khanguyennfq\CarForRent\controller\API;

use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\transformer\CarTransformer;

class CarControllerAPI
{
    private $response;
    private $carTransformer;
    private $carService;

    public function __construct(Response $response, CarTransformer $carTransformer, CarService $carService)
    {
         $this->response = $response;
         $this->carTransformer = $carTransformer;
         $this->carService = $carService;
    }

    public function listCars(): Response
    {
        $cars = $this->carService->listCar();
        $results = [];
        foreach ($cars as $car) {
            $results[] = $this->carTransformer->toArray($car);
        }
        return $this->response->toJson(['data' => $results], Response::HTTP_OK);
    }
}
