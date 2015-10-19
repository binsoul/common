<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\Equatable;
use BinSoul\Common\Identifiable;
use BinSoul\Common\IdentifiableDataObject;

class IdentifiableDataObjectImplementation implements Identifiable, Equatable, \Serializable
{
    use IdentifiableDataObject;

    private $privateProperty = 'private';
    protected $protectedProperty = 'protected';
    public $publicProperty = 'public';
}

class IdentifiableDataObjectTest extends DataObjectTest
{
    protected function createObject($data)
    {
        return new IdentifiableDataObjectImplementation(0, $data);
    }

    public function test_uses_provided_data()
    {
        $object = new IdentifiableDataObjectImplementation(1, ['foo' => 'bar']);

        $this->assertEquals(1, $object->id);
        $this->assertEquals('bar', $object->foo);
    }

    public function test_implements_identifiable()
    {
        $object1 = new IdentifiableDataObjectImplementation(1, ['foo' => 'bar']);
        $object2 = new IdentifiableDataObjectImplementation(1, ['foo' => 'bar']);
        $object3 = new IdentifiableDataObjectImplementation(2, ['foo' => 'bar']);

        $this->assertEquals(1, $object1->getId());
        $this->assertEquals(2, $object3->getId());
        $this->assertTrue($object1->isSameAs($object2));
        $this->assertFalse($object1->isSameAs($object3));
    }

    public function test_serializes_id()
    {
        $object1 = new IdentifiableDataObjectImplementation(1, ['foo' => 'bar']);
        $object2 = new IdentifiableDataObjectImplementation(1, ['foo' => 'bar']);

        $this->assertNotEmpty($object1->serialize());

        $object2->unserialize($object1->serialize());
        $this->assertEquals(1, $object2->getId());

        $object2->unserialize('');
        $this->assertNull($object2->getId());
        $this->assertEquals([], $object2->getData());
    }
}
