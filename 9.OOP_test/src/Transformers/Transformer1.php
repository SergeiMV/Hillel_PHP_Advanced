<?php

namespace Autobots\Transformers;

use Autobots\Schemas\TransformerSchema;

class Transformer1 extends TransformerSchema
{
    public function __construct()
    {
        $this->speed = 10;

        $this->weight = 10;

        $this->height = 10;
    }
}
