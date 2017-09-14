<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 11/09/2017
 * Time: 21:37
 */

namespace controller;


use model\Filme;
use util\DataConversor;
use view\View;
use model\validator\FilmeValidate;

class FilmeController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $validate = new FilmeValidate();
        $filme = new Filme();
        $validate = $validate->validaUploadFilme($data);
        if ($validate === true) {
            $filme->setNome($data['nome']);
            $filme->setDescricao($data['descricao']);
            $filme->setGenero($data['genero']);
            $filme->setFormato($data['formato']);
            $filme->setClassificacao($data['idade_recomendada']);
            $filme->cadastrar(); // deve retornar um id para o front para mandar o video logo apos.
        } else {
            View::render($validate);
        }
    }

    public function get($params = [])
    {
        $filme = new Filme();

        if (isset($params['id'])) $filme->setId($params['id']);
        if (isset($params['nome'])) $filme->setNome($params['nome']);
        if (isset($params['genero'])) $filme->setGenero($params['genero']);
        $data = ["SQL" => "" . $filme->listar() . ""];
        if ($_GET['stream'] == "true") {
            $filme->setId($_GET['id']);
            $filme->stream();
        }
        View::render($data);
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