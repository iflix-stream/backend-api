<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace controller;

use model\Video;
use view\View;

class VideoController
{

    public $video;
    /**
     * VideoController constructor.
     */
    public function __construct($parametrosHttp = [])
    {
        $this->video = new Video();

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            if(isset($parametrosHttp['id'])) $this->video->setId($parametrosHttp['id']);
            if(isset($parametrosHttp['nome'])) $this->video->setId($parametrosHttp['nome']);
            if(isset($parametrosHttp['genero'])) $this->video->setId($parametrosHttp['genero']);
        } else if ($method == "POST") {
            $this->video->cadastrar();
        } else if ($method == "PUT") {
            $this->video->alterar();
        } else if ($method == "DELETE") {
            $this->video->deletar();
        } else {
            View::render("Mensagem : Metodo Não implementado");
        }
    }

    public function listar($campo = "", $valor = "")
    {
//        $data = array("mensagem" => "Tabaco bem massa");
//        if ($campo != "" and $valor != "") {
//            $data = array(
//                "Mensagem" => "tabaco bem massa", $campo => $valor);
//        }
        $this->video->setId($valor);
        $data= ["SQL"=>$this->video->listar($campo, $valor)];
        View::render($data);
    }
}