<?php

declare(strict_types=1);

namespace LegacyFighter\Dietary\NewProducts;

use Brick\Math\BigDecimal;
use Ramsey\Uuid\Uuid;

class OldProduct
{
    private $serialNumber;

    private ProductPrice $price;

    private ProductDescription $productDescription;

    private ProductCounter $productCounter;

    private $counter;

    public function __construct(?BigDecimal $price, ?string $desc, ?string $longDesc, ?int $counter)
    {
        $this->serialNumber = Uuid::uuid4();
        $this->price = new ProductPrice($price);
        $this->productDescription = new ProductDescription($desc, $longDesc);
        $this->productCounter = new ProductCounter($counter);
        $this->counter = $counter;
    }

    /**
     * @throws \Exception
     */
    public function incrementCounter(): void
    {
        $this->price->validatePrice();

        $this->productCounter->increment();
    }

    /**
     * @throws \Exception
     */
    public function decrementCounter(): void
    {
        $this->price->validatePrice();

        $this->productCounter->decrement();
    }

    /**
     * @throws \Exception
     */
    public function changePriceTo(?BigDecimal $newPrice): void
    {
        if ($this->productCounter->isPositive()) {
            if ($newPrice === null) {
                throw new \Exception('new price null');
            }
            $this->price = new ProductPrice($newPrice);
        }
    }

    public function replaceCharFromDesc(?string $charToReplace, ?string $replaceWith): void
    {
        $this->productDescription = $this->productDescription->replaceCharFromDesc($charToReplace, $replaceWith);
    }

    public function formatDesc(): string
    {
        return $this->productDescription->formatDesc();
    }
}
