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
    private $episodios;
    private $temporadas;

    function __construct()
    {
        $this->setTipo('serie');
    }

    /**
     * @return mixed
     */
    public function getEpisodios()
    {
        return $this->episodios;
    }

    /**
     * @param mixed $episodios
     */
    public function setEpisodios($episodios)
    {
        $this->episodios = $episodios;
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

    public function retreaveSeries()
    {
        $series = VideoDAO::retreave($this);

        for ($i = 0; $i < count($series); $i++) {
            $series[$i]['temporadas'] = VideoDAO::retreaveTemporadas($series[$i]['id']);
            for ($j = 0; $j < count($series[$i]['temporadas']); $j++) {
                $series[$i]['temporadas'][$j]['episodios'] =
                    VideoDAO::retreaveEpisodios($series[$i]['temporadas'][$j]['id']);
            }
        }
        return $series;
    }

}