<?php

namespace Khanguyennfq\CarForRent\controller;
use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\model\UserModel;

class RegisterController
{
    /**
     * @return false|string
     */
    public function index(): false|string
    {
        return view::render('Register');
    }
    public function store()
    {
        $password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
        $user = new UserModel($_REQUEST['name'], $_REQUEST['email'],$password);
        $user->addUser();
    }
}
