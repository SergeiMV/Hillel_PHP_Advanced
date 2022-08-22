<?php

namespace Autobots\Tests;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Autobots\Transformers\MergeTransformer;
use Autobots\Transformers\Transformer1;

class MergeTransformerTest extends TestCase
{
    protected MergeTransformer $testRobot1;

    protected MergeTransformer $testRobot2;

    protected $robot1;

    public function setUp(): void
    {
        $this->testRobot1 = new MergeTransformer();

        $this->testRobot2 = new MergeTransformer();

        $this->robot1 = new Transformer1();

        $this->testRobot1->addTransformer($this->robot1);

        $this->testRobot2->addTransformer([$this->robot1, $this->robot1]);
    }

    public function testAddTransformer()
    {
        $this->assertEqualsCanonicalizing(
            $this->testRobot1->getWeight(),
            $this->robot1->getWeight()
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot1->getHeight(),
            $this->robot1->getHeight()
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot1->getSpeed(),
            $this->robot1->getSpeed()
        );


        $this->assertEqualsCanonicalizing(
            $this->testRobot2->getWeight(),
            $this->robot1->getWeight() * 2
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot2->getHeight(),
            $this->robot1->getHeight() * 2
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot2->getSpeed(),
            $this->robot1->getSpeed()
        );
    }
}
