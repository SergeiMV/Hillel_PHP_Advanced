<?php

namespace Autobots\Transformers;

use Autobots\Schemas\TransformerSchema;

class Transformer2 extends TransformerSchema
{
    public function __construct()
    {
        $this->speed = 130;

        $this->weight = 200;

        $this->height = 30;
    }
}
