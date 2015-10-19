<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\DataObject;
use BinSoul\Common\Equatable;

class DataObjectImplementation implements Equatable, \Serializable
{
    use DataObject;

    private $privateProperty = 'private';
    protected $protectedProperty = 'protected';
    public $publicProperty = 'public';
}

class DataObjectTest extends PropertyGeneratorTest
{
    protected function createObject($data)
    {
        return new DataObjectImplementation($data);
    }

    public function test_hasData_returns_correct_value()
    {
        $object = $this->createObject(['foo' => 'bar']);

        $this->assertTrue($object->hasData('foo'));
        $this->assertFalse($object->hasData('bar'));
    }

    public function test_setData_removes_old_properties()
    {
        $object = $this->createObject(['foo' => 'bar']);

        $this->assertEquals('bar', $object->foo);

        $object->setData(['baz' => 'qux']);
        $this->assertFalse($object->hasData('foo'));
        $this->assertObjectNotHasAttribute('foo', $object);

        $this->assertEquals('qux', $object->baz);
        $this->assertObjectHasAttribute('baz', $object);

        $this->assertObjectHasAttribute('publicProperty', $object);
    }

    public function test_getData_returns_correct_values()
    {
        $object = $this->createObject(['foo' => 'bar']);

        $this->assertEquals('bar', $object->foo);
        $this->assertEquals(['foo' => 'bar'], $object->getData());
        $object->foo = 'baz';
        $this->assertEquals(['foo' => 'baz'], $object->getData());

        $object->setData(['foo' => 'qux']);
        $this->assertEquals(['foo' => 'qux'], $object->getData());
    }

    public function test_implements_equatable()
    {
        $object1 = $this->createObject(['foo' => 'bar']);
        $object2 = $this->createObject(['foo' => 'bar']);
        $object3 = $this->createObject(['baz' => 'qux']);

        $this->assertNotEmpty($object1->getHash());
        $this->assertTrue($object1->isEqualTo($object2));
        $this->assertFalse($object1->isEqualTo($object3));
    }

    public function test_implements_serializable()
    {
        $object1 = $this->createObject(['foo' => 'bar']);
        $object2 = $this->createObject([]);

        $this->assertNotEmpty($object1->serialize());

        $object2->unserialize($object1->serialize());
        $this->assertEquals(['foo' => 'bar'], $object2->getData());

        $object2->unserialize('');
        $this->assertEquals([], $object2->getData());
    }
}
