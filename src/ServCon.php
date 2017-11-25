<?php

namespace Akizuki\ServCon;

use Strict\Property\Utility\ReadonlyPropertyContainer;

/**
 * [ Container ] Server Values Container
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 4kizuki. All Rights Reserved.
 * @package 4kizuki/servcon
 * @since 1.0.0
 * 
 * @property-read string $userAgent
 * @property-read string $requestSchema
 * @property-read string $requestHost
 * @property-read string $requestURI
 * @property-read string $requestMethod
 * @property-read int    $requestTime
 * @property-read double $requestTimeFloat
 * @property-read string $queryString
 * @property-read bool   $isHTTPS
 * @property-read int    $ifModifiedSince
 * @property-read string $rawIfModifiedSince
 */
class ServCon extends ReadonlyPropertyContainer
{

    // Keys
    const SVR_USER_AGENT = 'HTTP_USER_AGENT';
    const SVR_HTTPS      = 'HTTPS';
    const SVR_REQ_URI    = 'REQUEST_URI';
    const SVR_REQ_HOST   = 'SERVER_NAME';
    const SVR_REQ_METHOD = 'REQUEST_METHOD';
    const SVR_REQ_TIME   = 'REQUEST_TIME';
    const SVR_REQ_TIMEF  = 'REQUEST_TIME_FLOAT';
    const SVR_QUERY_STR  = 'QUERY_STRING';
    const SVR_IF_MOD_S   = 'HTTP_IF_MODIFIED_SINCE';
    // Default Values
    const DEF_USER_AGENT = null;
    const DEF_REQ_URI    = null;
    const DEF_REQ_HOST   = null;
    const DEF_REQ_METHOD = null;
    const DEF_QUERY_STR  = null;
    const DEF_IF_MOD_S   = null;

    public function __construct(array $svr)
    {
        $this->setReadonlyProperty('userAgent', $svr[self::SVR_USER_AGENT] ?? self::DEF_USER_AGENT);
        $this->setReadonlyProperty('isHTTPS', isset($svr[self::SVR_HTTPS]));
        $this->setReadonlyProperty('requestURI', $this->getRequestURI($svr));
        $this->setReadonlyProperty('requestHost', $svr[self::SVR_REQ_HOST] ?? self::DEF_REQ_HOST);
        $this->setReadonlyProperty('requestMethod', $svr[self::SVR_REQ_METHOD] ?? self::DEF_REQ_METHOD);
        $this->setReadonlyProperty('queryString', $svr[self::SVR_QUERY_STR] ?? self::DEF_QUERY_STR);
        $this->setReadonlyProperty('rawIfModifiedSince', $svr[self::SVR_IF_MOD_S] ?? self::DEF_IF_MOD_S);
        $this->setReadonlyProperty('requestSchema', isset($svr[self::SVR_HTTPS]) ? 'https' : 'http');
        $this->setReadonlyProperty('requestTime', (int) ($svr[self::SVR_REQ_TIME] ?? time()));
        $this->setReadonlyProperty('requestTimeFloat', (float) ($svr[self::SVR_REQ_TIMEF] ?? microtime(true)));

        if (isset($svr[self::SVR_IF_MOD_S])) {
            $this->setReadonlyProperty('ifModifiedSince', strtotime($svr[self::SVR_IF_MOD_S]));
        } else {
            $this->setReadonlyProperty('ifModifiedSince', null);
        }
    }

    /**
     * @param array $svr Server Variables
     * @return null|string
     */
    private function getRequestURI(array $svr)
    {
        if (isset($svr[self::SVR_REQ_URI])) {
            return ltrim(explode('?', $svr[self::SVR_REQ_URI])[0], '/');
        }
        return self::DEF_REQ_URI;
    }

}
