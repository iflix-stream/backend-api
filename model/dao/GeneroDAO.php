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

class GeneroDAO implements IDAO
{

    /**
     * @param Genero $genero
     * @return bool
     */
    static function create($genero)
    {
        $phiber = new Phiber();
        $phiber->setTable('genero');
        $phiber->setFields(['nome']);
        $phiber->setValues([$genero->getNome()]);
        if ($phiber->create()) return true;
        return false;
    }


    /**
     * @param Genero $genero
     */
    static function retreave($genero)
    {
     $phiber = new Phiber();
     $phiber->setTable('genero');
     $phiber->add($phiber->restrictions->equals("genero_id", $genero->getId()));
     if($phiber->select()){
         return ["sql" => (string)$phiber->show()];
     }
        return ["sql" => (string)$phiber->show()];
    }

    static function update($video)
    {
        // TODO: Implement update() method.
    }

    static function delete($video)
    {
        // TODO: Implement delete() method.
    }
}