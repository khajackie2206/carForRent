<?php

use PHPUnit\Framework\TestCase;
use Khanguyennfq\CarForRent\Service\SessionService;

class SessionServiceTest extends TestCase
{
    /**
     * @dataProvider setSessionProvider
     * @param $params
     * @return void
     */

    public function testSetSession($params)
    {
        $sessionService = new SessionService();
        $sessionService::setSession($params['key'], $params['value']);
        self::assertEquals($sessionService::getSession($params['key']), $params['value']);
        $sessionService::unsetSession($params['key']);
        self::assertEmpty($sessionService::getSession($params['key']));
    }

    public function setSessionProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'key' => 'username',
                    'value' => 'kha@123'
                ]
            ]
        ];
    }
}
