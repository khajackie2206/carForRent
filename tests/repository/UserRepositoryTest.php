<?php
namespace Khanguyennfq\CarForRent\tests\repository;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use Khanguyennfq\CarForRent\model\UserModel;
class UserRepositoryTest extends TestCase
{

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(DatabaseConnect::getConnection());
    }
    /**
     * @dataProvider findUserNameProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testFindUserName($params, $expected)
    {
        $result=$this->userRepository->findUserName($params);
        $this->assertEquals($expected['user_customer_name'], $result->getCustomerName());
        $this->assertEquals($expected['user_username'], $result->getUsername());
    }

    /**
     * @return array[]
     */
    public function findUserNameProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => 'kha@123',
                'expected' =>[
                    'user_customer_name' => 'kha',
                    'user_username' => 'kha@123',
                ]
            ],
            'happy-case-2' => [
                'params' => 'khajackie2206@gmail.com',
                'expected' =>[
                    'user_customer_name' => 'Kha Minh',
                    'user_username' => 'khajackie2206@gmail.com',
                ]
            ]
        ];
    }

    /**
     * @dataProvider notFoundUserNameProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testNotFoundUserName($params, $expected)
    {
        $result = $this->userRepository->findUserName($params);
        $this->assertEmpty($result);
    }

    /**
     * @return array[]
     */
    public function notFoundUserNameProvider(): array
    {
        return [
            'not-found-case-1' => [
                'params' =>  'sadasdfddasd',
                'expected' => null
            ]
        ];
    }

    /**
     * @dataProvider addUserProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testAddUser($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('addUser')->willReturn($params['user']);

        $user = new UserModel();
        $user->setUsername($params['username']);
        $user->setPassword($params['password']);
        $user->setCustomerName($params['customer_name']);

        $result=$userRepositoryMock->addUser($user);

        $this->assertEquals($expected['username'], $result->getUsername());
        $this->assertEquals($expected['customer_name'], $result->getCustomerName());
    }

    /**
     * @return array
     */
    public function addUserProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'kha@123',
                    'password' => '123',
                    'customer_name' => 'kha',
                    'user' => $this->getUser('kha@123', 'kha', 123)
                ],
                'expected' => [
                    'username' => 'kha@123',
                    'customer_name' => 'kha'
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'khajackie@gmail.com',
                    'password' => '123456',
                    'customer_name' => 'kha minh',
                    'user' => $this->getUser('khajackie@gmail.com', 'kha minh', 123456)
                ],
                'expected' => [
                    'username' => 'khajackie@gmail.com',
                    'customer_name' => 'kha minh'
                ]
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
}
