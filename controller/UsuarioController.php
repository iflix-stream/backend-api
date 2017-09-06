<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:31
 */

namespace controller;

use model\Usuario;
use util\DataConversor;
use view\View;
use util\Token;

class UsuarioController implements Controller
{
    private $token;

    public function __construct()
    {


    }


    /**
     *
     */
    public function post()
    {

        $usuario = new Usuario();
        $data = new DataConversor();
        $data = $data->converter();
        $date = date('Y-m-d');
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);
        $usuario->setAvatar('avatares/default.png');
        $usuario->setSenha($data['senha']);
        $usuario->setDataNascimento($data['data-nascimento']);
        $usuario->setDataCriacao($date);
        $usuario->setDataAlteracao($date);
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
        $this->token = new Token();
        $this->token = $this->token->token();
//        if ($this->token === 'normal') {
//            $usuario = new Usuario();
//            if (isset($params['id'])) $usuario->setId($params['id']);
//            $data = ["SQL" => "" . $usuario->listar() . ""];
//        } else if ($this->token === 'admin') {
//            $usuario = new Usuario();
//            if (isset($params['id'])) $usuario->setId($params['id']); //coloqei os msm metodos aki para o admin acessar mas talves ele teria uma funcionalidade que o usuario normal nao acessaria
//            View::render($usuario->listar());
//        } else {
//            $data = ["Mensagem" => "Nao tem permição"];
//        }
        $usuario = new Usuario();
        if (isset($params['id'])) {
            $usuario->setId($params['id']);
        }
        if (isset($params['nome'])) {
            $usuario->setNome($params['nome']);
        }

        View::render($usuario->listar());
    }

    public function put()
    {
        $this->token = new Token();
        $token = $this->token->token();
        $this->token->retornaClaims($token);
        $data = new DataConversor();
        $data = $data->converter();

        $usuario = new Usuario();

        isset($data['id']) ? $usuario->setId($data['id']) : null;
        isset($data['avatar']) ? $usuario->setAvatar($data['avatar']) : null;
        isset($data['nome']) ? $usuario->setNome($data['nome']): null;
        isset($data['email']) ? $usuario->setEmail($data['email']): null;
        isset($data['senha']) ? $usuario->setSenha($data['senha']): null;
        isset($data['controleDosPais'])? $usuario->setIsControleDosPais($data['controleDosPais']): null;
        $usuario->alterar();

    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }


}