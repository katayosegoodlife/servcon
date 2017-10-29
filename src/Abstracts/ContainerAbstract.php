<?php

namespace Akizuki\ServCon\Abstracts;

use PCC\Std\StandardClass;

/**
 * [ Abstract Class ] Container Abstract
 *
 * Add values in constructor. Get values by magic methods.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 */
abstract class ContainerAbstract extends StandardClass
{

    /** @var array */
    private $data = [];

    protected function add(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]) ? true : parent::__isset($name);
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return parent::__get($name);
    }

}
