<?php

namespace Khanguyennfq\CarForRent\repository;

use Khanguyennfq\CarForRent\database\DatabaseConnect;
use PDO;
use Khanguyennfq\CarForRent\model\UserModel;

class UserRepository
{
    private $conn;


    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
    }


    /**
     * @param $username
     * @return UserModel|null
     */
    public function findUserName($username): ?UserModel
    {
        $sql = $this->conn->prepare("SELECT * FROM user WHERE user_username = ? ");
        $sql->execute([$username]);
        $user = new UserModel();
        $row = $sql->fetch();
        if (!$row) {
            return null;
        }
        $user->setUsername($row['user_username']) ;
        $user->setPassword($row['user_password']) ;
        $user->setCustomerName($row['user_customer_name']) ;
        return $user;
    }
}
