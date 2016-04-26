<?php

declare (strict_types = 1);

namespace BinSoul\Common;

/**
 * Maps the keys of an array to public properties.
 *
 * The object prevents new properties from being added to it. Only keys existing in the provided data array can
 * be read or written.
 *
 * The keys of the data array are added as public properties to the object. This means calls to
 * <code>__get</code> and <code>__set</code> are only executed once for undefined properties. Afterwards the
 * properties are defined and accessible.
 */
trait PropertyGenerator
{
    /** @var mixed[] */
    protected $objectData;

    /**
     * Constructs an instance of this class.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->objectData = $data;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        if (array_key_exists($key, $this->objectData)) {
            $this->{$key} = $this->objectData[$key];

            return $this->objectData[$key];
        }

        throw new \InvalidArgumentException(sprintf('The property "%s" is not defined.', $key));
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value)
    {
        if (property_exists($this, $key)) {
            throw new \InvalidArgumentException(sprintf('The property "%s" is not public.', $key));
        }

        if (!array_key_exists($key, $this->objectData)) {
            throw new \InvalidArgumentException(sprintf('The property "%s" is not defined.', $key));
        }

        $this->{$key} = $value;
    }

    /**
     * Returns an array of generated public properties.
     *
     * @return \ReflectionProperty[]
     */
    protected function getGeneratedProperties(): array
    {
        $reflectionObject = new \ReflectionObject($this);
        $properties = $reflectionObject->getProperties(\ReflectionProperty::IS_PUBLIC);
        $result = [];
        foreach ($properties as $property) {
            if (!$property->isPublic() || @$property->isDefault()) {
                continue;
            }

            $result[] = $property;
        }

        return $result;
    }

    /**
     * Removes all generated public properties.
     */
    protected function removeGeneratedProperties()
    {
        $properties = $this->getGeneratedProperties();

        foreach ($properties as $property) {
            $name = $property->getName();
            unset($this->{$name});
        }
    }
}
