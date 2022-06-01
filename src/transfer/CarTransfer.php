<?php
namespace Khanguyennfq\CarForRent\transfer;
class CarTransfer
{
    private ?string $brand;
    private ?int $price;
    private ?string $color;
    private ?string $thumb;

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    /**
     * @param string|null $thumb
     */
    public function setThumb(?string $thumb): void
    {
        $this->thumb = $thumb;
    }

    public function formArray(array $params)
    {
        $this->brand = $params['brand'] ?? null;
        $this->price = $params['price'] ? $params['price'] : null;
        $this->color = $params['color'] ?? null;
        return $this;
    }

}
