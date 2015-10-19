<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\Equatable;
use BinSoul\Common\EquatableObject;

class EquatableObjectImplementation implements Equatable
{
    use EquatableObject;

    /** @var mixed */
    private $data;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
}

class EquatableObjectTest extends \PHPUnit_Framework_TestCase
{
    public function test_implements_equatable()
    {
        $object1 = new EquatableObjectImplementation('foobar');
        $object2 = new EquatableObjectImplementation('foobar');
        $object3 = new EquatableObjectImplementation('bazqux');
        $object4 = new EquatableObjectImplementation(1);

        $this->assertNotEmpty($object1->getHash());
        $this->assertTrue($object1->isEqualTo($object2));
        $this->assertFalse($object1->isEqualTo($object3));
        $this->assertFalse($object1->isEqualTo($object4));
    }
}
