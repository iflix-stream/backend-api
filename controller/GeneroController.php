<?php
/**
 * Created by PhpStorm.
 * User: letic
 * Date: 16/09/2017
 * Time: 13:49
 */

namespace controller;


use model\dao\GeneroDAO;
use model\Genero;
use view\View;

class GeneroController implements IController
{

    public function post()
    {
        $genero = new Genero();
        $genero->cadastrar();
    }

    public function get($params = [])
    {
        $genero = new Genero;

        if(isset($params['id'])) $genero->setId($params['id']);
        if(isset($params['nome'])) $genero->setId($params['nome']);
        $data = ["SQL"=>"".$genero->listar().""];

        View::render($data);

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