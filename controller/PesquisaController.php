<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 24/11/2017
 * Time: 11:51
 */

namespace controller;


use Exception;
use model\Pesquisa;
use util\DataConversor;
use util\Token;
use view\View;

class PesquisaController implements IController
{

    private $token;

    /**
     * PesquisaController constructor.
     */
    public function __construct()
    {
        $this->token = new Token();
        $this->token->token();
    }

    public function post()
    {

        $data = new DataConversor();
        $data = $data->converter();
        $pesquisa = new Pesquisa($this->token->retornaIdUsuario());
        if (isset($data['texto'])) $pesquisa->setTexto($data['texto']);
        if (isset($data['contexto'])) $pesquisa->setContexto($data['contexto']);
        if ($pesquisa->cadastrar() != -1) {
            header('HTTP/1.0 201');
        }
    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function get($params = [])
    {

        $pesquisa = new Pesquisa($this->token->retornaIdUsuario());

        if (isset($params['contexto'])) $pesquisa->setContexto($params['contexto']);
        (new View())->render($pesquisa->retreaveUltimas5());


    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        $pesquisa = new Pesquisa($this->token->retornaIdUsuario());
        if (isset($params['id'])) $pesquisa->setId($params['id']);
        if ($pesquisa->deletar()) {
            header('HTTP/1.0 410 Pesquisa deletada');
        };
    }
}