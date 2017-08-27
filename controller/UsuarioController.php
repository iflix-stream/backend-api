<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:31
 */
namespace controller;
use model\Usuario;
use view\View;
class UsuarioController
{
    public $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->listar();// temporario ate arrumar a api.php
    }

    public function listar(){
        $data =["SQL"=>"".$this->usuario->listar().""];
        View::render($data);
    }
}