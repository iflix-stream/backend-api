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

    /**
     * Filme constructor.
     */
    public function __construct()
    {
        $this->setTipo('filme');
    }

    function adicionaLista() {
        VideoDAO::adicionarSerieLista("filme", $this);
    }
}