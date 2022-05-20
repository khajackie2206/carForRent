<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\core\Route;
use PDO;

class RegisterController
{
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
    }

    public function index(): void
    {
        view::render('Register');
    }

    public function store()
    {
        $user = new UserModel();
        $user->setUsername($_POST['username']);
        $user->setPassword(password_hash(($_POST['password']), PASSWORD_BCRYPT));
        $user->setCustomerName($_POST['name']);
        $userRepository = new UserRepository($this->conn);
        $result = $userRepository->addUser($user);
        Route::redirect("/login");
    }
}
