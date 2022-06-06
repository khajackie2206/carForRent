<?php

namespace Khanguyennfq\CarForRent\controller\API;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Exception;

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

    public function login()
    {
        try {
            $userParams = $this->request->getRequestJsonBody();
            $this->userModel->fromArray($userParams);
            $userLogged = $this->loginService->login($this->userModel);
        } catch (Exception $e) {
            return $this->response->toJson(
                ['message' => $e],
                Response::HTTP_BAD_REQUEST
            );
        }
        if ($userLogged == null) {
            return $this->response->toJson(
                ['message' => 'Username or Password is invalid'],
                Response::HTTP_UNAUTHORIZED
            );
        }
            $token = $this->tokenService->jwtEncodeData($userLogged->getID());
            return $this->response->toJson([
                     'data' => $this->userTransformer->toArray($userLogged),
                    'token' => $token
            ], Response::HTTP_OK);
    }
}
