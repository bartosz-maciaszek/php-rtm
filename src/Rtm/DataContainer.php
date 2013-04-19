<?php

namespace Rtm;

class DataContainer implements \IteratorAggregate, \Countable
{
    /**
     * Attributes array
     * @var array
     */
    private $attributes = array();

    /**
     * Construct the object
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->attributes = $data;
    }

    /**
     * (non-PHPdoc)
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }

    /**
     * (non-PHPdoc)
     * @see Countable::count()
     */
    public function count()
    {
        return count($this->attributes);
    }

    /**
     * Magic method to catch set{attribute}() and get{attribute}() calls.
     * @param string $method
     * @param array $arguments
     * @throws BadMethodCallException
     * @return \Rtm\DataContainer|mixed
     */
    public function __call($method, array $arguments)
    {
        if (!preg_match('/^(set|get|has|remove)(\w+)$/', $method, $matches)) {
            throw new \BadMethodCallException(sprintf('Method %s not implemented', $method));
        }
        
        $methodType    = $matches[1];
        $attributeName = lcfirst($matches[2]);

        switch ($methodType) {
            case 'set':
                return $this->set($attributeName, $arguments[0]);
                break;

            case 'get':
                $default = isset($arguments[0]) ? $arguments[0] : null;
                return $this->get($attributeName, $default);
                break;

            case 'has':
                return $this->has($attributeName);
                break;

            case 'remove':
                return $this->remove($attributeName);
                break;
        }
    }

    /**
     * Get the value on the attribute
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if ($this->has($name)) {
            return $this->attributes[$name];
        }

        return $default;
    }

    /**
     * Set the value for the attribute
     * @param string $name
     * @param mixed $value
     * @return \Rtm\DataContainer
     */
    public function set($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Check whether we have such an attribute
     * @param string $name
     */
    public function has($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Remove given attribute
     * @param string $name
     */
    public function remove($name)
    {
        if ($this->has($name)) {
            unset($this->attributes[$name]);
        }
        return $this;
    }

    /**
     * Convert object to an array
     * @return array
     */
    public function toArray()
    {
        foreach ($this as $key => $attribute) {
            if ($attribute instanceof DataContainer) {
                $this->set($key, $attribute->toArray());
            }
        }

        return (array) $this->attributes;
    }
}
