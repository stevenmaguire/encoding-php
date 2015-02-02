<?php namespace Stevenmaguire\EncodingDotCom;

use \stdClass;

abstract class Model implements Contracts\Jsonable
{
    /**
     * Attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Magic method to get non-public properties
     *
     * @param  string $property
     *
     * @return mixed|null
     */
    public function __get($property)
    {
        return $this->getAttribute($property);
    }

    /**
     * Set named attribute from model
     *
     * @param string $name
     * @param integer|string|object|null $value
     *
     * @return Model
     */
    protected function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Get named attribute from model
     *
     * @param  string $name
     *
     * @return integer|string|object|null
     */
    protected function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    /**
     * Convert object to json
     *
     * @return string
     */
    public function toJson()
    {
        $object = new stdClass;
        $properties = $this->attributes;
        foreach ($properties as $name => $value) {
            if ($this->isJsonable($value)) {
                $object->$name = json_decode($value->toJson());
            } else {
                $object->$name = $value;
            }
        }
        return json_encode($object);
    }

    /**
     * Detect if object is Jsonable
     *
     * @param  object
     *
     * @return boolean
     */
    private function isJsonable($object)
    {
        if (is_object($object)) {
            $interfaces = class_implements($object);
            return in_array(
                'Stevenmaguire\EncodingDotCom\Contracts\Jsonable',
                $interfaces
            );
        }
        return false;
    }
}
