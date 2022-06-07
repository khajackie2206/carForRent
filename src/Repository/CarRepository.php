<?php

namespace Khanguyennfq\CarForRent\Repository;

use Khanguyennfq\CarForRent\Model\CarModel;
use PDO;

class CarRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $newcar
     * @return bool
     */
    public function addCar($newcar): bool
    {
        $sql = $this->getConn()->prepare("INSERT INTO car (ID, brand, price, color, thumb) VALUES (? ,? ,? ,? ,?)");
        return $sql->execute([$newcar[0], $newcar[1], $newcar[2], $newcar[3], $newcar[4]]);
    }

    /**
     * @return array|null
     */
    public function listCar()
    {
        $sql = $this->getConn()->prepare("SELECT * FROM `car` LIMIT 100");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $carsArray = [];
        foreach ($row as $key => $car) {
            $carData = new CarModel();
            $carData->setID($car['ID']);
            $carData->setBrandName($car['brand']);
            $carData->setCost($car['price']);
            $carData->setColor($car['color']);
            $carData->setThumb($car['thumb']);
            array_push($carsArray, $carData);
        }
        return $carsArray;
    }
}
