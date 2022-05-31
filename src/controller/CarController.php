<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\repository\CarRepository;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\service\UploadFileService;
use Khanguyennfq\CarForRent\transfer\CarTransfer;
use Khanguyennfq\CarForRent\validation\CarValidation;
use Exception;
class CarController
{
    private $response;
    private $request;
    private CarService $carService;
    private UploadFileService $uploadFileService;
    private CarValidation $carValidation;
    public function __construct( Response $response,   Request $request, CarService $carService, UploadFileService $uploadFileService, CarValidation $carValidation)
    {
        $this->response = $response;
        $this->request = $request;
        $this->carService = $carService;
        $this->uploadFileService = $uploadFileService;
        $this->carValidation = $carValidation;
    }

    public function index(): Response
    {
            $carList = $this->carService->listCar();
           return $this->response->view('HomePage', ["carList" => $carList]);
    }

    public function addCar(): Response
    {
        try {
            $params = $this->request->getFormParams();
            $img = $this->request->getFiles()['file'];
            $params = [
              ...$params,
                "file" => $img["name"]
            ];
            $carTransfer = new CarTransfer();
            $carTransfer->formArray($params);
            $errorValidate = $this->carValidation->validate($carTransfer);
            if($errorValidate){
               return $this->response->view('AddCar', ['error' => "Don't let any field empty!!!"]);
            }
            if ($img['name']){
                $errorUpload = $this->uploadFileService->handleUpload($img, "img/","image", 500000);
                if($errorUpload){
                    return $this->response->view('AddCar', ['error' => $errorUpload]);
                }
            }
            $car = $this->carService->createCar($carTransfer);
            if(empty($car)){
                return $this->response->view('AddCar',['error'=>"Something deo on!!!"]);
            }
            return $this->response->redirect("/");

        } catch (Exception $e){
            return $this->response->view('AddCar',['error'=>'Something went wrong!!!']);
        }
    }
    public function showForm(): Response
    {
        return $this->response->view('AddCar');
    }
}
