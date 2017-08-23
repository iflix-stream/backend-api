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
    public $video;

    public function __construct($campo = "", $valor = "")
    {
        $this->video = new Video();
<<<<<<< HEAD
=======

>>>>>>> 39fee9c02113b349fd53054ba4bcd523a166f95a
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            if (isset($campo)) {
                $this->video->listar($campo, $valor);
            } else {
                $this->video->listar();
            }
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
        $data= ["SQL"=>$this->video->listar()];
        return View::render($data);
    }
}