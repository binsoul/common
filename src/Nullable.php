<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Provides a method to check if an object exists.
 */
interface Nullable
{
    /**
     * Checks if the object exists.
     *
     * @return bool
     */
    public function exists(): bool;
}
