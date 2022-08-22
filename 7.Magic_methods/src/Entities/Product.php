<?php

namespace Hillel\Entities;

use Hillel\Casts\ArrayCast;
use Hillel\Casts\MoneyCast;
use Hillel\Casts\DateTimeCast;

class Product
{
    private float $price;

    private string $attributes;

    private int $updatedAt;

    protected $casts = [
        'price' => MoneyCast::class,
        'attributes' => ArrayCast::class,
        'updatedAt' => DateTimeCast::class,
    ];

    public function __construct($price, $attributes, $updatedAt)
    {
        $this->price = $price;
        $this->attributes = $attributes;
        $this->updatedAt = $updatedAt;
    }

    public function __set($variable, $value)
    {
        if (isset($this->casts[$variable])) {
            $this->$variable = $this->casts[$variable]::set($value);
        } else {
            throw new Exception("Wrong set");
        }
    }

    public function __get($variable)
    {
        if (isset($this->casts[$variable])) {
            return $this->casts[$variable]::get($this->$variable);
        } else {
            throw new Exception("Wrong get");
        }
    }

    public function __toString(): string
    {
	    return "Цена:" . MoneyCast::get($this->price) . "\n" . "Атрибуты:" . implode(' ', ArrayCast::get($this->attributes)) . "\n" . "Изменено:" . DateTimeCast::get($this->updatedAt) . "\n";
    }
}
