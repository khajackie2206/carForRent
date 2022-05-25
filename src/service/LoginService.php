<?php

namespace Khanguyennfq\CarForRent\service;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\repository\UserRepository;

class LoginService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(UserModel $user): UserModel | null
    {
        $existUser = $this->userRepository->findUserName($user->getUsername());
        if (!empty($existUser) && password_verify($user->getPassword(), $existUser->getPassword())) {
            SessionService::setSession("user_username", $existUser->getUsername());
            return $existUser;
        }
        return null;
    }
    public function validateLogin($request): bool
    {
        if (empty($request->username) || empty($request->password)) {
            return false;
        }
        return true;
    }
}
