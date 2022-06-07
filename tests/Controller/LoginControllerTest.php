<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\App\View;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\Service\LoginService;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Model\UserModel;
use Khanguyennfq\CarForRent\Controller\LoginController;
use Khanguyennfq\CarForRent\Service\SessionService;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase
{

    protected UserModel $user;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->user = new UserModel();
        $this->user->setID(1);
        $this->user->setUsername('kha@123');
        $this->user->setCustomerName('kha');
        $this->user->setPassword('123');

    }

    public function testLoginSuccess()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'kha@123',
            'password' => '123'
        ]);
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn($this->user);
        $loginController = new LoginController($requestMock, $loginRequestMock, $loginServiceMock, $response);
        $result = $loginController->login();
        $view = new Response();
        $expected = $view->redirect('/');
        $this->assertEquals($expected, $result);
    }

    public function testLoginFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'kha@123',
            'password' => '123'
        ]);
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn(null);
        $loginController = new LoginController($requestMock, $loginRequestMock, $loginServiceMock, $response);
        $result = $loginController->login();
        $view = new Response();
        $expected = $view->view('Login', ['errors' => 'Username or password is invalid']);
        $this->assertEquals($expected, $result);
    }


    public function testLogout()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $loginRequestMock, $loginServiceMock, $response);
        $sessionService = new SessionService();
        $sessionService::setSession('user_username', 'kha@123');
        $loginController = $loginController->logOut();
        $expected = $response->redirect('/');
        $this->assertEquals($expected, $loginController);
    }

    public function testIndexSuccess()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $loginRequestMock, $loginServiceMock, $response);
        $sessionService = new SessionService();
        $sessionService::setSession('user_username', 'kha@123');
        $loginController = $loginController->index();
        $expected = $response->redirect('/');
        $this->assertEquals($expected, $loginController);
        $sessionService::unsetSession('user_username');
    }

    public function testIndexFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $loginRequestMock, $loginServiceMock, $response);
        $loginController = $loginController->index();
        $expected = $response->view('Login');
        $this->assertEquals($expected, $loginController);
    }
}
