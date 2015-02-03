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
     * Attempt to handle non-implemented methods
     *
     * @param  string $method
     * @param  array $arguments
     *
     * @return Model|integer|string|null
     */
    public function __call($method, $arguments)
    {
        if ($this->isSetter($method)) {
            $name = $this->makeAttributeFromSetter($method);
            $value = isset($arguments[0]) ? $arguments[0] : null;
            return $this->setAttribute($name, $value);
        }
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
     * Attempt to merge array attribute
     *
     * @param string $name
     * @param integer|string|object|null $value
     *
     * @return Model
     */
    protected function mergeArrayAttribute($name, $value)
    {
        $current = $this->getAttribute($name);
        if (empty($current)) {
            $current = [];
        }
        $current[] = $value;
        return $this->setAttribute($name, $current);
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

    /**
     * Checks if method name is a setter
     *
     * @param  string $method
     *
     * @return boolean
     */
    private function isSetter($method)
    {
        return (boolean) preg_match('/^set.*$/', $method);
    }

    /**
     * Make attribute from setter method name
     *
     * @param  string $setter
     *
     * @return string
     */
    private function makeAttributeFromSetter($setter)
    {
        $attribute = preg_replace('/set/', '', $setter);
        return $this->fromCamelCase($attribute);
    }

    /**
     * Convert camel case to snake case
     *
     * @param  string $input
     *
     * @return string
     */
    private function fromCamelCase($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}
