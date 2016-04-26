<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Provides an implementation of the {@see Identifiable} interface.
 */
trait IdentifiableObject
{
    /** @var int|string */
    protected $objectId;

    /**
     * Constructs an instance of this class.
     *
     * @param string|int $id
     */
    public function __construct($id)
    {
        $this->objectId = $id;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->objectId;
    }

    /**
     * @param Identifiable $other
     *
     * @return bool
     */
    public function isSameAs(Identifiable $other): bool
    {
        return $this->getId() == $other->getId();
    }
}
