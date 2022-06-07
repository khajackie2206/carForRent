<?php

namespace Khanguyennfq\CarForRent\Service;

use Khanguyennfq\CarForRent\Repository\UserRepository;
use Khanguyennfq\CarForRent\Model\UserModel;
use Khanguyennfq\CarForRent\Request\RegisterRequest;

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
