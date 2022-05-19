<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\Route;
use Khanguyennfq\CarForRent\service\SessionService;
use PDO;

class LoginController
{
    /**
     * @var PDO
     */
    private PDO $conn;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;


    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
        $this->userRepository = new UserRepository($this->conn);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        if (SessionService::getSession("user_username")) {
            Route::redirect("/");
        } else {
            View::render("Login");
        }
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $loginRequest = new LoginRequest($_POST);
        $user = $this->userRepository->findUserName($loginRequest->username);
        if ($user == null) {
            View::render('Login', [
                'username' => $loginRequest->username,
                'password' => '',
                'error' => 'User is not exist',
            ]);
            return;
        }
        if (!password_verify($loginRequest->password, $user->password)) {
            View::render('Login', [
                'username' => $loginRequest->username,
                'password' => '',
                'error' => 'Wrong password',
            ]);
            return;
        }
        SessionService::setSession("user_username", $user->getUsername());
        Route::redirect('/');
    }

    /**
     * @return void
     */
    public function logOut(): void
    {
        SessionService::unsetSession('user_username');
        Route::redirect('/login');
    }
}
