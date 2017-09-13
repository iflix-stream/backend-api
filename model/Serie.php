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

    public function retreaveSeries() {
//        $series =
//        if(count($series) > 1 ){
//
//        for($i = 0; $i < count($series); $i++){
//
//            $series[$i]['temporada'] = VideoDAO::retreaveTemporadas($series[$i]['id']);
//            $series[$i]['temporada']['episodio'] = VideoDAO::retreaveEpisodios($series[$i]['temporada']['id']);
//        }
//
//        }
//        print_r($series);
        return VideoDAO::retreave($this);;
    }

}