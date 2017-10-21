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
    private $episodioId;
    private $episodioTemporadaId;
    private $episodioSerieId;
    private $tipo;
    private $permicao;

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
    public function getEpisodioId()
    {
        return $this->episodioId;
    }

    /**
     * @param mixed $episodioId
     */
    public function setEpisodioId($episodioId)
    {
        $this->episodioId = $episodioId;
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

    public function aumentar()
    {
        $var['tipo'] = $this->getTipo();
        $var['usuarioId'] = $this->getUsuarioId();
        if ($this->getTipo() == 'serie') {
            $var['episodioId'] = $this->getEpisodioId();
            $var['episodioTemporadaId'] = $this->getEpisodioTemporadaId();
            $var['episodioSerieId'] = $this->getEpisodioSerieId();
        } else {
            $var['filmeId'] = $this->getFilmeId();
        }
        ContagemDAO::create($var);
    }

    public function diminuir()
    {

    }

    public function recuperar()
    {
        $var[]='';
        if(!empty($this->getPermicao())){
            $var['permicao'] = $this->getPermicao();
        }
        ContagemDAO::retreave($var);
    }
}