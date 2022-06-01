<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Response;
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

    /**
     * @return Response
     */
    public function index(): Response
    {
            $carList = $this->carService->listCar();
           return $this->response->view('HomePage', ["carList" => $carList]);
    }

    /**
     * @return Response
     */
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
                $isUploadImage = $this->uploadFileService->handleUpload($img);
                if(is_array($isUploadImage)) {
                    return $this->response->view('AddCar',  $isUploadImage);
                }
                $carTransfer->setThumb($isUploadImage);
            }
            $car = $this->carService->createCar($carTransfer);
            if(empty($car)){
                return $this->response->view('AddCar',['error'=>"Can't create car!!!"]);
            }
            return $this->response->view('AddCar',['success'=>"Add car successfully!!!"]);

        } catch (Exception $e){
            return $this->response->view('AddCar',['error'=>'Something went wrong!!!']);
        }
    }
    public function showForm(): Response
    {
        return $this->response->view('AddCar');
    }
}
