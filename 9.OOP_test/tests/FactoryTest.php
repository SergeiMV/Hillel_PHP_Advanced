<?php

namespace Autobots\Tests;

use ReflectionClass;
use Autobots\Foundation\Factory;
use PHPUnit\Framework\TestCase;
use Autobots\Transformers\Transformer1;
use Autobots\Transformers\Transformer2;
use Autobots\Transformers\MergeTransformer;

class FactoryTest extends TestCase
{
    protected Factory $factory;

    public int $count;

    public MergeTransformer $testRobot;

    public $robot1;

    public function setUp(): void
    {
        $this->factory = new Factory();

        $this->factory->addType(new Transformer1());

        $this->count = 5;

        $this->testRobot = new MergeTransformer();

        $this->robot1 = new Transformer1();
    }

    public function testGetTypes()
    {
        $this->assertEqualsCanonicalizing("Transformer1", key($this->factory->types));

        $this->assertEqualsCanonicalizing(new Transformer1(), current($this->factory->types));
    }

    public function testCreateTransformer()
    {
        $this->assertEquals(
            true,
            (new ReflectionClass(Transformer1::class))
                ->isInstance(current($this->factory->createTransformer1(1)))
        );

        $this->assertEquals(
            true,
            (new ReflectionClass(Transformer1::class))
                ->isInstance(($this->factory->createTransformer1($this->count))[($this->count) - 1])
        );

        $this->assertEqualsCanonicalizing($this->count, count($this->factory->createTransformer1($this->count)));
    }

    public function testCreateMergeTransformer()
    {
        $this->testRobot->addTransformer($this->factory->createTransformer1($this->count));

        $this->assertEqualsCanonicalizing(
            $this->testRobot->getWeight(),
            $this->robot1->getWeight() * ($this->count)
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot->getHeight(),
            $this->robot1->getHeight() * ($this->count)
        );

        $this->assertEqualsCanonicalizing(
            $this->testRobot->getSpeed(),
            $this->robot1->getSpeed()
        );
    }
}
