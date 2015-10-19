<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\NullObject;

class NullObjectImplementation
{
    use NullObject;

    public function getAll($argument)
    {
        return [
            $this->returnNull(),
            $this->returnTrue(),
            $this->returnFalse(),
            $this->returnString(),
            $this->returnZero(),
            $this->returnArray(),
            $this->returnArgument($argument),
        ];
    }
}

class NullObjectTest extends \PHPUnit_Framework_TestCase
{
    public function test_ignores_get_and_set()
    {
        $object = new NullObjectImplementation();

        $this->assertNull($object->foo);
        $object->foo = 'bar';
        $this->assertNull($object->foo);
    }

    public function test_isset_and_unset()
    {
        $object = new NullObjectImplementation();

        $this->assertFalse(isset($object->foo));
        unset($object->foo);
        $this->assertFalse(isset($object->foo));
    }

    public function test_calls()
    {
        $object = new NullObjectImplementation();

        $this->assertNull($object->foo());
    }

    public function test_internal_helper_methods()
    {
        $object = new NullObjectImplementation();

        $expected = [
            null,
            true,
            false,
            '',
            0,
            [],
            'foobar',
        ];

        $this->assertSame($expected, $object->getAll('foobar'));
    }

    public function test_implements_nullable()
    {
        $object = new NullObjectImplementation();

        $this->assertFalse($object->exists());
    }
}
