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
use phiber\bin\queries\Restrictions;
use phiber\Phiber;
use util\Mensagem;
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
        $phiber = new Phiber($video);
        if ($phiber->create()) return true;
        return false;
    }

    /**
     * @param Video $video
     * @return array
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
        return (new Mensagem())->error("parametros-invalidos", 500);
    }

    /**
     * @param Video $video
     * @return bool
     */
    public static function update($video)
    {
        $phiber = new Phiber($video);
        $restrictionID = $phiber->restrictions->equals("id", $video->getId());

        $phiber->add($restrictionID);
        if ($phiber->update()) {
            return true;
        }
        return false;
    }

    /**
     * @param Video $video
     * @return array
     */
    public static function retreaveById($video)
    {
        $phiber = new Phiber();

        if ($video->getId() != null) {

            $restrictionID = $phiber->restrictions->equals("id", $video->getId());
            $restrictionAtivado = $phiber->restrictions->equals("ativado", '1');
            $restrictionAtivadoID = $phiber->restrictions->and($restrictionAtivado, $restrictionID);
            $phiber->add($restrictionAtivadoID);
            $phiber->setTable("filme");
            if ($video->getTipo() == "serie") {
                $phiber->setTable("serie");
            }

            return $phiber->select();
        }
        return (new Mensagem())->error("parametro-nome-nulo", 500);
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveByNome($video)
    {
        $phiber = new Phiber();

        if ($video->getNome() != null) {
            $restrictionNome = $phiber->restrictions->like("nome", $video->getNome());
            $restrictionAtivado = $phiber->restrictions->equals("ativado", "1");
            $restrictionAtivadoNome = $phiber->restrictions->and($restrictionAtivado, $restrictionNome);
            $phiber->add($restrictionAtivadoNome);
            $phiber->setTable("filme");
            if ($video->getTipo() == "serie") {
                $phiber->setTable("serie");
            }
            return $phiber->select();
        }
        return (new Mensagem())->error("parametro-nome-nulo", 500);
    }

    /**
     * @param Video $video
     * @return array
     */
    private static function retreaveByGenero($video)
    {
        $phiber = new Phiber();

        if ($video->getGenero() != null) {
            $restrictionAtivado = $phiber->restrictions->equals("ativado", "1");
            $restrictionGenero = $phiber->restrictions->equals("genero", $video->getGenero());
            $restrictionAtivadoGenero = $phiber->restrictions->and($restrictionAtivado, $restrictionGenero);
            $phiber->add($restrictionAtivadoGenero);
            $phiber->setTable("filme");
            if ($video->getTipo() == "serie") {
                $phiber->setTable("serie");
            }

            return $phiber->select();
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

        if ($video->getNome() == null)
            return (new Mensagem())->error("parametro-nome-nulo", 500);
        if ($video->getGenero() == null)
            return (new Mensagem())->error("parametro-genero-nulo", 500);
        if ($video->getGenero() == null && $video->getNome() == null)
            return (new Mensagem())->error("parametro-nome-genero-nulo", 500);


        $restrictionNome = $phiber->restrictions->like("nome", $video->getNome());
        $restrictionGenero = $phiber->restrictions->equals("genero", $video->getGenero());
        $restrictionNomeEGenero = $phiber->restrictions->and($restrictionNome, $restrictionGenero);
        $restrictionAtivado = $phiber->restrictions->equals("ativado", "1");
        $restrictionAtivadoNomeGenero = $phiber->restrictions->and($restrictionAtivado, $restrictionNomeEGenero);
        $phiber->add($restrictionAtivadoNomeGenero);
        $phiber->setTable("filme");
        if ($video->getTipo() == "serie") {
            $phiber->setTable("serie");
        }
        return $phiber->select();

    }

    /**
     * @param $video
     */
    static function retreaveRecomendados($video)
    {

    }

    /**
     * @param Video $video
     * @return string
     */
    static function delete($video)
    {
        $phiber = new Phiber($video);
        $restrictionID = $phiber->restrictions->equals("id", $video->getId());
        $phiber->add($restrictionID);
        if ($phiber->delete()) {
            return true;
        }
        return false;
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

            $criteria->setTable("minha_lista_filme");
            $criteria->setFields(["idUsuario", "idVideo"]);
            $criteria->setValues([$userID, $idVideo]);
        }
        if ($criteria->create()) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */

    /**
     * @return array
     */
    public static function newRetreaveLista()
    {
        $token = new Token();
        $token->token();
        $userID = $token->retornaIdUsuario();
        $arrMinhaLista = [];
        $phiber = new Phiber();
        $phiber->setTable("minha_lista_serie");
        $phiber->setFields(["serie_id"]);
        $phiber->add($phiber->restrictions->equals("usuario_id", $userID));
        $idSerie = $phiber->select();
        $arrMinhaLista['series'] = $idSerie;
//        $test1 = $phiber->show();


        $phiber->setTable("minha_lista_filme");
        $phiber->setFields(["filme_id"]);
        $phiber->add($phiber->restrictions->equals("usuario_id", $userID));
        $idFilme = $phiber->select();
        $arrMinhaLista['filmes'] = $idFilme;
//        $test2 = $phiber->show();

        return $arrMinhaLista;
    }

    /**
     * @param Video $video
     */
    public static function deleteItemLista($video)
    {

        $token = new Token();
        $token->token();
        $userID = $token->retornaIdUsuario();

        $phiber = new Phiber();
        $pUserId = $phiber->restrictions->equals("usuario_id", $userID);
        $cond = $phiber->restrictions->equals("filme_id", $video->getId());
        $phiber->setTable("minha_lista_filme");

        if ($video->getTipo() == "serie") {
            $phiber->setTable("minha_lista_serie");
            $cond = $phiber->restrictions->equals("serie_id", $video->getId());
        }

        $phiber->add($phiber->restrictions->and($pUserId, $cond));
        if($phiber->delete()){
            return ["sql"=>$phiber->show()];
        }
        return false;
    }


}