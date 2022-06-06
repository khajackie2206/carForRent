<?php

namespace Khanguyennfq\CarForRent\controller\API;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Khanguyennfq\CarForRent\validation\UserValidator;
use Exception;

class LoginControllerAPI extends AbstractAPIController
{
    private $loginService;
    private $tokenService;
    private $userTransformer;
    private $loginRequest;
    private $userValidator;

    public function __construct(
        Request $request,
        LoginRequest $loginRequest,
        LoginService $loginService,
        Response $response,
        TokenService $tokenService,
        UserTransformer $userTransformer,
        UserValidator $userValidator
         )
    {
        parent::__construct($request, $response);
        $this->loginRequest = $loginRequest;
        $this->loginService = $loginService;
        $this->tokenService = $tokenService;
        $this->userTransformer = $userTransformer;
        $this->userValidator = $userValidator;
    }

    public function login(): Response
    {
            $this->loginRequest->fromArray($this->request->getRequestJsonBody());
            $loginValidator = $this->userValidator->validateLogin($this->loginRequest);
            if(!$loginValidator) {
                return $this->response->toJson(
                    ['message' => 'Username or password cannot be empty'],
                    Response::HTTP_BAD_REQUEST
                );
            }
           $userLogged = $this->loginService->login($this->loginRequest);
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
