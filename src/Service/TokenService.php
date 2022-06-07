<?php

namespace Khanguyennfq\CarForRent\Service;

use Exception;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;
use Firebase\JWT\Key;

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

    public function validateToken($token): array | bool
    {
        try {
            $decoded = JWT::decode($token,  new Key($this->jwtSecret, 'HS256'));
        } catch (\Exception $e) {
           return false;
        }
        return (array)$decoded;
    }
}
