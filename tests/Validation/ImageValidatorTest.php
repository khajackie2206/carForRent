<?php

namespace Validation;

use Khanguyennfq\CarForRent\Validation\ImageValidator;
use PHPUnit\Framework\TestCase;

class ImageValidatorTest extends TestCase
{

    /**
     * @dataProvider validateImageSuccessProvider
     * @param $params
     * @return void
     */
    public function testValidateImageSuccess($params)
    {
        $imageValidator = new ImageValidator();
        $expected = $imageValidator->validateImage($params);
        $this->assertEquals($expected, '');
    }

    public function validateImageSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'name' => 'kia.jpg',
                    'full_path' => 'kia.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpkZ8Vyd',
                    'error' => 0,
                    'size' => 784381
                ],
            ]
        ];
    }

    /**
     * @dataProvider validateImageFailErrorProvider
     * @param $params
     * @return void
     */
    public function testImageFailError($params)
    {
        $imageValidator = new ImageValidator();
        $expected = $imageValidator->validateImage($params);
        $this->assertIsArray($expected);
    }

    public function validateImageFailErrorProvider()
    {
        return [
            'sad-case-1' => [
                'params' => [
                    'name' => 'kia.jpg',
                    'full_path' => 'kia.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpkZ8Vyd',
                    'error' => 1,
                    'size' => 784381
                ],
            ]
        ];
    }

    /**
     * @dataProvider validateImageFailFormatProvider
     * @param $params
     * @return void
     */
    public function testImageFailFormat($params)
    {
        $imageValidator = new ImageValidator();
        $expected = $imageValidator->validateImage($params);
        $this->assertIsArray($expected);
    }

    public function validateImageFailFormatProvider()
    {
        return [
            'sad-case-2' => [
                'params' => [
                    'name' => 'kia.gif',
                    'full_path' => 'kia.gif',
                    'type' => 'image/gif',
                    'tmp_name' => '/tmp/phpkZ8Vyd',
                    'error' => 0,
                    'size' => 784381
                ],
            ]
        ];
    }

    /**
     * @dataProvider validateImageFailSizeProvider
     * @param $params
     * @return void
     */
    public function testImageFailSize($params)
    {
        $imageValidator = new ImageValidator();
        $expected = $imageValidator->validateImage($params);
        $this->assertIsArray($expected);
    }

    public function validateImageFailSizeProvider()
    {
        return [
            'sad-case-2' => [
                'params' => [
                    'name' => 'kia.jpg',
                    'full_path' => 'kia.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpkZ8Vyd',
                    'error' => 0,
                    'size' => 10000000000000000000000000
                ],
            ]
        ];
    }
}
