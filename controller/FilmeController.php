<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 11/09/2017
 * Time: 21:37
 */

namespace controller;


use model\Filme;
use model\Genero;
use util\DataConversor;
use util\Token;
use view\View;
use model\validator\FilmeValidate;

class FilmeController implements IController
{
    private $token;

    public function __construct()
    {

//        $this->token = new Token();
//        $this->token = $this->token->token();
    }

    /**
     *
     */
    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $validate = new FilmeValidate();
        $filme = new Filme();
        $validate = $validate->validaUploadFilme($data);
        if ($validate === true) {
            $filme->setNome($data['nome']);
            $filme->setGenero($data['genero']);
            $filme->setClassificacao($data['idadeRecomendada']);
            $filme->setDuracao($data['duracao']);
            $filme->setThumbnail($data['thumbnail']);
            $filme->setCaminho($data['caminho']);
            $filme->setSinopse($data['sinopse']);
            View::render($filme->cadastrar()); // deve retornar um id para o front para mandar o video logo apos.
        } else {
            View::render($validate);
        }
    }

    public function get($params = [])
    {
        $filme = new Filme();

        if (isset($_GET['user'])) $filme->getUsuario()->setId($this->token['usuario']->id);
        if (isset($params['id'])) $filme->setId($params['id']);
        if (isset($params['nome'])) $filme->setNome($params['nome']);
        if (isset($params['genero'])) $filme->setGenero($params['genero']);
        if (!isset($_GET['stream'])) View::render($filme->listar());
        if (isset($_GET['stream']) == "true") {
            $filme->setId($_GET['id']);
            $filme->stream();
        }
    }

    public function put($params = [])
    {
        $filme = new Filme();
        $caminho = $filme->fazerUpload($filme->getTipo(), $filme->getNome());
        if (is_string($caminho)) {
            $filme->setCaminho($caminho);
            $filme->setId($params['id']); // id retornado apos adicionar entao setado para alterar o caminho. deve ser passado como parametro
            $filme->alterar();
        }
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {

    }
}