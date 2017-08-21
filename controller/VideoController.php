<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace controller;

include '../vendor/autoload.php';

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

    public function listar()
    {
        $data = array("mensagem" => "Tabaco bem massa");
        return View::render($data);
    }
}

new VideoController();