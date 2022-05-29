<?php

namespace Khanguyennfq\CarForRent\model;

class UserModel
{
    private string $customerName;
    private string $username;
    private string $password;
    private int $ID;

    /**
     * @return string
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @param string $customerName
     */
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function fromArray(array $params): void
    {
        $this->username = $params['username'] ?? null;
        $this->password = $params['password'] ?? null;
    }
}
