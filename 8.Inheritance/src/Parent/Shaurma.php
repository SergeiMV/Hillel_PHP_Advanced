<?php

namespace Shaurmichna\Parent;

abstract class Shaurma
{

    protected float $price;

    protected array $ingredients;

    protected string $title;

    public function getCost(): float
    {
        return round($this->price, 2);
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
