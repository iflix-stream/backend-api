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
        if ($phiber->create()){
            return $phiber->show();
        }
        return false;
    }


    /**
     * @param Genero $genero
     */
    public static function retreave($genero)
    {
     $phiber = new Phiber();
     $phiber->setTable('genero');
     $phiber->add($phiber->restrictions->equals("id", $genero->getId()));

        return  $phiber->select();


    }

    /**
     * @param Genero $genero
     * @return array
     */
    public static function retreaveByNome($genero){
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->add($phiber->restrictions->like("nome", $genero->getNome()));
        if($phiber->select()){
            return ["sql" => (string)$phiber->show()];
        }
        return ["sql" => (string)$phiber->show()];
    }

    /**
     * @param Genero $genero
     */
    public static function update($genero)
    {
       $phiber = new Phiber();
       $phiber->setTable('genero');
       $phiber->add($phiber->restrictions->equals("id", $genero->getId()));
        if($phiber->update()){
            return true;
        }
        return false;
    }

    /**
     * @param Genero $genero
     */
    public static function delete($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->add($phiber->restrictions->equals("id", $genero->getId()));
        if($phiber->delete()){
            return true;
        }
        return false;
    }
}