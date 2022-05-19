<?php
namespace Khanguyennfq\CarForRent\model;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
class UserModel
{
    private string $customerName;
    private string $email;
    private string $password;

    /**
     * @param string $customerName
     * @param string $email
     * @param string $password
     */
    public function __construct(string $customerName, string $email, string $password)
    {
        $this->customerName = $customerName;
        $this->email = $email;
        $this->password = $password;
    }
    public function addUser():void
    {
        try {
            $con = DatabaseConnect::getConnection();
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
    public function addCustomer(): void
    {
        try {
            $con = DatabaseConnect::getConnection();
            $sql = "INSERT INTO user (user_customer_name, user_username, user_password) VALUES ('$this->customerName', '$this->usern', 'Skagen 21', 'Stavanger', '4006', 'Norway');"
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}
