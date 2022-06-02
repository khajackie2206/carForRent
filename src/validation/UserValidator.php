<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\RegisterRequest;
class UserValidator extends Validator
{

    /**
     * @param UserModel $user
     * @return bool
     */
    public function validateLogin(UserModel $user): bool
    {
        if (empty($user->getUsername()) || empty($user->getPassword())) {
            return false;
        }
        return true;
    }

    public function validateRegister(RegisterRequest $registerRequest): bool | array
    {
        $val = new Validator();
        $val->name('username')->value($registerRequest->getUsername())->required()->max(50);
        $val->name('name')->value($registerRequest->getFullname())->required()->max(50);
        $val->name('password')->value($registerRequest->getPassword())->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();
        $val->name('re_password')->value($registerRequest->getConfirmPassword())->equal($registerRequest->getPassword())->required();
        if ($val->isSuccess()) {
            return true;
        }
        return $val->getErrors();
    }
}
