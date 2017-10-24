<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 31/08/2017
 * Time: 12:30
 */

namespace model;


use model\dao\ListaDAO;
use util\IflixException;
use util\Mensagem;

class Lista
{

    private $usuario;
    private $video;

    /**
     * Lista constructor.
     * @param Usuario $usuario
     * @param Video $video
     */
    public function __construct($usuario, $video)
    {
        $this->usuario = $usuario;
        $this->video = $video;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function adicionar()
    {
        try {
            if ($this->isUsuarioJaAdicionou()) {
                if (ListaDAO::create($this)) {
                    return (new Mensagem())->success("sucesso-adicionar-minha-lista");

                }
            }
            return $this->remover();

        } catch (IflixException $exception) {
            return $exception->retornaJsonMensagem();
        }
    }

    public function remover()
    {
        if (ListaDAO::delete($this)) {
            return (new Mensagem())->success("sucesso-remover-minha-lista");
        }
        return (new Mensagem())->error("erro-adicionar-minha-lista");

    }

    private function isUsuarioJaAdicionou()
    {
        ListaDAO::retornaListaWhereVideoAndUsuario($this);
        if (ListaDAO::getRows() == 0) {
            return true;
        }
        return false;
    }

}