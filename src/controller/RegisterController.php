<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\request\RegisterRequest;
use Khanguyennfq\CarForRent\service\UserService;
use Khanguyennfq\CarForRent\validation\UserValidator;
use Exception;
class RegisterController
{
    private $response;
    private $request;
    private $registerRequest;
    private $userValidator;
    private $userService;
    public function __construct(Request $request, Response $response, RegisterRequest $registerRequest, UserValidator $userValidator, UserService $userService)
    {
        $this->request = $request;
        $this->response = $response;
        $this->registerRequest = $registerRequest;
        $this->userValidator = $userValidator;
        $this->userService = $userService;
    }

    public function index(): Response
    {
        if (isset($_SESSION['user_username'])) {
            return $this->response->view('Register');
        }
        return $this->response->redirect('/');
    }

    public function addUser(): Response
    {
        try {

            $params = $this->request->getBody();
            $this->registerRequest->fromArray($params);
            $validate = $this->userValidator->validateRegister($this->registerRequest);
            if ($validate) {
                $this->userService->register($this->registerRequest);
            }
            $error = $validate;
        } catch (Exception $e) {
            $error['error'] = $e->getMessage();
        }
        return $this->response->view('Register', ['error' => $error]);
    }
}
