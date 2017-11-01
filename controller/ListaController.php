<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/10/2017
 * Time: 20:19
 */

namespace controller;


use InvalidArgumentException;
use model\Filme;
use model\Lista;
use model\Usuario;
use model\Video;
use util\DataConversor;
use view\View;

class ListaController implements IController
{

    /**
     * @var Usuario Usuario
     */
    private $usuario;

    /**
     * @var Video Video
     */
    private $video;

    /**
     * @var array|string
     */
    private $data;

    /**
     * ListaController constructor.
     */
    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->video = new Filme();
        $this->data = (new DataConversor())->converter();

    }


    public function post()
    {
        if (isset($this->data['tipo'])) {
            $class = "\\model\\" . ucfirst($this->data['tipo']);
            $this->video = new $class;
        }
        $parametrosEsquecidos = "";
        if (!isset($this->data['tipo'])) {
            $parametrosEsquecidos .= "tipo ";
        }

        if (!isset($this->data['usuario'])) {
            $parametrosEsquecidos .= "usuario ";
        }

        if (!isset($this->data['id'])) {
            $parametrosEsquecidos .= "id ";
        }
        if ($parametrosEsquecidos != "") {
            throw new InvalidArgumentException(
                "Parâmetro/s " . str_replace(" ", ", ", $parametrosEsquecidos) . " não passado/s"
            );

        }
        $this->usuario->setId($this->data['usuario']);
        $this->video->setId($this->data['id']);
        $list = new Lista($this->usuario, $this->video);
        View::render($list->adicionar());


    }

    public function get($params = [])
    {

        isset($params['usuario']) ? $this->usuario->setId($params['usuario']) : null;
        isset($params['id']) ? $this->video->setId($params['id']) : null;
        isset($params['tipo']) ? $this->video->setTipo($params['tipo']) : null;

        $list = new Lista($this->usuario, $this->video);
        if (isset($_GET['q'])) {
            switch ($_GET['q']) {
                case 'is-added':
                    $list->isUsuarioJaAdicionou()
                        ? View::render(["isAdicionado" => true])
                        : View::render(["isAdicionado" => false]);
                    break;

                case 'my':
                    View::render($list->retreaveListaUsuario());
                    break;
            }
        }

    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
    }


}