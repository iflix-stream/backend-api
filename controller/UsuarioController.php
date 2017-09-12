<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:31
 */

namespace controller;

use model\Usuario;
use model\validator\UsuarioValidate;
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
        $validar = new UsuarioValidate();
        $validar = $validar->validateUsuarioCriar($data);
        if ($validar === true) {
            $date = date('Y-m-d');
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            $usuario->setAvatar('avatares/default.png');
            $usuario->setSenha($data['senha']);
            $usuario->setDataNascimento($data['data-nascimento']);
            $usuario->setDataCriacao($date);
            $usuario->setDataAlteracao($date);
            View::render($usuario->cadastrar());
        } else {
            View::render($validar);
        }
//        if ($this->token === 'normal') {
//
//            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
//        } else if ($this->token === 'admin') {
//            $usuario = new Usuario();
//            $data = ["SQL" => "" . $usuario->cadastrar() . ""];
//        } else {
//            $data = ["Mensagem" => "Nao tem permição"];
//        }

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

    public function put($params = [])
    {
        $this->token = new Token();
        $this->token->token();
        $tokenClaims = $this->token->retornaIdUsuario();
        $data = new DataConversor();
        $data = $data->converter();
        $validar = new UsuarioValidate();
        $validar = $validar->validateUsuarioAlterar($data);
        if ($validar === true) {
            $usuario = new Usuario();
            $usuario->setId($tokenClaims);
            if (isset($data['avatar'])) {
                $usuario->setAvatar($data['avatar']);
            }
            if (isset($data['nome'])) {
                $usuario->setNome($data['nome']);
            }
            if (isset($data['senha'])) {
                $usuario->setSenha($data['senha']);
            }
            if (isset($data['isControleDosPais'])) {
                $usuario->setIsControleDosPais($data['isControleDosPais']);
            }
            View::render($usuario->alterar());
        } else {
            View::render($validar);
        }


    }

    public function delete($params = [])
    {
        // TODO: Implement delete() method.
    }


}