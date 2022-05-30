<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\repository\CarRepository;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\service\UploadFileService;
use Exception;
class CarController
{
    private $response;
    private $request;
    private $carService;
    private $uploadFileService;

    public function __construct( Response $response,   Request $request, CarService $carService, UploadFileService $uploadFileService)
    {
        $this->response = $response;
        $this->request = $request;
        $this->carService = $carService;
        $this->uploadFileService = $uploadFileService;
    }

    public function index(): Response
    {
            $carList = $this->carService->listCar();
           return $this->response->view('HomePage', ["carList" => $carList]);
    }

    public function showForm(): Response
    {
        return $this->response->view('AddCar');
    }
}
