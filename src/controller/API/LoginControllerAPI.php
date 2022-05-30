<?php

namespace Khanguyennfq\CarForRent\controller\API;
use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;

class LoginControllerAPI
{
    private $loginService;
    private $userModel;
    private $request;
    private $response;
    private $tokenService;
    private $userTransformer;

    public function __construct(Request $request, UserModel $userModel, LoginService $loginService, Response $response, TokenService $tokenService, UserTransformer $userTransformer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->userModel = $userModel;
        $this->loginService = $loginService;
        $this->tokenService = $tokenService;
        $this->userTransformer = $userTransformer;
    }

    public function index(): Response
    {
        if (SessionService::getSession("user_username")) {
            return $this->response->redirect('/');
        }
        return $this->response->view('Login');
    }

    public function login()
    {
        if ($this->request->isPost()) {
            $err = '';
            $userParams = $this->request->getRequestJsonBody();
            $this->userModel->fromArray($userParams);
            $userLogged = $this->loginService->login($this->userModel);
            if ($userLogged==null) {
                $err = 'Username or Password is invalid';
                return $this->response->toJson([
                    'message' => $err],
                    Response::HTTP_UNAUTHORIZED);
            }
            $userTokenData = [
                'id' => $userLogged->getID(),
                'username' => $userLogged->getUsername()
            ];
            $data = $this->tokenService->jwtEncodeData($this->request->getHost() . $this->request->getPath(), $userTokenData);
            return $this->response->toJson([
                     'data'=>$this->userTransformer->toArray($userLogged),
                    'token' => $data
            ],Response::HTTP_OK);

        }
    }

    public function logOut(): bool
    {
        SessionService::unsetSession('user_username');
        View::redirect('/');
        return true;
    }
}
