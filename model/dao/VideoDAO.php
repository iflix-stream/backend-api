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
use util\Token;

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
        if ($video->getId() != null and $video->getNome() == null and $video->getGenero() == null) {
            return self::retreaveById($video);
        }

        if ($video->getNome() != null and $video->getId() == null and $video->getGenero() == null) {
            return self::retreaveByNome($video);
        }

        if ($video->getGenero() != null and $video->getId() == null and $video->getNome() == null) {
            return self::retreaveByGenero($video);
        }

        if ($video->getGenero() != null and $video->getNome() != null and $video->getId() == null) {
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
     * @return string
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
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro ID nulo.";
    }

    /**
     * @param Video $video
     * @return string
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
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro nome nulo.";
    }

    /**
     * @param Video $video
     * @return string
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
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro nome nulo.";
    }

    /**
     * @param Video $video
     * @return string
     */
    private static function retreaveByNomeEGenero($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);

        if ($video->getNome() == null) return "Parametro nome nulo.";
        if ($video->getGenero() == null) return "Parametro genero nulo.";
        if ($video->getGenero() == null && $video->getNome() == null) return "Parametros nome e genero nulos.";


        $restrictionNome = $criteria->restrictions()->like("nome", $video->getNome());
        $restrictionGenero = $criteria->restrictions()->equals("genero", $video->getGenero());
        $restrictionNomeEGenero = $criteria->restrictions()->and($restrictionNome, $restrictionGenero);
        $restrictionAtivado = $criteria->restrictions()->equals("ativado", "1");
        $restrictionAtivadoNomeGenero = $criteria->restrictions()->and($restrictionAtivado, $restrictionNomeEGenero);
        $criteria->add($restrictionAtivadoNomeGenero);
        $criteria->select();
        return $criteria->show();

    }

    static function retreaveRecomendados($video)
    {

    }

    /**
     * @param Video $video
     * @return string
     */
    static function delete($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $restrictionID = $criteria->restrictions()->equals("id", $video->getId());
        $criteria->add($restrictionID);
        if ($criteria->delete()) {
            return $criteria->show();
        }
        return "Erro ao deletar vídeo de ID: " . $video->getId();
    }

    /**
     * @param string $tipo
     * @param int $idVideo
     * @return string
     */
    public static function adicionarItemLista($tipo, $idVideo)
    {

        $token = new Token();
        $token->token();
        $userID = $token->retornaIdUsuario();
        $criteria = new Phiber();
        if ($tipo == "serie") {
            $criteria->setTable("minha_lista_serie");
            $criteria->setFields(["idUsuario", "idVideo"]);
            $criteria->setValues([$userID, $idVideo]);
        } else {

            $criteria->setTable("minha_lista_serie");
            $criteria->setFields(["idUsuario", "idVideo"]);
            $criteria->setValues([$userID, $idVideo]);
        }
        if ($criteria->create()) {
            return $criteria->show();
        }
        return "Erro ao adicionar item á lista do usuário:" . $userID;
    }

}