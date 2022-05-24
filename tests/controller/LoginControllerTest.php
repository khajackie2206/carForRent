<?php

namespace Khanguyennfq\CarForRent\tests\controller;
se Khanguyennfq\CarForRent\controller\LoginController;
use Khanguyennfq\carForRent\core\Request;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\request\LoginRequest;use PHPUnit\Framework\TestCase;
class LoginControllerTest extends TestCase
{
   protected UserModel $user;
   public function  __construct(?string $name = null, array $data = [], $dataName = '')
   {
       parent::__construct($name, $data, $dataName);
       $this->user = new UserModel();
       $this->user->setCustomerName('kha');
       $this->user->setUsername('kha@123');
       $this->user->setPassword('123');
   }
   public function testLoginSuccess(): void
   {
       $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->getMock();


   }
}
