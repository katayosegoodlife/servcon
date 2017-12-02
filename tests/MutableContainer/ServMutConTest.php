<?php

namespace Akizuki\ServMutCon\Container\Tests;

use Akizuki\ServCon\MutableContainer\ServMutCon;
use PHPUnit\Framework\TestCase;
use Strict\Property\Errors\ReadonlyPropertyError;
use Strict\Property\Errors\UndefinedPropertyError as InaccessiblePropertyException;

class ServMutConTest extends TestCase
{

    const VAL_UA   = 'MyUserAgent';
    const VAL_HOST = 'example.com';
    const VAL_TIME = 'Fri Jan 01 2010 00:00:00 GMT';

    public function testValuesFull()
    {
        $t = new ServMutCon([
            ServMutCon::SVR_USER_AGENT => self::VAL_UA,
            ServMutCon::SVR_HTTPS      => 'On',
            ServMutCon::SVR_REQ_URI    => '/33/4',
            ServMutCon::SVR_REQ_HOST   => self::VAL_HOST,
            ServMutCon::SVR_REQ_METHOD => 'POST',
            ServMutCon::SVR_REQ_TIME   => 334,
            ServMutCon::SVR_REQ_TIMEF  => 334.334334,
            ServMutCon::SVR_QUERY_STR  => '33=4',
            ServMutCon::SVR_IF_MOD_S   => self::VAL_TIME,
        ]);
        $this->assertEquals(self::VAL_UA, $t->userAgent);
        $this->assertEquals('https', $t->requestSchema);
        $this->assertEquals(self::VAL_HOST, $t->requestHost);
        $this->assertEquals('33/4', $t->requestURI);
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
        $t = new ServMutCon([]);
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

    public function testIssetTrue()
    {
        $t = new ServMutCon([]);
        $this->assertTrue(isset($t->ifModifiedSince));
    }

    public function testIssetFalse()
    {
        $t = new ServMutCon([]);
        $this->assertFalse(isset($t->ifModifiedSince2));
    }

    public function testGetFail()
    {
        $t = new ServMutCon([]);
        $this->expectException(InaccessiblePropertyException::class);
        $s = $t->ifModifiedSince2;
    }

    public function testUnset()
    {
        $t = new ServMutCon([]);
        $this->expectException(ReadonlyPropertyError::class);
        unset($t->userAgent);
    }

    public function testSet()
    {
        $t = new ServMutCon([]);
        $t->userAgent = self::VAL_UA;
        $this->assertEquals($t->userAgent, self::VAL_UA);
    }

    public function testSetFail()
    {
        $t = new ServMutCon([]);
        $this->expectException(\Exception::class);

        $t->waaa = self::VAL_UA;
    }

}
