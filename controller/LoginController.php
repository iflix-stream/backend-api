<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 16:58
 */

namespace controller;


use model\Usuario;
use util\Mensagem;
use view\View;
class LoginController implements Controller
{
    static function post()
    {
        $login = new Usuario();

        View::render(Mensagem::normal("welcome"));
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