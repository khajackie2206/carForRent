<?php

namespace Khanguyennfq\CarForRent\Controller\API;

use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\Service\LoginService;
use Khanguyennfq\CarForRent\Service\TokenService;
use Khanguyennfq\CarForRent\Transformer\UserTransformer;
use Khanguyennfq\CarForRent\Validation\UserValidator;
use Exception;

class LoginControllerAPI extends AbstractAPIController
{
    private $loginService;
    private $tokenService;
    private $userTransformer;
    private $loginRequest;
    private $userValidator;

    public function __construct(
        Request         $request,
        LoginRequest    $loginRequest,
        LoginService    $loginService,
        Response        $response,
        TokenService    $tokenService,
        UserTransformer $userTransformer,
        UserValidator   $userValidator
    )
    {
        parent::__construct($request, $response);
        $this->loginRequest = $loginRequest;
        $this->loginService = $loginService;
        $this->tokenService = $tokenService;
        $this->userTransformer = $userTransformer;
        $this->userValidator = $userValidator;
    }

    /**
     * @return Response
     */
    public function login(): Response
    {
        $params = $this->request->getRequestJsonBody();
        $loginRequest = $this->loginRequest->fromArray($params);
        $loginValidator = $this->userValidator->validateLogin($loginRequest);
        if (!$loginValidator) {
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
