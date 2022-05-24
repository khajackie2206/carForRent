<?php

namespace Khanguyennfq\CarForRent\controller;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\core\Route;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\exception\LoginException;
use Khanguyennfq\CarForRent\service\LoginService;
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
    private $loginService;

    public function __construct()
    {
        $userRepository  = new UserRepository(DatabaseConnect::getConnection());
        $this->loginService = new LoginService($userRepository);
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
    public function login()
    {
        $user = new UserModel();
        $loginRequest = new LoginRequest($_POST);
        $user->setUsername($loginRequest->username);
        $user->setPassword($loginRequest->password);
        if (!$this->loginService->validateLogin($loginRequest)) {
            View::render('Login', [
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'error' => "You must type all blank"
            ]);
            return ;
        }
        try {
            $user_get = $this->loginService->login($user);
            SessionService::setSession("user_username", $user_get->getUsername());
            View::redirect("/");
        } catch (ValidationException $e) {
            View::render('Login', [
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'error' => $e->getMessage(),
            ]);
        }
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
