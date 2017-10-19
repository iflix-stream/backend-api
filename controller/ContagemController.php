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

class ContagemController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        if (isset($data['somar'])) {
            (new Contagem())->aumentar();
        } else if (isset($data['subtrair'])) {
            (new Contagem())->diminuir();
        }
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