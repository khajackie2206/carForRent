<?php

namespace controller\API;

use Khanguyennfq\CarForRent\Controller\API\LoginControllerAPI;
use Khanguyennfq\CarForRent\Core\Response;
use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Request\LoginRequest;
use Khanguyennfq\CarForRent\Service\LoginService;
use Khanguyennfq\CarForRent\Service\TokenService;
use Khanguyennfq\CarForRent\Transformer\UserTransformer;
use Khanguyennfq\CarForRent\Validation\UserValidator;
use Khanguyennfq\CarForRent\Model\UserModel;
use PHPUnit\Framework\TestCase;

class LoginControllerAPITest extends TestCase
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

    public function testLoginSuccess(): void
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getRequestJsonBody')->willReturn([
            'username' => 'kha@123',
            'password' => '123'
        ]);
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn($this->user);
        $userTransformerMock = $this->getMockBuilder(UserTransformer::class)->disableOriginalConstructor()->getMock();
        $tokenServiceMock = $this->getMockBuilder(TokenService::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateLogin')->willReturn(true);
        $loginController = new LoginControllerAPI($requestMock, $loginRequestMock, $loginServiceMock, $response, $tokenServiceMock, $userTransformerMock, $userValidatorMock);
        $loginController = $loginController->login();
        $this->assertEquals(200, $loginController->getStatusCode());
    }

    public function testLoginInvalid(): void
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getRequestJsonBody')->willReturn([
            'username' => 'kha@123',
            'password' => '123'
        ]);
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $userTransformerMock = $this->getMockBuilder(UserTransformer::class)->disableOriginalConstructor()->getMock();
        $tokenServiceMock = $this->getMockBuilder(TokenService::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateLogin')->willReturn(false);
        $loginController = new LoginControllerAPI($requestMock, $loginRequestMock, $loginServiceMock, $response, $tokenServiceMock, $userTransformerMock, $userValidatorMock);
        $loginController = $loginController->login();
        $this->assertEquals(400, $loginController->getStatusCode());
    }

    public function testLoginFail(): void
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getRequestJsonBody')->willReturn([
            'username' => 'kha@123',
            'password' => '123'
        ]);
        $response = new Response();
        $loginRequestMock = $this->getMockBuilder(LoginRequest::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn(null);
        $userTransformerMock = $this->getMockBuilder(UserTransformer::class)->disableOriginalConstructor()->getMock();
        $tokenServiceMock = $this->getMockBuilder(TokenService::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock = $this->getMockBuilder(UserValidator::class)->disableOriginalConstructor()->getMock();
        $userValidatorMock->expects($this->once())->method('validateLogin')->willReturn(true);
        $loginController = new LoginControllerAPI($requestMock, $loginRequestMock, $loginServiceMock, $response, $tokenServiceMock, $userTransformerMock, $userValidatorMock);
        $loginController = $loginController->login();
        $this->assertEquals(401, $loginController->getStatusCode());
    }
}
