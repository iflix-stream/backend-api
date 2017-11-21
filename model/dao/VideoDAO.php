<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 16:25
 */

namespace model\dao;


use model\MinhaLista;
use model\Serie;
use model\Usuario;
use model\Video;
use PDO;
use phiber\Phiber;
use util\Mensagem;
use util\Token;

class VideoDAO implements IDAO
{

    /**
     * @var Video
     */
    private $video;
    public static $rows;

    function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public static function getRows()
    {
        return self::$rows;
    }


    /**
     * @param Video $video
     * @return array
     */
    public static function create($video)
    {
        $phiber = new Phiber();
        if ($video->getTipo() == 'filme') {
            $phiber->setTable('filme');
        } else {
            $phiber->setTable('serie');
        }
        $phiber->setFields(['nome', 'classificacao', 'caminho', 'duracao', 'sinopse', 'thumbnail', 'genero_id']);
        $phiber->setValues([$video->getNome(), $video->getClassificacao(),
            $video->getCaminho(), $video->getDuracao(), $video->getSinopse(), $video->getThumbnail(), $video->getGenero()]);

        return ["id"=>$phiber->create()];

    }

    /**
     * @param Video $video
     * @param string $de
     * @param string $ate
     * @return array
     */
    public static function retreave($video, $de = '0 ', $ate = '20')
    {

        if ($video->getId() == null and $video->getNome() == null and $video->getGenero() == null) {
            return self::retreaveParaPaginacao($video, $de, $ate);
        }

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
            $restrictionAtivado = $phiber->restrictions->equals("status", '1');
            $restrictionAtivadoID = $phiber->restrictions->and($restrictionAtivado, $restrictionID);
//            $phiber->returnArray(true);
            $phiber->add($restrictionAtivadoID);
            $phiber->setTable("filme");
            if ($video->getTipo() == "serie") {
                $phiber->setTable("serie");
            }
            $phiber->returnArray(true);
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
            $restrictionAtivado = $phiber->restrictions->equals("status", "1");
            $restrictionAtivadoNome = $phiber->restrictions->and($restrictionAtivado, $restrictionNome);
            $phiber->add($restrictionAtivadoNome);
            $phiber->setTable("filme");
            if ($video->getTipo() == "serie") {
                $phiber->setTable("serie");
            }
            $phiber->returnArray(true);
            return $phiber->select();
        }
        return (new Mensagem())->error("parametro-nome-nulo", 500);
    }

    /**
     * @param Video $video
     * @param string $de
     * @param string $ate
     * @return array
     */
    private static function retreaveByGenero($video, $de = ' 0', $ate = '20')
    {
        $phiber = new Phiber();

        if ($video->getGenero() != null) {

            $sql = "SELECT filme.id AS id, filme.nome AS nome, classificacao, caminho, duracao, sinopse,
 thumbnail, filme.status, genero_id, genero.nome AS genero_nome FROM filme INNER JOIN genero ON genero.id = genero_id
  WHERE filme.status = :condition_status AND genero_id = :cond_genero
  OR genero.nome = :cond_genero  LIMIT $ate OFFSET $de;";

            if ($video->getTipo() == "serie") {
                $sql = "SELECT serie.id as id, serie.nome as nome, classificacao,
                sinopse, thumbnail, serie.status, genero_id, genero.nome as genero_nome FROM serie INNER JOIN genero ON genero.id = genero_id
                 WHERE serie.status = :condition_status AND WHERE filme.status = :condition_status AND genero_id = :cond_genero
  OR genero.nome = :cond_genero LIMIT $ate OFFSET $de ;";

            }
            $phiber->writeSQL($sql);
            $phiber->bindValue("cond_genero", $video->getGenero());
            $phiber->bindValue("condition_status", 1);
            $phiber->execute();
            return $phiber->fetchAll();
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
        $restrictionAtivado = $phiber->restrictions->equals("status", "1");
        $restrictionAtivadoNomeGenero = $phiber->restrictions->and($restrictionAtivado, $restrictionNomeEGenero);
        $phiber->add($restrictionAtivadoNomeGenero);
        $phiber->setTable("filme");
        if ($video->getTipo() == "serie") {
            $phiber->setTable("serie");
        }
        $phiber->returnArray(true);
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

        $userID = (new Token())->retornaIdUsuario();
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
    public static function newRetreaveLista()
    {

        $userID = (new Token())->retornaIdUsuario();

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
     * @return array
     */
    public static function deleteItemLista($video)
    {

        $userID = (new Token())->retornaIdUsuario();

        $phiber = new Phiber();
        $pUserId = $phiber->restrictions->equals("usuario_id", $userID);
        $cond = $phiber->restrictions->equals("filme_id", $video->getId());
        $phiber->setTable("minha_lista_filme");

        if ($video->getTipo() == "serie") {
            $phiber->setTable("minha_lista_serie");
            $cond = $phiber->restrictions->equals("serie_id", $video->getId());
        }

        $phiber->add($phiber->restrictions->and($pUserId, $cond));
        if ($phiber->delete()) {
            return ["sql" => $phiber->show()];
        }
        return ["sql" => (string)$phiber->show()];
    }

    public static function retreaveTemporadas($idSerie)
    {
        $phiber = new Phiber();
        $phiber->setTable('temporada');
        $phiber->setFields(["id", "numero"]);
//        $phiber->setFields(['temporada.serie_id as temp_serie_id',]);
//        $phiber->add($phiber->restrictions->join('episodio',['temporada.id','temporada_id']));
        $phiber->add($phiber->restrictions->equals("serie_id", $idSerie));
        $phiber->returnArray(true);
        $r = $phiber->select();

        return $r;

    }

    public static function retreaveEpisodios($idTemporada)
    {
        $phiber = new Phiber();
        $phiber->writeSQL("SELECT id,nome,sinopse,duracao,caminho FROM episodio WHERE temporada_id = :temporada_id");
        $phiber->bindValue("temporada_id", $idTemporada);
        $phiber->execute();
//        $phiber->setTable('episodio');
//        $phiber->setFields(['id', 'nome', 'sinopse', 'duracao', 'caminho']);
//        $phiber->add($phiber->restrictions->equals("temporada_id", $idTemporada));
//        $phiber->returnArray(true);
//        $r = $phiber->select();
        return $phiber->fetchAll();
    }

    /**
     * @param Video $video
     * @param string $de
     * @param string $ate
     * @return array
     */
    public static function retreaveParaPaginacao($video, $de = '0', $ate = '20')
    {
        $phiber = new Phiber();

        $sql = "SELECT filme.id AS id, filme.nome AS nome, classificacao, caminho, duracao, sinopse,
 thumbnail, filme.status, genero_id, genero.nome AS genero_nome FROM filme INNER JOIN genero ON genero.id = genero_id WHERE
 filme.status = :condition_status LIMIT 12,10";

        if ($video->getTipo() == "serie") {
            $sql = "SELECT serie.id as id, serie.nome as nome, classificacao,
                sinopse, thumbnail, serie.status, genero_id, genero.nome as genero_nome FROM serie INNER JOIN genero ON genero.id = genero_id WHERE
 serie.status = :condition_status LIMIT 20 OFFSET $de ;";

        }
        $phiber->writeSQL($sql);
        $phiber->bindValue("condition_status", 1);
        $phiber->execute();
        return $phiber->fetchAll();

    }

    /**
     * @param Video $video
     * @param Usuario $usuario
     * @return mixed
     */
    public static function retreaveTempoAssistido($video, $usuario)
    {
        $phiber = new Phiber();
        $phiber->writeSQL(
            "SELECT tempo FROM "
            . $video->getTipo() . "_assistido WHERE usuario_id = :usuario_id AND " . $video->getTipo() . "_id = :video_id"
        );

        $phiber->bindValue('usuario_id', $usuario->getId());
        $phiber->bindValue('video_id', $video->getId());
        $phiber->execute();
        $r = $phiber->fetch(PDO::FETCH_ASSOC)['tempo'];
        self::$rows = $phiber->rowCount();
        return $r != null ? $r : 0;
    }

    /**
     * @param Video $video
     * @param Usuario $usuario
     * @return string
     */
    public static function createSegundosAssistidos($video, $usuario)
    {
        $phiber = new Phiber($video);

        $phiber->setTable($video->getTipo() . "_assistido");
        $phiber->setFields(['usuario_id', $video->getTipo() . "_id", 'tempo']);
        $phiber->setValues([$usuario->getId(), $video->getId(), $video->getTempoAssistido()]);

        return $phiber->create();
    }

    /**
     * @param Video $video
     * @param Usuario $usuario
     * @return string
     */
    public static function updateSegundosAssistidos($video, $usuario)
    {
        $phiber = new Phiber($video);

        $phiber->setTable($video->getTipo() . "_assistido");
        $phiber->setFields(['tempo']);
        $phiber->setValues([$video->getTempoAssistido()]);
        $resUsuario = $phiber->restrictions->equals('usuario_id', $usuario->getId());
        $resVideo = $phiber->restrictions->equals($video->getTipo() . '_id', $video->getId());
        $resAnd = $phiber->restrictions->and($resUsuario, $resVideo);
        $phiber->add($resAnd);

        return $phiber->update();
    }

//    /**
//     * @param Video $video
//     * @param Usuario $usuario
//     * @return array
//     */
//    public static function retraveSegundosAssistidos($video, $usuario)
//    {
//        $phiber = new Phiber($video);
//
//        $phiber->setTable($video->getTipo() . "_assistido");
//        $restricutionUsuario = $phiber->restrictions->equals('usuario_id', $usuario->getId());
//        $restricutionVideo = $phiber->restrictions->equals($video->getTipo() . '_id', $usuario->getId());
//        $phiber->add($phiber->restrictions->and($restricutionUsuario,$restricutionVideo));
//        return $phiber->select();
//    }

    /**
     * @param Serie $serie
     * @param Usuario $usuario
     * @return mixed
     */
    public static function ultimoEpisodioAssistido(Serie $serie, Usuario $usuario)
    {
        $phiber = new Phiber();
        $phiber->writeSQL(
            "
            SELECT
              episodio_id as id,
              tempo as tempoAssistido,
              caminho
            FROM episodio_assistido
            INNER JOIN episodio ON episodio_assistido.episodio_id = episodio.id
            WHERE usuario_id = :condition_usuario_id AND serie_id = :condition_serie_id ORDER BY dataAlteracao DESC LIMIT 1;");

        $phiber->bindValue("condition_usuario_id", $usuario->getId());
        $phiber->bindValue("condition_serie_id", $serie->getId());
        $phiber->execute();
        self::$rows = $phiber->rowCount();
        return $phiber->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param Serie $serie
     * @return mixed
     */
    public static function primeiroEpisodio(Serie $serie)
    {
        $phiber = new Phiber();
        $phiber->writeSQL(
            "
            SELECT *
            FROM episodio
            
            WHERE serie_id = :condition_serie_id ORDER BY numero asc LIMIT 1;");

        $phiber->bindValue("condition_serie_id", $serie->getId());
        $phiber->execute();
        self::$rows = $phiber->rowCount();
        return $phiber->fetch(PDO::FETCH_ASSOC);
    }


}