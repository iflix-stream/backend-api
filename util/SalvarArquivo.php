<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 22/08/2017
 * Time: 08:14
 */

namespace util;

use util\GerarData;

class SalvarArquivo
{
    public function salvaArquivo($pasta, $nome)
    {
        $data = self::getData();
        $dataEx = explode("/", $data);
        $diretorio = "../" . $pasta . "/" . $dataEx[1] . "-" . $dataEx[0];
        if (!isset($_FILES[$nome])) {
            return false;
        }
        else if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
        $arquivo = $_FILES[$nome];
        $destino = $diretorio . "/" . $arquivo['name'];
        $url = substr($diretorio, 2) . "/" . $arquivo['name'];
        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return false;
        }
        return $url;
    }

    public function getData()
    {
        $getData = new GerarData();
        return $getData->gerarDataHora();
    }
}