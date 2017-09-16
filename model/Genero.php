<?php
/**
 * Created by PhpStorm.
 * User: Luke
 * Date: 15/09/2017
 * Time: 20:46
 */

namespace model;


use model\dao\GeneroDAO;

class Genero
{
    private $id;
    private $nome;

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

    public function cadastrar(){
        return GeneroDAO::create($this);
    }
    public function listar(){
        return GeneroDAO::retreave($this);
    }
    public function listarPorNome(){
        return GeneroDAO::retreaveByNome($this);
    }
    public function update(){
        return GeneroDAO::update($this);
    }
    public function delete(){
        return GeneroDAO::delete($this);
    }

}