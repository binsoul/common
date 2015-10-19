<?php

namespace BinSoul\Common;

/**
 * Ignores all called methods and doesn't change or return any properties.
 *
 * This trait also implements the {@see Nullable} interface.
 */
trait NullObject
{
    public function exists()
    {
        return false;
    }

    /**
     * @param string $key
     */
    public function __get($key)
    {
        return;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set($key, $value)
    {
        return;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return false;
    }

    /**
     * @param string $key
     */
    public function __unset($key)
    {
        return;
    }

    /**
     * Ignores calls of any method.
     *
     * @param string  $method
     * @param mixed[] $arguments
     */
    public function __call($method, $arguments)
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
    protected function returnTrue()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function returnFalse()
    {
        return false;
    }

    /**
     * @return string
     */
    protected function returnString()
    {
        return '';
    }

    /**
     * @return string
     */
    protected function returnZero()
    {
        return 0;
    }

    /**
     * @return array
     */
    protected function returnArray()
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
