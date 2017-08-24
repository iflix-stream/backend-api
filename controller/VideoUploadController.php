<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/08/2017
 * Time: 13:20
 */

namespace controller;

use model\VideoUpload;
use view\View;

class VideoUploadController
{
    public $videoUpload;

    public function __construct($campo = "", $valor = "")
    {
        $this->videoUpload = new VideoUpload();

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $this->videoUpload->cadastrar();
        } else {
            View::render(array("Mensagem"=>"Metodo Nao implementado"));
        }
    }
}