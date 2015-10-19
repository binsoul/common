<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\Identifiable;
use BinSoul\Common\IdentifiableObject;

class IdentifiableObjectImplementation implements Identifiable
{
    use IdentifiableObject;
}

class IdentifiableObjectTest extends \PHPUnit_Framework_TestCase
{
    public function test_implements_identifiable()
    {
        $object1 = new IdentifiableObjectImplementation('foobar');
        $object2 = new IdentifiableObjectImplementation('foobar');
        $object3 = new IdentifiableObjectImplementation('bazqux');
        $object4 = new IdentifiableObjectImplementation(1);

        $this->assertEquals('foobar', $object1->getId());
        $this->assertTrue($object1->isSameAs($object2));
        $this->assertFalse($object1->isSameAs($object3));
        $this->assertFalse($object1->isSameAs($object4));
    }
}
