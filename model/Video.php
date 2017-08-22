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
        $json = file_get_contents('php://input');// recebe tudo que vim da requisição
        $obj = (array)json_decode($json); // recebe em JSON e coloca no array

        $this->setNome($obj['nome']);
        $this->setDescricao($obj['descricao']);
        $this->setGenero($obj['genero']);
        $this->setFormato($obj['formato']);
        $this->setIdadeRecomendada($obj['idade_recomendada']);

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