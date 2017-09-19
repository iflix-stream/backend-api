<?php
/**
 * Created by PhpStorm.
 * User: Luke
 * Date: 15/09/2017
 * Time: 20:49
 */

namespace model\dao;

use phiber\Phiber;
use model\Genero;
use util\Mensagem;

class GeneroDAO implements IDAO
{
    private static $linhas;

    /**
     * @return mixed
     */
    public static function getLinhas()
    {
        return self::$linhas;
    }

    /**
     * @param mixed $linhas
     */
    public static function setLinhas($linhas)
    {
        self::$linhas = $linhas;
    }

    /**
     * @param Genero $genero
     * @return bool
     */
    public static function create($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->setFields(['nome']);
        $phiber->setValues([$genero->getNome()]);
        if ($phiber->create()) {
            return $phiber->show();
        }
        return false;
    }


    /**
     * @param Genero $genero
     * @param string $de
     * @param string $ate
     * @return array
     */
    public static function retreave($genero, $de = "0", $ate = "20")
    {
        if ($genero->getId() == null and $genero->getNome() == null) {

            return self::retreaveParaPaginacao($de, $ate);
        }

        if ($genero->getId() != null and $genero->getNome() == null) {
            return self::retreaveById($genero);
        }

        if ($genero->getNome() != null and $genero->getId() == null) {
            return self::retreaveByNome($genero);
        }

        return (new Mensagem())->error("parametros-invalidos", 500);
    }


    /**
     * @param Genero $genero
     * @return array
     */
    public static function retreaveById($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->add($phiber->restrictions->equals("id", $genero->getId()));
        $phiber->add($phiber->restrictions->equals("status", '1'));
        return $phiber->select();


    }

    /**
     * @param Genero $genero
     * @return array
     */
    public static function retreaveByNome($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->add($phiber->restrictions->equals("status", '1'));
        $phiber->add($phiber->restrictions->like("nome", $genero->getNome()));
        $r = $phiber->select();
        self::$linhas = $phiber->rowCount();
        return $r;

    }

    /**
     * @param Genero $genero
     * @return bool
     */
    public static function update($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->add($phiber->restrictions->equals("id", $genero->getId()));
        if ($phiber->update()) {
            return true;
        }
        return false;
    }

    /**
     * @param Genero $genero
     * @return bool
     */
    public static function delete($genero)
    {
        $phiber = new Phiber($genero);
        $phiber->add($phiber->restrictions->equals("id", $genero->getId()));
        if ($phiber->update()) {

            return true;
        }
        return false;
    }

    public static function retreaveParaPaginacao($de = "0 ", $ate = "20")
    {
        $phiber = new Phiber();

        $phiber->add($phiber->restrictions->limit($ate));
        $phiber->add($phiber->restrictions->offset($de));
        $phiber->add($phiber->restrictions->equals("status", '1'));
        $phiber->setTable("genero");
        $phiber->returnArray(true);
        return $phiber->select();
    }
}