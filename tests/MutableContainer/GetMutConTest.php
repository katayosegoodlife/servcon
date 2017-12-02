<?php

namespace Akizuki\ServConç\Tests;

use Akizuki\ServCon\MutableContainer\GetMutCon;
use PHPUnit\Framework\TestCase;

class GetMutConTest extends TestCase
{

    public function testConstruct()
    {
        $t = new GetMutCon(['a' => 'b']);
        $this->assertArrayHasKey('a', $t);
        $this->assertEquals('b', $t['a']);
    }

    public function testUnset()
    {
        $t = new GetMutCon(['a' => 'b']);
        unset($t['a']);
        $this->assertFalse(isset($t['a']));
    }
    public function testIsset()
    {
        $t = new GetMutCon(['a' => 'b']);
        $this->assertTrue(isset($t['a']));
        $this->assertFalse(isset($t['c']));
    }

    public function testSet()
    {
        $t = new GetMutCon(['a' => 'b']);
        $t['a'] = 'c';
        $this->assertEquals('c', $t['a']);
        $t['d'] = 'e';
        $this->assertEquals('e', $t['d']);

    }

}
