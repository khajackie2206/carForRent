<?php

namespace Khanguyennfq\CarForRent\repository;

use Khanguyennfq\CarForRent\model\UserModel;
use Exception;
class UserRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $username
     * @return UserModel|null
     */
    public function findUserName(string $username): ?UserModel
    {
        $sql = $this->getConn()->prepare("SELECT * FROM user WHERE username = ? ");
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

    /**
     * @param UserModel $user
     * @return bool
     */
    public function insertUser(UserModel $user): bool
    {
        $statement = $this->getConn()->prepare("INSERT INTO user(name ,username, password) VALUES(?, ?, ?)");
        try {
            $statement->execute([
                $user->getCustomerName(),
                $user->getUsername(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT)
            ]);
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
