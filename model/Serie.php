<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:01
 */

namespace model;


use model\dao\VideoDAO;

class Serie extends Video
{

    /**
     * @var Episodio Episodio
     */
    private $episodio;
    private $temporadas;

    /**
     * @var Usuario Usuario
     */
    private $usuario;

    function __construct()
    {
        $this->setTipo('serie');
        $this->episodio = new Episodio();
        $this->usuario = new Usuario();
    }

    /**
     * @return Episodio
     */
    public function getEpisodio()
    {
        return $this->episodio;
    }

    /**
     * @param Episodio $episodio
     */
    public function setEpisodio($episodio)
    {
        $this->episodio = $episodio;
    }

    /**
     * @return mixed
     */
    public function getTemporadas()
    {
        return $this->temporadas;
    }

    /**
     * @param mixed $temporadas
     */
    public function setTemporadas($temporadas)
    {
        $this->temporadas = $temporadas;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }


    public function retreaveSeries()
    {
        $series = VideoDAO::retreave($this);

        for ($i = 0; $i < count($series); $i++) {
            $series[$i]['temporadas'] = VideoDAO::retreaveTemporadas($series[$i]['id']);
            for ($j = 0; $j < count($series[$i]['temporadas']); $j++) {
                $series[$i]['temporadas'][$j]['episodios'] =
                    VideoDAO::retreaveEpisodios($series[$i]['temporadas'][$j]['id']);
                for ($k = 0; $k < count($series[$i]['temporadas'][$j]['episodios']); $k++) {
                    $series[$i]['temporadas'][$j]['episodios'][$k]['tempoAssistido'] =
                        VideoDAO::retreaveTempoEpisodioAssistido(
                            $this->getUsuario()->getId(), $series[$i]['temporadas'][$j]['episodios'][$k]['id']
                        )['tempo'];

                }

            }
        }
        return $series;
    }


}