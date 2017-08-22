<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace controller;

use view\View;

class VideoController
{
    /**
     * VideoController constructor.
     */
    public function __construct($campo = "", $valor = "")
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($campo)) {
                $this->listar($campo, $valor);
            }
            $this->listar();
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