<?php

namespace Rtm;

use ArrayObject;
use IteratorAggregate;
use ArrayIterator;
use Countable;

class DataContainer implements IteratorAggregate, Countable
{
    private $_attributes = null;

    public function __construct(array $data = array())
    {
        $this->_attributes = new ArrayObject($data);
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
        return count($this->_attributes);
    }

    private function setAttribute($name, $value)
    {
        $this->_attributes->offsetSet($name, $value);
    }

    private function getAttribute($name, $default = null)
    {
        if($this->_attributes->offsetExists($name))
        {
            return $this->_attributes->offsetGet($name);
        }

        return $default;
    }

    public function toStdClass()
    {
        foreach($this->_attributes as $key => $attribute)
        {
            if($attribute instanceof NA_Soap_DataContainer)
            {
                $this->setAttribute($key, $attribute->toStdClass());
            }
        }

        return (object) (array) $this->_attributes;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->_attributes);
    }
}