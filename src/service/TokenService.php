<?php

namespace Khanguyennfq\CarForRent\service;

use Exception;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;

class TokenService
{
    private string $jwtSecret;
    private static $loadEnv;

    public function __construct()
    {
        self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../../');
        self::$loadEnv->load();
        $this->jwtSecret = $_ENV['JWT_SECRET_TOKEN'];
    }

    /**
     * @param int $userID
     * @return string
     */
    public function jwtEncodeData(int $userID): string
    {
        $payload = [
           'sub' => $userID,
           'iat' => time()
        ];
        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }
}
