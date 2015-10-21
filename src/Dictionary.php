<?php

namespace BinSoul\Common;

/**
 * Provides a container which maps keys to values.
 */
class Dictionary implements \ArrayAccess
{
    /** @var mixed[] */
    protected $data;

    /**
     * Constructs an instance of this class.
     *
     * @param mixed[] $data initial data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Checks if an entry exists.
     *
     * @param string $key name of the entry
     *
     * @return bool
     */
    public function has($key)
    {
        if (!array_key_exists($key, $this->data)) {
            return false;
        }

        return true;
    }

    /**
     * Returns the value of an entry.
     *
     * @param string $key     name of the entry
     * @param mixed  $default return value if the entry doesn't exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (!array_key_exists($key, $this->data)) {
            return $default;
        }

        return $this->data[$key];
    }

    /**
     * Sets the value of an entry.
     *
     * @param string $key   name of the entry
     * @param mixed  $value value of the entry
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Removes an entry.
     *
     * @param string $key name of the entry
     */
    public function remove($key)
    {
        unset($this->data[$key]);
    }

    /**
     * Returns an array of all registered keys.
     *
     * @return string[]
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Returns an array of all registered values.
     *
     * @return string[]
     */
    public function values()
    {
        return array_values($this->data);
    }

    /**
     * Returns all values as array indexed by parameter name.
     *
     * @return mixed[]
     */
    public function all()
    {
        return $this->data;
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            throw new \InvalidArgumentException('Unable to push value to dictionary.');
        } else {
            $this->set($offset, $value);
        }
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
