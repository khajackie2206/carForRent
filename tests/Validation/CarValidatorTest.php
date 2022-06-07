<?php

namespace Validation;

use Khanguyennfq\CarForRent\Validation\CarValidator;
use Khanguyennfq\CarForRent\Validation\ImageValidator;
use Khanguyennfq\CarForRent\Transfer\CarTransfer;
use PHPUnit\Framework\TestCase;

class CarValidatorTest extends TestCase
{

    /**
     * @dataProvider validateCarSuccessProvider
     * @param $params
     * @return void
     */
    public function testValidateCarSuccess($params)
    {
        $imageValidatorMock = $this->getMockBuilder(ImageValidator::class)->disableOriginalConstructor()->getMock();
        $imageValidatorMock->expects($this->once())->method('validateImage')->willReturn('');
        $carValidator = new CarValidator($imageValidatorMock);
        $carTransfer = new CarTransfer();
        $carTransfer = $carTransfer->formArray($params['car']);
        $result = $carValidator->validateCar($carTransfer, $params['file']);
        $this->assertEmpty($result);
    }

    public function validateCarSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'car' => [
                        'brand' => 'lambo',
                        'price' => 150,
                        'color' => 'black',
                        'file' => 'carlambo.jpg'
                    ],
                    'file' => [
                        'name' => 'kia.jpg',
                        'full_path' => 'kia.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/phpkZ8Vyd',
                        'error' => 0,
                        'size' => 784135
                    ]
                ],
            ]
        ];
    }

    /**
     * @dataProvider validateCarFailProvider
     * @param $params
     * @return void
     */
    public function testValidateCarFail($params)
    {
        $imageValidatorMock = $this->getMockBuilder(ImageValidator::class)->disableOriginalConstructor()->getMock();
        $imageValidatorMock->expects($this->once())->method('validateImage')->willReturn('');
        $carValidator = new CarValidator($imageValidatorMock);
        $carTransfer = new CarTransfer();
        $carTransfer = $carTransfer->formArray($params['car']);
        $result = $carValidator->validateCar($carTransfer, $params['file']);
        $this->assertIsArray($result);
    }

    public function validateCarFailProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'car' => [
                        'brand' => '',
                        'price' => 5001,
                        'color' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                        'file' => 'carlambo.jpg'
                    ],
                    'file' => [
                        'name' => 'kia.jpg',
                        'full_path' => 'kia.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/phpkZ8Vyd',
                        'error' => 0,
                        'size' => 784135
                    ]
                ],
            ]
        ];
    }
}
