<?php

namespace BinSoul\Common;

/**
 * Extends the {@see PropertyGenerator} trait with methods to get and set data.
 *
 * This trait implements the {@see Equatable} and {@see \Serializable} interfaces.
 */
trait DataObject
{
    use EquatableObject;
    use PropertyGenerator;

    /**
     * Returns all data as an array including modifications to the generated properties.
     *
     * @return mixed[]
     */
    public function getData()
    {
        $properties = $this->getGeneratedProperties();

        $data = [];
        foreach ($properties as $property) {
            $key = $property->getName();
            $data[$key] = $this->{$key};
        }

        $result = array_merge($this->objectData, $data);
        ksort($result);

        return $result;
    }

    /**
     * Sets the data of this object.
     *
     * @param mixed[] $data
     */
    public function setData(array $data)
    {
        $this->removeGeneratedProperties();
        $this->objectData = $data;
    }

    /**
     * Returns whether the given key exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->objectData);
    }

    /**
     * Returns a hash value for the data of this object.
     *
     * @return string
     */
    public function getHash()
    {
        return md5(serialize($this->getData()));
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function serialize()
    {
        $data = $this->getData();

        return serialize($data);
    }

    /**
     * Reconstructs this object from it's string representation.
     *
     * @param string $string
     */
    public function unserialize($string)
    {
        $this->setData([]);

        if ($string == '') {
            return;
        }

        $data = unserialize($string);
        if (is_array($data)) {
            $this->objectData = $data;
        }
    }
}
