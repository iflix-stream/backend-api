<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace model;
include '../vendor/autoload.php';
use dao\VideoDAO;
use util\SalvarArquivo;
class Video extends MediaFactory
{


    public function cadastrar()
    {

    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function listar()
    {
       return VideoDAO::retreave($this);
    }

    public function fazerUpload(){
        $salvar = new SalvarArquivo();
        $salvar->salvaArquivo("Video","arquivo");
    }
}