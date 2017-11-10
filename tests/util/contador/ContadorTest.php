<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/11/2017
 * Time: 10:42
 */

namespace tests\util\contador;

use PHPUnit\Framework\TestCase;
use util\Contador;

class ContadorTest extends TestCase
{

    public function testSoma()
    {
        $c = new Contador();
        self::assertEquals(1, $c->somar());
    }

    public function testSubtrai()
    {
        $c = new Contador();
        self::assertEquals(0, $c->subtrair());
    }
}
