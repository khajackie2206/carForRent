<?php

namespace Khanguyennfq\CarForRent\service;

use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\RegisterRequest;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): bool
    {
        $existUser = $this->userRepository->findUserName($request->getUsername());
        if ($existUser == null) {
            $user = new UserModel();
            $user->setUsername($request->getUsername());
            $user->setCustomerName($request->getFullname());
            $user->setPassword($request->getPassword());
            $this->userRepository->insertUser($user);
            return true;
        }
        return false;
    }
}
