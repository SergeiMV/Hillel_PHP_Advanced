<?php

namespace Autobots\Transformers;

use Autobots\Schemas\TransformerSchema;

class Transformer3 extends TransformerSchema
{
    public function __construct()
    {
        $this->speed = 876;

        $this->weight = 534;

        $this->height = 134;
    }
}
