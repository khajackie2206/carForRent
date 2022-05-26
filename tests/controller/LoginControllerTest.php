<?php

namespace Khanguyennfq\CarForRent\tests\controller;

use Khanguyennfq\CarForRent\app\View;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\service\LoginService;
use Khanguyennfq\CarForRent\controller\LoginController;
use Khanguyennfq\CarForRent\service\SessionService;
use Khanguyennfq\CarForRent\model\UserModel;
use Khanguyennfq\CarForRent\core\Request;

class LoginControllerTest extends TestCase
{

    protected LoginService $loginService;
    protected UserModel $userModel;

    public function setUp(): void
    {
        $this->userModel = new UserModel();
    }

    /**
     * @dataProvider loginSuccessProvider
     * @runInSeparateProcess
     * @param $param
     * @return void
     */
    public function testLoginSuccess($param)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn($param);
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);

        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn($param['user']);

        $loginController = new LoginController($requestMock, $this->userModel, $loginServiceMock);
        $result = $loginController->login();
        $view = new View();
        $expected = $view::redirect('/');
        $this->assertEquals($expected, $result);
    }

    /**
     * @return \array[][]
     */
    public function loginSuccessProvider(): array
    {
        return [
            'login-1' => [
                'param' => [
                    'username' => 'kha@123',
                    'password' => '1234',
                    'user' => $this->getUser(
                        'kha@123',
                        'kha',
                        '1234',
                    )
                ],
            ],
        ];
    }

    /**
     * @dataProvider loginFailProvider
     * @param $param
     * @return void
     */
    public function testLoginFail($param)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn($param);
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);

        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn(null);

        $loginController = new LoginController($requestMock, $this->userModel, $loginServiceMock);
        $result = $loginController->login();
        $view = new View();
        $expected = $view::render('Login');
        $this->assertEquals($expected, $result);
    }

    public function loginFailProvider(): array
    {
        return [
            'login-1' => [
                'param' => [
                    'username' => 'kha@1234',
                    'password' => '123',
                    'user' => null
                ],
            ],
        ];
    }

    private function getUser(string $userName, string $customerName, string $password)
    {
        $user = new UserModel();
        $user->setCustomerName($customerName);
        $user->setUsername($userName);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        return $user;
    }

    /**
     * @runInSeparateProcess
     * @return void
     */
    public function testLogOut()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $this->userModel, $loginServiceMock);
        $view = new View();
        $result = $loginController->logOut();
        $expected = $view::redirect("/login");
        $this->assertEquals($expected, $result);
    }
    public function testIndexFail()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $this->userModel, $loginServiceMock);
        $view = new View();
        $result = $loginController->index();
        $expected = $view::render("Login");
        $this->assertEquals($expected, $result);
    }

    /**
     * @runInSeparateProcess
     * @return void
     */
    public function testIndexSuccess()
    {
        $sessionService = new SessionService();
        $sessionService::setSession('user_username', 'kha@123');
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($requestMock, $this->userModel, $loginServiceMock);
        $result = $loginController->index();
        $expected = false;
        $this->assertEquals($expected, $result);
        $sessionService::unsetSession('user_username');
    }
}
