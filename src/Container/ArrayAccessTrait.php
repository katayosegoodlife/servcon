<?php

namespace Akizuki\ServCon\Container;

/**
 * [ Container ] Server Values Container
 * 
 * @author katayose
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 */
Trait ArrayAccessTrait
{
    private $container = array();

    public function __construct(array $svr)
    {
        $this->container = $svr;
    }

    public function offsetSet($offset, $value) {
        throw new \LogicException();
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        throw new \LogicException();
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}
