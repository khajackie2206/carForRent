<?php

use Khanguyennfq\CarForRent\Request\LoginRequest;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\Repository\UserRepository;
use Khanguyennfq\CarForRent\Model\UserModel;
use Khanguyennfq\CarForRent\Service\LoginService;
use Dotenv\Exception\ValidationException;

class LoginServiceTest extends TestCase
{


    /**
     * @dataProvider loginSuccessProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testLoginSuccess(array $params, array $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn($params['userReturn']);
        $loginService = new LoginService($userRepositoryMock);
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($params);
        $userResult = $loginService->login($loginRequest);
        $expectedUser = $expected['user'];
        $this->assertEquals($expectedUser->getUsername(), $userResult->getUsername());
        $this->assertEquals($expectedUser->getID(), $userResult->getID());
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function getUser(string $id, string $customerName, string $username, string $password): UserModel
    {
        $user = new UserModel();
        $user->setID($id);
        $user->setUsername($username);
        $user->setCustomerName($customerName);
        $user->setPassword($password);
        return $user;
    }

    public function loginSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'kha@123',
                    'password' => '123',
                    'userReturn' => $this->getUser(5, 'kha', 'kha@123', $this->hashPassword('123')),
                ],
                'expected' => [
                    'user' => $this->getUser(5, 'kha', 'kha@123', $this->hashPassword('123'))
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'kha@1234',
                    'password' => '123',
                    'userReturn' => $this->getUser(27, 'kha', 'kha@1234', $this->hashPassword('123')),
                ],
                'expected' => [
                    'user' => $this->getUser(27, 'kha', 'kha@1234', $this->hashPassword('123'))
                ]
            ]
        ];
    }

    /**
     * @dataProvider loginFailProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testLoginFail($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn($expected['user']);
        $loginService = new LoginService($userRepositoryMock);
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($params);
        $userResult = $loginService->login($loginRequest);
        $this->assertNull($userResult);
    }

    public function loginFailProvider()
    {
        return [
            'sad-case-1' => [
                'params' => [
                    'username' => 'kha@123',
                    'password' => '123'
                ],
                'expected' => [
                    'user' => $this->getUser(5, 'kha', 'kha@123', $this->hashPassword('1234'))
                ]
            ],
            'sad-case-2' => [
                'params' => [
                    'username' => 'kha@1234',
                    'password' => '123'
                ],
                'expected' => [
                    'user' => $this->getUser(27, 'kha', 'kha@1234', $this->hashPassword('1234'))
                ]
            ]
        ];
    }
}
