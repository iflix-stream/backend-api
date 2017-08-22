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
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->listar();
        }
    }

    public static final function listar()
    {
        $data = array("mensagem" => "Tabaco bem massa");
        return View::render($data);
    }
}