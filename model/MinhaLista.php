<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 31/08/2017
 * Time: 12:30
 */

namespace model;


class MinhaLista
{

    private $idPerfil;
    private $itens;

    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * @param mixed $idPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    }

    /**
     * @return mixed
     */
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * @param mixed $itens
     */
    public function setItens($itens)
    {
        $this->itens = $itens;
    }



    public function adicionarItem(){
        //TODO: método de adiconar itens na lista;
    }
    public function removerItem(){
        //TODO: Método de remover itens da Lista;
    }

}