<?php

namespace Khanguyennfq\CarForRent\service;

use Exception;
use Firebase\JWT\JWT;
class TokenService
{
    private string $jwtSecret;
    private array $token;
    private int $issueAt;
    private int $expire;
    private string $jwt;

    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->issueAt = time();
        $this->expire = $this->issueAt + 3600;
        $this->jwtSecret = 'khajackie2206';
    }

    /**
     * @param $iss
     * @param $data
     * @return string
     */
    public function jwtEncodeData($iss, $data): string
    {
        $this->token = array (
            "iss" => $iss,
            "aud" => $iss,
            "iat" => $this->issueAt,
            "exp" => $this->expire,
            "data" =>$data
        );
        $this->jwt = JWT::encode($this->token, $this->jwtSecret,'HS256');
        return $this->jwt;
    }

}
