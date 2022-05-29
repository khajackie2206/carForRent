<?php

namespace Khanguyennfq\CarForRent\repository;

use Khanguyennfq\CarForRent\database\DatabaseConnect;
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

    public function findUserName(string $username): ?UserModel
    {
        $sql = $this->conn->prepare("SELECT * FROM user WHERE username = ? ");
        $sql->execute([$username]);
        $user = new UserModel();
        $row = $sql->fetch();
        if (!$row) {
            return null;
        }
        $user->setID($row['ID']) ;
        $user->setUsername($row['username']) ;
        $user->setPassword($row['password']) ;
        $user->setCustomerName($row['name']) ;
        return $user;
    }
}
