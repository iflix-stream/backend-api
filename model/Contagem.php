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
    private $Id;
    private $usuarioId;
    private $episodioTemporadaId;
    private $episodioSerieId;
    private $tipo;
    private $permicao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return mixed
     */
    public function getPermicao()
    {
        return $this->permicao;
    }

    /**
     * @param mixed $permicao
     */
    public function setPermicao($permicao)
    {
        $this->permicao = $permicao;
    }

    /**
     * @return mixed
     */
    public function getEpisodioTemporadaId()
    {
        return $this->episodioTemporadaId;
    }

    /**
     * @param mixed $episodioTemporadaId
     */
    public function setEpisodioTemporadaId($episodioTemporadaId)
    {
        $this->episodioTemporadaId = $episodioTemporadaId;
    }

    /**
     * @return mixed
     */
    public function getEpisodioSerieId()
    {
        return $this->episodioSerieId;
    }

    /**
     * @param mixed $episodioSerieId
     */
    public function setEpisodioSerieId($episodioSerieId)
    {
        $this->episodioSerieId = $episodioSerieId;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public function aumentar()
    {
        $var['tipo'] = $this->getTipo();
        $var['usuarioId'] = $this->getUsuarioId();
        $var['id'] = $this->getId();
        ContagemDAO::create($var);
    }

    public function diminuir()
    {
        $var['usuarioId'] = $this->getUsuarioId();
        ContagemDAO::delete($var);
    }

    public function recuperar()
    {
        $var[] = '';
        if (!empty($this->getPermicao())) {
            $var['permicao'] = $this->getPermicao();
        }
        ContagemDAO::retreave($var);
    }
}