<?php

namespace Khanguyennfq\CarForRent\Controller\API;

use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Service\CarService;
use Khanguyennfq\CarForRent\Transformer\CarTransformer;

class CarControllerAPI extends AbstractAPIController
{
    private $carTransformer;
    private $carService;

    public function __construct(Request $request, Response $response, CarTransformer $carTransformer, CarService $carService)
    {
        parent::__construct($request, $response);
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
