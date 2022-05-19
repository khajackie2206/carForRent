<?php

namespace Khanguyennfq\CarForRent\repository;

use PDO;
use Khanguyennfq\CarForRent\model\UserModel;

class UserRepository
{
    private PDO $conn;

    /**
     * @param $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param UserModel $user
     * @return UserModel
     */
    public function addUser(UserModel $user): UserModel
    {
        $sql = $this->conn->prepare("INSERT INTO user (user_customer_name, user_username, user_password) values (?,?,?) ");
        $sql->execute([
            $user->getCustomerName(),
            $user->getUsername(),
            $user->getPassword()
        ]);
        return $user;
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
        if ($row = $sql->fetch()) {
            $user->username = $row['user_username'];
            $user->password = $row['user_password'];
            $user->fullName = $row['user_customer_name'];
            return $user;
        } else {
            return null;
        }
    }
}
