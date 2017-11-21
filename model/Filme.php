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
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }


    /**
     * Filme constructor.
     */
    public function __construct()
    {
        $this->setTipo('filme');
        $this->usuario = new Usuario();
    }

    public function retreaveFilmes($de)
    {
        $filme = VideoDAO::retreave($this, $de);
        $movie = new Filme();
        for ($i = 0; $i < count($filme); $i++) {
            $movie->setId($filme[$i]['id']);
            $filme[$i]['tempoAssistido'] = VideoDAO::retreaveTempoAssistido(
                $movie,
                $this->usuario
            );
        }
        return $filme;
    }
}