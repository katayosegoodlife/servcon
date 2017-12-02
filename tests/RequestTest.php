<?php

namespace Akizuki\ServCon\Tests;

use Akizuki\ServCon\GetCon;
use Akizuki\ServCon\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    const UA = 'Mozilla/5.0 (Windows NT 6.1; rv:16.0) Gecko/20100101 Firefox/16.0';

    public function testConstruct()
    {
        $t = new Request(
            ['HTTP_USER_AGENT' => self::UA],
            ['id' => 2],
            [],
            [],
            []
        );
        $this->assertEquals(self::UA, $t->server->userAgent);
        $this->assertEquals(2, $t->get['id']);
    }


}
