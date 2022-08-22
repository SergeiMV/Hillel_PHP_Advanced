<?php

namespace Shaurmichna\Kinds;

use Shaurmichna\Parent\Shaurma;

class OdesskaShaurma extends Shaurma
{
    public function __construct()
    {
        $this->price = 69.00;
        $this->ingredients = [
            "огурцы маринованные",
            "картофель жаренный",
            "чесночный соус",
            "тандырный лаваш",
            "маринованный лук с барбарисом и зеленью",
            "мясо куриное",
            "салат коул слоу",
            "корейская морковь"
        ];
        $this->title = "Одесская шаурма";
    }
}
