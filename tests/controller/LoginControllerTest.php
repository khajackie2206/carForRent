<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\controller\LoginController;
use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase
{


    public function testLoginSuccess($params)
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $responseMock = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $userModelMock = $this->getMockBuilder(UserModel::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn($params['user']);
        $loginController = new LoginController($requestMock,$responseMock, $userModelMock, $loginServiceMock);
        $result = $loginController->login();
        $view  = new Response();
        $expected = $view->redirect('/');
        $this->assertEquals($expected, $result);
    }

}
