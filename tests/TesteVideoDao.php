<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 16:33
 */

namespace tests;



use PHPUnit\Framework\TestCase;
use dao\VideoDAO;
use model\Video;
include '../vendor/autoload.php';

final class TesteVideoDao extends TestCase
{
    function testReturnString() {
        $video = new Video();
        $video->setNome("Marcio");
        $this->assertEquals("SELECT * FROM video  WHERE (ativado = :condition_ativado AND id = :condition_id) ", VideoDAO::retreave($video));
    }
}
