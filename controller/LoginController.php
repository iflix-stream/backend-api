<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 16:58
 */

namespace controller;


use model\Usuario;
use view\View;
class LoginController implements Controller
{
    static function post()
    {
        $login = new Usuario();
        $data =["Mensagem"=>"".$login->login().""];
        View::render($data);
    }

    static function get($params = [])
    {
        // TODO: Implement get() method.
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