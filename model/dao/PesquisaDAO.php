<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 24/11/2017
 * Time: 11:52
 */

namespace model\dao;


use model\Pesquisa;
use phiber\Phiber;

class PesquisaDAO implements IDAO
{

    private static $rows = 0;

    /**
     * @return mixed
     */
    public static function getRows()
    {
        return self::$rows;
    }


    /**
     * @param Pesquisa $object
     * @return mixed
     */
    static function create($object)
    {

        $phiber = new Phiber();
        $phiber->setTable('pesquisa');
        $phiber->setFields(['texto', 'contexto', 'usuario_id']);
        $phiber->setValues([
            $object->getTexto(),
            $object->getContexto(),
            $object->getUsuario()->getId()
        ]);

        return $phiber->create();

    }

    /**
     * @param Pesquisa $object
     * @return mixed
     */
    static function retreave($object)
    {
        $phiber = new Phiber();
        $phiber->setTable('pesquisa');
        $phiber->add($phiber->restrictions->limit(5));
        $phiber->add(
            $phiber->restrictions->and($phiber->restrictions->and(
                $phiber->restrictions->equals('usuario_id', $object->getUsuario()->getId()),
                $phiber->restrictions->equals('contexto', $object->getContexto())
            ), $phiber->restrictions->equals("ativada", "1"))
        );
        $phiber->add($phiber->restrictions->limit(5));
        $phiber->add($phiber->restrictions->orderBy(['data_hora desc']));
        return $phiber->select();


    }

    /**
     * @param Pesquisa $object
     * @return mixed
     */
    static function update($object)
    {
        $phiber = new Phiber();
        $phiber->setTable('pesquisa');
        $phiber->setFields(['ativada']);
        $phiber->setValues(["1"]);
        $restrictionID = $phiber->restrictions->equals("id", $object->getId());
        $phiber->add($restrictionID);
        if ($phiber->update()) {
            return true;
        }
        return false;
    }

    /**
     * @param Pesquisa $object
     * @return mixed
     */
    static function delete($object)
    {
        $phiber = new Phiber();
        $phiber->setTable('pesquisa');
        $phiber->setFields(['ativada']);
        $phiber->setValues([" 0"]);
        $restrictionID = $phiber->restrictions->equals("id", $object->getId());
        $phiber->add($restrictionID);
        if ($phiber->update()) {
            return true;
        }
        return false;
    }

    /**
     * @param Pesquisa $object
     * @return array
     */
    static function retreaveByNome(Pesquisa $object)
    {
        $phiber = new Phiber();
        $phiber->setTable('pesquisa');
        $res1 =
            $phiber->restrictions->and(
                $phiber->restrictions->equals('usuario_id', $object->getUsuario()->getId()),
                $phiber->restrictions->equals('contexto', $object->getContexto())
            );
        $res2 =
            $phiber->restrictions->and(
                $phiber->restrictions->equals("ativada", "1"),
                $phiber->restrictions->equals("texto", $object->getTexto())
            );
        $phiber->add($phiber->restrictions->and($res1, $res2));
        $phiber->add($phiber->restrictions->limit(5));
        $r = $phiber->select();
        self::$rows = $phiber->rowCount();
        return $r;
    }
}