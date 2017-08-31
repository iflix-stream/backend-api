<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace model;

use model\dao\VideoDAO;
use util\Arquivo;
use view\View;

class Video extends MediaFactory
{
    private $id;
    private $nome;
    private $descricao;
    private $classificacao;
    private $idiomas;
    private $genero;
    private $idiomasLegendas;
    private $tipo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

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

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    public function cadastrar()
    {

        $json = file_get_contents('php://input');// recebe tudo que vim da requisição
        $obj = (array)json_decode($json); // recebe em JSON e coloca no array

        if (isset($obj['nome'])) {
            $this->setNome($obj['nome']);
            $this->setDescricao($obj['descricao']);
            $this->setGenero($obj['genero']);
            $this->setFormato($obj['formato']);
            $this->setClassificacao($obj['idade_recomendada']);
        } else {
            $caminho = $this->fazerUpload();
            if (is_string($caminho)) {
                $this->setCaminho($caminho);
                if(VideoDAO::create($this))
                return array("mensagem" => "Upload feito com sucesso!");
            }

        }

        return array("mensagem" => "Não foi possivel fazer o upload");
    }

    public function deletar()
    {
        return VideoDAO::delete($this);
    }

    public function alterar()
    {
        return VideoDAO::update($this);
    }

    public function listar()
    {
        return VideoDAO::retreave($this);
    }

    public function stream() {

    }

    public function listarRecomendados($idUsuario) {

    }

    public function fazerUpload()
    {
        $salvar = new Arquivo();
        return $salvar->salvar("Video", "arquivo");
    }
}