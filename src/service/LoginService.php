<?php

namespace Khanguyennfq\CarForRent\service;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\http\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\repository\UserRepository;

class LoginService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(UserModel $user): UserModel
    {
        $existUser = $this->userRepository->findUserName($user->getUsername());
        if (empty($existUser)) {
            throw new ValidationException("User is not found");
        }
        if (!password_verify($user->getPassword(), $existUser->password)) {
            throw new ValidationException("Password is wrong!!");
        }
        return $existUser;
    }
    public function validateLogin($request): bool
    {
        if (empty($request->username) || empty($request->password)) {
            return false;
        }
        return true;
    }
}
