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

class FilmeController implements Controller
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();

        $filme = new Filme();
        $filme->setNome($data['nome']);
        $filme->setDescricao($data['descricao']);
        $filme->setGenero($data['genero']);
        $filme->setFormato($data['formato']);
        $filme->setClassificacao($data['idade_recomendada']);
        $filme->cadastrar();
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

    public function put()
    {
        // TODO: Implement put() method.
    }

    public function delete()
    {
        // TODO: Implement delede() method.
    }
}