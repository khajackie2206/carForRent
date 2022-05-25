<?php

namespace Khanguyennfq\CarForRent\controller;

use Dotenv\Exception\ValidationException;
use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\core\Route;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\exception\LoginException;
use Khanguyennfq\CarForRent\service\LoginService;
use Exception;
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
    private $userModel;
    private $request;
    public function __construct(Request $request, UserModel $userModel, LoginService $loginService)
    {
        $this->request = $request;
        $this->userModel = $userModel;
        $this->loginService = $loginService;
    }

    /**
     * @return void
     */
    public function index(): bool
    {
        if (SessionService::getSession("user_username")) {
            View::redirect("/");
        }
        View::render("Login");
        return true;
    }

    /**
     * @return bool|string
     */
    public function login()
    {
        try {
            $err = '';
            if ($this->request->isPost()) {
                $userparams = $this->request->getBody();
                $this->userModel->fromArray($userparams);
                $userLogged = $this->loginService->login($this->userModel);
                if (!empty($userLogged)) {
                    return View::redirect("/");
                }
                $err = 'The username or password is invalid!';
            }
        } catch (Exception $e) {
            $err = "Something went wrong!!!";
        }
        return View::render('Login', [
            'username' => $this->userModel->getUsername(),
            'password' => $this->userModel->getPassword(),
            'error' => $err
        ]);
    }
    /**
     * @return void
     */
    public function logOut(): bool
    {
        SessionService::unsetSession('user_username');
        View::redirect('/login');
        return true;
    }
}
