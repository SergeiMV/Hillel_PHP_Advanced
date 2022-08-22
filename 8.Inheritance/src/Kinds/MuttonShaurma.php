<?php

namespace Shaurmichna\Kinds;

use Shaurmichna\Parent\Shaurma;

class MuttonShaurma extends Shaurma
{
    public function __construct()
    {
        $this->price = 85.00;
        $this->ingredients = [
            "острый соус",
            "огурцы маринованные",
            "кинза",
            "помидоры свежие",
            "маринованный лук с барбарисом и зеленью",
            "мясо баранины",
            "лаваш арабский"
        ];
        $this->title = "Шаурма из баранины";
    }
}
