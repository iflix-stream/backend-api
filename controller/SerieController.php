<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 11/09/2017
 * Time: 21:37
 */

namespace controller;


use model\Serie;
use view\View;

class SerieController implements Controller
{

    public function post()
    {
        $serie = new Serie();
        $serie->cadastrar();
        // TODO: Implement post() method.
    }

    public function get($params = [])
    {
        $serie = new Serie();

        if (isset($params['id'])) $serie->setId($params['id']);
        if (isset($params['nome'])) $serie->setNome($params['nome']);
        if (isset($params['genero'])) $serie->setGenero($params['genero']);
        $data = ["SQL" => "" . $serie->listar() . ""];
        if ($_GET['stream'] == "true") {
            $serie->setId($_GET['id']);
            $serie->stream();
        }
        View::render($data);
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        // TODO: Implement delede() method.
    }
}