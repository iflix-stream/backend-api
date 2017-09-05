<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 16:25
 */

namespace model\dao;


use model\MinhaLista;
use model\Video;
use phiber\Phiber;
use util\Mensagem;

class VideoDAO implements IDAO
{

    /**
     * @var Video
     */
    private $video;

    function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * @param Video $video
     * @return string
     */
    public static function create($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $criteria->create();
        return $criteria->show();
    }

    /**
     * @param Video $video
     * @return string
     */
    public static function retreave($video)
    {
        if ($video->getId() != null and $video->getNome() == null and $video->getGenero() == null){
           return self::retreaveById($video);
        }

        if($video->getNome() != null and $video->getId() == null and $video->getGenero() == null) {
            return self::retreaveByNome($video);
        }

        if($video->getGenero() != null and $video->getId() == null and $video->getNome() == null) {
            return self::retreaveByGenero($video);
        }

        if($video->getGenero() != null and $video->getNome() != null and $video->getId() == null) {
            return self::retreaveByNomeEGenero($video);
        }
        return "Parametros invalidos";
    }

    /**
     * @param Video $video
     * @return bool
     */
    public static function update($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $restrictionID = $criteria->restrictions()->equals("id", $video->getId());

        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return true;
        }
        return false;
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveById($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        if ($video->getId() != null) {

            $restrictionID = $criteria->restrictions()->equals("id", $video->getId());
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", '1');
            $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
            $criteria->add($restrictionAtivadoID);

            return $criteria->select();
        }
        return (new Mensagem())->error("parametro-id-nulo",500);
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveByNome($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        if ($video->getNome() != null) {
            $restrictionNome = $criteria->restrictions()->like("nome", $video->getNome());
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", "1");
            $restrictionAtivadoNome = $criteria->restrictions()->and($restrictionAtivado, $restrictionNome);
            $criteria->add($restrictionAtivadoNome);
            return $criteria->select();
        }
        return (new Mensagem())->error("parametro-nome-nulo",500);
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveByGenero($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        if ($video->getGenero() != null) {
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", "1");
            $restrictionGenero = $criteria->restrictions()->equals("genero", $video->getGenero());
            $restrictionAtivadoGenero = $criteria->restrictions()->and($restrictionAtivado, $restrictionGenero);
            $criteria->add($restrictionAtivadoGenero);
            return $criteria->select();
        }
        return (new Mensagem())->error("parametro-genero-nulo", 500);
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveByNomeEGenero($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);

        if ($video->getNome() == null) return (new Mensagem())->error("parametro-nome-nulo", 500);
        if ($video->getGenero() == null) return (new Mensagem())->error("parametro-genero-nulo", 500);
        if ($video->getGenero() == null && $video->getNome() == null) return (new Mensagem())->error("parametro-nome-genero-nulo", 500);


        $restrictionNome = $criteria->restrictions()->like("nome", $video->getNome());
        $restrictionGenero = $criteria->restrictions()->equals("genero", $video->getGenero());
        $restrictionNomeEGenero = $criteria->restrictions()->and($restrictionNome, $restrictionGenero);
        $restrictionAtivado = $criteria->restrictions()->equals("ativado", "1");
        $restrictionAtivadoNomeGenero = $criteria->restrictions()->and($restrictionAtivado, $restrictionNomeEGenero);
        $criteria->add($restrictionAtivadoNomeGenero);

        return $criteria->select();

    }

    static function  retreaveRecomendados($video) {

    }

    /**
     * @param Video $video
     * @return array
     */
    static function delete($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $restrictionID = $criteria->restrictions()->equals("id", $video->getId());
        $criteria->add($restrictionID);
        if($criteria->delete()){
            return (new Mensagem())->success("sucesso-deletar-video");
        }
        return (new Mensagem())->error("erro-deletar-video", 500);
    }

    /**
     * @param MinhaLista $lista
     * @param Video $video
     */
    public static function adicionarItemLista($lista, $video){



        }
}