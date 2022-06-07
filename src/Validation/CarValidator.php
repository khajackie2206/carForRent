<?php

namespace Khanguyennfq\CarForRent\Validation;

use Khanguyennfq\CarForRent\Transfer\CarTransfer;

class CarValidator extends Validator
{

    private ImageValidator $imageValidator;

    public function __construct(ImageValidator $imageValidator)
    {
        $this->imageValidator = $imageValidator;
    }

    /**
     * @param CarTransfer $car
     * @param $file
     * @return array
     */
    public function validateCar(CarTransfer $car, $file)
    {
        $validator = new Validator();
        $validator->name('brand')->value($car->getBrand())->min(3)->max(255)->required();
        $validator->name('color')->value($car->getColor())->max(30)->required();
        $validator->name('price')->value($car->getPrice())->is_int()->max(5000)->required();
        $imgValidate = $this->imageValidator->validateImage($file);
        if ($validator->isSuccess() && empty($imgValidate)) {
            return [];
        } else {
            return array_merge(is_array($validator->getErrors()) ? $validator->getErrors() : [], is_array($imgValidate) ? $imgValidate : []);
        }
    }
}
