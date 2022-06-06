<?php

namespace transformer;


use Khanguyennfq\CarForRent\transformer\CarTransformer;
use Khanguyennfq\CarForRent\model\CarModel;
use PHPUnit\Framework\TestCase;

class CarTransformerTest extends TestCase
{
   public function testToArray()
   {
       $carModel = new CarModel();
       $carModel->setID(1);
       $carModel->setBrandName('lambo');
       $carModel->setCost(50);
       $carModel->setColor('black');
       $carModel->setThumb('kha.jpg');
       $carTransfer = new CarTransformer();
       $result = $carTransfer->toArray($carModel);
       $expected = [
           'ID' => 1,
           'brand' => 'lambo',
           'price' => 50,
           'color' => 'black',
           'thumb' => 'kha.jpg'
       ];
       $this->assertEquals($expected, $result);
   }
}
