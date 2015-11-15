<?php

namespace BinSoul\Common;

/**
 * Extends the {@see DataObject} trait with an id value which is separated from the data.
 *
 * This trait implements the {@see Identifiable}, {@see Equatable} and {@see \Serializable} interfaces.
 *
 * @property int|string|null $id
 */
trait IdentifiableDataObject
{
    use IdentifiableObject;
    use DataObject;

    /**
     * Constructs an instance of this class.
     *
     * @param int|string|null $id
     * @param mixed[]         $data
     */
    public function __construct($id, array $data)
    {
        $this->objectId = $id;
        $this->objectData = $data;

        unset($this->objectData['id']);
    }

    public function __get($key)
    {
        if ($key == 'id') {
            $this->id = $this->objectId;

            return $this->objectId;
        } elseif (array_key_exists($key, $this->objectData)) {
            $this->{$key} = $this->objectData[$key];

            return $this->objectData[$key];
        }

        throw new \InvalidArgumentException(sprintf('The property "%s" is not defined.', $key));
    }

    public function __set($key, $value)
    {
        if ($key == 'id') {
            $this->objectId = $value;
            $this->id = $this->objectId;

            return;
        }

        if (!array_key_exists($key, $this->objectData)) {
            throw new \InvalidArgumentException(sprintf('The property "%s" is not defined.', $key));
        }

        $this->{$key} = $value;
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function serialize()
    {
        $data = $this->getData();
        unset($data['id']);

        return serialize(['id' => $this->objectId, 'data' => $data]);
    }

    /**
     * Reconstructs this object from it's string representation.
     *
     * @param string $string
     */
    public function unserialize($string)
    {
        $this->objectId = null;
        $this->setData([]);

        if ($string == '') {
            return;
        }

        $data = unserialize($string);
        if (is_array($data)) {
            $data = array_merge(['id' => null, 'data' => []], $data);
            $this->objectId = $data['id'];
            $this->objectData = $data['data'];
            unset($this->objectData['id']);
        }
    }
}
