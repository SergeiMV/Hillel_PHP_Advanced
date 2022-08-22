<?php

namespace Autobots\Schemas;

abstract class TransformerSchema
{
    protected $speed;

    protected $weight;

    protected $height;

    public $name;

//getters

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function __toString(): string
    {
        return  "Name: $this->name<br>Speed: $this->speed<br>Weight: $this->weight<br>Height: $this->height";
    }
}
