<?php

namespace Akizuki\ServCon\Tests;

use PHPUnit\Framework\TestCase;
use Akizuki\ServCon\ServCon;

class ServConTest extends TestCase
{

    /** @var ServCon */
    private static $servConFull;

    /** @var ServCon */
    private static $servConNone;

    const VAL_UA   = 'MyUserAgent';
    const VAL_HOST = 'example.com';
    const VAL_TIME = 'Fri Jan 01 2010 00:00:00 GMT';

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$servConFull = new ServCon([
            ServCon::SVR_USER_AGENT => self::VAL_UA,
            ServCon::SVR_HTTPS      => 'On',
            ServCon::SVR_REQ_URI    => '/33/4',
            ServCon::SVR_REQ_HOST   => self::VAL_HOST,
            ServCon::SVR_REQ_METHOD => 'POST',
            ServCon::SVR_REQ_TIME   => 334,
            ServCon::SVR_REQ_TIMEF  => 334.334334,
            ServCon::SVR_QUERY_STR  => '33=4',
            ServCon::SVR_IF_MOD_S   => self::VAL_TIME,
        ]);

        self::$servConNone = new ServCon([]);
    }

    public function testValuesFull()
    {
        $t = self::$servConFull;
        $this->assertEquals(self::VAL_UA, $t->userAgent);
        $this->assertEquals('https', $t->requestSchema);
        $this->assertEquals(self::VAL_HOST, $t->requestHost);
        $this->assertEquals('/33/4', $t->requestURI);
        $this->assertEquals('POST', $t->requestMethod);
        $this->assertEquals(334, $t->requestTime);
        $this->assertEquals(334.334334, $t->requestTimeFloat);
        $this->assertEquals('33=4', $t->queryString);
        $this->assertEquals(true, $t->isHTTPS);
        $this->assertEquals(strtotime(self::VAL_TIME), $t->ifModifiedSince);
        $this->assertEquals(self::VAL_TIME, $t->rawIfModifiedSince);
    }

    public function testValuesNone()
    {
        $t = self::$servConNone;
        $this->assertEquals(null, $t->userAgent);
        $this->assertEquals('http', $t->requestSchema);
        $this->assertEquals(null, $t->requestHost);
        $this->assertEquals(null, $t->requestURI);
        $this->assertEquals(null, $t->requestMethod);
        $this->assertTrue($t->requestTime >= time() - 2);
        $this->assertTrue($t->requestTime <= time() + 2);
        $this->assertTrue($t->requestTimeFloat >= time() - 2);
        $this->assertTrue($t->requestTimeFloat >= microtime(true) - 2.0);
        $this->assertTrue($t->requestTimeFloat <= microtime(true) + 2.0);
        $this->assertEquals(null, $t->queryString);
        $this->assertEquals(false, $t->isHTTPS);
        $this->assertEquals(null, $t->ifModifiedSince);
        $this->assertEquals(null, $t->rawIfModifiedSince);
    }

}
