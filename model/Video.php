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
       /*  if(is_string($this->fazerUpload())){  funcao para ir para outra classe para salvar a img
             $campos = file_get_contents('php://input');
             var_dump($campos);
         }*/
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

    public function fazerUpload()
    {
        $salvar = new SalvarArquivo();
        return $salvar->salvaArquivo("Video", "arquivo");
    }
    public function listar()
    {
       return VideoDAO::retreave($this);
    }

}