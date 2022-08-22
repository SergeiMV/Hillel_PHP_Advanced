<?php

namespace Shaurmichna\Transformations;

use Shaurmichna\Parent\Shaurma;

class ShaurmaCalculator
{
    private array $ingredientsAll = array("");

    private int $priceAll = 0;

    private array $titleAll;

    public function add(Shaurma $shaurma): void
    {
        $this->titleAll[] = $shaurma->getTitle();
        $this->priceAll += $shaurma->getCost();
        if (count($this->ingredientsAll) > 1) {
            $this->ingredientsAll = array_merge($this->ingredientsAll, $shaurma->getIngredients());
        } else {
            $this->ingredientsAll = $shaurma->getIngredients();
        }
    }

    public function getAllIngredients(): string
    {
        return implode(", ", array_unique($this->ingredientsAll));
    }

    public function getPrice(): string
    {
        return "С вас: " . $this->priceAll . " грн";
    }
}
