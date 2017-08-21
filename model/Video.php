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

class Video extends MediaFactory
{

    public function listar()
    {
        // TODO: Implement listar() method.
    }

    public function cadastrar()
    {
       VideoDAO::create($this);
    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

}

$v = new Video();
$v->setCaminho("dasdas");
$v->setDescricao("dsadasasddas");

$v->cadastrar();