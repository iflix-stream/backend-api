<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 19/10/2017
 * Time: 16:19
 */

namespace controller;


use model\Contagem;
use util\DataConversor;
use util\Token;

class ContagemController implements IController
{
    private $token;

    public function __construct()
    {
        $this->token = new Token();
        $this->token = $this->token->token();
    }


    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $contagem = new Contagem();
        if (isset($data['id'])) $contagem->setId($data['id']);
        $contagem->setTipo($data['tipo']);
        $contagem->setUsuarioId($this->token['usuario']->id);
        $contagem->aumentar();
    }

    public function get($params = [])
    {

        $contagem = new Contagem();
        if ($this->token['permissao'] === 'admin') {
            $contagem->setPermicao(true);
        }
        $contagem->recuperar();

    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        $contagem = new Contagem();
        $contagem->setUsuarioId($this->token['usuario']->id);
        $contagem->diminuir();
    }
}