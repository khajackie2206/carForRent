<?php

namespace Khanguyennfq\CarForRent\request;

class LoginRequest
{
    public string $username;
    public string $password;

    /**
     * @param array $loginRequest
     */
    public function __construct(array $loginRequest)
    {
        $this->username = $loginRequest['username'];
        $this->password = $loginRequest['password'];
    }
}
