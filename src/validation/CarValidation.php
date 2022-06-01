<?php

namespace Khanguyennfq\CarForRent\validation;

use Khanguyennfq\CarForRent\transfer\CarTransfer;

class CarValidation
{
    public function validate(CarTransfer $car): bool
    {
        if ($car->getPrice()=='' || $car->getColor() =='' || $car->getBrand() =='' || $car->getThumb() =='') {
            return true;
        }
        return false;
    }
}
