<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\request\RegisterRequest;
use Khanguyennfq\CarForRent\service\UserService;
use Khanguyennfq\CarForRent\validation\UserValidator;
use Exception;
class RegisterController extends BaseController
{
    private $registerRequest;
    private $userValidator;
    private $userService;

    public function __construct(Request $request, Response $response, RegisterRequest $registerRequest, UserValidator $userValidator, UserService $userService)
    {
        parent::__construct($request, $response);
        $this->registerRequest = $registerRequest;
        $this->userValidator = $userValidator;
        $this->userService = $userService;
    }

    public function index(): Response
    {
        if (isset($_SESSION['user_username'])) {
            return $this->response->redirect('/');
        }
        return $this->response->view('Register');
    }

    public function addUser(): Response
    {
        try {
            $params = $this->request->getBody();
            $this->registerRequest->fromArray($params);
            $validate = $this->userValidator->validateRegister($this->registerRequest);
            if ($validate===true) {
               if ($this->userService->register($this->registerRequest)){
                    return $this->response->redirect('/login');
               }
               return $this->response->view('Register',['errors'=>['username' => 'Username already exists']]);
            }
        } catch (Exception $e) {
            return $this->response->view('Register', ['errors' => $e->getMessage()]);
        }
        return $this->response->view('Register',['errors' => $validate]);
    }
}
