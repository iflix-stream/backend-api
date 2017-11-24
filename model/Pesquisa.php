<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 24/11/2017
 * Time: 11:52
 */

namespace model;


use InvalidArgumentException;
use model\dao\PesquisaDAO;

class Pesquisa
{
    private $id;
    private $usuario;
    private $texto;
    private $dataHora;
    private $contexto;
    private $ativada;

    /**
     * Pesquisa constructor.
     * @param $usuario
     */
    public function __construct($usuario)
    {

        $this->usuario = new Usuario();
        $this->usuario->setId($usuario);
    }


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
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * @param mixed $dataHora
     */
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;
    }

    /**
     * @return mixed
     */
    public function getContexto()
    {
        return $this->contexto;
    }

    /**
     * @param mixed $contexto
     */
    public function setContexto($contexto)
    {
        $this->contexto = $contexto;
    }

    public function retreaveUltimas5()
    {
        if (!isset($this->contexto)) {
            throw new InvalidArgumentException("Argumento contexto é requirido");
        }
        return PesquisaDAO::retreave($this);
    }

    public function cadastrar()
    {
        $rByNome = $this->linhasRetreaveByNome();
        if (PesquisaDAO::getRows() > 0) {
            $this->id = $rByNome[0]['id'];
            return $this->alterar();
        }
        return PesquisaDAO::create($this);
    }

    public function linhasRetreaveByNome()
    {
        return PesquisaDAO::retreaveByNome($this);
    }

    public function alterar()
    {
        $this->usuario = $this->usuario->getId();
        return PesquisaDAO::update($this);
    }

    public function deletar()
    {
        $this->ativada = '0 ';
        $this->usuario = $this->usuario->getId();
        return PesquisaDAO::delete($this);
    }
}