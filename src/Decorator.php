<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Allows to add new functionality dynamically to objects.
 */
trait Decorator
{
    /** @var object */
    protected $decoratedObject;

    /**
     * Constructs an instance of this decorator with the given decorated object.
     *
     * @param object $decorated
     */
    public function __construct($decorated)
    {
        $this->setDecoratedObject($decorated);
    }

    /**
     * Sets the decorated object.
     *
     * @param object $decorated
     */
    public function setDecoratedObject($decorated)
    {
        if (!is_object($decorated)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Expected an object but got an argument of type "%s" instead.',
                    gettype($decorated)
                )
            );
        }

        $this->decoratedObject = $decorated;
    }

    /**
     * Returns the decorated object.
     *
     * @return object
     */
    public function getDecoratedObject()
    {
        return $this->decoratedObject;
    }

    /**
     * Returns the property of the decorated object.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->decoratedObject->{$key};
    }

    /**
     * Sets the property of the decorated object.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value)
    {
        $this->decoratedObject->{$key} = $value;
    }

    /**
     * Returns whether the property of the decorated object is set.
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return isset($this->decoratedObject->{$key});
    }

    /**
     * Unsets the property of the decorated object.
     *
     * @param string $key
     */
    public function __unset(string $key)
    {
        unset($this->decoratedObject->{$key});
    }

    /**
     * Calls the missing method on the decorated object with the given arguments.
     *
     * @param string  $method
     * @param mixed[] $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return call_user_func_array([$this->decoratedObject, $method], $arguments);
    }
}
