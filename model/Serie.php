<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:01
 */

namespace model;


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



}