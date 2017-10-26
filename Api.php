<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 17:46
 */

include 'vendor/autoload.php';

use util\HeaderWriter;
use util\Mensagem;
use util\Settings;
use view\View;
use controller\IController;

class Api
{
    public static $url;

    function __construct($url = "")
    {
        new HeaderWriter();
        //-------Responsável pelo load das Settings-------\\
        Settings::load();

        //--------Responsável pelo REST--------\\
        self::$url = $url;
        if (isset($_SERVER['HTTP_HOST']) and isset($_SERVER['REQUEST_URI'])) {
            self::$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }

        $class = "\\controller\\" . ucfirst($this->retornaClasseURL()) . "Controller";

        if($classFiltrada = strstr($this->retornaClasseURL(), '?', true)) {
            $class = "\\controller\\" . ucfirst($classFiltrada) . "Controller";

        }
        if (!class_exists($class)) {
            View::render((new Mensagem())->error("class-not-found",404));
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
     * @param IController $classe
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

                return $classe->put($this->retornaCamposeValoresFormatados());
                break;
            case 'DELETE':
                return $classe->delete($this->retornaCamposeValoresFormatados());
                break;
            default:
                return View::render((new Mensagem())->error("method-not-found",404));
        }
    }
}
new Api();
