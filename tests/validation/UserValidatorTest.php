<?php

namespace validation;

use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\validation\UserValidator;
use Khanguyennfq\CarForRent\request\RegisterRequest;
use PHPUnit\Framework\TestCase;

class UserValidatorTest extends TestCase
{

    /**
     * @dataProvider validateRegisterSuccessProvider
     * @param $params
     * @return void
     */
    public function testValidateRegisterSuccess($params)
    {
      $registerRequest = new RegisterRequest();
      $registerRequest->fromArray($params);
      $userValidator = new UserValidator();
      $expected = $userValidator->validateRegister($registerRequest);
      $this->assertTrue($expected);
    }

    public function validateRegisterSuccessProvider()
    {
        return [
             'happy-case-1'=> [
                'params' => [
                    'username' => 'kha@123',
                    'name' => 'kha',
                    'password' => '123',
                    're_password' => '123'
                ],
              ]
         ];
    }

    /**
     * @dataProvider validateRegisterFailProvider
     * @param $params
     * @return void
     */
    public function testValidateRegisterFail($params)
    {
        $registerRequest = new RegisterRequest();
        $registerRequest->fromArray($params);
        $userValidator = new UserValidator();
        $expected = $userValidator->validateRegister($registerRequest);
        $this->assertIsArray($expected);
    }

    public function validateRegisterFailProvider()
    {
        return [
            'sad-case-1'=> [
                'params' => [
                    'username' => '',
                    'name' => '',
                    'password' => '123',
                    're_password' => '1234'
                ],
            ]
        ];
    }

    /**
     * @dataProvider validateLoginFailProvider
     * @param $params
     * @return void
     */
    public function testValidateLoginFail($params)
    {
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($params);
        $userValidator = new UserValidator();
        $expected = $userValidator->validateLogin($loginRequest);
        $this->assertFalse($expected);
    }

    public function validateLoginFailProvider()
    {
        return [
            'sad-case-1'=> [
                'params' => [
                    'username' => '',
                    'password' => '',
                ],
            ]
        ];
    }
}
