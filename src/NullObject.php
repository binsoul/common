<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Ignores all called methods and doesn't change or return any properties.
 *
 * This trait also implements the {@see Nullable} interface.
 */
trait NullObject
{
    public function exists(): bool
    {
        return false;
    }

    /**
     * @param string $key
     */
    public function __get(string $key)
    {
        return;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value)
    {
        return;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function __isset(string $key)
    {
        return false;
    }

    /**
     * @param string $key
     */
    public function __unset(string $key)
    {
        return;
    }

    /**
     * Ignores calls of any method.
     *
     * @param string  $method
     * @param mixed[] $arguments
     */
    public function __call(string $method, $arguments)
    {
        return;
    }

    protected function returnNull()
    {
        return;
    }

    /**
     * @return bool
     */
    protected function returnTrue(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function returnFalse(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    protected function returnString(): string
    {
        return '';
    }

    /**
     * @return int
     */
    protected function returnZero(): int
    {
        return 0;
    }

    /**
     * @return array
     */
    protected function returnArray(): array
    {
        return [];
    }

    /**
     * @param mixed $argument
     *
     * @return mixed
     */
    protected function returnArgument($argument)
    {
        return $argument;
    }
}
