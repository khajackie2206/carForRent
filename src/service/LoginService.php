<?php

namespace Khanguyennfq\CarForRent\service;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\validation\UserValidator;

class LoginService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserModel $user
     * @return UserModel|array
     */
    public function login(UserModel $user)
    {
        $userValidator = new UserValidator();
        $existUser = $this->userRepository->findUserName($user->getUsername());
        if (!empty($existUser) && password_verify($user->getPassword(), $existUser->getPassword()) && $userValidator->validateLogin($user)) {
            SessionService::setSession("user_username", $existUser->getUsername());
            return $existUser;
        }
        return null;
    }
}
