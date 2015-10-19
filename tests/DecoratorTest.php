<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\Decorator;

class DecoratorImplementation
{
    use Decorator;
}

class DeocratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_uses_given_object()
    {
        $object = new \stdClass();
        $decorator = new DecoratorImplementation($object);

        $this->assertSame($object, $decorator->getDecoratedObject());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_invalid_type()
    {
        new DecoratorImplementation(1);
    }

    public function test_get_and_set()
    {
        $object = new \stdClass();
        $object->foobar = 'foobar';

        $decorator = new DecoratorImplementation($object);
        $this->assertEquals('foobar', $decorator->foobar);
        $decorator->foobar = 'bazqux';
        $this->assertEquals('bazqux', $decorator->foobar);
    }

    public function test_isset_and_unset()
    {
        $object = new \stdClass();
        $object->foobar = 'foobar';

        $decorator = new DecoratorImplementation($object);
        $this->assertTrue(isset($decorator->foobar));
        unset($decorator->foobar);
        $this->assertFalse(isset($decorator->foobar));
    }

    public function test_calls_unknown_methods()
    {
        $object = $this->getMock(\stdClass::class, ['abc']);
        $object->expects($this->once())->method('abc');

        $decorator = new DecoratorImplementation($object);
        $decorator->abc();
    }
}
