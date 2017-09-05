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
use util\Token;

class UsuarioController implements Controller
{
    private $token;

    public function __construct()
    {

        $this->token = new Token();
        $this->token = $this->token->token();

    }


    public function post()
    {

        $usuario = new Usuario();
//        if ($this->token === 'normal') {
//
//            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
//        } else if ($this->token === 'admin') {
//            $usuario = new Usuario();
//            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
//        } else {
//            $data = ["Mensagem" => "Nao tem permição"];
//        }
        View::render($usuario->cadastrar());

    }

    public function get($params = [])
    {
        if ($this->token === 'normal') {
            $usuario = new Usuario();
            if (isset($params['id'])) $usuario->setId($params['id']);
            $data = ["SQL" => "" . $usuario->listar() . ""];
        } else if ($this->token === 'admin') {
            $usuario = new Usuario();
            if (isset($params['id'])) $usuario->setId($params['id']); //coloqei os msm metodos aki para o admin acessar mas talves ele teria uma funcionalidade que o usuario normal nao acessaria
            $data = ["SQL" => "" . $usuario->listar() . ""];
        } else {
            $data = ["Mensagem" => "Nao tem permição"];
        }
        View::render($data);
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