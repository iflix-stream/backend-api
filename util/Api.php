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
use controller\Controller;

class Api
{
    public static $url;

    function __construct($url = "")
    {
        self::$url = $url;
        if (isset($_SERVER['HTTP_HOST']) and isset($_SERVER['REQUEST_URI'])) {
            self::$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }

        $class = "\\controller\\" . ucfirst($this->retornaClasseURL()) . "Controller";
        if (!class_exists($class)) {
            View::render(
                ["mensagem" =>
                    "Classe nao encontrada, favor passar uma classe valida pela URL"
                ]);
            return false;
        }
        return $this->selecionaMetodo(new $class);
    }


    private function retornaClasseURL()
    {
        $arrayUrl = explode("/", self::$url);
        return $arrayUrl[3];
    }

    public function retornaCamposeValoresFormatados()
    {
        $arrayUrl = explode("/", self::$url);
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

    /**
     * @param Controller $classe
     * @return mixed
     */
    public function selecionaMetodo($classe)
    {
        $method = $_SERVER['REQUEST_METHOD'];
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
                return View::render(["mensagem" => "Método não implementado."]);
        }
    }
}
new Api();
