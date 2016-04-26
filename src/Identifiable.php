<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Provides methods to compare objects based on their identifier.
 */
interface Identifiable
{
    /**
     * Returns an identifier for this object.
     *
     * @return int|string
     */
    public function getId();

    /**
     * Indicates whether some other object is the same as this one.
     *
     * @param Identifiable $other
     *
     * @return bool
     */
    public function isSameAs(Identifiable $other): bool;
}
