<?php

namespace Khanguyennfq\CarForRent\Transfer;

class CarTransfer
{
    private string $brand;
    private int|string $price;
    private string $color;
    private string $thumb;

    /**
     * @return string|null
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     */
    public function setPrice(int|string $price): void
    {
        $this->price = is_numeric($price) ? (int)$price : 0;
    }

    /**
     * @return string|null
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getThumb(): string
    {
        return $this->thumb;
    }

    /**
     * @param string|null $thumb
     */
    public function setThumb(string $thumb): void
    {
        $this->thumb = $thumb;
    }

    public function formArray(array $params)
    {
        $this->setBrand($params['brand'] ?? null);
        $this->setPrice($params['price'] ?? null);
        $this->setColor($params['color'] ?? null);
        $this->setThumb($params['file'] ?? null);
        return $this;
    }
}
