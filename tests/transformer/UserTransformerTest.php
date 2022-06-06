<?php

namespace transformer;

use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Khanguyennfq\CarForRent\model\UserModel;
use PHPUnit\Framework\TestCase;

class UserTransformerTest extends TestCase
{
    public function testToArray()
    {
        $userModel = new UserModel();
        $userModel->setID(1);
        $userModel->setUsername('kha@123');
        $userModel->setCustomerName('kha');
        $userTransfer = new UserTransformer();
        $result = $userTransfer->toArray($userModel);
        $expected = [
            'id' => 1,
            'username' => 'kha@123',
            'fullName' => 'kha',
        ];
        $this->assertEquals($expected, $result);
    }
}
