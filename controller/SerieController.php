<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 11/09/2017
 * Time: 21:37
 */

namespace controller;


use model\Serie;
use util\Mensagem;
use view\View;

class SerieController implements IController
{

    private $token;

    /**
     * SerieController constructor.
     */
    public function __construct()
    {
//        $this->token = new Token();
//        $this->token = $this->token->token();
    }

    public function post()
    {
        $serie = new Serie();
        $serie->cadastrar();

    }

    public function get($params = [])
    {
        $serie = new Serie();

        if (isset($this->token['usuario']->id)) {
            $serie->getUsuario()->setId($this->token['usuario']->id);
        }
        if (isset($_GET['user'])) {
            $serie->getUsuario()->setId($_GET['user']);
        }

        if (isset($params['id'])) $serie->setId($params['id']);
        if (isset($params['nome'])) $serie->setNome($params['nome']);
        if (isset($params['genero'])) $serie->setGenero($params['genero']);
        $data = (new Mensagem())->error('parametros-invalidos', 500);

        if (!isset($_GET['stream'])) $data = $serie->retreaveSeries();

        if (isset($_GET['stream']) and $_GET['stream'] == "true") {
            $serie->setId($_GET['id']);
            $serie->stream();
        }

        if (isset($_GET['q']) == 'ultimo-episodio') {

            $data = $serie->retreaveUltimoEpisodioAssistido();
        }

        if (isset($_GET['q']) == 'primeiro-episodio') {
            $data = $serie->retreavePrimeiroEpisodio();
        }

        View::render($data);
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        $video = new Serie();
        $data = [];
        if ($_GET['deleteItemLista'] == "true") {
            $data = $video->deleteItemLista();
        }
        View::render($data);
    }
}