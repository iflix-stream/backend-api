<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/11/2017
 * Time: 12:52
 */

namespace tests\util\tradutor;

use PHPUnit\Framework\TestCase;
use util\Tradutor;

class TradutorTest extends TestCase
{

    public function testTraduzir()
    {
        self::assertEquals("Bem-vindo ao IFlix", Tradutor::do('welcome'));
    }
}
