<?php

use Khanguyennfq\CarForRent\request\LoginRequest;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\service\LoginService;
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
                    'user' => $this->getUser('kha@123', 'kha',123)
                ],
                'expected' => [
                    'customer_name' => 'kha',
                    'username' => 'kha@123',
                ]
            ]
        ];
    }

    private function getUser(string $userName, string $customerName, string $password)
    {
       $user = new UserModel();
       $user->setCustomerName($customerName);
       $user->setUsername($userName);
       $user->setPassword(password_hash($password,PASSWORD_BCRYPT));
       return $user;
    }
}
