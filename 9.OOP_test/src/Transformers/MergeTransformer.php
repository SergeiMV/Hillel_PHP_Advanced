<?php

namespace Autobots\Transformers;

use Autobots\Schemas\TransformerSchema;

class MergeTransformer extends TransformerSchema
{
    private array $container;

    public function __construct()
    {
        $this->weight = 0;

        $this->height = 0;

        $this->speed = 0;
    }

    public function addTransformer($class)
    {
        if (is_object($class)) {
            $this->container[] = $class;
        } elseif (is_array($class)) {
            foreach ($class as $unit) {
                $this->container[] = $unit;
            }
        }
        $this->addStats();
    }

    public function addStats()
    {
        foreach ($this->container as $unit) {
            $weightM[] = $unit->getWeight();
            $heightM[] = $unit->getHeight();
            $speedM[] = $unit->getSpeed();
        }
        $this->weight = array_sum($weightM);
        $this->height = array_sum($heightM);
        $this->speed = min($speedM);
        unset($weightM, $heightM, $speedM);
    }
}
