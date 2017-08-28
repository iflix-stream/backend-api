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
    private $url;

    function __construct($url = "")
    {
        $this->url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ($url != "") {
            $this->url = $url;
        }

        $class = "\\controller\\" . ucfirst($this->retornaClasseURL()) . "Controller";
        if (!class_exists($class)) {
            View::render(
                ["mensagem" =>
                    "Classe nao encontrada, favor passar uma classe valida pela URL"
                ]);
            return false;
        }
        $method = $_SERVER['REQUEST_METHOD'];
        $classe = new $class();
        switch ($method) {
            case 'GET':
                return $classe->get($this->retornaCamposeValoresFormatados());
                break;
            case 'POST':
                return $classe->post();
                break;
            case 'PUT':
                return $classe->put();
                break;
            case 'DELETE':
                return $classe->delete();
                break;
            default:
                echo "Nao implementado";
        }
    }


    private function retornaClasseURL()
    {
        $arrayUrl = explode("/", $this->url);
        return $arrayUrl[3];
    }

    public function retornaCamposeValoresFormatados()
    {
        $arrayUrl = explode("/", $this->url);
        $arrCamposEValoresSemFiltro = [];
        for ($i = 4; $i < count($arrayUrl); $i++) {
            $arrCamposEValoresSemFiltro[$i] = $arrayUrl[$i];
        }
        $arrCamposEValoresReindexado = array_values($arrCamposEValoresSemFiltro);

        $arrReturn = [];
        for ($j = 0; $j < count($arrCamposEValoresReindexado) - 1; $j++) {
            if ($arrCamposEValoresReindexado[$j + 1] != "") {
                $arrReturn[$arrCamposEValoresReindexado[$j]] = $arrCamposEValoresReindexado[$j + 1];
            }
        }

        return $arrReturn;
    }
}

new Api();
