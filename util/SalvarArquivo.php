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
        $filename_path = md5(time() . uniqid());// salvar imagem
        $url = substr($diretorio, 2) . "/" . $filename_path;
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
        $arquivo = $_FILES[$nome];
        $arquivo['name'] = $filename_path;
        $destino = $diretorio . "/" . $arquivo['name'];
        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return $url;
        }
        return false;
    }

    public function getData()
    {
        $getData = new GerarData();
        return $getData->gerarDataHora();
    }
}