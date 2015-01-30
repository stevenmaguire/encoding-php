<?php namespace Stevenmaguire\EncodingDotCom\Traits;

trait GetTrait
{
    /**
     * Magic method to get non-public properties
     *
     * @param  string $property
     *
     * @return mixed|null
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }
}
