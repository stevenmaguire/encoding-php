<?php namespace Stevenmaguire\EncodingDotCom\Traits;

use \ReflectionClass;
use \stdClass;

trait JsonifyTrait
{
    /**
     * Convert object to json
     *
     * @return string
     */
    public function toJson()
    {
        $object = new stdClass;
        $properties = $this->getAccessibleProperties();
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
     * [isJsonable description]
     *
     * @param  [type]   [description]
     *
     * @return boolean  [description]
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
     * [getAccessibleProperties description]
     *
     * @return [type] [description]
     */
    private function getAccessibleProperties()
    {
        $properties = [];
        $ref = new ReflectionClass($this);
        foreach ($ref->getProperties() as $property) {
            if ($property->isProtected()) {
                $name = $property->getName();
                $properties[$name] = $this->$name;
            }
        }
        return $properties;
    }
}
