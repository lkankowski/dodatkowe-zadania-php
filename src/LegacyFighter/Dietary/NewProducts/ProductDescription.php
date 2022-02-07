<?php

namespace LegacyFighter\Dietary\NewProducts;

class ProductDescription
{
    public function __construct(
        private ?string $description,
        private ?string $longDescription,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function replaceCharFromDesc(?string $charToReplace, ?string $replaceWith): self
    {
        if (empty($this->longDescription) ||
            empty($this->description)) {
            throw new \Exception('null or empty desc');
        }
        return new self(
            str_replace($charToReplace, $replaceWith, $this->description),
            str_replace($charToReplace, $replaceWith, $this->longDescription)
        );
    }

    public function formatDesc(): string
    {
        if (empty($this->longDescription) || empty($this->description)) {
            return '';
        }

        return $this->description.' *** '.$this->longDescription;
    }
}