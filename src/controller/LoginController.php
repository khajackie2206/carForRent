<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Exception;

class LoginController extends BaseController
{

    private $loginService;
    private $loginRequest;
    public function __construct(Request $request, LoginRequest $loginRequest, LoginService $loginService, Response $response)
    {
        parent::__construct($request, $response);
        $this->loginRequest = $loginRequest;
        $this->loginService = $loginService;
    }

    /**
     * @return void
     */
    public function index(): Response
    {
        if (SessionService::getSession("user_username")) {
            return $this->response->redirect('/');
        }
        return $this->response->view('Login');
    }

    /**
     * @return Response
     */
    public function login(): Response
    {
        try {
            $errorMessage = "";
            $userparams = $this->request->getBody();
            $this->loginRequest->fromArray($userparams);
            if ($this->request->isPost()) {
                $userLogged = $this->loginService->login($this->loginRequest);
                if ($userLogged) {
                    return $this->response->redirect('/');
                }
                $errorMessage = 'Username or password is invalid';
            }
        } catch (Exception $e) {
            $errorMessage = 'Something went wrong!!!';
        }
            return $this->response->view('Login', [
                'errors' => $errorMessage,
            ]);
    }

    public function logOut()
    {
        SessionService::unsetSession('user_username');
        return $this->response->redirect('/');
    }
}
