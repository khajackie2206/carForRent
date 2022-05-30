<?php

namespace Khanguyennfq\CarForRent\repository;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
use PDO;
class CarRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
    }

    public function addCar($newcar): bool
    {
        $sql = $this->conn->prepare("INSERT ONTO car(ID, brand, price, color, thumb VALUES (?,?,?,?) ");
        return $sql->execute($newcar);
    }

    public function listCar()
    {
        $sql = $this->conn->prepare("SELECT * FROM `car`");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(!$row)
        {
            return null;
        }
        $carArray = [];
        foreach ($row as $key => $car){
            $carData = new CarModel();
            $carData->setID($car['ID']);
            $carData->setBrandName($car['brand']);
            $carData->setCost($car['price']);
            $carData->setColor($car['color']);
            $carData->setThumb($car['thumb']);
            array_push($carArray, $carData);
        }
        return $carArray;
    }
}
