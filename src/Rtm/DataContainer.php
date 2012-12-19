<?php

namespace Rtm;

use ArrayObject;
use IteratorAggregate;
use ArrayIterator;
use Countable;

class DataContainer implements IteratorAggregate, Countable
{
    private $attributes = null;

    public function __construct(array $data = array())
    {
        $this->attributes = new ArrayObject($data);
    }

    public function __call($method, array $arguments)
    {
        $methodType    = substr($method, 0, 3);
        $attributeName = strtolower(substr($method, 3, 1)) . substr($method, 4);

        switch($methodType)
        {
            case 'set':
                $this->setAttribute($attributeName, $arguments[0]);
                return $this;
                break;

            case 'get':
                $default = isset($arguments[0]) ? $arguments[0] : null;
                return $this->getAttribute($attributeName, $default);
                break;

            default:
                throw new Exception(sprintf('Method %s not implemented', $method));
        }
    }

    public function count()
    {
        return count($this->attributes);
    }

    public function get($name, $default = null)
    {
        return $this->getAttribute($name, $default);
    }

    public function set($name, $value)
    {
        return $this->setAttribute($name, $value);
    }

    private function setAttribute($name, $value)
    {
        $this->attributes->offsetSet($name, $value);
    }

    private function getAttribute($name, $default = null)
    {
        if($this->attributes->offsetExists($name))
        {
            return $this->attributes->offsetGet($name);
        }

        return $default;
    }

    public function toStdClass()
    {
        foreach($this->attributes as $key => $attribute)
        {
            if($attribute instanceof DataContainer)
            {
                $this->setAttribute($key, $attribute->toStdClass());
            }
        }

        return (object) (array) $this->attributes;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }
}
