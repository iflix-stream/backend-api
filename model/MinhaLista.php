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

    private $idUsuario;
    private $idVideo;
    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getIdVideo()
    {
        return $this->idVideo;
    }

    /**
     * @param mixed $idVideo
     */
    public function setIdVideo($idVideo)
    {
        $this->idVideo = $idVideo;
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