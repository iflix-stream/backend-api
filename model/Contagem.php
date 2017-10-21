<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 19/10/2017
 * Time: 16:20
 */

namespace model;


use model\dao\ContagemDAO;
use util\Contador;

class Contagem
{
    private $filmeId;
    private $usuarioId;
    private $horarioPlay;

    /**
     * @return mixed
     */
    public function getFilmeId()
    {
        return $this->filmeId;
    }

    /**
     * @param mixed $filmeId
     */
    public function setFilmeId($filmeId)
    {
        $this->filmeId = $filmeId;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param mixed $usuarioId
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return mixed
     */
    public function getHorarioPlay()
    {
        return $this->horarioPlay;
    }

    /**
     * @param mixed $horarioPlay
     */
    public function setHorarioPlay($horarioPlay)
    {
        $this->horarioPlay = $horarioPlay;
    }

    public function aumentar()
    {
        $this->setHorarioPlay(time());
        $var['filmeId'] = $this->getFilmeId();
        $var['usuarioId'] = $this->getUsuarioId();
        $var['horarioPlay'] = $this->getHorarioPlay();
        ContagemDAO::create($var);
    }

    public function diminuir()
    {
        (new Contador())->subtrair();
    }
}