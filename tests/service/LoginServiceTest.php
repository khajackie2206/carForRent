<?php

use Khanguyennfq\CarForRent\request\LoginRequest;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\service\LoginService;
use Dotenv\Exception\ValidationException;

class LoginServiceTest extends TestCase
{


    /**
     * @dataProvider loginSuccessProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testLoginSuccess($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn($params['userReturn']);
        $loginService = new LoginService($userRepositoryMock);
        $userModel = new UserModel();
        $userModel->fromArray($params);
        $userResult = $loginService->login($userModel);
        $expectedUser = $expected['user'];
        $this->assertEquals($expectedUser->getUsername(), $userResult->getUsername());
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function getUser( string $username, string $password): UserModel
    {
        $user = new UserModel();
        $user->setUsername($username);
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
                    'userReturn' => $this->getUser( 'kha@123', $this->hashPassword('123')),
                ],
                'expected' => [
                    'user' => $this->getUser('kha@123', $this->hashPassword('123'))
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'kha@1234',
                    'password' => '123',
                    'userReturn' => $this->getUser('kha@1234', $this->hashPassword('123')),
                ],
                'expected' => [
                    'user' => $this->getUser('kha@1234', $this->hashPassword('123'))
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
        $userModel = new UserModel();
        $userModel->fromArray($params);
        $userResult = $loginService->login($userModel);
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
                    'user' => $this->getUser('kha@123', $this->hashPassword('1234'))
                ]
            ],
            'sad-case-2' => [
                'params' => [
                    'username' => 'kha@1234',
                    'password' => '123'
                ],
                'expected' => [
                    'user' => $this->getUser('kha@1234', $this->hashPassword('1234'))
                ]
            ]
        ];
    }
}
