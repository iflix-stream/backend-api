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
     * @param array $parametrosHttp
     */
    public function __construct($parametrosHttp = [])
    {
        $this->video = new Video();

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            if(isset($parametrosHttp['id'])) $this->video->setId($parametrosHttp['id']);
            if(isset($parametrosHttp['nome'])) $this->video->setNome($parametrosHttp['nome']);
            if(isset($parametrosHttp['genero'])) $this->video->setGenero($parametrosHttp['genero']);
            $this->listar();
        } else if ($method == "POST") {
            $this->video->cadastrar();
        } else if ($method == "PUT") {
            $this->video->alterar();
        } else if ($method == "DELETE") {
            $this->video->deletar();
        } else {
            View::render(["mensagem"=>"Método não implementado."]);
        }
    }

    public function listar()
    {

        $data= ["SQL"=>"".$this->video->listar().""];
        View::render($data);
    }
}