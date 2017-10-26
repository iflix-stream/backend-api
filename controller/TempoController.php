<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/10/2017
 * Time: 15:10
 */

namespace controller;


use model\Episodio;
use model\Filme;
use model\Usuario;
use util\DataConversor;

class TempoController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $user = new Usuario();

        if ($data['tipo'] == 'serie') {
            $ep = new Episodio();
            $ep->setId($data['id']);
            $user->setId($data['usuario']);

            if(isset($data['tempo']))  $ep->setTempoAssistido($data['tempo']);
            $ep->gerenciaSegundosAssistidos($ep, $user);

        } elseif ($data['tipo'] == 'filme') {
            $movie = new Filme();
            $movie->setId($data['id']);
            $user->setId($data['usuario']);

            if(isset($data['tempo'])) $movie->setTempoAssistido($data['tempo']);

            $movie->gerenciaSegundosAssistidos($movie, $user);
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