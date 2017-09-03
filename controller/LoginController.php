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
    public function post()
    {
        $login = new Usuario();
        View::render($login->login());
    }

    public function get($params = [])
    {
        // TODO: Implement get() method.
    }

    public function put()
    {
        // TODO: Implement put() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}