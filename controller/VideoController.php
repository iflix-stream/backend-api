<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace controller;

use view\View;
use model\Video;

class VideoController extends Video
{
    /**
     * VideoController constructor.
     */
    public function __construct($campo = "", $valor = "")
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            if (isset($campo)) {
                $this->listar($campo, $valor);
            } else {
                $this->listar();
            }
        } else if ($method == "POST") {
            $this->cadastrar();
        } else if ($method == "PUT") {
            $this->alterar();
        } else if ($method == "DELETE") {
            $this->deletar();
        } else {
            View::render("Mensagem : Metodo Não implementado");
        }
    }

    public function listar($campo = "", $valor = "")
    {
        $data = array("mensagem" => "Tabaco bem massa");
        if ($campo != "" and $valor != "") {
            $data = array(
                "Mensagem" => "tabaco bem massa", $campo => $valor);
        }
        return View::render($data);
    }
}