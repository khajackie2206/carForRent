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
    /**
     * @return array
     */
    private function getUser(string $userName, string $customerName, string $password)
    {
        $user = new UserModel();
        $user->setCustomerName($customerName);
        $user->setUsername($userName);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        return $user;
    }
}
