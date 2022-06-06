<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\RegisterRequest;
use Khanguyennfq\CarForRent\request\LoginRequest;

class UserValidator extends Validator
{

    /**
     * @param UserModel $user
     * @return bool
     */
    public function validateLogin(LoginRequest $loginRequest): bool
    {
        if (empty($loginRequest->getUsername()) || empty($loginRequest->getPassword())) {
            return false;
        }
        return true;
    }

    /**
     * @param RegisterRequest $registerRequest
     * @return bool|array
     */
    public function validateRegister(RegisterRequest $registerRequest): bool | array
    {
        $val = new Validator();
        $val->name('username')->value($registerRequest->getUsername())->required()->min(6)->max(50);
        $val->name('name')->value($registerRequest->getFullname())->required()->min(3)->max(50);
        $val->name('password')->value($registerRequest->getPassword())->min(3)->required();
        $val->name('retype password')->value($registerRequest->getConfirmPassword())->equal($registerRequest->getPassword())->required();
        if ($val->isSuccess()) {
            return true;
        }
        return $val->getErrors();
    }
}
