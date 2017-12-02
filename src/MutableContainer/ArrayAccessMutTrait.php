<?php

namespace Akizuki\ServCon\MutableContainer;

/**
 * [ Container ] Server Values Container
 * 
 * @author katayose
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 */
Trait ArrayAccessMutTrait
{
    private $container = array();

    public function __construct(array $svr)
    {
        $this->container = $svr;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}
