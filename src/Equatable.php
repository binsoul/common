<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Provides methods to compare objects based on their data.
 */
interface Equatable
{
    /**
     * Returns a hash value for the data of this object.
     *
     * @return string
     */
    public function getHash(): string;

    /**
     * Indicates whether some other object is equal to this one.
     *
     * @param Equatable $other
     *
     * @return bool
     */
    public function isEqualTo(Equatable $other): bool;
}
