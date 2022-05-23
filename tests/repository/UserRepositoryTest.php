<?php
namespace Khanguyennfq\CarForRent\tests\repository;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\repository\UserRepository;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
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
        $result=$this->userRepository->findUserName($params);
        $this->assertEmpty($result);
    }

    /**
     * @return array[]
     */
    public function notFoundUserNameProvider(): array
    {
        return [
            'not-found-case-1' => [
                'params' => 'hgkjhkjh',
                'expected' => []
            ]
        ];
    }
}
