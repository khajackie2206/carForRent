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
    private $carService;
    private $uploadFileService;
    private $carValidator;
    private $carTransfer;

    public function __construct(
        Response $response,
        Request $request,
        CarService $carService,
        UploadFileService $uploadFileService,
        CarValidator $carValidator,
        CarTransfer $carTransfer
    ) {
        $this->response = $response;
        $this->request = $request;
        $this->carService = $carService;
        $this->uploadFileService = $uploadFileService;
        $this->carValidator = $carValidator;
        $this->carTransfer = $carTransfer;
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
            $file = $this->request->getFiles()['file'];
            $params['file'] = $file['name'];
            $this->carTransfer->formArray($params);
            $carValidate = $this->carValidator->validateCar($this->carTransfer, $file);
            if (!empty($carValidate)) {
                return $this->response->view('AddCar', ['errorMessage' => $carValidate]);
            }
            $isUploadImage = $this->uploadFileService->handleUpload($file);
            $this->carTransfer->setThumb($isUploadImage);
            $this->carService->createCar($this->carTransfer);
            return $this->response->view('AddCar', ['success' => "Add car successfully!!!"]);
        } catch (Exception $e) {
            return $this->response->view('AddCar', ['error' => $e]);
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
