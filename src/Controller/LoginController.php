<?php

namespace Khanguyennfq\CarForRent\Controller;

use Khanguyennfq\CarForRent\App\View;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Model\UserModel;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\Service\LoginService;
use Khanguyennfq\CarForRent\Service\SessionService;
use Khanguyennfq\CarForRent\Service\TokenService;
use Khanguyennfq\CarForRent\Transformer\UserTransformer;
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
                if ($userLogged != null) {
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
