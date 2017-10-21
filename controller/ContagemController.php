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
        $contagem->setFilmeId($data['filmeId']);
        $contagem->setUsuarioId($this->token['usuario']->id);
        $contagem->aumentar();

    }

    public function get($params = [])
    {
        // TODO: Implement get() method.
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        // TODO: Implement delete() method.
    }
}