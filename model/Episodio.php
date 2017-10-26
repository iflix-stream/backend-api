<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 20/10/2017
 * Time: 17:57
 */

namespace model;


class Episodio extends Video
{

    private $tempoAssistido;

    /**
     * Episodio constructor.
     */
    public function __construct()
    {
        $this->setTipo('episodio');
    }


    /**
     * @return mixed
     */
    public function getTempoAssistido()
    {
        return $this->tempoAssistido;
    }

    /**
     * @param mixed $tempoAssistido
     */
    public function setTempoAssistido($tempoAssistido)
    {
        $this->tempoAssistido = $tempoAssistido;
    }


}