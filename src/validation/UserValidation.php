<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;

class UserValidation
{

    public function validateLogin(UserModel $user): bool
    {
        if (empty($user->getUsername()) || empty($user->getPassword())) {
            return false;
        }
        return true;
    }
}
