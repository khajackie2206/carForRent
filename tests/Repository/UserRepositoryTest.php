<?php

namespace Khanguyennfq\CarForRent\tests\repository;

use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\Repository\UserRepository;
use Khanguyennfq\CarForRent\Database\DatabaseConnect;
use Khanguyennfq\CarForRent\Model\UserModel;

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
