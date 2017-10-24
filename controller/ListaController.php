<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/10/2017
 * Time: 20:19
 */

namespace controller;


use model\Filme;
use model\Lista;
use model\Usuario;
use model\Video;
use util\DataConversor;
use view\View;

class ListaController implements IController
{

    /**
     * @var Usuario
     */
    private $usuario;

    /**
     * @var Video
     */
    private $video;

    /**
     * @var array|string
     */
    private $data;

    /**
     * ListaController constructor.
     * @param $video
     */
    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->video = new Filme();
        $this->data = (new DataConversor())->converter();
        $class = "\\model\\" . ucfirst($this->data['tipo']);
        $this->video = new $class;
    }


    public function post()
    {
        $list = new Lista($this->usuario, $this->video);
        $this->usuario->setId($this->data['usuario']);
        $this->video->setId($this->data['id']);
        View::render($list->adicionar());
    }

    public function get($params = [])
    {
        // TODO: Implement get() method.
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        $list = new Lista($this->usuario, $this->video);
        $this->usuario->setId($this->data['usuario']);
        $this->video->setId($this->data['id']);
        $list->remover();
    }
}