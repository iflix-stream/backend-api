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
    static private $token;

    public function __construct()
    {
        self::$token = Token::token();
    }


    static function post()
    {
        if (self::$token === 'normal') {
            $usuario = new Usuario();
            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
        } else if (self::$token === 'admin') {
            $usuario = new Usuario();
            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
        } else {
            $data = ["Mensagem" => "Nao tem permição"];
        }
        View::render($data);

    }

    static function get($params = [])
    {
        if (self::$token === 'normal') {
            $usuario = new Usuario();
            if (isset($params['id'])) $usuario->setId($params['id']);
            $data = ["SQL" => "" . $usuario->listar() . ""];
        } else if (self::$token === 'admin') {
            $usuario = new Usuario();
            if (isset($params['id'])) $usuario->setId($params['id']); //coloqei os msm metodos aki para o admin acessar mas talves ele teria uma funcionalidade que o usuario normal nao acessaria
            $data = ["SQL" => "" . $usuario->listar() . ""];
        } else {
            $data = ["Mensagem" => "Nao tem permição"];
        }
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