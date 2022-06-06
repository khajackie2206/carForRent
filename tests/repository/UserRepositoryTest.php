<?php

namespace Khanguyennfq\CarForRent\tests\repository;

use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\model\UserModel;

class UserRepositoryTest extends TestCase
{


    public function testFindUserNameSuccess()
    {
        $userRepository = new UserRepository();
        $result = $userRepository->findUserName('kha@123');
        $this->assertEquals('kha@123', $result->getUsername());
    }

    public function testFindUserNameFail()
    {
        $userRepository = new UserRepository();
        $result = $userRepository->findUserName('asdasdassffw');
        $this->assertEquals(null, $result);
    }




}
