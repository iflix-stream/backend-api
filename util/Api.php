<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 17:46
 */

namespace util;
include '../vendor/autoload.php';

use view\View;

class Api
{
    function __construct()
    {
        $class = "\\controller\\" . ucfirst($this->retornaClasseURL()) . "Controller";
        if (!class_exists($class)) {
            View::render(
                ["mensagem" =>
                    "Classe nao encontrada, favor passar uma classe valida pelo parametro"
                ]);
            return false;
        }
        return new $class();
    }

    public function retornaURL()
    {
        return "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    private function retornaClasseURL()
    {
        $arrayUrl = explode("/", $this->retornaURL());
        return $arrayUrl[3];
    }

    private function retornaCampoURL()
    {
        $arrayUrl = explode("/", $this->retornaURL());
        if (!isset($arrayUrl[4])) {
            return false;
        }
        return $arrayUrl[4];
    }

    private function retornaValorCampoURL()
    {
        $arrayUrl = explode("/", $this->retornaURL());
        if (!isset($arrayUrl[5])) {
            return false;
        }
        return $arrayUrl[5];
    }
}

new Api();