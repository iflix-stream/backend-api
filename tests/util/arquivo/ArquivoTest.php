<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/11/2017
 * Time: 07:58
 */

namespace tests\util\arquivo;

use PHPUnit\Framework\TestCase;
use util\Arquivo;

class ArquivoTest extends TestCase
{


    public function testCriarArquivo()
    {
        $file = new Arquivo();
        $file->setPath('./contagem.txt');
        self::assertEquals(true, $file->create());
    }

    /**
     * @depends testCriarArquivo
     */
    public function testEscreverArquivo()
    {
        $file = new Arquivo();
        $file->setPath('./contagem.txt');
        self::assertEquals(true, $file->write("ola mundo"));
    }

    /**
     * @depends testEscreverArquivo
     */
    public function testLerArquivo()
    {
        $file = new Arquivo();
        $file->setPath('./contagem.txt');
        self::assertEquals("ola mundo", $file->read());
    }

    /**
     * @depends testLerArquivo
     */
    public function testMudarArquivo()
    {
        $file = new Arquivo();
        $file->setPath('./contagem.txt');
        $file->write("pamonha");
        self::assertEquals("pamonha", $file->read());
    }

    public function testDeleteArquivo()
    {
        $file = new Arquivo;
        $file->setPath('./contagem.txt');
        $file->delete();
        self::assertEquals(false, is_dir($file->getPath()));
    }


}
