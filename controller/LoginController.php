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
use model\validator\UsuarioValidate;
use util\Token;
use util\DataConversor;

class LoginController implements Controller
{


    public function post()
    {
        $login = new Usuario();
        $validate = new UsuarioValidate();
        $data = new DataConversor();
        $data = $data->converter();
        $validate = $validate->validateLogin($data);
        if ($validate === true) {
            $login->setEmail($data['email']);
            $login->setSenha($data['senha']);
            $login->login();
            $data = ["token" => $login->login()];
        } else {
            $data = $validate;
        }
        View::render($data);
    }


    public function get($params = [])
    {
        View::render((new Mensagem())->error('login-somente-post', 500));
    }

    public function put()
    {
        View::render((new Mensagem())->error('login-somente-post', 500));
    }

    public function delete()
    {
        View::render((new Mensagem())->error('login-somente-post', 500));
    }
}