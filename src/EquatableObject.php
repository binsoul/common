<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Provides an implementation of the {@see Equatable} interface.
 */
trait EquatableObject
{
    public function getHash(): string
    {
        return md5(serialize($this));
    }

    public function isEqualTo(Equatable $other): bool
    {
        return $this->getHash() == $other->getHash();
    }
}
