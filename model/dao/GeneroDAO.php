<?php
/**
 * Created by PhpStorm.
 * User: Luke
 * Date: 15/09/2017
 * Time: 20:49
 */

namespace model\dao;

use phiber\Phiber;

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

    static function retreave($video)
    {
        // TODO: Implement retreave() method.
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