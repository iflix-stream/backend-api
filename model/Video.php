<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:57
 */

namespace model;

use model\dao\VideoDAO;
use util\Upload;
use util\VideoStream;

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
    private $tempoAssistido;

    /**
     * Video constructor.
     * @param $genero
     */


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
    public function getTempoAssistido()
    {
        return $this->tempoAssistido;
    }

    /**
     * @param mixed $tempoAssistido
     */
    public function setTempoAssistido($tempoAssistido)
    {
        $this->tempoAssistido = $tempoAssistido;
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
     * @return string Genero
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
       return VideoDAO::create($this);
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

        $stream = new VideoStream(dirname(__FILE__) . "/../video/" . $this->tipo . "/" . $this->id . ".mp4");
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
        $salvar = new Upload();
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

    /**
     * @param Video $video
     * @param Usuario $usuario
     */
    public function gerenciaSegundosAssistidos($video, $usuario) {

        VideoDAO::retreaveTempoAssistido($video, $usuario);
        if(VideoDAO::getRows() == 0) {
            VideoDAO::createSegundosAssistidos($video, $usuario);
        }else{
            VideoDAO::updateSegundosAssistidos($video,$usuario);
        }

    }
}