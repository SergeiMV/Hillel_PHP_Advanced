<?php

namespace Shaurmichna\Kinds;

use Shaurmichna\Parent\Shaurma;

class BeefShaurma extends Shaurma
{
    public function __construct()
    {
        $this->price = 75.00;
        $this->ingredients = [
            "чесночный соус",
            "говяжий окорок",
            "огурцы маринованные",
            "маринованный лук с барбарисом и зеленью",
            "салат коул слоу",
            "тандырный лаваш",
            "помидоры свежие",
            "хумус",
            "соус тахин"
        ];
        $this->title = "Говяжья шаурма";
    }
}
