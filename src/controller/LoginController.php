<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Exception;

class LoginController
{

    private $loginService;
    private $userModel;
    private $request;
    private $response;
    public function __construct(Request $request, UserModel $userModel, LoginService $loginService, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->userModel = $userModel;
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
            $this->userModel->fromArray($userparams);
            if ($this->request->isPost()) {
                $userLogged = $this->loginService->login($this->userModel);
                if ($userLogged != null) {
                    return $this->response->redirect('/');
                }
                $errorMessage = 'Username or password is invalid';
            }
        } catch (Exception $e) {
            $errorMessage = 'Something went wrong!!!';
        }
            return $this->response->view('Login', [
                'error' => $errorMessage,
            ]);
    }

    /**
     * @return bool
     */
    public function logOut(): bool
    {
        SessionService::unsetSession('user_username');
        View::redirect('/');
        return true;
    }
}
