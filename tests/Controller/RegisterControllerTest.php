<?php

namespace controller;

use Khanguyennfq\CarForRent\Controller\RegisterController;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Request\RegisterRequest;
use Khanguyennfq\CarForRent\Validation\UserValidator;
use Khanguyennfq\CarForRent\Service\UserService;
use Khanguyennfq\CarForRent\Service\SessionService;
use PHPUnit\Framework\TestCase;

class RegisterControllerTest extends TestCase
{
    public function testIndexSuccess()
    {
        $sessionService = new SessionService();
        $sessionService::setSession('user_username', 'kha@123');
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $registerRequestMock = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $registerController = new RegisterController($requestMock, $response, $registerRequestMock, $userValidatorMock, $userServiceMock);
        $registerController = $registerController->index();
        $response = new Response();
        $expected = $response->redirect('/');
        $this->assertEquals($expected, $registerController);
        $sessionService::unsetSession('user_username');
    }

    public function testIndexFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $response = new Response();
        $registerRequestMock = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $registerController = new RegisterController($requestMock, $response, $registerRequestMock, $userValidatorMock, $userServiceMock);
        $registerController = $registerController->index();
        $response = new Response();
        $expected = $response->view('Register');
        $this->assertEquals($expected, $registerController);
    }

    public function testAddUserSuccess()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn([
         'username' => 'username',
            'name'  => 'name',
            'password' => 'password',
            're_password' => 're_password'
        ]);
        $response = new Response();
        $registerRequestMock = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateRegister')->willReturn(true);
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userServiceMock->expects($this->once())->method('register')->willReturn(true);
        $registerController = new RegisterController($requestMock, $response, $registerRequestMock, $userValidatorMock, $userServiceMock);
        $registerController = $registerController->addUser();
        $expected = new Response();
        $expected->redirect('/login');
        $this->assertEquals($expected, $registerController);
    }

    public function testAddUserFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'kha@123',
            'name'  => 'kha',
            'password' => 'password',
            're_password' => 're_password'
        ]);
        $response = new Response();
        $registerRequestMock = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateRegister')->willReturn(true);
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userServiceMock->expects($this->once())->method('register')->willReturn(false);
        $registerController = new RegisterController($requestMock, $response, $registerRequestMock, $userValidatorMock, $userServiceMock);
        $registerController = $registerController->addUser();
        $expected = new Response();
        $expected->view('Register',['errors' => ['username' => 'Username already exists']]);
        $this->assertEquals($expected, $registerController);
    }

    public function testAddUserValidateFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => '',
            'name'  => '',
            'password' => 'password',
            're_password' => 're_password'
        ]);
        $response = new Response();
        $registerRequestMock = $this->getMockBuilder(RegisterRequest::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateRegister')->willReturn([
            'username' => 'Field value username is required.',
            'password' => 'Field value password is required.'
        ]);
        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $registerController = new RegisterController($requestMock, $response, $registerRequestMock, $userValidatorMock, $userServiceMock);
        $registerController = $registerController->addUser();
        $expected = new Response();
        $expected->view('Register',['errors' => ['username' => 'Field value username is required.', 'password' => 'Field value password is required.']]);
        $this->assertEquals($expected, $registerController);
    }

}
