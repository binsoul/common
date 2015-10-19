<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\PropertyGenerator;

class PropertyGeneratorImplementation
{
    use PropertyGenerator;

    private $privateProperty = 'private';
    protected $protectedProperty = 'protected';
    public $publicProperty = 'public';
}

class PropertyGeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected function createObject($data)
    {
        return new PropertyGeneratorImplementation($data);
    }

    public function test_uses_provided_data()
    {
        $object = $this->createObject(['foo' => 'bar']);

        $this->assertEquals('bar', $object->foo);
    }

    public function test_get_creates_new_properties()
    {
        $object = $this->createObject(['foo' => 'bar']);

        $this->assertEquals('bar', $object->foo);
        $this->assertObjectHasAttribute('foo', $object);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_access_to_undefined_property()
    {
        $object = $this->createObject([]);

        $this->assertNull($object->foo);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_mutation_of_undefined_property()
    {
        $object = $this->createObject([]);

        $object->foo = 'bar';
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_access_to_private_property()
    {
        $object = $this->createObject([]);

        $this->assertNull($object->privateProperty);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_access_to_protected_property()
    {
        $object = $this->createObject([]);

        $this->assertNull($object->protectedProperty);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_mutation_of_private_property()
    {
        $object = $this->createObject([]);

        $object->privateProperty = 'foobar';
        $this->assertNull($object->privateProperty);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_throws_exception_for_mutation_of_protected_property()
    {
        $object = $this->createObject([]);

        $object->privateProperty = 'foobar';
        $this->assertNull($object->privateProperty);
    }
}
