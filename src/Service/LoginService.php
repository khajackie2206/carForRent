<?php

namespace Khanguyennfq\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\Repository\UserRepository;
use Khanguyennfq\CarForRent\Validation\UserValidator;

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
            return $existUser;
        }
        return null;
    }
}
