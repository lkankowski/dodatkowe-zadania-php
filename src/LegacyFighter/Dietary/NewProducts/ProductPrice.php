<?php

namespace LegacyFighter\Dietary\NewProducts;

use Brick\Math\BigDecimal;

class ProductPrice
{
    public function __construct(
        private ?BigDecimal $price
    )
    {
    }

    public function isValid(): bool
    {
        return $this->price !== null && $this->price->getSign() > 0;
    }

    public function validatePrice()
    {
        if (!$this->isValid()) {
            throw new \Exception('Invalid price');
        }
    }
}
