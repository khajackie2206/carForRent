<?php

namespace Service;

use Khanguyennfq\CarForRent\Service\TokenService;
use PHPUnit\Framework\TestCase;

class TokenServiceTest extends TestCase
{
    public function testGenerateAndValidateToken()
    {
        $tokenService = new TokenService();
        $token = $tokenService->jwtEncodeData(1);
        $expectedToken = $tokenService->validateToken($token);
        $this->assertEquals(1, $expectedToken['sub']);
    }
}
