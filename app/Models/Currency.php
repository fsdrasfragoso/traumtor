<?php

namespace App\Models;

class Currency
{
    private $amount;

    private function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public static function create(int $amount): self
    {
        return new static($amount);
    }

    public static function createFromFloat(float $amount): self
    {
        return static::create($amount * 100);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function toFloat(): float
    {
        return $this->amount / 100;
    }

    public function __toString()
    {
        return number_format($this->toFloat(), 2, ',', '.');
    }
}
