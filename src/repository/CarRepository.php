<?php

namespace Khanguyennfq\CarForRent\repository;
use Khanguyennfq\CarForRent\model\CarModel;
use Khanguyennfq\CarForRent\database\DatabaseConnect;
class CarRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnect::getConnection();
    }

    public function listCar(): ?CarModel
    {
        $sql = $this->conn->prepare("SELECT * FROM car");
        $sql->execute();
        $car = new CarModel();
        try {
            if ($row = $sql->fetch()) {
                $car->setID($row['id']);
                $car->setBrandName($row['brand']);
                $car->setColor($row['color']);
                $car->setCost($row['price']);
                $car->setThumb($row['thumb']);
                return $car;
            } else {
                return null;
            }
        } finally {
            $sql->closeCursor();
        }
    }
}