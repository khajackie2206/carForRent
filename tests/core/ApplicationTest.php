<?php

namespace Khanguyennfq\CarForRent\tests\core;

use Khanguyennfq\CarForRent\core\Application;
use Khanguyennfq\CarForRent\core\Request;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{

    /**
     * @dataProvider applicationProvider
     * @param $params
     * @return void
     */
  public function testApplication($params)
  {
     $requestMock->expects(self::once())->method("getMethod")->willReturn($params['method']);
     $requestMock->expects(self::once())->method("getPath")->willReturn($params['uri']);
     $app = new Application($params['uri']);
     self::assertTrue($app->run($params['uri']));
  }

    public function applicationProvider()
    {
        return [
            'case1' => [
                'params' => '/'
            ],
            'case2' => [
                'params' => [
                    'method' => 'POST',
                    'uri' => "/abcxyz"
                ]
            ]
        ];
    }
}
