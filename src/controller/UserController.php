<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;

class UserController
{
    /**
     * @return false|string
     */
    public function index(): bool
    {
        view::render('Login');
        return true;
    }
}
