<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:01
 */

namespace model;



use model\dao\VideoDAO;

class Filme extends Video
{

    private $usuario;

    /**
     * Filme constructor.
     */
    public function __construct()
    {
        $this->setTipo('filme');
        $this->usuario = new Usuario();
    }

    public function retreaveFilmes()
    {
        $filme = VideoDAO::retreave($this);


        return $filme;
    }
}