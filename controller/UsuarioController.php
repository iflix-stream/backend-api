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
class UsuarioController implements Controller
{


    static function post()
    {
        // TODO: Implement post() method.
    }

    static function get($params = [])
    {
        $usuario = new Usuario();
        if(isset($params['id'])) $usuario->setId($params['id']);
        $data =["SQL"=>"".$usuario->listar().""];
        View::render($data);
    }

    static function put()
    {
        // TODO: Implement put() method.
    }

    static function delete()
    {
        // TODO: Implement delete() method.
    }
}