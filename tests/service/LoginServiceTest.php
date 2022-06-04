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
     * @dataProvider loginDataProvider
     * @param $params
     * @param $expected
     * @return void
     */

    public function testLogin($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn($params['user']);

        $loginService = new LoginService($userRepositoryMock);

        $user = new UserModel();
        $loginRequest = new LoginRequest($params);
        $user->setUsername($loginRequest->username);
        $user->setPassword($loginRequest->password);

        $result = $loginService->login($user);

        $this->assertEquals($expected['customer_name'], $result->getCustomerName());
        $this->assertEquals($expected['username'], $result->getUsername());
    }

    /**
     * @return array[]
     */
    public function loginDataProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'kha@123',
                    'password' => '123',
                    'user' => $this->getUser('kha@123', 'kha', 123)
                ],
                'expected' => [
                    'customer_name' => 'kha',
                    'username' => 'kha@123',
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'khajackie@gmail.com',
                    'password' => '123456',
                    'user' => $this->getUser('khajackie@gmail.com', 'kha minh', 123456)
                ],
                'expected' => [
                    'customer_name' => 'kha minh',
                    'username' => 'khajackie@gmail.com',
                ]
            ]
        ];
    }

    /**
     * @dataProvider loginFailDataProvider
     * @param $params
     * @return void
     */
    public function testLoginFail($params)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserName')->willReturn($params['user']);

        $loginService = new LoginService($userRepositoryMock);

        $user = new UserModel();
        $loginRequest = new LoginRequest($params);
        $user->setUsername($loginRequest->username);
        $user->setPassword($loginRequest->password);

        $result = $loginService->login($user);

        $this->assertEmpty($result);
    }
    public function loginFailDataProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'kha@123asdas',
                    'password' => '123asdasd',
                    'user' => null
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'khajackie@gmail.comm',
                    'password' => '123456aa',
                    'user' => null
                ],
            ]
        ];
    }
    private function getUser(string $userName, string $customerName, string $password)
    {
        $user = new UserModel();
        $user->setCustomerName($customerName);
        $user->setUsername($userName);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        return $user;
    }


    /**
     * @dataProvider validateTrueDataProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testValidateTrue($params, $expected)
    {
        $loginRequest = new LoginRequest($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $loginService = new LoginService($userRepositoryMock);
        $result = $loginService->validateLogin($loginRequest);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function validateTrueDataProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'username1',
                    'password' => 'password1'
                ],
                'expected' => true
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'username2',
                    'password' => 'password2'
                ],
                'expected' => true
            ]
        ];
    }

    /**
     * @dataProvider validateFalseDataProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testValidateFalse($params, $expected)
    {
        $loginRequest = new LoginRequest($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $loginService = new LoginService($userRepositoryMock);
        $result = $loginService->validateLogin($loginRequest);
        $this->assertEquals($expected, $result);
    }

    public function validateFalseDataProvider(): array
    {
        return [
            'sad-case-1' => [
                'params' => [
                    'username' => '',
                    'password' => 'password1'
                ],
                'expected' => false
            ],
            'sad-case-2' => [
                'params' => [
                    'username' => 'username2',
                    'password' => ''
                ],
                'expected' => false
            ],
            'sad-case-3' => [
                'params' => [
                    'username' => '',
                    'password' => ''
                ],
                'expected' => false
            ]
        ];
    }
}
