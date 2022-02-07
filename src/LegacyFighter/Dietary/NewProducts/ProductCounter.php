<?php

namespace LegacyFighter\Dietary\NewProducts;

class ProductCounter
{
    public function __construct(
        private ?int $availability
    )
    {
    }

    public function isValid(): bool
    {
        return $this->availability !== null;
    }

    public function isPositive()
    {
        $this->validateNull();
        return $this->availability > 0;
    }

    private function isNegative()
    {
        return $this->availability < -1;
    }

    public function validateNull()
    {
        if (!$this->isValid()) {
            throw new \Exception('null counter');
        }
    }

    public function validateNegative()
    {
        if ($this->isNegative()) {
            throw new \Exception('Negative counter');
        }
    }

    public function increment()
    {
        $this->validateNull();
        if ($this->availability + 1 < 0) {
            throw new \Exception("Negative counter");
        }
        $this->availability++;
    }

    public function decrement()
    {
        $this->validateNull();
        $this->availability--;
        if ($this->availability < 0) {
            throw new \Exception('Negative counter');
        }

    }
}