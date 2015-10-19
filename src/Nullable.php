<?php

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
    public function exists();
}
