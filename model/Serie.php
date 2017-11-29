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
        $episodio = new Episodio();

        for ($i = 0; $i < count($series); $i++) {
            $this->setId($series[$i]['id']);
            $series[$i]['ultimo_ep_assistido'] = $this->retreaveUltimoEpisodioAssistido();
            $series[$i]['primeiro_episodio'] = $this->retreavePrimeiroEpisodio();
            $series[$i]['temporadas'] = VideoDAO::retreaveTemporadas($series[$i]['id']);
            for ($j = 0; $j < count($series[$i]['temporadas']); $j++) {
                $series[$i]['temporadas'][$j]['episodios'] =
                    VideoDAO::retreaveEpisodios($series[$i]['temporadas'][$j]['id']);
                for ($k = 0; $k < count($series[$i]['temporadas'][$j]['episodios']); $k++) {
                    $episodio->setId($series[$i]['temporadas'][$j]['episodios'][$k]['id']);
                    $series[$i]['temporadas'][$j]['episodios'][$k]['tempoAssistido'] =
                        VideoDAO::retreaveTempoAssistido(
                            $episodio,
                            $this->usuario
                        );

                }
            }

        }
        return $series;
    }

    public function retreaveUltimoEpisodioAssistido()
    {
        $last = VideoDAO::ultimoEpisodioAssistido($this, $this->usuario);
        if (VideoDAO::getRows() == 1) {
            return $last;
        }
        return 0;
    }

    public function retreavePrimeiroEpisodio()
    {
        $first = VideoDAO::primeiroEpisodio($this);
        if (VideoDAO::getRows() == 1) {
            return $first;
        }
        return 0;
    }


}