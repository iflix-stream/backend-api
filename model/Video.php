<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace model;

use finfo;
use model\dao\VideoDAO;
use util\Arquivo;
use util\DataConversor;
use util\Mensagem;
use util\VideoStream;
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
    private $duracao;
    private $sinopse;
    private $thumbnail;

    /**
     * Video constructor.
     * @param $genero
     */
    public function __construct()
    {
        $this->genero = new Genero();
    }


    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param mixed $duracao
     */
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }

    /**
     * @return mixed
     */
    public function getSinopse()
    {
        return $this->sinopse;
    }

    /**
     * @param mixed $sinopse
     */
    public function setSinopse($sinopse)
    {
        $this->sinopse = $sinopse;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

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
     * @return Genero
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
        //Cadastrar e colocar o nome do vídeo para o ID, não esquecer de colocar subdiretorio filme/serie
        //Se caso não fazer o upload, deletar o filme/serie cadastrado do banco.
        $data = new DataConversor();
        $data = $data->converter();

        if (isset($data['upload'])) { // verifica se tem upload no post se tiver seta e salva se nao e porque ele quer colocar o link;
            VideoDAO::create($this);
        } else {
            $caminho = $this->fazerUpload();
            if (is_string($caminho)) {
                $this->setCaminho($caminho); // para setar o caminho tera que retornar o id do video inserido e atualizar com o caminho;
                if (VideoDAO::create($this)) // aki nao e create tem que dar update na tabela;
                    return array("mensagem" => "Upload feito com sucesso!");
            }

        }

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

    public function stream()
    {

        if (empty($this->id)) {
//            echo (new Mensagem())->error("parametro-id-nulo",500);
            die("Parametro ID nulo");
        }

        $stream = new VideoStream(dirname(__FILE__) . "/../video/" . $this->id . ".mp4");
        $stream->start();
    }

    public function retreaveLista()
    {

        return VideoDAO::newRetreaveLista();
    }

    public function listarRecomendados($idUsuario)
    {
//        return VideoDAO::retreaveLista();
    }

    public function fazerUpload($tipo, $nome)
    {
        $salvar = new Arquivo();
        return $salvar->salvar($tipo, $nome);
    }

    public function adicionarItemLista()
    {

        return VideoDAO::adicionarItemLista($this->getTipo(), $this->getId());
    }

    public function deleteItemLista()
    {
        return VideoDAO::deleteItemLista($this);


    }
}