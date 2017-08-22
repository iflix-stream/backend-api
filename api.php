<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/08/2017
 * Time: 18:04
 */
namespace api;

include 'vendor/autoload.php';
use controller\VideoController;
class api
{
    public function __construct()
    {
        try {
            $array = explode('/',$_SERVER['REQUEST_URI']);
            $string= $array[2]."Controller"; // concatena o nome da url que vem com Controller
         //   VideoController::listar(); chama a controller normalmente
            eval($string."::listar();"); // tenta chamar a controller pela string que vem da url
        } catch (execption $e) {
            $e->getCode();
        }
    }

}
new api();
