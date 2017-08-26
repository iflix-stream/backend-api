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
    private $video;

    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            VideoDAO::class,
            VideoDAO::retreave($this->video)
        );
    }

    public function testarRetreaveDinamico()
    {
        $this->video = new Video();
        $this->video->setNome("Um dia de verão");
        $this->video->setGenero("Comédia");

        $this->assertEquals(
            "SELECT * FROM video  WHERE (ativado = :condition_ativado AND
 (nome LIKE CONCAT('%',:condition_nome,'%') AND genero = :condition_genero)", VideoDAO::retreave($this->video));
    }
}
