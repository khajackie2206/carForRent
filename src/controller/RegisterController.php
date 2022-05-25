<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\core\Route;
use Khanguyennfq\CarForRent\service\LoginService;


class RegisterController
{

    private $loginService;
    private $userModel;
    private $request;
    public function __construct(Request $request, UserModel $userModel, LoginService $loginService)
    {
        $this->request = $request;
        $this->userModel = $userModel;
        $this->loginService = $loginService;
    }

    public function index(): void
    {
        view::render('Register');
    }

    public function store()
    {
        $err = '';
        if($this->request->isPost()) {
            $userParams = $this->request->getBody();
            $this->userModel->fromArrayAddUser($userParams);
            $result = $this->userRepository->addUser($this->userModel);
            Route::redirect("/login");
        }
    }
}
