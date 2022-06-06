<?php

namespace controller\API;

use Khanguyennfq\CarForRent\controller\API\LoginControllerAPI;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\request\LoginRequest;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\service\TokenService;
use Khanguyennfq\CarForRent\transformer\UserTransformer;
use Khanguyennfq\CarForRent\validation\UserValidator;
use Khanguyennfq\CarForRent\model\UserModel;
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
        $loginController = new LoginControllerAPI($requestMock , $loginRequestMock,$loginServiceMock,$response,$tokenServiceMock, $userTransformerMock, $userValidatorMock);
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
        $loginController = new LoginControllerAPI($requestMock , $loginRequestMock,$loginServiceMock,$response,$tokenServiceMock, $userTransformerMock, $userValidatorMock);
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
        $loginController = new LoginControllerAPI($requestMock , $loginRequestMock,$loginServiceMock,$response,$tokenServiceMock, $userTransformerMock, $userValidatorMock);
        $loginController = $loginController->login();
        $this->assertEquals(401, $loginController->getStatusCode());
    }
}
