<?php

namespace BinSoul\Common;

/**
 * Provides an implementation of the {@see Identifiable} interface.
 */
trait IdentifiableObject
{
    /** @var int|string */
    protected $objectId;

    public function __construct($id)
    {
        $this->objectId = $id;
    }

    public function getId()
    {
        return $this->objectId;
    }

    public function isSameAs(Identifiable $other)
    {
        return $this->getId() == $other->getId();
    }
}
