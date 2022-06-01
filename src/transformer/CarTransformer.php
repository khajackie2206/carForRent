<?php

namespace Khanguyennfq\CarForRent\transformer;

use Khanguyennfq\CarForRent\model\CarModel;

class CarTransformer
{
    public function toArray(CarModel $car): array
    {
        return [
            'ID' => $car->getID(),
            'brand' => $car->getBrandName(),
            'price' => $car->getCost(),
            'color' => $car->getColor(),
            'thumb' => $car->getThumb()
        ];
    }
}
