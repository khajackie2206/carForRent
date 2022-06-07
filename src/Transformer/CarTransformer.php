<?php

namespace Khanguyennfq\CarForRent\Transformer;

use Khanguyennfq\CarForRent\Model\CarModel;

class CarTransformer
{
    /**
     * @param CarModel $car
     * @return array
     */
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
