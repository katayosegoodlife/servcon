<?php

namespace Akizuki\ServConç\Tests;

use Akizuki\ServCon\Container\GetCon;
use PHPUnit\Framework\TestCase;

class GetConTest extends TestCase
{

    public function testConstruct()
    {
        $t = new GetCon(['a' => 'b']);
        $this->assertArrayHasKey('a', $t);
        $this->assertEquals('b', $t['a']);
    }

    public function testUnset()
    {
        $t = new GetCon(['a' => 'b']);
        $this->expectException(\LogicException::class);
        unset($t['a']);
    }
    public function testIsset()
    {
        $t = new GetCon(['a' => 'b']);
        $this->assertTrue(isset($t['a']));
        $this->assertFalse(isset($t['c']));
    }

    public function testSet1()
    {
        $t = new GetCon(['a' => 'b']);
        $this->expectException(\LogicException::class);
        $t['a'] = 'c';
    }

    public function testSet2()
    {
        $t = new GetCon(['a' => 'b']);
        $this->expectException(\LogicException::class);
        $t['d'] = 'e';
    }

}
