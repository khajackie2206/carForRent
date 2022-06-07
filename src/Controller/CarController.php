<?php

namespace Khanguyennfq\CarForRent\Controller;

use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Service\CarService;
use Khanguyennfq\CarForRent\Service\UploadFileService;
use Khanguyennfq\CarForRent\Transfer\CarTransfer;
use Khanguyennfq\CarForRent\Validation\CarValidator;
use Exception;

class CarController extends BaseController
{

    private $carService;
    private $uploadFileService;
    private $carValidator;
    private $carTransfer;

    public function __construct(
        Response          $response,
        Request           $request,
        CarService        $carService,
        UploadFileService $uploadFileService,
        CarValidator      $carValidator,
        CarTransfer       $carTransfer
    )
    {
        parent::__construct($request, $response);
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
