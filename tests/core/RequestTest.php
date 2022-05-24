<?php
namespace Khanguyennfq\CarForRent\tests\core;

use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\core\Request;
class RequestTest extends TestCase
{

    public function testGetPath()
    {
       $request = new Request();
       $_SERVER['REQUEST_URI'] = '/login?redirect=true';
       $this->assertEquals('/login', $request->getPath());
    }

    /**
     * @dataProvider getMethodProvider
     * @param $params
     * @return void
     */
    public function testGetMethod($param)
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = $param;
        $this->assertEquals($param, $request->getMethod());
    }

    public function getMethodProvider()
    {
        return [
              ['GET'],
              ['POST'],
              ['PUT'],
              ['DELETE'],
              ['PATCH'],
        ];
    }
}
