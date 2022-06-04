<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\transfer\CarTransfer;

class CarValidator
{

    /**
     * @param CarTransfer $car
     * @return array|Validator
     */
    public function validateCar(CarTransfer $car)
    {
        $validator = new Validator();
        $validator->name('brand')->value($car->getBrand())->min(3)->max(255)->required();
        $validator->name('color')->value($car->getColor())->max(30)->required();
        $validator->name('price')->value($car->getPrice())->is_int()->max(5000)->required();
        if ($validator->isSuccess()) {
            return [];
        } else {
            return $validator->getErrors();
        }
    }
}
