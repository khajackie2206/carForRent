<?php

namespace Khanguyennfq\CarForRent\service;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\validation\UserValidator;

class LoginService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function login(LoginRequest $loginRequest)
    {
        $userValidator = new UserValidator();
        $existUser = $this->userRepository->findUserName($loginRequest->getUsername());
        if (!empty($existUser) && password_verify($loginRequest->getPassword(), $existUser->getPassword()) && $userValidator->validateLogin($loginRequest)) {
            SessionService::setSession("user_username", $existUser->getUsername());
            return true;
        }
        return null;
    }
}
