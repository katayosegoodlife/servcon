<?php

namespace Akizuki\ServCon\MutableContainer;

use Akizuki\ServCon\Container\ServCon;

/**
 * [ Container ] Server Values Container
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 * 
 * @property string $userAgent
 * @property string $requestSchema
 * @property string $requestHost
 * @property string $requestURI
 * @property string $requestMethod
 * @property int    $requestTime
 * @property double $requestTimeFloat
 * @property string $queryString
 * @property bool   $isHTTPS
 * @property int    $ifModifiedSince
 * @property string $rawIfModifiedSince
 */
class ServMutCon extends ServCon
{
    public function __set($n, $v)
    {
        if ($this->issetReadonlyProperty($n)) {
            $this->setReadonlyProperty($n, $v);
            return;
        }
        throw new \Exception();
    }

}
