<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\service\CarService;
use Khanguyennfq\CarForRent\service\UploadFileService;
use Khanguyennfq\CarForRent\transfer\CarTransfer;
use Khanguyennfq\CarForRent\validation\CarValidator;
use Exception;
use Khanguyennfq\CarForRent\validation\ImageValidator;

class CarController
{
    private $response;
    private $request;
    private CarService $carService;
    private UploadFileService $uploadFileService;
    private CarValidator $carValidator;
    private ImageValidator $imageValidator;

    public function __construct(
        Response $response,
        Request $request,
        CarService $carService,
        UploadFileService $uploadFileService,
        CarValidator $carValidator,
        ImageValidator $imageValidator
    ) {
        $this->response = $response;
        $this->request = $request;
        $this->carService = $carService;
        $this->uploadFileService = $uploadFileService;
        $this->carValidator = $carValidator;
        $this->imageValidator = $imageValidator;
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
            $params = $this->request->getBody();
            $img = $this->request->getFiles()['file'];
            $params['file'] = $img['name'];
            $carTransfer = new CarTransfer();
            $carTransfer->formArray($params);
            $carValidate = $this->carValidator->validateCar($carTransfer);
            $imgValidate = $this->imageValidator->validateImage($img);
            $errorMessage = array_merge(is_array($carValidate) ? $carValidate : [], is_array($imgValidate) ? $imgValidate : []);
            if (!empty($errorMessage)) {
                return $this->response->view('AddCar', ['errorMessage' => $errorMessage]);
            }
            $isUploadImage = $this->uploadFileService->handleUpload($img);
            $carTransfer->setThumb($isUploadImage);
            $this->carService->createCar($carTransfer);
            return $this->response->view('AddCar', ['success' => "Add car successfully!!!"]);
        } catch (Exception $e) {
            return $this->response->view('AddCar', ['error' => 'Something went wrong!!!']);
        }
    }

    /**
     * @return Response
     */
    public function showForm(): Response
    {
        return $this->response->view('AddCar');
    }
}
