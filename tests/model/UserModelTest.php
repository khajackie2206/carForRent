<?php

namespace model;

use Khanguyennfq\CarForRent\model\UserModel;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    public function testGetSet()
    {
        $params = [
            'ID' => 1,
            'username' => 'username',
            'customerName' => 'customerName',
            'password' => '1234'
        ];
        $userModel = new UserModel();
        $userModel->setID($params['ID']);
        $userModel->setCustomerName($params['customerName']);
        $userModel->setUsername($params['username']);
        $userModel->setPassword($params['password']);
        $this->assertEquals($userModel->getID(), $params['ID']);
        $this->assertEquals($userModel->getUsername(), $params['username']);
        $this->assertEquals($userModel->getCustomerName(), $params['customerName']);
        $this->assertEquals($userModel->getPassword(), $params['password']);
    }
}
