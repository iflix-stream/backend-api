<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace model;
use dao\VideoDAO;
use util\SalvarArquivo;
use view\View;
class Video extends MediaFactory
{

    private $classificacao;
    private $idiomas;
    private $genero;
    private $idiomasLegendas;

    /**
     * @return mixed
     */
    public function getClassificacao()
    {
        return $this->classificacao;
    }

    /**
     * @param mixed $classificacao
     */
    public function setClassificacao($classificacao)
    {
        $this->classificacao = $classificacao;
    }

    /**
     * @return mixed
     */
    public function getIdiomas()
    {
        return $this->idiomas;
    }

    /**
     * @param mixed $idiomas
     */
    public function setIdiomas($idiomas)
    {
        $this->idiomas = $idiomas;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getIdiomasLegendas()
    {
        return $this->idiomasLegendas;
    }

    /**
     * @param mixed $idiomasLegendas
     */
    public function setIdiomasLegendas($idiomasLegendas)
    {
        $this->idiomasLegendas = $idiomasLegendas;
    }


    public function cadastrar()
    {

         $json = file_get_contents('php://input');// recebe tudo que vim da requisição
         $obj = (array)json_decode($json); // recebe em JSON e coloca no array

         if(isset($obj['nome'])){
             $this->setNome($obj['nome']);
             $this->setDescricao($obj['descricao']);
             $this->setGenero($obj['genero']);
             $this->setFormato($obj['formato']);
             $this->setClassificacao($obj['idade_recomendada']);
         }
        else{
            $caminho = $this->fazerUpload();
            if (is_string($caminho)) {
                $this->setCaminho($caminho);
            } else {
                View::render(array("Mesagem"=>"Não foi possivel fazer o upload"));
            }
        }
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

    public function listar()
    {
       return VideoDAO::retreave($this);
    }

    public function fazerUpload()
    {
        $salvar = new SalvarArquivo();
        return $salvar->salvaArquivo("Video", "arquivo");
    }
}