<?php

namespace Khanguyennfq\CarForRent\tests\app;
use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\app\Application;
class ApplicationTest extends TestCase
{

    /**
     * @dataProvider applicationProvider
     * @param $params
     * @return void
     */
    public function testApplication($params)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects(self::once())->method("getMethod")->willReturn($params['method']);
        $requestMock->expects(self::once())->method("getPath")->willReturn($params['Uri']);

        $application = new Application($requestMock);
        self::assertTrue($application->run());
    }

    public function applicationProvider()
    {
        return [
            'case1' => [
                'params' => [
                    'method' => 'GET',
                    'Uri' => "/"
                ]
            ],
            'case2' => [
                'params' => [
                    'method' => 'POST',
                    'Uri' => "/abcxyz"
                ]
            ],
            'case3' => [
                'params' => [
                    'method' => 'PUT',
                    'Uri' => "/abcxyz"
                ]
            ],
            'case4' => [
                'params' => [
                    'method' => 'DELETE',
                    'Uri' => "/abcxyz"
                ]
            ]
        ];
    }
}
