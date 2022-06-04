<?php

namespace Khanguyennfq\CarForRent\model;

class UserModel
{
    private ?string $customerName;
    private ?string $username;
    private ?string $password;
    private ?int $ID;

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @param string|null $customerName
     */
    public function setCustomerName(?string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int|null
     */
    public function getID(): ?int
    {
        return $this->ID;
    }

    /**
     * @param int|null $ID
     */
    public function setID(?int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @param array $params
     * @return void
     */
    public function fromArray(array $params): void
    {
        $this->username = $params['username'] ?? null;
        $this->password = $params['password'] ?? null;
    }
}
