<?php

namespace BinSoul\Common;

/**
 * Provides an implementation of the {@see Equatable} interface.
 */
trait EquatableObject
{
    public function getHash()
    {
        return md5(serialize($this));
    }

    public function isEqualTo(Equatable $other)
    {
        return $this->getHash() == $other->getHash();
    }
}
