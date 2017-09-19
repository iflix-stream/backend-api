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
use util\DataConversor;
use util\Mensagem;
use view\View;

class GeneroController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $genero = new Genero();
        $genero->setNome($data['nome']);
        View::render($genero->cadastrar());
    }

    public function get($params = [])
    {
        $genero = new Genero;

        if (isset($params['id'])) $genero->setId($params['id']);
        if (isset($params['nome'])) $genero->setNome($params['nome']);


        View::render($genero->listar());

    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        $genero = new Genero();
        $data = (new Mensagem())->error("parametros-invalidos", 500);
        if (isset($params['id'])) {
            $genero->setId($params['id']);
            $genero->setStatus("'0'");
            $data = $genero->delete();
        }
        View::render($data);

    }
}