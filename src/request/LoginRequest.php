<?php

namespace Khanguyennfq\CarForRent\request;

class LoginRequest
{

    private string $username;
    private string $password;

    /**
     * @return mixed|string
     */
    public function getUsername(): mixed
    {
        return $this->username;
    }

    /**
     * @param mixed|string $username
     */
    public function setUsername(mixed $username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed|string
     */
    public function getPassword(): mixed
    {
        return $this->password;
    }

    /**
     * @param mixed|string $password
     */
    public function setPassword(mixed $password): void
    {
        $this->password = $password;
    }

    public function fromArray(array $requestBody): self
    {
        $this->setUsername($requestBody['username']);
        $this->setPassword($requestBody['password']);
        return $this;
    }
}
