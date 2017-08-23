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
<<<<<<< HEAD
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
=======
>>>>>>> 39fee9c02113b349fd53054ba4bcd523a166f95a

    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

<<<<<<< HEAD
    public function fazerUpload() {
        $salvar = new SalvarArquivo();
        return $salvar->salvaArquivo("Video","arquivo");;
=======
    public function listar()
    {
       return VideoDAO::retreave($this);
    }

    public function fazerUpload(){
        $salvar = new SalvarArquivo();
        $salvar->salvaArquivo("Video","arquivo");
>>>>>>> 39fee9c02113b349fd53054ba4bcd523a166f95a
    }
}