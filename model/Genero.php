<?php
/**
 * Created by PhpStorm.
 * User: Luke
 * Date: 15/09/2017
 * Time: 20:46
 */

namespace model;


use model\dao\GeneroDAO;
use util\Mensagem;

class Genero
{
    private $id;
    private $nome;
    private $status;

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



    public function cadastrar()
    {
        GeneroDAO::retreaveByNome($this);
        if (GeneroDAO::getLinhas() > 0) {
            return (new Mensagem())->error("nome-genero-existe", 500);
        }
        return GeneroDAO::create($this);

    }

    public function listar()
    {
        return GeneroDAO::retreave($this);
    }

    public function listarPorNome()
    {
        return GeneroDAO::retreaveByNome($this);
    }

    public function update()
    {
        return GeneroDAO::update($this);
    }

    public function delete()
    {
        if (GeneroDAO::delete($this)) {
            return (new Mensagem())->success("sucesso-deletar-genero");
        }
        return (new Mensagem())->error("erro-deletar-genero", 500);
    }

}