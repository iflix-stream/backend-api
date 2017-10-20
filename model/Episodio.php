<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 20/10/2017
 * Time: 17:57
 */

namespace model;


class Episodio
{
    private $id;
    private $nome;
    private $sinopse;
    private $caminho;
    private $duracao;
    private $tempoAssistido;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSinopse()
    {
        return $this->sinopse;
    }

    /**
     * @param mixed $sinopse
     */
    public function setSinopse($sinopse)
    {
        $this->sinopse = $sinopse;
    }

    /**
     * @return mixed
     */
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * @param mixed $caminho
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;
    }

    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param mixed $duracao
     */
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
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