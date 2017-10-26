<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/10/2017
 * Time: 13:53
 */

namespace tests\video;

use model\dao\VideoDAO;
use model\Episodio;
use model\Filme;
use model\Serie;
use model\Usuario;
use model\Video;
use PHPUnit\Framework\TestCase;

include '../../vendor/autoload.php';

class VideoDAOTest extends TestCase
{
    private $video;
    private $usuario;

    /**
     * VideoDAOTest constructor.
     */
    public function __construct()
    {

        $this->usuario = new Usuario();
        $this->usuario->setId(84);
        parent::__construct();
    }


    /** @test */
    function create_filme_assistido_return_table_test()
    {
        $this->video = new Filme();
        $this->video->setId(1);
        $this->assertEquals('filme_assistido', VideoDAO::createSegundosAssistidos($this->video, $this->usuario));
    }


    /** @test */
    function create_episodio_assistido_return_table_test()
    {
        $this->video = new Episodio();
        $this->video->setId(1);
        $this->assertEquals('episodio_assistido', VideoDAO::createSegundosAssistidos($this->video, $this->usuario));
    }

    /** @test */
    function create_episodio_assistido_return_true_test()
    {
        $this->video = new Episodio();
        $this->video->setId(1);
        $this->assertEquals(true, VideoDAO::createSegundosAssistidos($this->video, $this->usuario));
    }

    /** @test */
    function update_filme_assistido_return_table_test()
    {
        $this->video = new Filme();
        $this->video->setId(1);
        self::assertEquals('filme_assistido',
            VideoDAO::updateSegundosAssistidos($this->video, $this->usuario));

    }

    /** @test */
    function update_episodio_assistido_return_table_test()
    {
        $this->video = new Episodio();
        $this->video->setId(1);
        self::assertEquals('episodio_assistido',
            VideoDAO::updateSegundosAssistidos($this->video, $this->usuario));

    }

    /** @test */
    function update_episodio_assistido_return_true_test()
    {
        $this->video = new Episodio();
        $this->video->setId(1);
        $this->video->setTempoAssistido(56);
        self::assertEquals(true,
            VideoDAO::updateSegundosAssistidos($this->video, $this->usuario));

    }

    /** @test */
    function retreave_episodio_assistido_return_table() {
        $this->video = new Episodio();
        $this->video->setId(1);
        print_r(VideoDAO::retreaveTempoEpisodioAssistido($this->usuario->getId(), $this->video->getId()));
    }

}
