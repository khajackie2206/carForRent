<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\transfer\CarTransfer;

class CarValidator
{

    public function validateCar(CarTransfer $car)
    {
        $carError = [];
        if ($car->getBrand() == '') {
            $carError['brand'] = "Brand can't be empty!";
        }
        if ($car->getPrice() == '') {

            $carError['price'] = "Price can't be empty!";
        }
        if ($car->getColor() == '') {

            $carError['color'] = "Color can't be empty!";
        }
        return $carError;
    }
}
