<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 23/11/2017
 * Time: 09:22
 */

namespace model;


use util\Arquivo;
use util\Settings;

class Avatar
{
    public function listar()
    {
        $file = new Arquivo();
        $file->setPath(Settings::SERVER_PATH . '/assets/avatares');
        return $file->toList()->getArrayCopy();
    }
}