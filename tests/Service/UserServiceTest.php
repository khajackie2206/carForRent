<?php

namespace Service;

use Khanguyennfq\CarForRent\Service\UserService;
use Khanguyennfq\CarForRent\Repository\UserRepository;
use Khanguyennfq\CarForRent\Request\RegisterRequest;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $registerRequest = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn(null);
        $userService = new  UserService($userRepositoryMock);
        $result = $userService->register($registerRequest);
        $this->assertTrue($result);
    }
}
